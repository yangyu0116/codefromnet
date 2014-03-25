<?php 
include ("recognise.class.php");


$url='http://vote.client.sina.com.cn/imgserial.php?r='.rand(0,9999);//验证码图片地址
file_put_contents('pic.png',file_get_contents($url));//保存在本地



$recognise = new recognise();
$recognise->setImage('pic.png');
$recognise->makeData();//生成二值数据
$num = $recognise->process();//识别并返回结果

//$recognise->drawPic();
//print_r($recognise->dataRec);


echo	'识别结果：'.$num;
?>
<br />原图像：
<img src="pic.png">