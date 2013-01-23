
<?php

class Store
{
	var $name;//店名
	var $address;//店址

	 //定义一个构造方法初始化赋值
    function __construct($name, $address) {
        $this->name = $name;
        $this->address = $address;
    }
    //把一个数据库的查询结果转换成放有该对象的数组
    public function getStoreList($result){
      $storelist =array();
      if ($result != false){
        while($storerow = mysql_fetch_array($result)){
          $store = new Store($storerow["name"],$storerow["address"]);
          array_push($storelist,$store);
        }
        return $storelist;
      }
    }
}

?>