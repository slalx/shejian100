<?php
header('Content-Type: text/html; charset=utf-8');
/**
  * wechat reponse 
  */
include $_SERVER['DOCUMENT_ROOT'].'/responecenter/weixinresponse.php';
//define your token
define("TOKEN", "shejian");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();

include $_SERVER['DOCUMENT_ROOT'].'/db/db_close.php';
?>