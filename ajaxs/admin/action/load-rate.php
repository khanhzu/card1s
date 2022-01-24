<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('admin_request')){
        $rank = xss($_POST['rank']);
        $telco = xss($_POST['telco']);

        $validate = validateForm(['rank', 'telco']);

        if($validate) {
            $data = $JTech->db_row("SELECT * FROM `telco-rate` WHERE `telco` = '$telco' ");

            if($data) {
                $res['status'] = true;
                $res['v_10000'] = $data[$rank."_10000"];
                $res['v_20000'] = $data[$rank."_20000"];
                $res['v_30000'] = $data[$rank."_30000"];
                $res['v_50000'] = $data[$rank."_50000"];
                $res['v_100000'] = $data[$rank."_100000"];
                $res['v_200000'] = $data[$rank."_200000"];
                $res['v_300000'] = $data[$rank."_300000"];
                $res['v_500000'] = $data[$rank."_500000"];
                $res['v_1000000'] = $data[$rank."_1000000"];

                die(json_encode($res));
            }else{
                die(jsonResponse("Nhà mạng không khả dụng", false));
            }
        }

    }else{
        die(jsonResponse(non_admin, false));
    }