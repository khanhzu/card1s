<?php
    require('../../../../core/database.php');
    require('../../../../core/function.php');

    if($JTech->checkToken('request')){
        $phone = xss($_POST['phone']);
        $validate = validateForm(['phone']);

        if($validate) {
            if(!validPhone($phone)) {
                die(jsonResponse("Trường phone không hợp lệ.", false));
            }

            $check = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `users` WHERE `phone` = '$phone' "));

            if($check) {
                die(jsonResponse("Trường phone đã được sử dụng.", false));
            }

            if($JTech->user('phone') == '') {
                $JTech->db_query("UPDATE `users` SET `phone` = '$phone' WHERE `username` = '".$JTech->user('username')."' ");
                die(jsonResponse("Cập nhật số điện thoại thành công", true));
            }else{
                die(jsonResponse("Không được phép cập nhật", false));
            }

        }
    }else{
        die(jsonResponse(login_required, false));
    }