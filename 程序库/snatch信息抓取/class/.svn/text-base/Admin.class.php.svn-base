<?php
/*
 *名称:Admin.class.php
 *作用:管理员相关类
 *说明:
 *作者:KuaiYigang@xingmo.com
 *时间:2007-7-18
 *更新:2007-7-18
 */
class Admin
{
	var $_db;
	function __construct() 
	{
		global $db;
		$this->_db = $db;
	}


	/******************************************
	  *函数：ifLogin()
	  *作用：检查是否已经登录,如果没有则退出
	  *输入：
	  *输出：
	  **
	  ******************************************
	  *－－制作－－日期－－
	  *KuaiYigang@xingmo.com  2004-11-03 03:05
	  ******************************************
	  *－－修改－－日期－－目的－－
	  *
	  */
	function ifLogin($username, $passwd, $table)
	{
		if($username == "" || $passwd == "") 
		{
			return false;
			exit();
		}
		else
		{
			//从数据库中检索帐号名为登录帐号名的数据
			$sql = "SELECT `passwd` FROM `".$table."` ";
			$sql .= "WHERE `username` = '".$username."' ";
			$res = $this->_db -> GetAll($sql);
			if ($res[0]["passwd"] <> $passwd)
			{
				return false;
				exit();
			}
			else
			{
				return true;
			}
		}
	}

	
}
?>