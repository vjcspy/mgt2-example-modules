<?php
declare(strict_types=1);
/**
 * @by SwiftOtter, Inc., 2019/02/12
 * @website https://swiftotter.com
 **/
/** Adapted from: https://inchoo.net/magento-2/magento-2-api/ */

$userData = array("username" => "admin", "password" => "Joseph123");
$ch = curl_init("https://lc.commerce.site/rest/V1/integration/admin/token");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Length: " . strlen(json_encode($userData))));

$token = curl_exec($ch);

var_dump($token);

$ch = curl_init("http://lc.commerce.site/rest/V1/acl");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));

$result = curl_exec($ch);

var_dump($result);