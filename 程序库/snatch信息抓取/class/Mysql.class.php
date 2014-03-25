<?php
/**
 *名称:Mysql.class.php
 *作用:数据库的类
 *说明:
 *作者:KuaiYigang@xingmo.com
 *时间:2004-5-22
 **/
class Mysql
{
	function connect($database, $mode='3')
	{
		global $INC;
		require_once $INC."/adodb/adodb.inc.php";
		$this->db = ADONewConnection('mysql');

		global $CONFIG;
		require $CONFIG.'/mysql.php';

		$conn = $this->db-> Connect($mysql_host,$mysql_user,$mysql_pwd,$database);
		if (!$conn) 
		{
			echo $this->db->ErrorMsg();
			exit();
		}
		$this->db -> SetFetchMode($mode);
	    $this->db ->  Query ("set names gbk;");
		return $this->db;
	}

}
?>