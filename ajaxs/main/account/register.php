<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if(!$JTech->checkToken('request')) {
        $username = xss($_POST['username']);
        $full_name = xss($_POST['full_name']);
        $phone_or_email = xss($_POST['phone_or_email']);
        $password = xss($_POST['password']);

        if(!empty($JTech->setting('google_site_key')) && !empty($JTech->setting('google_secret_key')) ) {
            $captcha = $_POST['g-recaptcha-response'];
            $validate = validateForm(['username', 'full_name', 'phone_or_email', 'password', 'g-recaptcha-response']);
        }else{
            $validate = validateForm(['username', 'full_name', 'phone_or_email', 'password']);
        }
        
        if($validate) {

            if(!validUsername($username)) {
                die(jsonResponse("Trường username phải có tối thiểu 6 ký tự.", false));
            }

            if(!validPassword($password)) {
                die(jsonResponse("Trường password phải có tối thiểu 8 ký tự.", false));
            }

            if(!validFullname($full_name)) {
                die(jsonResponse("Trường full_name không hợp lệ.", false));
            }

            if(!empty($JTech->setting('google_site_key')) && !empty($JTech->setting('google_secret_key')) ) {
                if(!google_captcha($captcha)) {
                    die(jsonResponse("Xác thực captcha thất bại, tải lại trang thử lại", false));
                }
            }

            $info = $JTech->db_row("SELECT * FROM `users` WHERE `username` = '$username' LIMIT 1 ");
            if($info) {
                die(jsonResponse("Trường username đã tồn tại.", false));
            }

            $phone = "";
            $email = "";

            if(!filter_var($phone_or_email, FILTER_VALIDATE_EMAIL)) {
                // TRƯỜNG NÀY LÀ SỐ ĐIỆN THOẠI

                if(!validPhone($phone_or_email)) {
                    die(jsonResponse("Trường phone_or_email không hợp lệ.", false));
                }

                $phone = $phone_or_email;
                $check = $JTech->db_row("SELECT * FROM `users` WHERE `phone` = '$phone_or_email' LIMIT 1 ");
            }else{
                // TRƯỜNG NÀY LÀ EMAIL
                $email = $phone_or_email;
                $check = $JTech->db_row("SELECT * FROM `users` WHERE `email` = '$phone_or_email' LIMIT 1 ");
            }

            if(!$check) {
                $num_reg = $JTech->db_num_rows("SELECT * FROM `users` WHERE `ip` = '".getUserIP()."' ");

                if($num_reg >= $JTech->setting('reg_per_ip')) {
                    die(jsonResponse("Bạn đã đạt giới hạn tạo ".$JTech->setting('reg_per_ip')." tài khoản", false));
                }else{
                    $token = createToken();

                    $insert = $JTech->db_query("INSERT INTO `users` SET 
                    `full_name` = '$full_name',
                    `username` = '$username',
                    `password` = '".typePassword($password)."',
                    `phone` = '$phone',
                    `email` = '$email',
                    `token` = '".$token."',
                    `rank` = 'member',
                    `last_access` = '".time()."',
                    `ip` = '".getUserIP()."',
                    `user_agent` = '".$_SERVER['HTTP_USER_AGENT']."',
                    `created_time` = '".time()."'
                    ");

                    if($insert) {
                        if($JTech->setting('nofication_auth') == 'yes') {
                            sendTele(templateTele($username." đăng ký thành công"));
                        }

                        // GHI NHỚ ĐĂNG NHẬP (31 NGÀY = 1 THÁNG)
                        setcookie('token', $token, time() + 2678400, '/');
                        die(jsonResponse("Đăng ký thành công, chờ chuyển hướng...", true));
                    }
                }
            }else{
                die(jsonResponse("Trường phone_or_email đã tồn tại.", false));
            }

        }

    }else{
        die(jsonResponse("Bạn đã đăng nhập rồi...", false));
    }
?>