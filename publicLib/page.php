
<?php

class Page
{
	var $page;//当前页数
	var $pagesize;//每页显示的数目
	var $querycondition;//查询条件
	var $querytable;//查询的表

	//定义一个构造方法初始化赋值
    function __construct($page, $pagesize, $querycondition, $querytable) {
        $this->page = $page;
        $this->pagesize = $pagesize;
        $this->querycondition = $querycondition;
        $this->querytable = $querytable;
    }
    //执行查询
    public function sqlQueryResults(){
    	$offset = $this->calOffset();
    	$pagesize = $this->pagesize;
    	$sqlcondition = $this->querycondition;
    	$querytable = $this->querytable;

    	$menurs = mysql_query("select * from $querytable $sqlcondition  order by id desc limit $offset,$pagesize;");

      return $menurs;
    }
    //计算总页数
    public function calToltalPages(){
    	//取得记录总数$rs,计算总页数用
    	$sqltype = $this->querycondition;
    	$querytable = $this->querytable;
      $pagesize = $this->pagesize;
		  $rsss = mysql_query("select count(*) from $querytable $sqltype");
  		$myrow = mysql_fetch_array($rsss);
  		$numrows = $myrow[0];
		//计算总页数
  		$pages = intval($numrows / $pagesize);
  		if ($numrows % $pagesize){
			$pages++;
  		}
  		return $pages;
    }
    //计算偏移量
    private function calOffset(){
    	$offset = $this->pagesize*($this->page - 1);
    	return $offset;
    }
}

?>