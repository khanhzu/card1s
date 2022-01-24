<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if(!$JTech->checkToken('request')) {
        $username = xss($_POST['username']);
        $password = xss($_POST['password']);

        $validate = validateForm(['username', 'password']);
        
        if($validate) {
            
            $info = $JTech->db_row("SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '".typePassword($password)."' LIMIT 1 ");

            if($info) {
                if($info['banned'] != 1) {
                    // TOKEN PHIÊN ĐĂNG NHẬP NÀY
                    $token = createToken();

                    $update = $JTech->db_query("UPDATE `users` SET 
                    `token` = '$token', 
                    `ip` = '".getUserIP()."',
                    `last_access` = '".time()."',
                    `user_agent` = '".$_SERVER['HTTP_USER_AGENT']."'
                    WHERE `username` = '$username'
                    ");

                    if($update) {

                        if($JTech->setting('nofication_auth') == 'yes') {
                            sendTele(templateTele($username." đăng nhập thành công"));
                        }

                        // GHI NHỚ ĐĂNG NHẬP (31 NGÀY = 1 THÁNG)
                        setcookie('token', $token, time() + 2678400, '/');
                        die(jsonResponse("Đăng nhập thành công, chờ chuyển hướng...", true));
                    }
                } else {
                    die(jsonResponse("Tài khoản của bạn đã bị vô hiệu hóa", false));
                }
                
            } else {
                die(jsonResponse("Tên đăng nhập hoặc mật khẩu không đúng", false));
            }
        }

    }else{
        die(jsonResponse("Bạn đã đăng nhập rồi...", false));
    }
?>