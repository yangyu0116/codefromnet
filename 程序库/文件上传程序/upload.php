<?

$page_action=(isset($_GET["action"]))?$_GET["action"]:"";
if ($page_action=="upload"){
	require("upload_inc.php");
	$r=new upload_class("upload_file","../pic/test/1/3/23/123/2/",date("YmdHis",time()));
	$r->upload_format=".jpg,.bmp,.gif";
	$r->upload_max_size=200*1024;	//200K
	$r->upload_file();
	if ($r->upload_err==1){
		echo "<br>�ϴ��ɹ�!";
		echo "<br>�ļ����浽:".$r->to_filepath.$r->to_fileexp;
	}else{
		echo "<br>�ϴ�ʧ��!";
		echo "<br>������ʾ:".$r->upload_err();
	}
	unset($r);
}
?>

<html><head>
<title>�����ļ���</title></head> 
<body> 
<form enctype="multipart/form-data" action="?action=upload" method="post"> 
��ѡ���ļ��� <br>
<input name="upload_file" type="file"><br>
<input type="submit" value="�ϴ��ļ�"> 
</form> 
</body>
</html> 
