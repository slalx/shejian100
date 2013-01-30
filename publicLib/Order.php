<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/publicLib/page.php';

class Order
{
	var $userid;//用户微信号
  var $restaurantid;//餐馆编号
	var $orderinfo;//订单信息
  var $address;//送餐地址
  var $telephone;//用户手机号
  var $createtime;//订单创建时间
  var $chusername;//订单用户姓名

	 //定义一个构造方法初始化赋值
    function __construct($userid, $restaurantid, $orderinfo,$address,$telephone,$chusername) {
        $this->userid = $userid;
        $this->restaurantid = $restaurantid;
        $this->orderinfo = $orderinfo;
        $this->address = $address;
        $this->telephone = $telephone;
        $this->chusername = $chusername;
    }
    //保存订单
    public function save(){
      //合成sql语句
      $userid = $this->userid;
      $restaurantid = $this->restaurantid;
      $orderinfo = $this->orderinfo;
      $address = $this->address;
      $telephone = $this->telephone;
      $chusername = $this->chusername;

      $rowvalues = "('$userid','$restaurantid','$orderinfo','$address','$telephone','$chusername')";
      $query_string = "insert into orderform(userid,restaurantid,orderinfo,address,telephone,chusername) values ".$rowvalues.";"; 
      //插入数据库
      $r = mysql_query($query_string);
      if (!$r){
        die('插入Error: ' . mysql_error());
      } 
    }
    //根据日期查询订单
    public function getOrdersByDate($page,$pagesize,$sqlcondition){
      $orderpage = new Page($page, $pagesize, $sqlcondition, 'orderform');
      $orderresult = $orderpage->sqlQueryResults($sqlcondition);
      return $orderresult;
    }
    //计算总订单数
    public function getTotalOrdersCount($page, $pagesize, $sqlcondition){
      $orderpage = new Page($page, $pagesize, $sqlcondition, 'orderform');
      $totalOrdersCount = $orderpage->calToltalPages();
      return $totalOrdersCount;
    }
    //
    //保存订单
    public function delete($id){
      //合成sql语句
      $query_string = "delete from orderform where id=$id;"; 

      $r = mysql_query($query_string);
      if (!$r){
        die('插入Error: ' . mysql_error());
      } 
      return $r;
    }
    //更新订单状态
    public function updateStatus($id,$status){
      //合成sql语句
      $query_string = "update orderform set status=$status where id=$id;"; 

      $r = mysql_query($query_string);
      if (!$r){
        die('插入Error: ' . mysql_error());
      } 
      return $r;
    }
}

?>