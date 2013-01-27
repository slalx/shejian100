<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf8">
		<link rel="stylesheet" type="text/css" href="/resource/common.css">
		<link rel="stylesheet" type="text/css" href="/resource/css/login.css">
		<title>商户合作平台登录</title> 
	</head>
	<body class="loginpage">
		<div class="header">
			<div class="headerContent">
				<div class="icon left"></div>
				<a class="right" href="/index.php?module=login" id="loginLink" un="login">登录</a>
				<a class="right" href="/index.php?module=reg" id="regLink" un="reg">注册</a>
				<div class="clr"></div>
			</div>
		</div>
		<?php 
            $module = $_GET["module"];
            if(!$module){
                $module = 'desc';
            }
        ?>
		<div class="container"> 
			<div class="content">
				<?php include $_SERVER['DOCUMENT_ROOT'].'/customer/uc/'.$module.'.php'; ?>
			</div>
		</div>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/customer/include/footer.php'; ?>
		<script src="/resource/js/jQuery.js"></script>
		<script src="/resource/js/cookie.js"></script>
	</body>
</html>

