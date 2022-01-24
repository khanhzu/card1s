<?php

require('../../core/database.php');
require('../../core/function.php');

$token = $JTech->getToken();

if($token === NULL || empty($token)) {
    exit('Bạn chưa đăng nhập mà ???');
}

$JTech->db_query("UPDATE `users` SET `token` = '', `is_verify` = 0 WHERE `token` = '$token' LIMIT 1");
unset($_COOKIE['token']);
setcookie('token', null, -1, '/');
header('Location: /account/login');
