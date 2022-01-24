<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    require('../../../api_3rd/napthe365-topup.php');
    
    if(!empty($JTech->setting('email_napthe365')) && !empty($JTech->setting('password_napthe365')) && !empty($JTech->setting('security_napthe365'))) { 
        if($JTech->checkToken('request')){
            $dial = xss($_POST['telco']);
            $price = intval($_POST['price']);
            $phone = xss($_POST['phone']);

            $validate = validateForm(['dial', 'price', 'phone']);

            if($validate) {

                if(!validPhone($phone)) {
                    die(jsonResponse("Trường phone định dạng không hợp lệ.", false));
                }

                if($price > $JTech->user('cash')) {
                    die(jsonResponse(not_enough_cash, false));
                }

                if($dial == 'tratruoc') {
                    $dial_ = 'TT';
                }else{
                    $dial_ = 'TS';
                }
                
                $format_card = $phone.':'.$price.':'.$dial_;
                $api = naptien($JTech->setting('email_napthe365'), $JTech->setting('password_napthe365'), $JTech->setting('security_napthe365'), $format_card);
                $data = json_decode($api, true);
                
                if($data['errorCode'] == 0) {
                    $order_code = rand_string(14); // MÃ ĐƠN HỆ THỐNG
                    
                    // TRỪ TIỀN TÀI KHOẢN
                    $JTech->db_query("UPDATE `users` SET `cash` = `cash` - '$price' WHERE `username` = '".$JTech->user('username')."' ");
                    
                    // TẠO ĐƠN
                    $JTech->db_query("INSERT INTO `topup-mobile` SET
                    `order_code` = '$order_code',
                    `username` = '".$JTech->user('username')."',
                    `dial` = '$dial_',
                    `phone` = '$phone',
                    `price` = '$price',
                    `created_time` = '".time()."'
                    ");

                    if($JTech->setting('nofication_topup') == 'yes') {
                        sendTele(templateTele($JTech->user('username')." nạp ".number_format($price)."đ cho SĐT $phone ($dial)"));
                    }

                    die(jsonResponse(success_purchase, true));

                }else if($data['errorCode'] == 26) {
                    die(jsonResponse("Nhà mạng này không được hỗ trợ", false));
                }else{
                    die(jsonResponse("Giao dịch không thành công #".$data['errorCode'], false));
                }
            }
        }else{
            die(jsonResponse(login_required, false));
        }
    }else{
        die(jsonResponse(maintenance_msg, false));
    }