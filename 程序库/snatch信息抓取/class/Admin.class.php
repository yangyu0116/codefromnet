<?php
/*
 *����:Admin.class.php
 *����:����Ա�����
 *˵��:
 *����:KuaiYigang@xingmo.com
 *ʱ��:2007-7-18
 *����:2007-7-18
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
	  *������ifLogin()
	  *���ã�����Ƿ��Ѿ���¼,���û�����˳�
	  *���룺
	  *�����
	  **
	  ******************************************
	  *���������������ڣ���
	  *KuaiYigang@xingmo.com  2004-11-03 03:05
	  ******************************************
	  *�����޸ģ������ڣ���Ŀ�ģ���
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
			//�����ݿ��м����ʺ���Ϊ��¼�ʺ���������
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