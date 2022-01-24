<?php
    require('../../../../core/database.php');
    require('../../../../core/function.php');

    if($JTech->checkToken('request')){
        $name = xss($_POST['name']);
        $callback_url = xss($_POST['callback_url']);

        $validate = validateForm(['name', 'callback_url']);

        if($validate) {
            if(strlen($name) > 30) {
                die(jsonResponse("Trường name độ dài không cho phép.", false));
            }

            if(!filter_var($callback_url, FILTER_VALIDATE_URL)) {
                die(jsonResponse("Trường callback_url không hợp lệ", false));
            }

            $partner_id = rand_int();
            $partner_key = md5(time());

            $JTech->db_query("INSERT INTO `api-partner` SET 
            `username` = '".$JTech->user('username')."',
            `name` = '$name',
            `partner_id` = '$partner_id',
            `partner_key` = '$partner_key',
            `callback_url` = '$callback_url',
            `status` = 'active',
            `created_time` = '".time()."'
            ");

            if($JTech->setting('nofication_api_partner') == 'yes') {
                sendTele(templateTele($JTech->user('username')." thêm đối tác API (Tên: $name)"));
            }

            die(jsonResponse("Bạn đã thêm API thành công!", true));

        }
    }else{
        die(jsonResponse(login_required, false));
    }