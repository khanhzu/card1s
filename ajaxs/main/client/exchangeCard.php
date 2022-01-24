<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('request')){
        // KIỂM THẺ
        
        $list_item = "";
    
        foreach($_POST['data'] as $data) {
            $telco = xss($data['telco']);
            $pin = xss($data['pin']);
            $serial = xss($data['serial']);
            $amount = intval($data['amount']);

            if(!$telco || !$pin || !$serial || !$amount) {
                die('<div class="alert alert-danger">Thông tin gửi lên chưa đủ, vui lòng kiểm tra lại.</div>');
            }else{
                $info = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `card-data` WHERE `pin` = '$pin' OR `serial` = '$serial' "));
                $telco_data = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `telco-rate` WHERE `telco` = '$telco' "));

                if(!$telco_data) {
                    $list_item .= '<li>Serial '.$serial.': Không xác định được nhà mạng</li>';
                } else if(!array_key_exists($amount, amount_data())) {
                    $list_item .= '<li>Serial '.$serial.': Không xác định được mệnh giá</li>';
                } else if($info) {
                    $list_item .= '<li>Serial '.$serial.': Dữ liệu thẻ đã tồn tại</li>';
                } else if(check_spam($JTech->user('username'))) {
                    die('<div class="alert alert-danger">Đổi thẻ cào không khả dụng bây giờ, thử lại vào ngày mai.</div>');
                } else {
                    $request_id = rand_string(11);
                    $amount_recieve = getRecieve($telco, $amount, $JTech->user('rank'));

                    $data = serverExCard($telco, $pin, $serial, $amount, $request_id);

                    if($data['status'] == 'success') {

                        $JTech->db_query("INSERT INTO `card-data` SET
                        `server` = '".$JTech->setting('server_ex_card')."',
                        `request_id` = '$request_id',
                        `username` = '".$JTech->user('username')."',
                        `telco` = '$telco',
                        `pin` = '$pin',
                        `serial` = '$serial',
                        `amount` = '$amount',
                        `amount_real` = '$amount',
                        `amount_recieve` = '$amount_recieve',
                        `status` = 'wait',
                        `created_time` = '".time()."',
                        `day` = '".date('d')."',
                        `month` = '".date('m')."',
                        `year` = '".date('Y')."'
                        ");

                        $list_item .= '<li>Serial '.$serial.': Gửi thẻ thành công, chờ xử lý</li>';
                    } else {
                        $list_item .= '<li>Serial '.$serial.': '.$data['message'].'</li>';
                    }
                }
            }
        }
        
        echo '<div class="alert alert-danger">';
        echo '<ul>';
        echo $list_item;
        echo '</ul>';
        echo '</div>';
    }else{
        die('<div class="alert alert-danger">Bạn chưa đăng nhập, vui lòng đăng nhập <a href="/account/login">tại đây</a></div>');
    }