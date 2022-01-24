<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('admin_request')){
        $id = intval($_POST['id']);
        $cash = intval($_POST['cash']);
        $type = xss($_POST['type']);

        $info = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `users` WHERE `id` = '$id' "));

        $validate = validateForm(['id', 'cash', 'type']);

        if($validate) {
            if($info) {
                
                if($type == '+') {
                    addTop($info['username'], $cash);
                }

                $JTech->db_query("UPDATE `users` SET `cash` =  `cash` $type '$cash' WHERE `id` = '$id' ");
                die(jsonResponse("Đã $type".$cash." cho ".$info['username'], true));

            }else{
                die(jsonResponse("Không tìm thấy thành viên", false));
            }
        }

    }else{
        die(jsonResponse(non_admin, false));
    }