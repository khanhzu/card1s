<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    require('../../../api_3rd/napthe365-topup.php');
    
    if($JTech->checkToken('request')){
        $reciever = xss($_POST['reciever']);
        $cash = intval($_POST['cash']);
        $description = xss($_POST['description']);

        $validate = validateForm(['reciever', 'cash']);

        if($validate) {

            if($cash < $JTech->setting('min_cash_transfer')) {
                die(jsonResponse("Trường cash tối thiểu ".number_format($JTech->setting('min_cash_transfer'))."đ.", false));
            }

            if($cash > $JTech->setting('max_cash_transfer')) {
                die(jsonResponse("Trường cash tối đa ".number_format($JTech->setting('max_cash_transfer'))."đ.", false));
            }

            if(strlen($description) > 100) {
                die(jsonResponse("Trường description tối đa 100 kí tự.", false));
            }

            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $info = $JTech->db_row("SELECT * FROM `users` WHERE `email` = '$reciever' AND `banned` = 0 LIMIT 1 ");
            }else if(validPhone($reciever)) {
                $info = $JTech->db_row("SELECT * FROM `users` WHERE `phone` = '$reciever' AND `banned` = 0 LIMIT 1 ");
            }else{
                $info = $JTech->db_row("SELECT * FROM `users` WHERE `username` = '$reciever' AND `banned` = 0 LIMIT 1 ");
            }

            if($info) {
                if($info['username'] != $JTech->user('username')) { 
                    $res['status'] = true;
                    $res['full_name'] = $info['full_name'];
                    die(json_encode($res));
                } else {
                    die(jsonResponse("Tài khoản nhận phải khác tài khoản gửi.", false));
                }
            }else{
                die(jsonResponse("Trường reciever không tồn tại.", false));
            }

        }
    }else{
        die(jsonResponse(login_required, false));
    }