
<div id="main" class="container">
    <div class="containerBox boxIndex"> 
        <div class="mainPanel"> 
            <h2 class="h2">欢迎你，<?= $_SESSION["username"] ?></h2> 
            <div class="todoList"> <h3 class="">最新订单</h3> </div> 
            <div id="wxChartsFans" class="wxCharts">
                <div class="highcharts-container" id="highcharts-0" style="position: relative; overflow: hidden; width: 660px; height: 300px; text-align: left; line-height: normal; font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; ">
                    <?php
                        if ($_GET['direct'] == 'reg'){
                    ?>
                    <a href="" style="color:red;">还没有添加菜单，抓紧去添加菜单吧！！！</a>
                    <?php } ?>
                </div>
            </div> 
        </div> 
        <div class="extendPanel"> 
            <div class="extInfo"> 
                <h3>系统公告</h3> 
                <p>如果你在使用过程中有任何疑问或者建议，请加我们的公众号进行咨询反馈：shejian_100<br>联系邮箱：<a href="mailto:shejian100@163.com">shejian100@163.com</a></a><br></span></p> 
            </div> 
            <div class="extInfo"> 
                <h3>新功能推荐</h3> 
                <p>商家广场 <a href="#">详情&gt;&gt;</a></p> 
            </div> 
        </div> 
    </div>
</div>