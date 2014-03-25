<?php


$action = $_GET['action'];
$articleid = intval($_GET['articleid']);
if ($action == 'show'){

	//8.4指平均得分=总评分/总次数，558是指总评分次数
	//在你的mysql中建立两字段来存储总评分和总次数
	echo "document.getElementById('scoredata').innerHTML='8.4|558';";
}elseif($action == 'add'){

	if( intval($_COOKIE['citylife']) != $gid ){

		$score = intval($_GET['score']);
		setcookie("citylife", $gid, time()+3600);	//expire 1 hour
		echo "alert('感谢您的参与！');";
		echo "document.getElementById('scoredata').innerHTML='8.4|558';";
		echo "scoreinit();";
	}else{
		echo "alert('请勿重复评分');";
	}
}else{
	exit('yangyu');
}


?>