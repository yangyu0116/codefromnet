<?php
/*
 *名称: config.ini.php
 *作用: 全站配置文件
 *说明:
 *时间: 2004-11-01 15:14
 *更新: 2007-9-27
 */
session_start(); 

define('SITE_ROOT', dirname(__FILE__));

$URL = 'http://'.$_SERVER['SERVER_NAME'];//网站当前URL
$ROOT = SITE_ROOT;
$CLASS = SITE_ROOT."/class";//class目录
$COMMON = SITE_ROOT."/common";//common目录
$CONFIG = SITE_ROOT."/config";//config目录
$FUNC = SITE_ROOT."/func";//func目录
$INC = SITE_ROOT."/inc";//includes目录
$UPLOAD = SITE_ROOT."/upload";//上传目录
$TPL = SITE_ROOT;//templates目录*
$TPL_C = SITE_ROOT."/tpl_c";//Smarty编译目录*

if(PHP_VERSION < '4.1.0') 
{
	$_GET = &$HTTP_GET_VARS;
	$_POST = &$HTTP_POST_VARS;
	$_COOKIE = &$HTTP_COOKIE_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	$_ENV = &$HTTP_ENV_VARS;
	$_FILES = &$HTTP_POST_FILES;
}

require_once $CONFIG.'/database.php';//数据库名称

function __autoload($class_name) 
{
	global $CLASS;
    require_once($CLASS.'/'.$class_name.".class.php");
}

//用户登录COOKIE处理
//require_once $ROOT.'/common/cookie.php';

//session
//require_once $ROOT.'/common/session.php';
?>