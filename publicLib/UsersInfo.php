<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/publicLib/page.php';

class UsersInfo
{
	var $id;//用户微信号
  var $username;//餐馆编号
	var $address;//订单信息
  var $telephone;//送餐地址
  var $type;//用户手机号
  var $createtime;//订单创建时间

	 //定义一个构造方法初始化赋值
    function __construct($username, $address, $telephone,$type) {
        $this->username = $username;
        $this->address = $address;
        $this->telephone = $telephone;
        $this->type = $type;
    }
    //保存用户信息
    public function save(){
      //合成sql语句
      $username = $this->username;
      $address = $this->address;
      $telephone = $this->telephone;
      $type = $this->type;

      $rowvalues = "('$username','$address','$telephone','$type')";
      $query_string = "insert into usersinfo(username,address,telephone,type) values ".$rowvalues.";"; 
      //插入数据库
      $r = mysql_query($query_string);
      if (!$r){
        die('插入Error: ' . mysql_error());
      } 
    }
    //根据日期查询订单
    public function getOrdersByDate($page,$pagesize,$sqlcondition){
      $orderpage = new Page($page, $pagesize, $sqlcondition, 'usersinfo');
      $orderresult = $orderpage->sqlQueryResults($sqlcondition);
      return $orderresult;
    }
    //计算总订单数
    public function getTotalOrdersCount($page, $pagesize, $sqlcondition){
      $orderpage = new Page($page, $pagesize, $sqlcondition, 'usersinfo');
      $totalOrdersCount = $orderpage->calToltalPages();
      return $totalOrdersCount;
    }
    //
}

?>