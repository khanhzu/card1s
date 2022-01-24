<?php
    require('../../../../core/database.php');
    require('../../../../core/function.php');

    // GOOGLE LIB - AUTHENTICATOR
    require_once($_SERVER['DOCUMENT_ROOT'].'/api_3rd/googleLib/GoogleAuthenticator.php');
    $ga = new PHPGangsta_GoogleAuthenticator();

    if($JTech->checkToken('request', true)){
        $type = xss($_POST['type']);

        $validate = validateForm(['type']);

        if($validate) {
            switch($type) {
                case 'on':
                    if($JTech->user('2fa_code') == '') {
                        $secret = $ga->createSecret();
                        $JTech->db_query("UPDATE `users` SET `2fa_code` = '".$secret."', `is_verify` = '1' WHERE `username` = '".$JTech->user('username')."' ");
                        
                        die(jsonResponse("Bật trình tạo mã thành công", true));
                    }else{
                        die(jsonResponse("Bạn đã bật trình tạo mã rồi", false));
                    }
                    break;
                case 'off':
                    if($JTech->user('2fa_code') != '') {
                        $JTech->db_query("UPDATE `users` SET `2fa_code` = '', `is_verify` = '0' WHERE `username` = '".$JTech->user('username')."' ");
                        die(jsonResponse("Tắt trình tạo mã thành công", true));
                    }else{
                        die(jsonResponse("Trình tạo mã chưa khả dụng để tắt", false));
                    }
                    break;
                case 'check':
                    $token = xss($_POST['token']);

                    $validate = validateForm(['token']);
                    if($validate) {
                        $checkResult = $ga->verifyCode($JTech->user('2fa_code', true), $token, 2);    // 2 = 2*30sec clock tolerance
                        if ($checkResult) {
                            $JTech->db_query("UPDATE `users` SET `is_verify` = 1 WHERE `username` = '".$JTech->user('username', true)."' ");
                            die(jsonResponse("Xác thực thành công", true));
                        } else {
                            die(jsonResponse("Mã đăng nhập không hợp lệ, hãy thử lại.", false));
                        }
                    }
                    break;
                default: 
                    echo '???';
                    break;
            }
        }
    }else{
        die(jsonResponse(login_required, false));
    }