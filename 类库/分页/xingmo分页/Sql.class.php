<?php
/**
 *名称:Sql.class.php
 *作用:常用Sql类
 *说明:
 *作者:KuaiYigang@xingmo.com
 *时间:2004-11-03
 **/
class Sql
{ 
	/******************************************
	  *函数：ifExist($table,$field,$value,$db)
	  *作用：判断数据表中是否存在一条数据
	  *输入：$table(数据表),$field(字段名),$value(数据),$db(连接库)
	  *输出：true:false
	  **
	  ******************************************
	  *－－制作－－日期－－
	  *kuaiyigang@xingmo.com  2004-06-29 09:15
	  ******************************************
	  *－－修改－－日期－－目的－－
	  *
	  */
	 function ifExist($table,$field,$value,$db)
	 {
		 $sql = "SELECT * FROM `".$table."` WHERE 1 ";
		 $sql .= "AND `".$field."` = '".$value."' ";
		 $res = $db -> GetAll($sql);
		 return count($res) ? true : false;
	 }

	/******************************************
	  *函数：listAll($from,$max,$sql_list,$db, $sql_page='')
	  *作用：列表显示
	  *输入：$_GET['from'],$max,$sql,$db, $sql_page
	  *输出：$sql
	  **
	  ******************************************
	  *－－制作－－日期－－
	  *KuaiYigang@xingmo.com  2004-06-29 09:15
	  ******************************************
	  *－－修改－－日期－－目的－－
	  *
	  */
	 function listAll($from,$max,$sql_list,$db,$sql_page)
	{
		 if(!isset($from))
		 {
			 $from=0;
		 }	
		if($sql_page=='')
		{
			$res = $db->GetAll($sql_list);
			$total = count($res);
			
		}
		else
		{
			$res = $db -> GetAll($sql_page);
			$total = $res[0][0];
		}
		$step=$total-$from;
		$step=$step>$max?$max:$step;#当前页显示的条数
		$sql_list .= "LIMIT $from,$step  ";#对当前页显示内容的查询
		$res = $db -> GetAll($sql_list);
		return (count($res)>0)?$res:false;
	}


	/******************************************
	  *函数：goPage($from,$f,$max,$sql,$db,$query='')
	  *作用：分页（首页，上一页，下一页，尾页）
	  *输入：$_GET['from'],'from',$max,$sql,$db,$query=''
	  *输出：首页，上一页，下一页，尾页
	  **
	  ******************************************
	  *－－制作－－日期－－
	  *KuaiYigang@xingmo.com  2004-06-29 09:20
	  ******************************************
	  *－－修改－－日期－－目的－－
	  *KuaiYigang@xingmo.com 2004-12-13 0:43 加了$query
	  */
	 public function goPage($from,$f,$max,$sql,$db,$query='',$IsSingle=1)
	{
		 $res = $db -> GetAll($sql);
		 if($IsSingle==1)
		{
			$total = $res[0][0];
		}
		else
		{
			$total = count($res);
		}
		 $pages=ceil($total/$max);
		 $num = ceil(($from+$max)/$max);#第几页

		 $return = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
		 $return .= "<td width=\"25%\" nowrap>第".$num."/".$pages."页&nbsp;每页".$max."条&nbsp;总数量".$total."&nbsp;</td>";
		 $return .= "<td width=\"50%\" nowrap align=\"center\"><a href=\"$PHP_SELF?$query&$f=0\">首页</a>&nbsp;";
		 if ($from>=$max)
		{
			 $return .= "<a href=\"$PHP_SELF?$query&$f=";
			 $return .= ($from-$max)."\">";
			 $return .= "上一页</a>&nbsp;";
		}		
		if($from+$max<$total)
		{
			$return .= "<a href=\"$PHP_SELF?$query&$f=";
			$return .=  ($from+$max)."\">";
			$return .= "下一页</a>&nbsp;";
		}		
		$return .= "<a href=\"$PHP_SELF?$query&$f=";	
		$return .= ((($pages*$max-$max) > 0) ? ($pages*$max-$max) : 0)."\">尾页</a>&nbsp;";
		$return .= "</td>";		
		$return .= "<td width=\"25%\" nowrap align=right>到<select name='select' onchange='javascript:window.location.href=this.options[this.selectedIndex].value'>";
		for($i=0;$i<$pages;$i++)
		{
			$j = $i + 1;
			$temp = $i * $max;
			$return .= "<option value=$PHP_SELF?$query&$f=$temp ";
			if($num == $j) 
			{
				$return .= "selected";
			}
			$return .= ">$j</option>";
		}
		$return .= "</select>页</td>";
		$return .= " </tr></table>";	
		
		return $return;
	}
	function goPageText($from,$f,$max,$sql,$db,$query='',$IsSingle=1)
	{
		 //$total = count($res);
		 $res = $db -> GetAll($sql);
		 if($IsSingle==1)
		{
			$total = $res[0][0];
		}
		else
		{
			$total = count($res);
		}
		 $pages=ceil($total/$max);
		 $num = ceil(($from+$max)/$max);#第几页

		 $return = "第".$num."/".$pages."页&nbsp;每页".$max."条&nbsp;总数量".$total."&nbsp;";
		 
		 if ($from>=$max)
		{
			 $return .= "<a href=\"$PHP_SELF?$query&$f=0\">首页</a>&nbsp;";
			 $return .= "<a href=\"$PHP_SELF?$query&$f=";
			 $return .= ($from-$max)."\">";
			 $return .= "上一页</a>&nbsp;";
		}		
		if($from+$max<$total)
		{
			$return .= "<a href=\"$PHP_SELF?$query&$f=";
			$return .=  ($from+$max)."\">";
			$return .= "下一页</a>&nbsp;";
			$return .= "<a href=\"$PHP_SELF?$query&$f=";	
			$return .= ((($pages*$max-$max) > 0) ? ($pages*$max-$max) : 0)."\">尾页</a>&nbsp;";
		}		
		
		$return .= "到<select name='select' onchange='javascript:window.location.href=this.options[this.selectedIndex].value'>";
		for($i=0;$i<$pages;$i++)
		{
			$j = $i + 1;
			$temp = $i * $max;
			$return .= "<option value=$PHP_SELF?$query&$f=$temp ";
			if($num == $j) 
			{
				$return .= "selected";
			}
			$return .= ">$j</option>";
		}
		$return .= "</select>页";
	
		return $return;
	}
		/******************************************
	  *函数：listAlldate($from,$max,$sql_list,$db, $sql_page='')
	  *作用：列表显示
	  *输入：$_GET['page'],$max,$sql,$db, $sql_page
	  *输出：$sql
	  **
	  ******************************************
	  *－－制作－－日期－－
	  *KuaiYigang@xingmo.com  2004-06-29 09:15
	  ******************************************
	  *－－修改－－日期－－目的－－
	  *
	  */
	 function listAlldate($from,$max,$sql_list,$db)
	{
		 if($from == 0 || $from == "")
		 {
			 $from=1;
		 }	
			
			$res = $db->GetAll($sql_list);
			$total = count($res);
		$start = ($from-1)*$max;	
		//$step = $max*$from - 1;
		//$step=$total-$from;
		$step=$step>$max?$max:$step;#当前页显示的条数
		$sql_list .= "LIMIT $start,$max  ";#对当前页显示内容的查询
		$res = $db -> GetAll($sql_list);
		return (count($res)>0)?$res:false;
	}
	/******************************************
	  *函数：gotoPage($from,$f,$max,$sql,$db,$query='')
	  *作用：分页（首页，上一页，下一页，尾页）
	  *输入：$_GET['page'],'page',$max,$sql,$db,$query=''
	  *输出：首页，上一页，下一页，尾页
	  **
	  ******************************************
	  *－－制作－－日期－－
	  *LiYong@xingmo.com  2007-08-10
	  ******************************************
	  *－－修改－－日期－－目的－－
	  *
	  */
	 public function gotoPage($from,$f,$max,$sql,$db,$query='')
	{
		 if($from == 0 || $from == "")
		 {
		 	$from = 1;
		 }
		 $res = $db -> GetAll($sql);
		 $total = count($res);

		 $pages=ceil($total/$max);
		 $num = $from;#第几页
		 /*
		 if($from > $pages)
		 {
		 	echo "<script language=javascript>alert('页码错误！');history.back();</script>";
			exit();
		 }
		 */
		 $return = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#cccccc\" class=\"table_bk\">";
		 $return .= "<form name=\"form1\" method=\"post\" action=\"\"><tr>";
		 $return .= "<td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"#0073aa\"><font color=\"#FFFFFF\" style=\"font-size:14px;\">".$total."</font></td>";
		 $return .= "<td width=\"10%\" align=\"center\" bgcolor=\"#0073aa\"><font color=\"#FFFFFF\" style=\"font-size:14px;\">".$num."/".$pages."</font></td>";
		// $return .= "<td width=\"25%\" nowrap>第".$num."/".$pages."页&nbsp;每页".$max."条&nbsp;总数量".$total."&nbsp;</td>";
		 $return .= "<td width=\"6%\" align=\"center\" bgcolor=\"#FFFFFF\">";
		 $return .= "<a href=\"$PHP_SELF?$query&$f=1\"><img src=\"/tpl/default/images/play_left.gif\" width=\"15\" height=\"12\" border=\"0\" /></a></td>";
		// $return .= "<td width=\"50%\" nowrap align=\"center\"><a href=\"$PHP_SELF?$query&$f=0\">首页</a>&nbsp;";
		for($i=1;$i<=$pages;$i++)
		{
			$return .= "<td width=\"6%\" align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"$PHP_SELF?$query&$f=$i\">".$i."</a></td>";
		}
		/*
		 if ($from>=$max)
		{
			 $return .= "<a href=\"$PHP_SELF?$query&$f=";
			 $return .= ($from-$max)."\">";
			 $return .= "上一页</a>&nbsp;";
		}		
		if($from+$max<$total)
		{
			$return .= "<a href=\"$PHP_SELF?$query&$f=";
			$return .=  ($from+$max)."\">";
			$return .= "下一页</a>&nbsp;";
		}		
		$return .= "<a href=\"$PHP_SELF?$query&$f=";	
		$return .= ((($pages*$max-$max) > 0) ? ($pages*$max-$max) : 0)."\">尾页</a>&nbsp;";
		$return .= "</td>";		
		$return .= "<td width=\"25%\" nowrap align=right>到<select name='select' onchange='javascript:window.location.href=this.options[this.selectedIndex].value'>";
		for($i=0;$i<$pages;$i++)
		{
			$j = $i + 1;
			$temp = $i * $max;
			$return .= "<option value=$PHP_SELF?$query&$f=$temp ";
			if($num == $j) 
			{
				$return .= "selected";
			}
			$return .= ">$j</option>";
		}
		$return .= "</select>页</td>";
		$return .= " </tr></table>";	
		*/
		$return .= "<td width=\"6%\" align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"$PHP_SELF?$query&$f=$pages\">";
		$return .= "<img src=\"/tpl/default/images/play_right.gif\" width=\"15\" height=\"12\" border=\"0\" /></a></td>";
		$return .= "<td width=\"11%\" align=\"center\" bgcolor=\"#FFFFFF\">";
		$return .= "<input name=\"page_num\" id=\"page_num\" type=\"text\" value=\"$num\" size=\"4\" />";
		$return .= "</td><td width=\"14%\" align=\"center\" bgcolor=\"#FFFFFF\">";
		$return .= '<input type="button" name="button" value="GO" onclick="javascript:window.location.href=\'?'.$query.'&page=\'+$F(\'page_num\')" /></td>';
		$return .= "</tr></form></table>";
		return $return;
	}
	/******************************************
	  *函数：listOne($getArray,$table)
	  *作用：列表显示
	  *输入：$getArray,$table
	  *输出：$Res
	  **
	  ******************************************
	  *－－制作－－日期－－
	  *KuaiYigang@xingmo.com  2004-06-29 09:15
	  ******************************************
	  *－－修改－－日期－－目的－－
	  *
	  */
	 function listOne($id,$table,$db)
	 {
		 $sql = "SELECT * FROM `$table` WHERE 1 ";
		 $sql .= "AND `ID` = '".$id."' "; 
		 $sql.="  ORDER BY `id` DESC LIMIT 1 ";
		 $Res = $db -> GetAll($sql);
		 return (count($Res)>0)?$Res:false;
	 }
	

	/******************************************
	  *函数：delOne($ID,$table,$db)
	  *作用：删除一条内容
	  *输入：$ID,$table,$db
	  *输出：true/false
	  **
	  ******************************************
	  *－－制作－－日期－－
	  *KuaiYigang@xingmo.com  2004-12-15 0:45
	  ******************************************
	  *－－修改－－日期－－目的－－
	  *
	  */
	 function delOne($ID,$table,$db)
	 {
		 $sql = "DELETE FROM `".$table."` WHERE 1 ";
		 $sql .= "AND `ID`='".$ID."' ";
		 return ($db -> Query($sql))?true:false;
	 }


	 /******************************************
	  *函数：selectSql($fields,$term,$table) 
	  *作用：根据条件，从数据表中选择相关的字段，返回一个sql
	  *输入：$fields(要选择的字段,如'`username`,`passwd`,`address`'),$term(条件，数组),$table(数据表名)
	  *输出：从数据表中选择结果的数组
	  **
	  ******************************************
	  *－－制作－－日期－－
	  *KuaiYigang@xingmo.com  2004-12-29 17:21:50
	  ******************************************
	  *－－修改－－日期－－目的－－
	  *
	  */
	function selectSql($fields,$term,$table,$link='=') 
	{
		$sql = 'SELECT  '.$fields.' FROM `'.$table.'` WHERE 1';
		foreach ($term as $key => $value)
		{
			$sql .= ' AND `'.$key.'`';
			if ($link == '=')
			{
				$sql .= ' '.$link.' '.$value;
			}
			if ($link == 'LIKE')
			{
				$sql .= ' '.$link.' %'.$value.'%';
			}
		}
		return $sql;
	}
	
	
	/**
	*插入一条数据
	*返回插入行的 id 或者 true
	* 2007-4-4 pangzunlian@sina.com
	*/
	function insert($data,$table,$db)
	{
		$sql	= $this->createSql($table,$data,"insert",'');
		$flag	= $db -> Query($sql);
		$result	= mysql_insert_id() == '' ? 'true' : mysql_insert_id();
		
		return  $result;
	}

	/* 
	* 执行sql的update操作
	* $sql_where 是sql的where子句
	* 返回 MySQL 最后操作影响的列数目
	* 2007-4-4 pangzunlian@sina.com
	*/
	function update($data,$sql_where,$table,$db)
	{
		$sql = $this->createSql($table,$data,"update",$sql_where);
		$flag	= $db -> Query($sql);

		return  $result = mysql_affected_rows();
	}

	/* 
	* 根据id 取得一条记录
	* $value 值 $fieldname 字段 $table表
	* 返回 返回取得的数据
	* 2007-4-4 pangzunlian@sina.com
	*/	
	function getDataById($value,$fieldname="id",$table)
	{
		$sql = "select * from `".$table."` where `".$fieldname."` = '".$value."' " ;
		
		$Res = $db -> GetAll($sql);
		return (count($Res)>0)?$Res:false;
	}

	/**
	*方法：createSql( $table, $data, $action = 'insert', $parameters = '' )
	*作用：生成标准sql语句
	*输入：表$table, 数据$data $key=>字段名、$val=>值, 默认插入$action = 'insert', 条件$parameters = ''
	*输出：sql语句
	*作者：pangzunlian@sina.com
	*修改时间：2007-4-4 
	*/  
	function createSql( $table, $data, $action = 'insert', $parameters = '' )
	{
		reset( $data );
		if ( $action == 'insert' ) {
			$query = 'insert into `' . $table . '` (';
			$keystr = $valstr = '';
			while ( list( $columns, $value ) = each( $data ) ) {
				$keystr .= '`' . $columns . '`, ';
				switch ( ( string )$value ) {
					case 'now()':
						$valstr .= 'now(), ';
						break;
					case 'null':
						$valstr .= 'null, ';
						break;
					default:
						$valstr .= '\'' . $value  . '\', ';
						break;
				}
			}
			$query .= substr( $keystr, 0, -2 ) . ') values (' . substr( $valstr, 0, -2 ) . ')';
		} elseif ( $action == 'update' ) {
			$query = 'update `' . $table . '` set ';
			while ( list( $columns, $value ) = each( $data ) ) {
				switch ( ( string )$value ) {
					case 'now()':
						$query .= '`' . $columns . '` = now(), ';
						break;
					case 'null':
						$query .= '`' . $columns .= '` = null, ';
						break;
					default:
						$query .= '`' . $columns . '` = \'' . $value  . '\', ';
						break;
				}
			}
			$query = substr( $query, 0, -2 ) . ' where ' . $parameters;
		}

		return $query ;
	}
}
?>