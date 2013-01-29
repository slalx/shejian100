<div id="header" class="header"> 
    <div class="logoArea"> 
        <a class="logo left block" href="/"> <img src="/resource/i/logoshejian.png" alt="舌尖商家平台"> </a> 
        <div class="accountOp right"> 
            <span><a href="#"><?= $_SESSION["username"] ?></a></span> 
            <span class="none"><a href="#">帮助中心</a></span> 
            <span><a  href="/customer/uc/exit.php">退出</a></span> 
        </div> 
        <div class="clr"></div> 
    </div> 
    <div class="navigator"> 
        <ul class="textLarge"> 
            <li <?php if($_GET["module"]=='homemodule' || !$_GET["module"]){ ?>class="selected"<?php }?> ><a href="/customer/home.php" > 首页</a> </li> 
            <li <?php if($_GET["module"]=='menumanager' || $_GET["module"]=='addmenu'){ ?>class="selected"<?php }?>><a href="/customer/home.php?module=menumanager" > 菜单管理</a> </li> 
            <li <?php if($_GET["module"]=='usermanager'){ ?>class="selected"<?php }?>><a href="/customer/home.php?module=usermanager" > 用户管理</a> </li> 
            <li <?php if($_GET["module"]=='ordermanager'){ ?>class="selected"<?php }?>><a href="/customer/home.php?module=ordermanager" > 订单管理</a> </li> 
            <li <?php if($_GET["module"]=='customersettting'){ ?>class="selected"<?php }?>><a href="/customer/home.php?module=customersettting" > 设置</a> </li> 
        </ul> 
    </div> 
</div>