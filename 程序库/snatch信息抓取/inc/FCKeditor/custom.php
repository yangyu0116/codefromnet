<?php
/*
 *����:custom.php
 *����:FCKeditor���Զ���
 *˵��:
 *����:��ģ��˾www.xingmo.com
 *ʱ��:2006-5-30
 *����:2006-5-30
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/config.ini.php';

$Files = new Files;
$Image = new Image;

//�ж�ͼƬ�Ĵ�С�Ƿ����޶��ķ�Χ��
if($_FILES['NewFile']['error'] == 1)
{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\"><script>window.parent.alert('���ϴ���ͼƬ����������ļ���С�����ϴ���');</script>";
	exit;
}
elseif($_FILES['NewFile']['error'] == 0)
{
}
else
{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\"><script>window.parent.alert('�ϴ�ͼƬʧ�ܣ��������ϴ���');</script>";
	exit;
}

//���·������
$Config['UserFilesAbsolutePath'] = $UPLOAD.'/'.date('Ymd');
$Files = new Files;
$Files->mkdirAll($Config['UserFilesAbsolutePath']);

$Config['UserFilesUrl'] = $URL.'/upload/'.date('Ymd');

$Ext = $Files->getExt($_FILES['NewFile']['name']);
$DistFileName = time().'.'.$Ext;

$Config['Enabled'] = true ;
 ?>
