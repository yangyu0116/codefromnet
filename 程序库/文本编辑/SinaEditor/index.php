<?php
/**
 * 新浪博客编辑器PHP版封装类调用方法
 * 
 */
header('Content-Type:text/html;Charset=utf-8;');
include_once('sinaEditor.class.php');
extract($_POST);
extract($_GET);
unset($_POST,$_GET);
if(isset($act)){
$act=='subok' && die("提交的内容是：<br>".htmlspecialchars($gently_editor));
}
$editor=new sinaEditor('gently_editor');
$editor->Value='<h2>这个是一个测试！</h2><br>
我的博客:<a href="http://www.zendstudio.net/">http://www.zendstudio.net/</a>';
$editor->BasePath='.';
$editor->Height=500;
$editor->Width=700;
$editor->AutoSave=false;


?>
<form name="form1" id="form1" method="post" action="index.php?act=subok">
<?
	$editor->Create();
?>
<input type="submit" value="提交">
<input type="reset" value="重置">
</form>
	