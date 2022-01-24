<?php
    require('../core/database.php');
    require('../core/function.php');


   if(isset($_GET['status']) && isset($_GET['request_id'])) {
        $status = $_GET['status'];
        $request_id = $_GET['request_id'];
        $telco = $_GET['telco']; // NHÀ MẠNG
        $pin = $_GET['pin']; // MÃ THẺ
        $serial = $_GET['serial']; // SERIAL
        $amount = intval($_GET['amount']); // MỆNH GIÁ GỬI
        $amount_real = intval($_GET['amount_real']); // MỆNH GIÁ THỰC
        $amount_recieve = intval($_GET['amount_recieve']); // SỐ TIỀN NHẬN ĐƯỢC



        $info_card = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `card-data` WHERE `request_id` = '$request_id' AND `status` = 'wait' AND `pin` = '$pin' AND `serial` = '$serial' "));
     
        if($info_card) {
            
            if($status == 'success') {
                $JTech->db_query("UPDATE `card-data` SET 
                `status` = 'success',
                `profit` = '".getProfit($info_card['amount'], $info_card['amount_recieve'], getPercent($telco, $JTech->getUser($info_card['username'], 'rank'), $info_card['amount']))."' 
                WHERE `request_id` = '$request_id' 
                ");

                $JTech->db_query("UPDATE `users` SET 
                `cash` = `cash` + '".$info_card['amount_recieve']."' 
                WHERE `username` = '".$info_card['username']."' 
                ");
                
                if(!empty($info_card['callback'])) {
                    $response = curlGet($info_card['callback']."?status=success&request_id=$request_id&telco=$telco&pin=$pin&serial=$serial&amount=$declared_value&amount_real=$value&amount_recieve=".$info_card['amount_recieve']);
                    
                    $JTech->db_query("UPDATE `card-data` SET 
                    `callback_response` = '$response' 
                    WHERE `request_id` = '$request_id' 
                    ");
                    
                    $JTech->db_query("UPDATE `api-partner` SET 
                    `last_used` = '".time()."' 
                    WHERE `partner_key` = '".$info_card['partner_key']."' 
                    ");

                    if($JTech->setting('nofication_callback') == 'yes') {
                        sendTele(templateTele("Callback thành công đến ".$info_card['callback']." (PARTNER KEY: ".$info_card['partner_key'].")"));
                    }
                }

                if($JTech->setting('nofication_res_card') == 'yes') {
                    sendTele(templateTele($serial." (THẺ ĐÚNG)"));
                }

                addTop($info_card['username'], $info_card['amount_recieve']);

                die('DUYỆT THÀNH CÔNG SERIAL '.$serial);
            }else if($status == 'wrong_amount') {
                if($JTech->getUser($info_card['username'], 'rank') == 'vip') {
                    $amount_ = $value * ((100 - getTelco($telco, 'vip_'.$value)) / 100);
                }else{
                    $amount_ = $value * ((100 - getTelco($telco, 'member_'.$value)) / 100);
                }
                
                $amount_recieve = $amount_ * ((100 - 50) / 100); // TRỪ 50% 

                $JTech->db_query("UPDATE `card-data` SET 
                `status` = 'wrong_amount', 
                `profit` = '".getProfit($info_card['amount'], $amount_recieve, getPercent($telco, $JTech->getUser($info_card['username'], 'rank'), $value))."',
                `amount_real` = '$value',
                `amount_recieve` = '$amount_recieve' 
                WHERE `request_id` = '$request_id'
                ");

                $JTech->db_query("UPDATE `users` SET
                `cash` = `cash` + '$amount_recieve' 
                WHERE `username` = '".$info_card['username']."' 
                ");
                
                if(!empty($info_card['callback'])) {
                    $response = curlGet($info_card['callback']."?status=wrong_amount&request_id=$request_id&telco=$telco&pin=$pin&serial=$serial&amount=$declared_value&amount_real=$value&amount_recieve=$amount_recieve");
                    
                    $JTech->db_query("UPDATE `card-data` SET 
                    `callback_response` = '$response' 
                    WHERE `request_id` = '$request_id' 
                    ");

                    $JTech->db_query("UPDATE `api-partner` SET 
                    `last_used` = '".time()."' WHERE 
                    `partner_key` = '".$info_card['partner_key']."' 
                    ");

                    if($JTech->setting('nofication_callback') == 'yes') {
                        sendTele(templateTele("Callback thành công đến ".$info_card['callback']." (PARTNER KEY: ".$info_card['partner_key'].")"));
                    }
                }
                if($JTech->setting('nofication_res_card') == 'yes') {
                    sendTele(templateTele($serial." (SAI MỆNH GIÁ)"));
                }

                addTop($info_card['username'], $amount_recieve);

                die('SAI MỆNH GIÁ '.$serial.'. THỰC '.$value);
            }else{
                $JTech->db_query("UPDATE `card-data` SET 
                `status` = 'fail' 
                WHERE `request_id` = '$request_id' 
                ");
                
                if(!empty($info_card['callback'])) {
                    $response = curlGet($info_card['callback']."?status=fail&request_id=$request_id&telco=$telco&pin=$pin&serial=$serial");

                    $JTech->db_query("UPDATE `card-data` SET 
                    `callback_response` = '$response'
                     WHERE `request_id` = '$request_id' 
                     ");
                     
                    $JTech->db_query("UPDATE `api-partner` SET 
                    `last_used` = '".time()."' 
                    WHERE `partner_key` = '".$info_card['partner_key']."' 
                    ");

                    if($JTech->setting('nofication_callback') == 'yes') {
                        sendTele(templateTele("Callback thành công đến ".$info_card['callback']." (PARTNER KEY: ".$info_card['partner_key'].")"));
                    }
                }
                if($JTech->setting('nofication_res_card') == 'yes') {
                    sendTele(templateTele($serial." (THẺ SAI)"));
                }

                
                die('THẺ SAI SERIAL '.$serial);
            }

        }else{
            die('KHÔNG TÌM THẤY REQUEST ID: '.$request_id);
        }


    } else {
        die('THIẾU DỮ LIỆU CALLBACK');
    }
?>