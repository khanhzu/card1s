<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    
    if($JTech->checkToken('admin_request')){
        $key = xss($_POST['key']);

        $validate = validateForm(['key']);

        if($validate) {
            $api_ = file_get_contents("https://jzontech.biz/api/info-product.php?product=GACHTHE");
            $data = json_decode($api_, true);

            if($data['status']) {

                if($data['data']['last_version'] != $JTech->setting('code_version')) {
                    $api = 'https://jzontech.biz/api/update.php?key='.$key;

                    $file = $_SERVER['DOCUMENT_ROOT']."/".md5(time()).".zip";
                    file_put_contents($file, file_get_contents($api));
                    
                    $zip = new \ZipArchive;
                    $res = $zip->open($file);
                    if ($res === TRUE) {
                        $zip->extractTo($_SERVER['DOCUMENT_ROOT']);
                        $zip->close();
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/jtech.php')) {
                            $install = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/jtech.php');
                            unlink($_SERVER['DOCUMENT_ROOT'].'/jtech.php');
                        }

                        unlink($file);
                        $JTech->db_query("UPDATE `setting` SET `value` = '".$data['data']['last_version']."' WHERE `name` = 'code_version' ");
                        $JTech->db_query("UPDATE `setting` SET `value` = '".$data['data']['detail_version']."' WHERE `name` = 'code_log' ");

                        die(jsonResponse("Cập nhật thành công phiên bản ".$data['data']['last_version'], true));

                    } else {
                        unlink($file);
                        $ok = json_decode(file_get_contents($api), true);
                        $message = $ok['message'];
                        die(jsonResponse($message, false));
                    }


                }else{
                    die(jsonResponse("Phiên bản hiện tại của bạn là mới nhất.", false));
                }

            }else{
                die(jsonResponse($data['message'], false));
            }
        }
            

    }else{
        die(jsonResponse(non_admin, false));
    }