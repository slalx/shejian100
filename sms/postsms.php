<?php
    define('SCRIPT_ROOT',  dirname(__FILE__).'/');
require_once SCRIPT_ROOT.'demo_gbk.php';
date_default_timezone_set("Asia/Chongqing");
    sendSMS();
    echo "<br>";
    getBalance();
?>

