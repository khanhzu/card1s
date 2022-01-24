<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('admin_request')){
    	foreach ($_POST as $key => $value) {
	        $JTech->db_query("UPDATE `setting` SET `value` = '$value' WHERE `name` = '$key'  ");
	    }

        die(jsonResponse("Lưu thay đổi thành công", true));

    }else{
        die(jsonResponse(non_admin, false));
    }