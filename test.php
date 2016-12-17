<?php

$url = 'https://rally1.rallydev.com/slm/webservice/v2.0/requirement/33525234744';
$username = 'rally-slack@nbcuni.com';
$password = '2Es*69EpMGW4Cbwr#hsIa7^1NPN4*#';

$crl = curl_init();
curl_setopt($crl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
curl_setopt($crl, CURLOPT_URL, $url);
curl_setopt($crl, CURLOPT_USERPWD, "$username:$password");
curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 30);

$response = curl_exec($crl);
$status_code = curl_getinfo($crl, CURLINFO_HTTP_CODE);

curl_close($crl);

var_dump($status_code);
var_dump(json_decode($response));
