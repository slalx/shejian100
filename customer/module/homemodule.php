<?php
include $_SERVER['DOCUMENT_ROOT'].'/db/db_open.php';

$restaurantid = $_COOKIE["sj_uid"];

$query_string = "select * from store where id='$restaurantid'"; 
//插入数据库
$result = mysql_query($query_string);
$storerow = mysql_fetch_array($result);
if($storerow){
    $name = $storerow[name];
    $ownername = $storerow[ownername];
    $coverimage = $storerow[coverimage];
}
$tasktitle = "新功能推荐";
$tasklists = '<p ><a href="#" style="color:red;display:none;">商家广场 &gt;&gt;</a></p>';
if($coverimage==0){
    $tasktitle = "装修店铺";
    $tasklists = $tasklists.'<p ><a href="/customer/home.php?module=editstorecover" style="color:red;">上传店铺封面 &gt;&gt;</a><br>&nbsp;&nbsp;有封面的店铺才能展示给食客</p>';
    $tasklists.='<p ><a href="/customer/home.php?module=menumanager" style="color:red;">管理菜单 &gt;&gt;</a><br>&nbsp;&nbsp;随时可以修改你店里的菜单</p>' ;
} 
?>
<script>
    document.getElementById('storenameid').innerHTML='<?= $name ?>';
</script>
<div id="main" class="container">
    <div class="containerBox boxIndex"> 
        <div class="mainPanel"> 
            <h2 class="h2">欢迎你，<?= $ownername ?></h2> 
            <div class="todoList"> <h3 class="">店铺动态</h3> </div> 
            <div id="wxChartsFans" class="wxCharts">
                <div class="highcharts-container" id="highcharts-0" style="position: relative; overflow: hidden; width: 660px; height: 300px; text-align: left; line-height: normal; font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; ">
                    <?php
                        if ($_GET['direct'] == 'reg'){
                    ?>
                    <a href="/customer/home.php?module=menumanager" style="color:red;">还没有添加菜单，抓紧去添加菜单吧！！！</a>
                    <?php } ?>
                </div>
            </div> 
        </div> 
        <div class="extendPanel"> 
            <div class="extInfo"> 
                <h3><?= $tasktitle ?></h3> 
                <?= $tasklists ?>
            </div> 
            <div class="extInfo"> 
                <h3>系统公告</h3> 
                <p>如果你在使用过程中有任何疑问或者建议，请联系我们进行咨询反馈<br>微信号：shejian_100<br>联系邮箱：<a href="mailto:shejian100@163.com">shejian100@163.com</a></a><br></span></p> 
            </div> 
        </div> 
    </div>
</div>