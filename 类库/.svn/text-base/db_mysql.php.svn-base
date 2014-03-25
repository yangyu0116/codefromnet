<?php
/**
 * Copyright (c) 2003-07  PHPWind.net. All rights reserved.
 * 
 * @filename: db_mysql.php
 * @author: Noizy (noizyfeng@gmail.com), QQ:7703883
 * @modify: Thu Mar 15 15:32:15 CST 2007
 */
!function_exists('readover') && exit('Forbidden');

Class DB {
	var $query_num = 0;
	function DB($dbhost, $dbuser, $dbpw, $dbname, $pconnect = 0) {
		$this->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
	}
	function connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect = 0){
		$pconnect==0 ? @mysql_connect($dbhost, $dbuser, $dbpw) : @mysql_pconnect($dbhost, $dbuser, $dbpw);
		mysql_errno() && $this->halt('Connect ("'.$dbhost.'") to MySQL ("'.$dbhost.'","'.$dbuser.'") failed');
		if ($this->server_version() >= '40100') {
			!$GLOBALS['charset'] && $this->halt('Please Check System Charset!');
			$this->query("SET character_set_connection='".$GLOBALS['charset']."',character_set_results='".$GLOBALS['charset']."', character_set_client=binary",'U_B');
			if ($this->server_version() > '50000') {
				$this->query("SET sql_mode=''",'U_B');
				$this->query_num--;
			}
			$this->query_num--;
		}
		$dbname && $this->select_db($dbname);
		return true;
	}
	function select_db($dbname){
		!@mysql_select_db($dbname) && $this->query('Cannot use database: '.$dbname);
	}
	function insert_id(){
		return $this->get_value('SELECT LAST_INSERT_ID()');
	}
	function server_version(){
		$match = explode('.',$this->server_info());
		$info  = (int)sprintf('%d%02d%02d',$match[0],$match[1],intval($match[2]));
		return $info;
	}
	function server_info(){
		return $this->get_value('SELECT VERSION()');
	}
	function get_value($SQL,$field = 0){
		$rt = $this->get_one($SQL,$field);
		$value = isset($rt[$field]) ? $rt[$field] : null;
	    return $value;
	}
	function get_one($SQL,$field='lxblog'){
		$query = $this->query($SQL,'U_B');
		$rt =& $this->fetch_array($query,(is_int($field) ? 'MYSQL_NUM' : 'MYSQL_ASSOC'));
		return $rt;
	}
	function pw_update($SQL_1,$SQL_2,$SQL_3){
		$SQL = ($this->get_one($SQL_1)) ? $SQL_2 : $SQL_3;
		return $this->update($SQL);
	}
	function update($SQL){
		if ($GLOBALS['db_lp']==1) {
			$SQL = (substr($SQL,0,7)=='REPLACE') ? substr($SQL,0,7).' LOW_PRIORITY'.substr($SQL,7) : substr($SQL,0,6).' LOW_PRIORITY'.substr($SQL,6);
		}
		return $this->query($SQL,'U_B');
	}
	function query($SQL,$method=''){
		$GLOBALS['PW']!='pw_' && $SQL = str_replace(' pw_',' '.$GLOBALS['PW'],$SQL);
		$query = ($method=='U_B' && function_exists('mysql_unbuffered_query')) ? @mysql_unbuffered_query($SQL) : @mysql_query($SQL);
		$this->query_num++;
		!$query && $this->halt('Query Error: ' . $SQL);
		return $query;
	}
	function fetch_array($query, $result_type = 'MYSQL_ASSOC'){
		if ($result_type=='MYSQL_ASSOC') {
			return mysql_fetch_assoc($query);
		} elseif ($result_type=='MYSQL_NUM') {
			return mysql_fetch_row($query);
		} else {
			return mysql_fetch_array($query);
		}
	}
	function affected_rows() {
		return mysql_affected_rows();
	}
	function num_rows($query) {
		if (!is_bool($query)) {
			return mysql_num_rows($query);
		} else {
			return 0;
		}
	}
	function free_result(){
		foreach (func_get_args() as $rt) {
			if (is_resource($rt) && get_resource_type($rt) === 'mysql result'){
				return mysql_free_result($rt);
			}
		}
		return true;
	}
	function close() {
		return mysql_close();
	}
	function halt($msg='') {
		require_once(R_P.'mod/db_mysql_error.php');
		new DB_ERROR($msg);
	}
}
?>