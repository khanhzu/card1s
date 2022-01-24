<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    require('../../../api_3rd/napthe365-topup.php');
    
    if($JTech->checkToken('request')){
        $cash = intval($_POST['cash']);
        $bank_data = xss($_POST['bank_data']);
        $description = xss($_POST['description']);

        $validate = validateForm(['cash', 'bank_data']);

        if($validate) {

            if($cash < $JTech->setting('min_cash_withdraw')) {
                die(jsonResponse("Trường cash tối thiểu ".number_format($JTech->setting('min_cash_withdraw'))."đ.", false));
            }

            if($cash > $JTech->setting('max_cash_withdraw')) {
                die(jsonResponse("Trường cash tối đa ".number_format($JTech->setting('max_cash_withdraw'))."đ.", false));
            }

            if($description != "") { 
                if(strlen($description) > 100) {
                    die(jsonResponse("Trường description tối đa 100 kí tự.", false));
                }
            }
            
            $info = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `bank-users` WHERE `key` = '$bank_data' AND `username` = '".$JTech->user('username')."' "));

            if($info) {

                if($JTech->db_num_rows("SELECT * FROM `withdraw` WHERE `username` = '".$JTech->user('username')."' AND `status` = 'wait' ") <= 0) {

                    $total_withdraw = $cash - $JTech->setting('fee_cash_withdraw');

                    if($cash > $JTech->user('cash')) {
                        die(jsonResponse(not_enough_cash, false));
                    }

                    $withdraw_code = rand_string(11);

                    $JTech->db_query("UPDATE `users` SET `cash` = `cash` - '$cash' WHERE `username` = '".$JTech->user('username')."' ");
                    $JTech->db_query("INSERT INTO `withdraw` SET
                    `withdraw_code` = '$withdraw_code',
                    `username` = '".$JTech->user('username')."',
                    `bank_name` = '".$info['bank_name']."',
                    `owner` = '".$info['owner']."',
                    `number_account` = '".$info['number_account']."',
                    `branch` = '".$info['branch']."',
                    `cash_original` = '$cash',
                    `cash_withdraw` = '$total_withdraw',
                    `status` = 'wait',
                    `created_time` = '".time()."'
                    ");

                    if($JTech->setting('nofication_withdraw') == 'yes') {
                        sendTele(templateTele($JTech->user('username')." tạo yêu cầu rút ".$total_withdraw."đ qua ".$info['bank_name']));
                    }

                    die(jsonResponse("Tạo yêu cầu rút tiền thành công", true));
                } else {
                    die(jsonResponse("Bạn không thể tạo thêm yêu cầu khi chưa hoàn tất", false));
                }
            }else{
                die(jsonResponse("Không tìm thấy thông tin ngân hàng", false));
            }

        }
    }else{
        die(jsonResponse(login_required, false));
    }