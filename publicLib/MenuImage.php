
<?php

class MenuImage
{
	var $url;//
	var $createtime;//
  var $msgid;//
  var $id;//
  var $username;
  var $status;

	 //定义一个构造方法初始化赋值
    function __construct($url, $createtime,$msgid,$id,$username,$status) {
        $this->url = $url;
        $this->createtime = $createtime;
        $this->msgid = $msgid;

        $this->id = $id;
        $this->username = $username;
        $this->status = $status;
    }
    //保存菜单图片信息
    public function save(){
      //合成sql语句
      $username = $this->username;
      $url = $this->url;
      $createtime = $this->createtime;
      $msgid = $this->msgid;

      $rowvalues = "('$url','$createtime','$msgid','$username')";
      $query_string = "insert into menuimage(url,createtime,msgid,username) values ".$rowvalues.";"; 
      //插入数据库
      $r = mysql_query($query_string);
      if (!$r){
        die('插入Error: ' . mysql_error());
      } 
    }  
}

?>