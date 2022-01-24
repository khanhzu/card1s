<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('admin_request')){
        $id = intval($_POST['id']);

        $username = xss($_POST['username']);
        $full_name = xss($_POST['full_name']);
        $phone = xss($_POST['phone']);
        $email = xss($_POST['email']);
        $cash = intval($_POST['cash']);
        $rank = xss($_POST['rank']);
        $token = xss($_POST['token']);

        $validate = validateForm(['id', 'username', 'full_name', 'rank']);

        if($validate) {
            $save = $JTech->db_query("UPDATE `users` SET
            `username` = '$username',
            `full_name` = '$full_name',
            `phone` = '$phone',
            `email` = '$email',
            `cash` = '$cash',
            `rank` = '$rank',
            `token` = '$token'
            WHERE `id` = '$id'
            ");

            if($save) {
                die(jsonResponse("Đã lưu thay đổi thành viên", true));
            }
            
        }
    }else{
        die(jsonResponse(non_admin, false));
    }