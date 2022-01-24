<?php
    require('../../core/database.php');
    require('../../core/function.php');
    
    $api = jzonCurl("https://api.web2m.com/historyapizalopay/".$JTech->setting('zalo_token'));
    $call = json_decode($api, true);

    if($call['status'] && $call['code'] == 200) {

        foreach($call['data'] as $zalo) {
            $owner          = $zalo['appusername'];
            $transid        = $zalo['transid'];
            $amount         = $zalo['amount'];
            $comment        = $zalo['description'];
            $transfer_time  = $zalo['reqdate'];
            $extractComment = jzonParseContent($comment);

            if($amount > $JTech->setting('recharge_fee')) {
                if($JTech->setting('memo_mode') == 'user'){
                    $user = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `users` WHERE `username` = '$extractComment' LIMIT 1"));
                }else if($JTech->setting('memo_mode') == 'uid'){
                    $user = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `users` WHERE `id` = '$extractComment' LIMIT 1"));
                }else{
                    die("No memo mode found.");
                }

                $zaloData = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `auto-zalo-pay` WHERE `transid` = '$transid' "));

                if(!$zaloData){
                    if($user){
                        $j_amount = $amount - $JTech->setting('recharge_fee');
                        addTop($user['username'], $j_amount);
                        
                        $JTech->db_query("INSERT INTO `auto-zalo-pay` SET
                        `mode` = '".setting('memo_mode')."',
                        `username` = '".$user['username']."',
                        `transid` = '$transid',
                        `owner` = '$owner',
                        `amount` = '$amount',
                        `comment` = '$comment',
                        `created_time` = '".microtime($transfer_time)."',
                        `day` = '".date('d', microtime($transfer_time))."',
                        `month` = '".date('m', microtime($transfer_time))."',
                        `year` = '".date('Y', microtime($transfer_time))."'
                        ");
                        $JTech->db_query("UPDATE `users` SET `cash` = `cash` + '$j_amount' WHERE `username` = '".$user['username']."' ");
                        
                        if($JTech->setting('nofication_recharge') == 'yes') {
                            sendTele(templateTele($user['username']." nạp ".number_format($j_amount)."đ qua ZALO PAY"));
                        }
                    }
                }
            }
        }
    
    }else{
        die('Lấy dữ liệu Zalo Pay thất bại!');
    }