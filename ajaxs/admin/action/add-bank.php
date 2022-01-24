<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('admin_request')){
        $logo = xss($_POST['logo']);
        $owner = xss($_POST['owner']);
        $number_account = xss($_POST['number_account']);
        $noti = xss($_POST['noti']);

        $validate = validateForm(['logo', 'owner', 'number_account']);

        if($validate) {
            
            $JTech->db_query("INSERT INTO `bank-users` SET
            `username` = 'web',
            `key` = '".md5(time())."',
            `logo` = '$logo',
            `owner` = '$owner',
            `number_account` = '$number_account',
            `noti` = '$noti',
            `created_time` = '".time()."'
            ");

            die(jsonResponse("Thêm ngân hàng thành công", true));

        }
    }else{
        die(jsonResponse(non_admin, false));
    }