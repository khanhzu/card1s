<?php
    require('../../../../core/database.php');
    require('../../../../core/function.php');
    
    if($JTech->checkToken('request')){
        $bank_name = xss($_POST['bank_name']);
        $owner = xss($_POST['owner']);
        $number_account = xss($_POST['number_account']);
        $branch = xss($_POST['branch']);

        $validate = validateForm(['bank_name', 'owner', 'number_account']);

        if($validate) {
            
            if(!array_key_exists($bank_name, bank_data())) {
                die(jsonResponse("Trường bank_name không hợp lệ.", false));
            }

            if(strlen($owner) > 100 || strlen($number_account) > 100 || strlen($branch) > 100) {
                die(jsonResponse("Độ dài đầu vào không cho phép.", false));
            }

          $check = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `bank-users` WHERE `bank_name` = '$bank_name' AND `username` = '".$JTech->user('username')."' "));

            if($check) {
                die(jsonResponse("Thông tin ngân hàng này đã tồn tại.", false));
            }

            if($JTech->db_num_rows("SELECT * FROM `bank-users` WHERE `username` = '".$JTech->user('username')."' ") <= 10) {

                $JTech->db_query("INSERT INTO `bank-users` SET
                `username` = '".$JTech->user('username')."',
                `key` = '".md5(time())."',
                `number_account` = '$number_account',
                `owner` = '$owner',
                `bank_name` = '$bank_name',
                `branch` = '$branch',
                `created_time` = '".time()."'
                ");

                die(jsonResponse("Thêm ngân hàng thành công", true));
            }else{
                die(jsonResponse("Bạn đã đạt đến ngưỡng tối đa 10 ngân hàng", true));
            }
        }
    }else{
        die(jsonResponse(login_required, false));
    }