<?php
    require('../../../../core/database.php');
    require('../../../../core/function.php');
    
    if($JTech->checkToken('request')){
        $id = xss($_POST['id']);

        $validate = validateForm(['id']);

        if($validate) {
            $info = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `api-partner` WHERE `id` = '$id' AND `username` = '".$JTech->user('username')."' "));

            if($info) {
                $JTech->db_query("DELETE FROM `api-partner` WHERE `id` = '$id' AND `username` = '".$JTech->user('username')."'");
                die(jsonResponse("Xóa API thành công", true));
            }else{
                die(jsonResponse("Partner không tồn tại", false));
            }
        }
    }else{
        die(jsonResponse(login_required, false));
    }