<?php  
session_start();  
if($_SESSION[username]==""){  
    echo "<script>alert('请登录!');window.location.href='/index.php?module=login';</script>";  
  }  
?>  
<html>
    <head>
        <meta charset="utf-8">
        <title>客户中心</title>
        <link rel="stylesheet" type="text/css" href="/resource/common.css">
        <link href="http://res.wx.qq.com/mpres/htmledition/images/favicon125122.ico" rel="Shortcut Icon">
    </head>
    <body class="zh_CN indexPage">

        <?php 
            $module = $_GET["module"];
            if(!$module){
                $module = 'homemodule';
            }
        ?>
        
        <?php include $_SERVER['DOCUMENT_ROOT'].'/customer/include/header.php'; ?>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/customer/module/'.$module.'.php'?>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/customer/include/footer.php'; ?>
    </body>
</html>

















