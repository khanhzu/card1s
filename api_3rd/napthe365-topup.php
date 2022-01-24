<?php

function login_buycard($userName, $password, $security){
	$bk = 'https://napthe365.com/v2/PayCard/DangNhap';
	$soap_request="userName=".$userName."&password=".$password."&security=".$security;		

	$curl = curl_init($bk.'?'.$soap_request);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl,CURLOPT_CONNECTTIMEOUT ,30);
	curl_setopt($curl, CURLOPT_ENCODING, "gzip");
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($curl, CURLOPT_POSTFIELDS,$soap_request);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($curl, CURLOPT_POST,           true );
	$data = curl_exec($curl);
	if (!is_object(json_decode($data))) {
		return json_decode($data);
	}else{
		echo "Tài khoản hoặc mật khẩu không đúng vui lòng kiểm tra lại!";
		unset($data);
		die;
	}
}


function naptien($userName, $password, $security, $card){
	$token_card = login_buycard($userName, $password, $security);

	$bk = 'https://napthe365.com/v2/PayCards/TelcoPay/TopupMobile';
	$soap_request="msg=$card";
	$curl = curl_init($bk.'?'.$soap_request);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl,CURLOPT_CONNECTTIMEOUT ,30);
	curl_setopt($curl, CURLOPT_ENCODING, "gzip");
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($curl, CURLOPT_POSTFIELDS,$soap_request);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($curl, CURLOPT_POST,           true );
	curl_setopt($curl, CURLOPT_HTTPHEADER,     array("Token:$token_card"));

	$data = curl_exec($curl);
	return $data;
}

?>