
<?php

class Store
{
	var $name;//店名
	var $address;//店址
  var $id;//店的编号
  var $lat;//纬度
  var $lon;//经度
  var $coverimageext;

	 //定义一个构造方法初始化赋值
    function __construct($name, $address,$id,$lat,$lon,$coverimageext) {
        $this->name = $name;
        $this->address = $address;
        $this->id = $id;

        $this->lat = $lat;
        $this->lon = $lon;

        $this->coverimageext = $coverimageext;
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
                             $storerow["longitude"],$storerow["coverimageext"]);
          array_push($storelist,$store);
        }
        return $storelist;
      }
    }
    public function getOneStoreById($storeid){
      //合成sql语句
      $query_string = "select * from store where id='$storeid';"; 

      $r = mysql_query($query_string);
      if (!$r){
        die('插入Error: ' . mysql_error());
      } 
      return $r; 
    }      
}

?>