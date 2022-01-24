<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('admin_request')){

        $api = file_get_contents("https://jzontech.biz/api/info-product.php?product=GACHTHE");
        $data = json_decode($api, true);

        if($data['status']) {
            $res['status'] = true;
            $res['detail_version'] = $JTech->setting('code_log');
            $res['current_version'] = $JTech->setting('code_version');

            if($data['data']['last_version'] == $JTech->setting('code_version')) {
                $last_version = $data['data']['last_version'];
                $status = "<span class='badge badge-success'>ĐÃ CẬP NHẬT</span>";
            }else{
                $last_version = $data['data']['last_version'];
                $detail_new_version = $data['data']['detail_version'];
                $status = "<span class='badge badge-danger'>CHƯA CẬP NHẬT</span>";
            }

            $res['last_version'] = $last_version;
            $res['detail_new_version'] = $detail_new_version;
            $res['status_'] = $status;
            die(json_encode($res));
        }else{
            die(jsonResponse($data['message'], false));
        }

    }else{
        die(jsonResponse(non_admin, false));
    }