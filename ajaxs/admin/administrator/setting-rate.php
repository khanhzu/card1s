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
                foreach ($_POST as $key => $value) {
                    if($key != "telco" || $key != "rank") {
                        $JTech->db_query("UPDATE `telco-rate` SET `$key` = '$value' WHERE `telco` = '$telco' ");
                    }
                }

                die(jsonResponse("Lưu thay đổi chiết khấu thành công", true));
            }else{
                die(jsonResponse("Nhà mạng không khả dụng", false));
            }
        }

    }else{
        die(jsonResponse(non_admin, false));
    }