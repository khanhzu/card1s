<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('admin_request')){
        $id = intval($_POST['id']);
        $password = xss($_POST['password']);

        $info = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `users` WHERE `id` = '$id' "));

        $validate = validateForm(['id', 'password']);

        if($validate) {
            if($info) {
                $JTech->db_query("UPDATE `users` SET `password` =  '".typePassword($password)."' WHERE `id` = '$id' ");
                die(jsonResponse("Reset mật khẩu thành công", true));
            }else{
                die(jsonResponse("Không tìm thấy thành viên", false));
            }
        }

    }else{
        die(jsonResponse(non_admin, false));
    }