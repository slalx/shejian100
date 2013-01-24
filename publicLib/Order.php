
<?php

class Order
{
	var $userid;//用户微信号
  var $restaurantid;//餐馆编号
	var $orderinfo;//订单信息
  var $address;//送餐地址
  var $telephone;//用户手机号
  var $createtime;//订单创建时间

	 //定义一个构造方法初始化赋值
    function __construct($userid, $restaurantid, $orderinfo,$address,$telephone) {
        $this->userid = $userid;
        $this->restaurantid = $restaurantid;
        $this->orderinfo = $orderinfo;
        $this->address = $address;
        $this->telephone = $telephone;
    }

    public function save(){
      //合成sql语句
      $userid = $this->userid;
      $restaurantid = $this->restaurantid;
      $orderinfo = $this->orderinfo;
      $address = $this->address;
      $telephone = $this->telephone;

      $rowvalues = "('$userid','$restaurantid','$orderinfo','$address','$telephone')";
      $query_string = "insert into orderform(userid,restaurantid,orderinfo,address,telephone) values ".$rowvalues.";"; 
      //插入数据库
      $r = mysql_query($query_string);
      if (!$r){
        die('插入Error: ' . mysql_error());
      }
       
    }
}

?>