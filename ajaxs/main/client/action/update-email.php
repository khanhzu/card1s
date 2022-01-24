<?php
    require('../../../../core/database.php');
    require('../../../../core/function.php');

    if($JTech->checkToken('request')){
        $email = xss($_POST['email']);
        $validate = validateForm(['email']);

        if($validate) {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die(jsonResponse("Trường email không hợp lệ.", false));
            }

            $check = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `users` WHERE `email` = '$email' "));

            if($check) {
                die(jsonResponse("Trường email đã được sử dụng.", false));
            }

            if($JTech->user('email') == '') {
                $JTech->db_query("UPDATE `users` SET `email` = '$email' WHERE `username` = '".$JTech->user('username')."' ");
                die(jsonResponse("Cập nhật email thành công", true));
            }else{
                die(jsonResponse("Không được phép cập nhật", false));
            }

        }
    }else{
        die(jsonResponse(login_required, false));
    }