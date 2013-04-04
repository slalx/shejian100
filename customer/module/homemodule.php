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
            <div class="todoList"> <h3 class="">店铺动态</h3> 
                <?php
                        if ($_GET['direct'] == 'reg'){
                    ?>
                    <a href="/customer/home.php?module=menumanager" style="color:red;">还没有添加菜单，抓紧去添加菜单吧！！！</a>
                    <?php } ?></div> 
            <div id="wxChartsFans" class="wxCharts"></div> 
            <div id="wxChartsMsgNum" class="wxCharts"></div>
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
<script src="/resource/js/highcharts3.0.js"></script>
<script type="text/javascript">

(function(){

  var DATA = {};
  DATA.chartsData = {
    recvMsgStat: [0,0,0,0,0,1,0],
    fansStat: [0,0,1,0,0,0,0]
  };
    

  DATA.month = "4" * 1;
  DATA.day = "4" * 1;
  var initChartsFans = function(days){
    var chart = new Highcharts.Chart({
          chart: {
              renderTo: 'wxChartsFans',
              zoomType: 'xy'
          },
          title: {
              text: "每日新增订单数"
          },
          xAxis: [{
              labels:{
                  formatter: function() {
                      return this.value;
                  },
                  style: {
                      color: '#7eafdd'
                  }
              },
              title: {
                  text: '',
                  style: {
                      color: '#7eafdd'
                  }
              },
              categories: days
          }],
          yAxis: [{ // Secondary yAxis
              title: {
                  text: "每日新增订单数",
                  style: {
                      color: '#4572A7'
                  }
              },
              labels: {
                  formatter: function() {
                      return this.value + '个';
                  },
                  style: {
                      color: '#4572A7'
                  }
              },
              allowDecimals:false

          }],
          tooltip: {
              formatter: function() {
                  var unit = {
                      "每日新增订单数": "个"

                  }[this.series.name];

                  return ''+
                      this.x +': '+ this.y +' '+ unit;
              }
          },
          legend: {
                enabled:false
            },
          series: [{
              name: "每日新增订单数",
              color: '#4572A7',
              type: 'spline',
              data: DATA.chartsData.fansStat
          }],
          exporting: {
              enabled: false
          }
      });
  }
  var initChartsMsgNum = function(days){
    var chart = new Highcharts.Chart({
          chart: {
              renderTo: 'wxChartsMsgNum',
              zoomType: 'xy'
          },
          title: {
              text: "每日接收订单数"
          },
          xAxis: [{
              labels:{
                  formatter: function() {
                      return this.value;
                  },
                  style: {
                      color: '#7eafdd'
                  }
              },
              title: {
                  text: '',
                  style: {
                      color: '#7eafdd'
                  }
              },
              categories: days
          }],
          yAxis: [{ // Primary yAxis
              labels: {
                  formatter: function() {
                      return this.value + '条';
                  },
                  style: {
                      color: '#89A54E'
                  }
              },
              min: 0,
              title: {
                  text: "每日接收订单数",
                  style: {
                      color: '#89A54E'
                  }
              },
              allowDecimals:false
          }],
          tooltip: {
              formatter: function() {
                  var unit = {
                      "每日接收订单数": "单"
                  }[this.series.name];

                  return ''+
                      this.x +': '+ this.y +' '+ unit;
              }
          },
          legend: {
                enabled:false
            },
          series: [{
              name: "每日接收订单数",
              color: '#89A54E',
              type: 'spline',
              data: DATA.chartsData.recvMsgStat
          }],
          exporting: {
              enabled: false
          }
      });
  }


  var getDaysList = function(_day, _month){
    var yesObj = {},
      dayList = [],
      day = _day,
      month = _month;
    for(var i = 0; i < 7; i++){
      yesObj = getYesterday(day,month);
      day = yesObj.day;
      month = yesObj.month;
      dayList.push(month+'-'+day);
    }
    return dayList.reverse();
  }
  var isLeapYear = function(utc){
    var d = new Date, y = utc ? d.getUTCFullYear() : d.getFullYear();
    return !(y % 4) && (y % 100) || !(y % 400) ? true : false;
    
  };
  var getYesterday = function(day,month){
    var monthDays = [31,28,31,30,31,30,31,31,30,31,30,31],
      yDay = day - 1,
      yMonth = month;
    if(yDay <= 0){/*last month*/
      yMonth -= 1;
      yMonth = yMonth <= 0 ? 12 : yMonth;
      if(yMonth == 2 && isLeapYear()){
        yDay = 29;
      }else if(yMonth == 2 && !isLeapYear()){
        yDay = 28;
      }else{
        yDay = monthDays[yMonth - 1];
      }
    }
    return {day:yDay,month:yMonth};
  }

  var main = function(){
    if (DATA.chartsData.recvMsgStat != '' &&  DATA.chartsData.fansStat != ''){
        DATA.chartsData = {
          recvMsgStat: DATA.chartsData.recvMsgStat.reverse(),
          fansStat: DATA.chartsData.fansStat.reverse()
        };
        var days = getDaysList(DATA.day, DATA.month);
        initChartsFans(days);
        initChartsMsgNum(days);
    }
  }

  main();


})();
</script>







