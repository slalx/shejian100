<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/publicLib/page.php';

class FeedBack
{
	var $userid;//用户微信号
  var $restaurantid;//餐馆编号
	var $feedbackcontent;//订单信息


	 //定义一个构造方法初始化赋值
    function __construct($userid, $restaurantid, $feedbackcontent) {
        $this->userid = $userid;
        $this->restaurantid = $restaurantid;
        $this->feedbackcontent = $feedbackcontent;
    }
    //保存反馈信息
    public function save(){
      //合成sql语句
      $userid = $this->userid;
      $restaurantid = $this->restaurantid;
      $feedbackcontent = $this->feedbackcontent;

      $rowvalues = "('$userid','$restaurantid','$feedbackcontent')";
      $query_string = "insert into feedback(userid,restaurantid,feedback) values ".$rowvalues.";"; 
      //插入数据库
      $r = mysql_query($query_string);
      return $r;
    }

}

?>