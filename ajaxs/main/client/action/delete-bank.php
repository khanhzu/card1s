<?php
    require('../../../../core/database.php');
    require('../../../../core/function.php');
    
    if($JTech->checkToken('request')){
        $key = xss($_POST['key']);

        $validate = validateForm(['key']);

        if($validate) {
            $info = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `bank-users` WHERE `key` = '$key' AND `username` = '".$JTech->user('username')."' "));

            if($info) {

                $JTech->db_query("DELETE FROM `bank-users` WHERE `key` = '$key' ");

                die(jsonResponse("Xóa thành công", true));

            }else{
                die(jsonResponse("Ngân hàng không tồn tại", false));
            }
        }
    }else{
        die(jsonResponse(login_required, false));
    }