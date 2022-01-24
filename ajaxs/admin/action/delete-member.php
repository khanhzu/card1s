<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('admin_request')){
        $id = intval($_POST['id']);

        $info = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `users` WHERE `id` = '$id' "));

        if($info) {
            $JTech->db_query("DELETE FROM `users` WHERE `id` = '$id' ");
            die(jsonResponse("Xóa tài khoản thành công", true));
        }else{
            die(jsonResponse("Không tìm thấy thành viên", false));
        }

    }else{
        die(jsonResponse(non_admin, false));
    }