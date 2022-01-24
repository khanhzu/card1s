<?php
    require('../../core/database.php');
    require('../../core/function.php');

    if($JTech->setting('momo_token') != "") {
        $api = curlGet("https://api.web2m.com/historyapimomo1h/".$JTech->setting('momo_token'));
        $call = json_decode($api, true);

        if(isset($call['momoMsg']['tranList'])) {
            foreach($call['momoMsg']['tranList'] as $momo) {
                $partnerId      = $momo['partnerId'];
                $comment        = $momo['comment'];
                $tranId         = $momo['tranId'];
                $partnerName    = $momo['partnerName'];
                $amount         = $momo['amount'];
                $extractComment = jzonParseContent($comment);

                
                if($amount > $JTech->setting('recharge_fee')) {
                    if($JTech->setting('memo_mode') == 'user'){
                        $user = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `users` WHERE `username` = '$extractComment' LIMIT 1"));
                    }else if($JTech->setting('memo_mode') == 'uid'){
                        $user = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `users` WHERE `id` = '$extractComment' LIMIT 1"));
                    }else{
                        die("No memo mode found.");
                    }

                    $momoData = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `auto-momo` WHERE `tranId` = '$tranId' "));

                    if(!$momoData){
                        if($user){
                            $j_amount = $amount - $JTech->setting('recharge_fee');
                            
                            addTop($user['username'], $j_amount);

                            $JTech->db_query("INSERT INTO `auto-momo` SET
                            `mode` = '".$JTech->setting('memo_mode')."',
                            `username` = '".$user['username']."',
                            `tranId` = '$tranId',
                            `partnerId` = '$partnerId',
                            `partnerName` = '$partnerName',
                            `amount` = '$amount',
                            `comment` = '$comment',
                            `created_time` = '".time()."',
                            `day` = '".date('d')."',
                            `month` = '".date('m')."',
                            `year` = '".date('Y')."'
                            ");
                            $JTech->db_query("UPDATE `users` SET `cash` = `cash` + '$j_amount' WHERE `username` = '".$user['username']."' ");
                            
                            if($JTech->setting('nofication_recharge') == 'yes') {
                                sendTele(templateTele($user['username']." nạp ".number_format($j_amount)."đ qua VÍ MOMO"));
                            }
                        }
                    }
                }
            }
        }else{
            die($call['msg']);
        }

    }








