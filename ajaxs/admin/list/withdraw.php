<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('admin_request')){
        $id = intval($_POST['id']);

        $bank_name = xss($_POST['bank_name']);
        $owner = xss($_POST['owner']);
        $number_account = xss($_POST['number_account']);
        $branch = xss($_POST['branch']);
        $status = xss($_POST['status']);

        $validate = validateForm(['id', 'bank_name', 'owner', 'number_account']);

        if($validate) {

            if(!array_key_exists($bank_name, bank_data())) {
                die(jsonResponse("Trường bank_name không hợp lệ.", false));
            }

            $save = $JTech->db_query("UPDATE `withdraw` SET
            `bank_name` = '$bank_name',
            `owner` = '$owner',
            `number_account` = '$number_account',
            `branch` = '$branch',
            `status` = '$status'
            WHERE `id` = '$id'
            ");

            if($save) {
                die(jsonResponse("Đã lưu thay đổi thông tin rút tiền", true));
            }
            
        }
    }else{
        die(jsonResponse(non_admin, false));
    }