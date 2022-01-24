<?php
    header('Content-Type: application/json');

    require('../core/database.php');
    require('../core/function.php');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $headers = apache_request_headers();
        $partner_id = xss($headers['partner_id']);
        $partner_key = xss($headers['partner_key']);

        $info_api = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `api-partner` WHERE `partner_id` = '$partner_id' AND `partner_key` = '$partner_key' AND `status` = 'active' "));

        if($info_api) {

            $request_id = xss($_GET['request_id']);
            $telco = xss($_GET['telco']);
            $pin = xss($_GET['pin']);
            $serial = xss($_GET['serial']);
            $amount = intval($_GET['amount']);

            if(!$telco || !$pin || !$serial || !$amount || !$request_id || strlen($request_id) > 30) {
                die(jsonPretty(array(
                    "status" => "fail",
                    "message" => "Dữ liệu đầu vào không hợp lệ"
                )));
            }else{
                $info = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `card-data` WHERE `pin` = '$pin' OR `serial` = '$serial' "));
                $info_rq_id = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `card-data` WHERE `request_id` = '$request_id' AND `username` = '".$info_api['username']."' "));
                $telco_data = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `telco-rate` WHERE `telco` = '$telco' "));

                if(!$telco_data) {
                    die(jsonPretty(array(
                        "status" => "fail",
                        "message" => "Không xác định được nhà mạng"
                    )));
                } else if(!array_key_exists($amount, amount_data())) {
                    die(jsonPretty(array(
                        "status" => "fail",
                        "message" => "Không xác định được mệnh giá"
                    )));
                } else if($info_rq_id) {
                    die(jsonPretty(array(
                        "status" => "fail",
                        "message" => "Request ID này đã tồn tại"
                    )));
                } else if($info) {
                    die(jsonPretty(array(
                        "status" => "fail",
                        "message" => "Dữ liệu thẻ đã tồn tại"
                    )));
                } else if(check_spam($info_api['username'])) {
                    die(jsonPretty(array(
                        "status" => "fail",
                        "message" => "API không khả dụng bây giờ, thử lại vào ngày mai"
                    )));
                } else {
                    $amount_recieve = getRecieve($telco, $amount, $JTech->getUser($info_api['username'], "rank"));

                    $data = serverExCard($telco, $pin, $serial, $amount, $request_id);

                    if($data['status'] == 'success') {

                        $JTech->db_query("INSERT INTO `card-data` SET
                        `server` = '".$JTech->setting('server_ex_card')."',
                        `request_id` = '$request_id',
                        `partner_key` = '$partner_key',
                        `username` = '".$info_api['username']."',
                        `telco` = '$telco',
                        `pin` = '$pin',
                        `serial` = '$serial',
                        `amount` = '$amount',
                        `amount_recieve` = '$amount_recieve',
                        `callback` = '".$info_api['callback_url']."',
                        `status` = 'wait',
                        `created_time` = '".time()."',
                        `day` = '".date('d')."',
                        `month` = '".date('m')."',
                        `year` = '".date('Y')."'
                        ");

                        die(jsonPretty(array(
                            "status" => "success",
                            "message" => "Gửi thẻ thành công, chờ xử lý"
                        )));
                    } else if($data['status'] == 'wrong_amount') {
                        
                        $JTech->db_query("INSERT INTO `card-data` SET
                        `server` = '".$JTech->setting('server_ex_card')."',
                        `request_id` = '$request_id',
                        `partner_key` = '$partner_key',
                        `username` = '".$info_api['username']."',
                        `telco` = '$telco',
                        `pin` = '$pin',
                        `serial` = '$serial',
                        `amount` = '$amount',
                        `amount_recieve` = '0',
                        `callback` = '".$info_api['callback_url']."',
                        `status` = 'wrong_amount',
                        `created_time` = '".time()."',
                        `day` = '".date('d')."',
                        `month` = '".date('m')."',
                        `year` = '".date('Y')."'
                        ");

                        die(jsonPretty(array(
                            "status" => "fail",
                            "message" => "Thẻ đúng nhưng sai mệnh giá, vui lòng liên hệ ADMIN"
                        )));
                   } else {
                        die(jsonPretty(array(
                            "status" => "fail",
                            "message" => $data['message']
                        )));
                    }
                }
            }
        }else{
            die(jsonPretty(array(
                "status" => "fail",
                "message" => "Đối tác API không tồn tại hoặc chưa được kích hoạt"
            )));
        }
    }else{
        die(jsonPretty(array(
            "status" => "fail",
            "message" => "Phương thức Không cho phép"
        )));
    }
    

?>