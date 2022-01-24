<?php

$JTech = new JzonTech;

define('login_required', 'Phiên đăng nhập đã hết hạn, vui lòng đăng nhập lại.');
define('non_admin', 'ACCESS DENIED');
define('not_enough_cash', 'Số dư hiện tại không đủ để giao dịch');
define('success_purchase', 'Thanh toán thành công');
define('maintenance_msg', 'Dịch vụ đang được bảo trì, quay lại sau.');

if($JTech->checkToken('request')) {
    $JTech->db_query("UPDATE `users` SET `last_access` = '".time()."', `ip` = '".getUserIP()."', `user_agent` = '".$_SERVER['HTTP_USER_AGENT']."' WHERE `username` = '".$JTech->user('username')."' ");
}

function typeRank($data) {
    switch ($data) {
        case 'vip':
            return '<span class="badge badge-pill badge-warning">VIP</span>';
            break;
        case 'agency':
            return '<span class="badge badge-pill badge-danger">ĐẠI LÝ</span>';
            break;
        case 'admin':
            return '<span class="badge badge-pill badge-success">BOY PLAY</span>';
            break;
    }
}

function displayFullname() {
    global $JTech;

    if($JTech->user('full_name') == '') {
        echo 'Khách';
    }else{
        echo $JTech->user('full_name');
    }
}

function displayCash() {
    global $JTech;

    if($JTech->user('cash') == '') {
        echo 'Bạn chưa đăng nhập';
    }else{
        echo '<i class="fas fa-wallet"></i> '.number_format($JTech->user('cash')).'đ';
    }
}

function jsonResponse($message, $status) {
    $res['status'] = $status;
    $res['message'] = $message;
    return json_encode($res);
}

function xss($data) {
    // Fix &entity\n;
    $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
    
    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
    
    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
    
    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
    
    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
    
    do {
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    }
    while ($old_data !== $data);
    
    // we are done...
    $ducthanhit = htmlspecialchars(addslashes(trim($data)));

    return $ducthanhit;
}

function validateForm($arr) {
    foreach($arr as $name) {
        if(empty(xss($_POST[$name]))) {
            die(jsonResponse("Trường $name không được bỏ trống.", false));
        }
    }

    return true;
}

function typePassword($data){
    return md5($data);
}

function createToken($length = 25) {
    $bytes = random_bytes($length);
    return bin2hex($bytes);
}

function getUserIP() {
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function FULL_URL($path) {
    return "https://".$_SERVER['SERVER_NAME'].$path;
}

function validUsername($username) {
    if(preg_match('/^[a-zA-Z0-9]{6,}$/', $username)) { 
        return true;
    }else{
        return false;
    }
}

function validPassword($password) {
    if(strlen($password) >= 8) {
        return true;
    }else{
        return false;
    }
}

function validFullname($fullname) {
    if(strlen($fullname) >= 5 && strlen($fullname) <= 30) {
        return true;
    }else{
        return false;
    }
}

function validPhone($phone){
    if(preg_match("/^\d+\.?\d*$/",$phone)){
        if(strlen($phone) >= 10 && strlen($phone) <= 11) {
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function typeTelco($data) {
    # FUNCTION NÀY CHỈ ĐƯỢC SỬ DỤNG TRONG MUA THẺ ĐIỆN THOẠI VÀ MUA THẺ GAME

    $arr_telco = array(
        "Zing" => "ZING",
        "Viettel" => "VTT",
        "Vinaphone" => "VNP",
        "Garena" => "GAR",
        "Vietnammobile" => "VNM",
        "Mobifone" => "VMS",
        "Vcoin" => "VTC",
        "Gate" => "FPT"
    );

    $telco = $arr_telco[$data];

    if(!empty($telco)) {
        return $telco;
    }
}

function getProviderID($data) {
    # FUNCTION NÀY CHỈ ĐƯỢC SỬ DỤNG TRONG MUA THẺ ĐIỆN THOẠI VÀ MUA THẺ GAME

    $arr_telco = array(
        "Zing" => 12,
        "Viettel" => 1,
        "Vinaphone" => 3,
        "Garena" => 14,
        "Vietnammobile" => 7,
        "Mobifone" => 2,
        "Vcoin" => 13,
        "Gate" => 5
    );

    $telco = $arr_telco[$data];

    if(!empty($telco)) {
        return $telco;
    }
}

function curlGet($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $data = curl_exec($ch);
    
    curl_close($ch);
    return $data;
}

function rand_string($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function rand_int($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function formatDate($time){
    return date('d/m/Y H:i:s', $time);
}

function detectTelco($phone) {
    $prefix = substr($phone, 0, 3);
    
    $viettel_arr = ['086', '096', '097', '098', '032', '033', '034', '035', '036', '037', '038', '039'];
    $vinaphone_arr = ['088', '091', '094', '083', '084', '085', '081', '082'];
    $mobifone_arr = ['089', '090', '093', '070', '079', '077', '076', '078'];
    $vietnammobile_arr = ['092', '056', '058'];
    $gmobile_arr = ['099', '059'];

    if(in_array($prefix, $viettel_arr)) {
        return "VIETTEL";
    }

    if(in_array($prefix, $vinaphone_arr)) {
        return "VINAPHONE";
    }

    if(in_array($prefix, $mobifone_arr)) {
        return "MOBIFONE";
    }

    if(in_array($prefix, $vietnammobile_arr)) {
        return "VIETNAMMOBILE";
    }

    if(in_array($prefix, $gmobile_arr)) {
        return "GMOBILE";
    }

    return "???";
}

function bank_data() {
    // KHÔNG DÙNG HOẶC THÊM THÌ COPY HOẶC XÓA DÒNG ĐÓ

    return array(
        'MOMO' => 'MOMO - VÍ ĐIỆN TỬ',
        'THESIEURE' => 'THESIEURE - VÍ ĐIỆN TỬ',
        'TECHCOMBANK' => 'TECHCOMBANK - NH TMCP KY THUONG VIET NAM (TCB)',
        'VIETCOMBANK' => 'VIETCOMBANK -NH TMCP NGOAI THUONG VIET NAM (VCB)',
        'BIDV' => 'BIDV - NH DAU TU VA PHAT TRIEN VIET NAM',
        'VIETINBANK' => 'VIETINBANK - NH TMCP CONG THUONG VIET NAM',
        'AGRIBANK' => 'AGRIBANK - NH NN - PTNT VIET NAM',
        'SACOMBANK' => 'SACOMBANK - NH TMCP SAI GON THUONG TIN',
        'DONGABANK' => 'DONGABANK -NH TMCP DONG A (EAB)',
        'VPBANK' => 'VPBANK - NH TMCP VIET NAM THINH VUONG',
        'TPBANK' => 'TPBANK - NH TMCP TIEN PHONG',
        'SHINHANBANK' => 'SHINHANBANK - NH TNHH SHINHAN VIET NAM',
        'ACB' => 'ACB - NH TMCP A CHAU',
        'MB BANK' => 'MB BANK - NH TMCP QUAN DOI',
        'SCB' => 'SCB - NH TMCP SAI GON',
        'SHB' => 'SHB - NH TMCP SAI GON HA NOI',
        'MSB' => 'MSB - Ngân Hàng TMCP Hàng Hải Việt Nam',
        'SEABANK' => 'SEABANK - NH TMCP XUAT NHAP KHAU VIET NAM (EIB)',
        'SEABANK' => 'SEABANK - NH TMCP DONG NAM A',
        'BAOVIETBANK' => 'BAOVIETBANK - NH TMCP BAO VIET (BVB)',
        'GPBANK' => 'GPBANK - NH TMCP DAU KHI TOAN CAU (GPB)',
        'HDBANK' => 'HDBANK - NH TMCP PHAT TRIEN TP.HCM (HDB)',
        'KIENLONGBANK' => 'KIENLONGBANK - NH TMCP KIEN LONG',
        'LIENVIETPOSTBANK' => 'LIENVIETPOSTBANK - NH TMCP LIEN VIET',
        'NAMABANK' => 'NAMABANK - NHTMCP NAM A (NAB)',
        'OCB' => 'OCB - NH TMCP PHUONG DONG',
        'OCEANBANK' => 'OCEANBANK - NH TMCP DAI DUONG (OJB)',
        'VIB' => 'VIB - NH TMCP QUOC TE VIET NAM',
        'VIETABANK' => 'VIETABANK - NH TMCP VIET A'
    );
}

function status_withdraw($data) {
    switch($data) {
        case 'success':
            return '<span class="badge badge-success">Thành công</span>';
            break;
        case 'wait':
            return '<span class="badge badge-warning">Chờ duyệt</span>';
            break;
        case 'cancel':
            return '<span class="badge badge-danger">Đã hủy</span>';
            break;
    }
}

function amount_data() {
    // KHÔNG ĐƯỢC CHỈNH SỬA FUNCTION NÀY

    return array(
        '10000' => '10,000 đ',
        '20000' => '20,000 đ',
        '30000' => '30,000 đ',
        '50000' => '50,000 đ',
        '100000' => '100,000 đ',
        '200000' => '200,000 đ',
        '300000' => '300,000 đ',
        '500000' => '500,000 đ',
        '1000000' => '1,000,000 đ'
    );
}

function getPercent($telco, $rank, $cash) {
    global $JTech;
    $percent = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `telco-rate` WHERE `telco` = '$telco' "))[$rank."_".$cash];
    return $percent;
}

function getRecieve($telco, $cash, $rank) {
    global $JTech;
    $percent = getPercent($telco, $rank, $cash);
    return $cash * ((100 - $percent) / 100);
}

function server_data() {
    // KHÔNG ĐƯỢC CHỈNH SỬA FUNCTION NÀY

    return array(
        'trumthe' => 'trumthe.vn',
        'gachthe1s' => 'gachthe1s.com',
        'doithe' => 'doithe.vn',
        'tcv' => 'thecaovip.xyz'
    );
}

function theme_mode() {
    global $JTech;

    switch($JTech->setting('theme_mode')) {
        case 'darkgray':
            return '<link rel="stylesheet" id="css-theme" href="https://'.$_SERVER['SERVER_NAME'].'/frontend/main/assets/css/themes/xwork.min.css">';
            break;
        case 'darkblue':
            return '<link rel="stylesheet" id="css-theme" href="https://'.$_SERVER['SERVER_NAME'].'/frontend/main/assets/css/themes/xmodern.min.css">';
            break;
        case 'darkgreen':
            return '<link rel="stylesheet" id="css-theme" href="https://'.$_SERVER['SERVER_NAME'].'/frontend/main/assets/css/themes/xeco.min.css">';
            break;
        case 'smoothpurple':
            return '<link rel="stylesheet" id="css-theme" href="https://'.$_SERVER['SERVER_NAME'].'/frontend/main/assets/css/themes/xsmooth.min.css">';
            break;
        case 'inspiregreen':
            return '<link rel="stylesheet" id="css-theme" href="https://'.$_SERVER['SERVER_NAME'].'/frontend/main/assets/css/themes/xinspire.min.css">';
            break;
        case 'darkblue2':
            return '<link rel="stylesheet" id="css-theme" href="https://'.$_SERVER['SERVER_NAME'].'/frontend/main/assets/css/themes/xdream.min.css">';
            break;
        case 'darkgray2':
            return '<link rel="stylesheet" id="css-theme" href="https://'.$_SERVER['SERVER_NAME'].'/frontend/main/assets/css/themes/xpro.min.css">';
            break;
        case 'darkgray3':
            return '<link rel="stylesheet" id="css-theme" href="https://'.$_SERVER['SERVER_NAME'].'/frontend/main/assets/css/themes/xplay.min.css">';
            break;
        default:
            return '';
            break;
    }
}

function status_card($data) {
    switch($data) {
        case 'success':
            return '<span class="badge badge-success">Thẻ đúng</span>';
            break;
        case 'wait':
            return '<span class="badge badge-warning">Thẻ chờ</span>';
            break;
        case 'fail':
            return '<span class="badge badge-danger">Thẻ sai</span>';
            break;
        case 'wrong_amount':
            return '<span class="badge badge-info">Sai mệnh giá</span>';
            break;
    }
}

function getTelco($telco, $value) {
    global $JTech;
    return mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `telco-rate` WHERE `telco` = '$telco' "))[$value];
}

function status_api($data) {
    switch($data) {
        case 'active':
            return '<span class="badge badge-success">Hoạt động</span>';
            break;
        case 'non-active':
            return '<span class="badge badge-secondary">Đang tắt</span>';
            break;
    }
}

function jsonPretty($data) {
    // ĐỂ SỬ DỤNG FUNCTION NÀY PHẢI CÓ HEADER Content-Type: application/json;

    return json_encode($data, JSON_PRETTY_PRINT);
}

function check_spam($username) {
    global $JTech;

    $num_rows = $JTech->db_num_rows("SELECT * FROM `card-data` WHERE `username` = '$username' AND `status` = 'fail' AND `day` = '".date('d')."' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' ");
    
    if($num_rows >= 20) {
        return true;
    } else {
        return false;
    }
}

function memo_recharge($type){

    global $JTech;

    $mode = $JTech->setting('memo_mode');

    switch($type){
        case 'page':
            if($JTech->checkToken('request')) { 
                if($mode == 'uid'){
                    return $JTech->setting('memo_name').$JTech->user('id');      
                }

                if($mode == 'user'){
                    return $JTech->setting('memo_name').$JTech->user('username');      
                }
            }
            break;
    }
}

function jzonParseContent($str){
    global $JTech;
    preg_match('/'.$JTech->setting('memo_name').'(.*[^\s])/', $str, $matches);
    return $matches[1];
}

function getProfit($amount, $amount_recieve, $percent) {
    $ok1 = $amount - $amount_recieve;
    $ok2 = $ok1 * ((100 - $percent) / 100);

    return $ok1 - $ok2;
}

function total_card($telco){
    global $JTech;
    return $JTech->db_num_rows("SELECT * FROM `card-data` WHERE `telco` = '$telco' AND `status` = 'success' OR `status` = 'wrong_amount' ");
}

function sendTele($message){
    global $JTech;
    
    $tele_token = $JTech->setting('tele_token');
    $tele_chatid = $JTech->setting('tele_chatid');
    
    $data = http_build_query([
        'chat_id' => $tele_chatid,
        'text' => $message,
    ]);
    
    $url = 'https://api.telegram.org/bot'.$tele_token.'/sendMessage';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Win) AppleWebKit/1000.0 (KHTML, like Gecko) Chrome/65.663 Safari/1000.01');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    if($data){
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function templateTele($content){
    return "🔔 THÔNG BÁO

📝 Nội dung: ".$content."
🕒 Thời gian: ".date('d/m/Y H:i:s');
}

function noficationSelect($name) {
    global $JTech;

    if($JTech->setting($name) == 'yes') {
        return 'checked';
    }
}

function addTop($username, $cash){

    global $JTech;
    
    // RESET TOP KHI HẾT THÁNG
    $JTech->db_query("DELETE FROM `rank` WHERE `month` != '".date('m')."' OR `year` != '".date('Y')."' ");

    $check = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `rank` WHERE `username` = '$username' "));

    if($check){
        // NẾU ĐÃ TỒN TẠI TRONG SQL
        $JTech->db_query("UPDATE `rank` SET `cash` = `cash` + '$cash' WHERE `username` = '$username' ");
    }else{
        // NẾU CHƯA TỒN TẠI TRONG SQL
        $JTech->db_query("INSERT INTO `rank` (`username`, `cash`, `month`, `year`) VALUES ('$username', '$cash', '".date('m')."', '".date('Y')."') ");
    }

}

function isMobile(){
    $useragent = $_SERVER['HTTP_USER_AGENT'];

    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        return true;
    }else{
        return false;
    }

}


function google_captcha($captcha) {

    global $JTech;

    $ip = $_SERVER['REMOTE_ADDR'];
    // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($JTech->setting('google_secret_key')) . '&response=' . urlencode($captcha).'&remoteip='.$ip;
    $response = file_get_contents($url);
    $json = json_decode($response, true);

    if($json['success']) {
        return true;
    }else{
        return false;
    }
}


function show_name_rank($name) {

    global $JTech;

    if($JTech->setting('hide_name_rank') == 'yes') {
        return substr_replace($name, "****", 5);
    }else{
        return $name;
    }
}
function serverExCard($telco, $pin, $serial, $amount, $request_id) {
    global $JTech;

    $data = array(
        'request_id' => $request_id,
        'telco' => $telco,
        'pin' => $pin,
        'serial' => $serial,
        'amount' => $amount
    );
        
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => 'http://'.server_data()[$JTech->setting('server_ex_card')].'/api/send-card?'.http_build_query($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
            'partner_id: '.$JTech->setting('partner_id').'',
            'partner_key: '.$JTech->setting('partner_key').''
        ],
    ]);

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response, true);
}
