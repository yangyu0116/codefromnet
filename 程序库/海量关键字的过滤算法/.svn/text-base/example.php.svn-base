<?php



//文章内容
$str="我恨台独丰富多彩的小区活动，方便的活动提醒
健康的小区生活，建立和扩展你的社交网络
通畅开放的交流、沟通、交往平台
恨台独丰富多彩享的大南京站编辑部副主编舞台丰富的小区活动，方便的活动提醒
健康的小区生活，建立和扩展你的社交网络
通畅开放的交流、沟通、交往平台
展示自我、分享共享的大舞台丰富多万科即将
健康的小区生活开放的交流、沟通、交往平台
展示自我、分享共享的大舞台丰富多万科即将
健康的小区生活，建立和扩展你的开放的交流、沟通、交往平台
展示自我、分享共享的大舞台丰富多万科即将
健康的小区生活，建立和扩展你的，建立和扩展你的社交网络
通畅开放的交流、沟通、交往平台
展示自我、分享共享的大舞台家宝  ";


include_once 'keyword.class.php';


$badwordfile	= 'badword.src.php';//关键词数组所在文件名，也可以是从数据库中读出的，这里保存在了一个文件里



//我的函数
$starttime= microtime_float();
$keyword= new keyword($badwordfile);
$myword=$keyword->replace($str,1);
$endtime= microtime_float();
//我的函数结束


//str_replace函数
$time_start = microtime_float();
include_once($badwordfile);
str_replace($badword, $badword,$str);
$time_end = microtime_float();
//str_replace函数结束



printf("<br>我的函数时间   : %f<br>",$endtime - $starttime);
printf("<br>str_replace时间: %f<br>",$time_end - $time_start);
echo	"<br>我的结果：<br>".$myword;




//时间函数
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}