<?php
/**
 *����:Sql.class.php
 *����:����Sql��
 *˵��:
 *����:KuaiYigang@xingmo.com
 *ʱ��:2004-11-03
 **/
class Sql
{ 
	/******************************************
	  *������ifExist($table,$field,$value,$db)
	  *���ã��ж����ݱ����Ƿ����һ������
	  *���룺$table(���ݱ�),$field(�ֶ���),$value(����),$db(���ӿ�)
	  *�����true:false
	  **
	  ******************************************
	  *���������������ڣ���
	  *kuaiyigang@xingmo.com  2004-06-29 09:15
	  ******************************************
	  *�����޸ģ������ڣ���Ŀ�ģ���
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
	  *������listAll($from,$max,$sql_list,$db, $sql_page='')
	  *���ã��б���ʾ
	  *���룺$_GET['from'],$max,$sql,$db, $sql_page
	  *�����$sql
	  **
	  ******************************************
	  *���������������ڣ���
	  *KuaiYigang@xingmo.com  2004-06-29 09:15
	  ******************************************
	  *�����޸ģ������ڣ���Ŀ�ģ���
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
		$step=$step>$max?$max:$step;#��ǰҳ��ʾ������
		$sql_list .= "LIMIT $from,$step  ";#�Ե�ǰҳ��ʾ���ݵĲ�ѯ
		$res = $db -> GetAll($sql_list);
		return (count($res)>0)?$res:false;
	}


	/******************************************
	  *������goPage($from,$f,$max,$sql,$db,$query='')
	  *���ã���ҳ����ҳ����һҳ����һҳ��βҳ��
	  *���룺$_GET['from'],'from',$max,$sql,$db,$query=''
	  *�������ҳ����һҳ����һҳ��βҳ
	  **
	  ******************************************
	  *���������������ڣ���
	  *KuaiYigang@xingmo.com  2004-06-29 09:20
	  ******************************************
	  *�����޸ģ������ڣ���Ŀ�ģ���
	  *KuaiYigang@xingmo.com 2004-12-13 0:43 ����$query
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
		 $num = ceil(($from+$max)/$max);#�ڼ�ҳ

		 $return = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
		 $return .= "<td width=\"25%\" nowrap>��".$num."/".$pages."ҳ&nbsp;ÿҳ".$max."��&nbsp;������".$total."&nbsp;</td>";
		 $return .= "<td width=\"50%\" nowrap align=\"center\"><a href=\"$PHP_SELF?$query&$f=0\">��ҳ</a>&nbsp;";
		 if ($from>=$max)
		{
			 $return .= "<a href=\"$PHP_SELF?$query&$f=";
			 $return .= ($from-$max)."\">";
			 $return .= "��һҳ</a>&nbsp;";
		}		
		if($from+$max<$total)
		{
			$return .= "<a href=\"$PHP_SELF?$query&$f=";
			$return .=  ($from+$max)."\">";
			$return .= "��һҳ</a>&nbsp;";
		}		
		$return .= "<a href=\"$PHP_SELF?$query&$f=";	
		$return .= ((($pages*$max-$max) > 0) ? ($pages*$max-$max) : 0)."\">βҳ</a>&nbsp;";
		$return .= "</td>";		
		$return .= "<td width=\"25%\" nowrap align=right>��<select name='select' onchange='javascript:window.location.href=this.options[this.selectedIndex].value'>";
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
		$return .= "</select>ҳ</td>";
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
		 $num = ceil(($from+$max)/$max);#�ڼ�ҳ

		 $return = "��".$num."/".$pages."ҳ&nbsp;ÿҳ".$max."��&nbsp;������".$total."&nbsp;";
		 
		 if ($from>=$max)
		{
			 $return .= "<a href=\"$PHP_SELF?$query&$f=0\">��ҳ</a>&nbsp;";
			 $return .= "<a href=\"$PHP_SELF?$query&$f=";
			 $return .= ($from-$max)."\">";
			 $return .= "��һҳ</a>&nbsp;";
		}		
		if($from+$max<$total)
		{
			$return .= "<a href=\"$PHP_SELF?$query&$f=";
			$return .=  ($from+$max)."\">";
			$return .= "��һҳ</a>&nbsp;";
			$return .= "<a href=\"$PHP_SELF?$query&$f=";	
			$return .= ((($pages*$max-$max) > 0) ? ($pages*$max-$max) : 0)."\">βҳ</a>&nbsp;";
		}		
		
		$return .= "��<select name='select' onchange='javascript:window.location.href=this.options[this.selectedIndex].value'>";
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
		$return .= "</select>ҳ";
	
		return $return;
	}
	
	/******************************************
	  *������listOne($getArray,$table)
	  *���ã��б���ʾ
	  *���룺$getArray,$table
	  *�����$Res
	  **
	  ******************************************
	  *���������������ڣ���
	  *KuaiYigang@xingmo.com  2004-06-29 09:15
	  ******************************************
	  *�����޸ģ������ڣ���Ŀ�ģ���
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
	  *������delOne($ID,$table,$db)
	  *���ã�ɾ��һ������
	  *���룺$ID,$table,$db
	  *�����true/false
	  **
	  ******************************************
	  *���������������ڣ���
	  *KuaiYigang@xingmo.com  2004-12-15 0:45
	  ******************************************
	  *�����޸ģ������ڣ���Ŀ�ģ���
	  *
	  */
	 function delOne($ID,$table,$db)
	 {
		 $sql = "DELETE FROM `".$table."` WHERE 1 ";
		 $sql .= "AND `ID`='".$ID."' ";
		 return ($db -> Query($sql))?true:false;
	 }


	 /******************************************
	  *������selectSql($fields,$term,$table) 
	  *���ã����������������ݱ���ѡ����ص��ֶΣ�����һ��sql
	  *���룺$fields(Ҫѡ����ֶ�,��'`username`,`passwd`,`address`'),$term(����������),$table(���ݱ���)
	  *����������ݱ���ѡ����������
	  **
	  ******************************************
	  *���������������ڣ���
	  *KuaiYigang@xingmo.com  2004-12-29 17:21:50
	  ******************************************
	  *�����޸ģ������ڣ���Ŀ�ģ���
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
	*����һ������
	*���ز����е� id ���� true
	* 2007-4-4 pangzunlian@sina.com
	*/
	/*
	function insert($data,$table)
	{
		global $db;
		$sql	= $this->createSql($table,$data,"insert",'');
		$flag	= $db -> Query($sql);
		$result	= mysql_insert_id() == '' ? 'true' : mysql_insert_id();
		
		return  $result;
	}
	*/
	function insert($data,$table,$db)
	{
		$sql	= $this->createSql($table,$data,"insert",'');
		$flag	= $db -> Query($sql);
		$result	= mysql_insert_id() == '' ? 'true' : mysql_insert_id();
		
		return  $result;
	}

	/* 
	* ִ��sql��update����
	* $sql_where ��sql��where�Ӿ�
	* ���� MySQL ������Ӱ�������Ŀ
	* 2007-4-4 pangzunlian@sina.com
	*/
	function update($data,$sql_where,$table)
	{
	    $sql = $this->createSql($table,$data,"update",$sql_where);
		$flag	= $db -> Query($sql);

		return  $result = mysql_affected_rows();
	}

	/* 
	* ����id ȡ��һ����¼
	* $value ֵ $fieldname �ֶ� $table��
	* ���� ����ȡ�õ�����
	* 2007-4-4 pangzunlian@sina.com
	*/	
	function getDataById($value,$fieldname="id",$table)
	{
		$sql = "select * from `".$table."` where `".$fieldname."` = '".$value."' " ;
		
		$Res = $db -> GetAll($sql);
		return (count($Res)>0)?$Res:false;
	}

	/**
	*������createSql( $table, $data, $action = 'insert', $parameters = '' )
	*���ã����ɱ�׼sql���
	*���룺��$table, ����$data $key=>�ֶ�����$val=>ֵ, Ĭ�ϲ���$action = 'insert', ����$parameters = ''
	*�����sql���
	*���ߣ�pangzunlian@sina.com
	*�޸�ʱ�䣺2007-4-4 
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