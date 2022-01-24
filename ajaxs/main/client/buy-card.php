<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    require('../../../api_3rd/napthe365-buy-card.php');
    
    if(!empty($JTech->setting('email_napthe365')) && !empty($JTech->setting('password_napthe365')) && !empty($JTech->setting('security_napthe365'))) { 
        if($JTech->checkToken('request')){
            $telco = xss($_POST['telco']);
            $price = intval($_POST['price']);
            $amount = intval($_POST['amount']);

            $validate = validateForm(['telco', 'price', 'amount']);

            if($validate) {
                if($amount > $JTech->setting('max_amount_buy_card')) {
                    die(jsonResponse("Tối đa mua ".$JTech->setting('max_amount_buy_card')." thẻ trong một lần", false));
                }

                $total_pay = $price * $amount;
                
                if($total_pay > $JTech->user('cash')) {
                    die(jsonResponse(not_enough_cash, false));
                }

                $format_card = typeTelco($telco).':'.$price.':'.$amount;
                $api = buycard($JTech->setting('email_napthe365'), $JTech->setting('password_napthe365'), $JTech->setting('security_napthe365'), $format_card);
                $data = json_decode($api, true);

                if($data['errorCode'] == 0) {
                    $order_code = rand_string(14); // MÃ ĐƠN HỆ THỐNG
                    
                    // TRỪ TIỀN TÀI KHOẢN
                    $JTech->db_query("UPDATE `users` SET `cash` = `cash` - '$total_pay' WHERE `username` = '".$JTech->user('username')."' ");
                    
                    // TẠO ĐƠN
                    $JTech->db_query("INSERT INTO `buy-card-order` SET
                    `order_code` = '$order_code',
                    `username` = '".$JTech->user('username')."',
                    `telco` = '$telco',
                    `amount` = '$amount',
                    `price` = '$price',
                    `total_pay` = '$total_pay',
                    `created_time` = '".time()."'
                    ");


                    $list_card = json_decode($data['Data'], true);
                    foreach($list_card as $card) {
                        $pin = $card['PinCode'];
                        $telco_ = $card['Telco'];
                        $serial = $card['Serial'];
                        $amount = $card['Amount'];
                        $trace = $card['Trace']; // MÃ GIAO DỊCH BÊN THỨ 3

                        $JTech->db_query("INSERT INTO `buy-card-data` SET
                        `order_code` = '$order_code',
                        `trace_3rd` = '$trace',
                        `telco` = '$telco',
                        `price` = '$price',
                        `pin` = '$pin',
                        `serial` = '$serial'
                        ");
                    }

                    if($JTech->setting('nofication_buy_card') == 'yes') {
                        sendTele(templateTele($JTech->user('username')." mua $amount thẻ $telco ".number_format($price)."đ"));
                    }

                    $res['status'] = true;
                    $res['message'] = success_purchase;
                    $res['order_code'] = $order_code;
                    die(json_encode($res));

                } else if($data['errorCode'] == 5) {
                    die(jsonResponse("Hệ thống hiện tại hết thẻ cho nhà mạng này, thử lại sau.", false));
                } else {
                    die(jsonResponse("Liên hệ zalo 0968507339 để mua thẻ, hoặc lh https://www.facebook.com/hieuvip22code/  thanks  #".$data['errorCode'], false));
                }
            }
        }else{
            die(jsonResponse(login_required, false));
        }
    }else{
        die(jsonResponse(maintenance_msg, false));
    }