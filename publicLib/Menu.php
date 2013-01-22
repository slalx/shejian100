
<?php

class Menu
{
	var $name;//菜名
	var $price;//菜价

	 //定义一个构造方法初始化赋值
    function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
    //把一个数据库的查询结果转换成放有该对象的数组
    public function getMenuList($result){
      $menulist =array();
      if ($result != false){
        while($menurow = mysql_fetch_array($result)){
          $menu = new Menu($menurow["name"],$menurow["price"]);
          array_push($menulist,$menu);
        }
        return $menulist;
      }
    }
}

?>