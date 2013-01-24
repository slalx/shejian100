
<?php

class Store
{
	var $name;//店名
	var $address;//店址
  var $id;//店的编号
  var $lat;//纬度
  var $lon;//经度

	 //定义一个构造方法初始化赋值
    function __construct($name, $address,$id,$lat,$lon) {
        $this->name = $name;
        $this->address = $address;
        $this->id = $id;

        $this->lat = $lat;
        $this->lon = $lon;
    }
    //把一个数据库的查询结果转换成放有该对象的数组
    public function getStoreList($result){
      $storelist =array();
      if ($result != false){
        while($storerow = mysql_fetch_array($result)){
          $store = new Store($storerow["name"],
                             $storerow["address"],
                             $storerow["id"],
                             $storerow["latitude"],
                             $storerow["longitude"]);
          array_push($storelist,$store);
        }
        return $storelist;
      }
    }
}

?>