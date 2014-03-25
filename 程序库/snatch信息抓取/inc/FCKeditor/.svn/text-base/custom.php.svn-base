<?php
/*
 *名称:custom.php
 *作用:FCKeditor—自定义
 *说明:
 *开发:星模公司www.xingmo.com
 *时间:2006-5-30
 *更新:2006-5-30
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/config.ini.php';

$Files = new Files;
$Image = new Image;

//判断图片的大小是否在限定的范围内
if($_FILES['NewFile']['error'] == 1)
{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\"><script>window.parent.alert('您上传的图片过大，请调整文件大小后再上传！');</script>";
	exit;
}
elseif($_FILES['NewFile']['error'] == 0)
{
}
else
{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\"><script>window.parent.alert('上传图片失败，请重新上传！');</script>";
	exit;
}

//相关路径设置
$Config['UserFilesAbsolutePath'] = $UPLOAD.'/'.date('Ymd');
$Files = new Files;
$Files->mkdirAll($Config['UserFilesAbsolutePath']);

$Config['UserFilesUrl'] = $URL.'/upload/'.date('Ymd');

$Ext = $Files->getExt($_FILES['NewFile']['name']);
$DistFileName = time().'.'.$Ext;

$Config['Enabled'] = true ;
 ?>
