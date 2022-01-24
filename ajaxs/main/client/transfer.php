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

                if($cash > $JTech->user('cash')) {
                    die(jsonResponse(not_enough_cash, false));
                }
                
                $transaction_code = rand_string(11);

                $total_transfer = $cash - $JTech->setting('fee_cash_transfer');

                $JTech->db_query("UPDATE `users` SET `cash` = `cash` - '$cash' WHERE `username` = '".$JTech->user('username')."' ");
                $JTech->db_query("UPDATE `users` SET `cash` = `cash` + '$total_transfer' WHERE `username` = '".$info['username']."' ");

                $JTech->db_query("INSERT INTO `transfer-receipt` SET
                `transaction_code` = '$transaction_code',
                `sender` = '".$JTech->user('username')."',
                `reciever` = '".$info['username']."',
                `cash_original` = '$cash',
                `cash_transfer` = '$total_transfer',
                `description` = '$description',
                `created_time` = '".time()."'
                ");
                
                if($JTech->setting('nofication_transfer') == 'yes') {
                    sendTele(templateTele($JTech->user('username')." đã chuyển ".number_format($total_transfer)."đ cho ".$info['username']." (ND: ".$description.")"));
                }
                
                $res['status'] = true;
                $res['cash'] = number_format($total_transfer)."đ";
                $res['full_name'] = $info['full_name'];
                $res['time'] = formatDate(time());
                $res['transaction_code'] = $transaction_code;

                die(json_encode($res));

            }else{
                die(jsonResponse("Trường reciever không tồn tại.", false));
            }

        }
    }else{
        die(jsonResponse(login_required, false));
    }