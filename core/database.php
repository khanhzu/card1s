<?php
session_start();
error_reporting(0);

# HIỂN THỊ LỖI THÌ GỠ GHI CHÚ NÀY RA
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);

date_default_timezone_set('Asia/Ho_Chi_Minh');

$config = [
    'LOCALHOST' => 'localhost',
    'DATABASE' => 'todoicodesite_shop',
    'USERNAME' => 'todoicodesite_shop',
    'PASSWORD' => 'todoicodesite_shop'
];

class JzonTech
{
    public function connect_db()
    {
        global $config;
        ($conn = mysqli_connect($config['LOCALHOST'], $config['USERNAME'], $config['PASSWORD'], $config['DATABASE'])) or die("Kết nối DATABASE thất bại");
        $conn->set_charset("utf8mb4");
        return $conn;
    }

    public function full_url()
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . 
                $_SERVER['REQUEST_URI'];
        return $link;
    }

    public function __construct()
    {
        $this->connect_db();
    }

    public function db_row($query) {
        $result = mysqli_query($this->connect_db(), $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }

    public function db_num_rows($query) {
        $result = mysqli_query($this->connect_db(), $query);
        $num = mysqli_num_rows($result);
        return $num;
    }

    public function db_query($query) {
        $result = mysqli_query($this->connect_db(), $query);
        return $result;
    }

    public function setting($name)
    {
        $result = mysqli_query($this->connect_db(), "SELECT * FROM `setting` WHERE `name` = '$name' ");
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return $row['value'];
    }

    public function getToken() 
    {
        if(isset($_COOKIE['token'])) {
            return $_COOKIE['token'];
        }
    }

    public function checkToken($type, $perm_verify = false) 
    {
        $token = $this->getToken();

        if($token === NULL || empty($token)) {
            $token = sha1(md5(time()));
        }

        $result = mysqli_query($this->connect_db(), "SELECT * FROM `users` WHERE `token` = '$token' ");
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        // exit(var_dump($row['2fa_code'] != '' && !$row['is_verify']));

        if($type == 'request') {
            // if($token === NULL || empty($token)) {
            //     return false;
            // }

            if($row) {
                if($row['banned'] != 1) {
                    if($perm_verify === false) {
                        if($row['2fa_code'] != '' && !$row['is_verify']){
                            return false;
                        }
                    }
                        
                    // HẾT HẠN PHIÊN ĐĂNG NHẬP
                    $sec = time() - $row['last_access'];
                    if($sec <= 2678400) {
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        if($type == 'client') {

            // if($token === NULL || empty($token)) {
            //     exit('<script>document.location = "/account/login";</script>');
            // }
            
            if($perm_verify === false) {
                if($row['2fa_code'] != '' && !$row['is_verify']){
                    exit('<script>document.location = "/acco+++unt/security/verify";</script>');
                }
            }

            if($row) {
                if($row['banned'] != 1) {
                    // HẾT HẠN PHIÊN ĐĂNG NHẬP
                    $sec = time() - $row['last_access'];
                    if($sec > 2678400) {
                        exit('<script>document.location = "/account/logout";</script>');
                    }
                }else{
                    exit('<script>document.location = "/account/banned";</script>');
                }
            }else{
                exit('<script>document.location = "/account/login";</script>');
            }
        }

        if($type == 'banned') {

            // if($token === NULL || empty($token)) {
            //     exit('<script>document.location = "/account/login";</script>');
            // }

            if($row) {
                if($row['banned'] != 1) {
                    exit('<script>document.location = "/";</script>');
                }
            }else{
                exit('<script>document.location = "/account/login";</script>');
            }
        }

        if($type == 'admin_page') {

            // if($token === NULL || empty($token)) {
            //     exit('<script>document.location = "/account/login";</script>');
            // }
            
            if($perm_verify === false) {
                if($row['2fa_code'] != '' && !$row['is_verify']){
                    exit('<script>document.location = "/account/security/verify";</script>');
                }
            }

            if($row) {  
                if($row['admin'] == 1) {
                    // HẾT HẠN PHIÊN ĐĂNG NHẬP
                    $sec = time() - $row['last_access'];
                    if($sec > 2678400) {
                        exit('<script>document.location = "/account/logout";</script>');
                    }
                }else{
                    exit('<script>document.location = "/";</script>');
                }
            }else{
                exit('<script>document.location = "/account/login";</script>');
            }
        }

        if($type == 'admin_request') {
            // if($token === NULL || empty($token)) {
            //     return false;
            // }
            
            if($perm_verify === false) {
                if($row['2fa_code'] != '' && !$row['is_verify']){
                    return false;
                }
            }

            if($row) {
                if($row['admin'] == 1) {
                    // HẾT HẠN PHIÊN ĐĂNG NHẬP
                    $sec = time() - $row['last_access'];
                    if($sec <= 2678400) {
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        if($type == 'auth') {
            // if($token === NULL || !empty($token)) {
            //     exit('<script>document.location = "/account/login";</script>');
            // }

            if($row) {
                // HẾT HẠN PHIÊN ĐĂNG NHẬP
                $sec = time() - $row['last_access'];
                if($sec > 2678400) {
                    exit('<script>document.location = "/account/logout";</script>');
                }else{
                    if($perm_verify === false) {
                        if($row['2fa_code'] != '' && !$row['is_verify']){
                            exit('<script>document.location = "/account/security/verify";</script>');
                        }else{
                            exit('<script>document.location = "/";</script>');
                        }
                    }else{
                        exit('<script>document.location = "/";</script>');
                    }
                }
            }
        }

        if($type == 'verify') {
            // if($token === NULL || !empty($token)) {
            //     exit('<script>document.location = "/account/login";</script>');
            // }

            if($row) {
                $sec = time() - $row['last_access'];
                if($sec > 2678400) {
                    exit('<script>document.location = "/account/logout";</script>');
                }else{
                    if($row['2fa_code'] != '' && $row['is_verify']){ 
                        exit('<script>document.location = "/";</script>');
                    } else if($row['2fa_code'] == '') {
                        exit('<script>document.location = "/";</script>');
                    }
                }
            }
        }

        return "???";
    }

    public function user($value, $perm_verify = false)
    {
        if($this->checkToken('request', $perm_verify)) {
            $token = $this->getToken();
            $result = mysqli_query($this->connect_db(), "SELECT * FROM `users` WHERE `token` = '$token' ");
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if($row) {
                return $row[$value];
            }
        }
    }

    public function getUser($username, $value)
    {
        $result = mysqli_query($this->connect_db(), "SELECT * FROM `users` WHERE `username` = '$username' ");
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($row) {
            return $row[$value];
        }
    }

    public function isMobile()
    {
        $useragent = $_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
            return true;
        }else{
            return false;
        }
    }
}
