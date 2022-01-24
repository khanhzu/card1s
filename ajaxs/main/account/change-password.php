<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('request')){
        $old_password = xss($_POST['old_password']);
        $new_password = xss($_POST['new_password']);
        $renew_password = xss($_POST['renew_password']);

        $validate = validateForm(['old_password', 'new_password', 'renew_password']);

        if($validate) {
            if(typePassword($old_password) != $JTech->user('password')) {
                die(jsonResponse("Trường old_password không đúng.", false));
            }

            if(!validPassword($new_password)) {
                die(jsonResponse("Trường new_password phải có tối thiểu 8 ký tự.", false));
            }

            if($renew_password != $new_password) {
                die(jsonResponse("Xác nhận mật khẩu mới không trùng khớp.", false));
            }

            $JTech->db_query("UPDATE `users` SET `password` = '".typePassword($new_password)."' WHERE `username` = '".$JTech->user('username')."' ");
            
            if($JTech->setting('nofication_auth') == 'yes') {
                sendTele(templateTele($JTech->user('username')." đổi mật khẩu thành công"));
            }
            die(jsonResponse("Thay đổi mật khẩu thành công", true));
        }
    }else{
        die(jsonResponse(login_required, false));
    }