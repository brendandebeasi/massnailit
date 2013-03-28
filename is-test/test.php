<?php
require_once('src/conn.cfg.php');
require_once('src/isdk.php');

$app = new iSDK;
$app->cfgCon("mni");

$returnFields = ['Id','ProductName','ProductPrice','ShortDescription'];
$query = ['Id' => '%'];
$contacts = $app->dsQuery("Product",10,0,$query,$returnFields);
print_r($contacts);