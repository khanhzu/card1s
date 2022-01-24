<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('admin_request')){
        $id = intval($_POST['id']);

        $info = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `users` WHERE `id` = '$id' "));

        if($info) {
            if($info['banned'] == 1) {
                $JTech->db_query("UPDATE `users` SET `banned` = '0' WHERE `id` = '$id' ");
                die(jsonResponse("Mở tài khoản thành công", true));
            }else if($info['banned'] == 0) {
                $JTech->db_query("UPDATE `users` SET `banned` = '1' WHERE `id` = '$id' ");
                die(jsonResponse("Vô hiệu hóa thành công", true));
            }
        }else{
            die(jsonResponse("Không tìm thấy thành viên", false));
        }

    }else{
        die(jsonResponse(non_admin, false));
    }