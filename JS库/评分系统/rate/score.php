<?php


$action = $_GET['action'];
$articleid = intval($_GET['articleid']);
if ($action == 'show'){

	//8.4ָƽ���÷�=������/�ܴ�����558��ָ�����ִ���
	//�����mysql�н������ֶ����洢�����ֺ��ܴ���
	echo "document.getElementById('scoredata').innerHTML='8.4|558';";
}elseif($action == 'add'){

	if( intval($_COOKIE['citylife']) != $gid ){

		$score = intval($_GET['score']);
		setcookie("citylife", $gid, time()+3600);	//expire 1 hour
		echo "alert('��л���Ĳ��룡');";
		echo "document.getElementById('scoredata').innerHTML='8.4|558';";
		echo "scoreinit();";
	}else{
		echo "alert('�����ظ�����');";
	}
}else{
	exit('yangyu');
}


?>