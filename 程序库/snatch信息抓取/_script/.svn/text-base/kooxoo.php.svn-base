<?php
require_once '../config.ini.php';
//require_once $COMMON.'/mysql.php';
$Mysql = new Mysql;

class Snatch
{
	public $contents = '';

	//得到$left与$right中间的东西
	function getValue($str, $left, $right)
	{
		$len1 = strlen($left);
		$pos1 = strpos($str, $left);
		if($pos1 === false) return;
		$pos2 = strpos($str, $right, $pos1+strlen($left));
		if($pos2 === false) return;
		$s = substr($str, $pos1+strlen($left), $pos2-($pos1+strlen($left)));
		return $s;
	}

	//得到$left与$right之间的东西(包括$left和$right)
	function getValue2($str, $left, $right)
	{
		$pos1 = strpos($str, $left);
		if($pos1 === false) return;
		$pos2 = strpos($str, $right, $pos1);
		if($pos2 === false) return;
		$s = substr($str, $pos1, $pos2 + strlen($right) - $pos1);
		return $s;
	}

	//POST数据，得到返回的页面内容
	function postPage($url, $postdata)
	{       
		$c = curl_init();
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($c, CURLOPT_VERBOSE, 1);				//显示更多信息      
		//curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);  //支持重定向   
		curl_setopt($c, CURLOPT_URL, $url);        
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST,  2);     
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, FALSE);    
		//curl_setopt($c, CURLOPT_USERAGENT,  $useragent);     
		curl_setopt($c, CURLOPT_POST, 1);     
		curl_setopt($c, CURLOPT_POSTFIELDS, $postdata);     
		curl_setopt($c, CURLOPT_HEADER, 1);	// Header 内容放到了 $res 中       
		$res = curl_exec($c);       
		curl_close($c);
		return $res;
	}

	function getContents($url)
	{
		$this->contents = file_get_contents($url);
	}

	function process_page($url, $page)
	{  
		$Files = new Files;
		if($page>1)
		{
			$full_length  = strlen($url);
			$type_length  = strlen($Files->getExt($url));
			$name_length  = $full_length-$type_length;
			$name         = substr($url,0,$name_length-1);
			$url2 = $name."-".$page.".".$Files->getExt($url);
			$str = file_get_contents($url2);  
		}
		else
		{
			$str = file_get_contents($url);  
		}
		//$str = $this->postPage($url, '_pageIndex='.$page.'&q_role=person');
		$pos0 = 0;
		while(1)
		{      
			$left1 = '<div class="listimg"><a href="';
			$right1 = '" target="_blank" kxalog="id=sight_sight';
			$pos1 = strpos($str, $left1, $pos0);
			if($pos1 === false) break;
			$pos2 = strpos($str, $right1, $pos1);
			if($pos2 === false) break;
			$subs = substr($str, $pos1, $pos2 + strlen($right1) - $pos1);
			$thumburl = $this->getValue($subs, $left1, $right1);

			if($thumburl <> '')
			{
					$this->getData($thumburl);
				//}
			}
			$pos0 = $pos2;
		}
	}

	//对景点详细页处理
	function getData($url)
	{
		global $Mysql;
		global $db;
		global $type;

		$contents = file_get_contents($url);

        //导航信息
        preg_match_all("/<div id=\"main\" class=\"clear\">(.*?)<div id=\"mainleft\">/is", $contents, $guide);
		$guide  = trim ($guide[1][0]);
		$guide = strip_tags ($guide);
		$guide = explode('&nbsp;&gt;&nbsp;',$guide);
		$guide[3] = iconv('utf-8', 'gbk', $guide[3]);
		$guide[4] = iconv('utf-8', 'gbk', $guide[4]);

		//图片
        preg_match_all("/kxalog=\'id=si_mainpic\'><img src=\"(.*?)\" width=\"268\" height=\"196\"/is", $contents, $pic);
		$pic = trim ($pic[1][0]);
		$pic = strip_tags ($pic);
		$pic_name = substr($pic,34);

		$pic_name1 = dirname(__FILE__).'\img\\'.$pic_name;
		$dirname = explode('/',$pic_name);
		$dirname[0] =  dirname(__FILE__).'\img\\'.$dirname[0];
		$dirname[1] =  $dirname[0].'\\'.$dirname[1];
		if(!is_dir($dirname[0])){   
			mkdir ($dirname[0], 0700);
		}
		if(!is_dir($dirname[1])){ 
			mkdir ($dirname[1], 0700);
		}
		$this -> GrabImage($pic,$pic_name1);
		

		//景点名称
		preg_match_all("/<div class=\"clear\"><strong>(.*?)<\/strong>/is", $contents, $name);
		$name = trim ($name[1][0]);
		$name = str_replace('旅游指南','',$name);
		$name = iconv('utf-8', 'gbk', $name);

		//详细页网址	
		preg_match_all("/class=\"moreguide\"><a href=\"(.*?)\" kxalog=\"id=si_moreguide/is", $contents, $introduce_url);
		$introduce_url = 'http://travel.kooxoo.com'.trim ($introduce_url[1][0]);

		//进入详细页
		$contents2 = file_get_contents($introduce_url);
		//简介
		preg_match_all("/<strong>简介<\/strong>(.*?)<p style=\"padding-top: 2px; text-align: right; margin-bottom: 10px;\"><a href=\"http:\/\/travel.kooxoo.com\/feedback\" kxalog=\"id=gi_jiucuo\/0/is", $contents2, $introduce);
		$introduce = trim($introduce[0][0]);
		$introduce = str_replace('<p style="padding-top: 2px; text-align: right; margin-bottom: 10px;"><a href="http://travel.kooxoo.com/feedback" kxalog="id=gi_jiucuo/0','',$introduce);
		$introduce = iconv('utf-8', 'gbk', $introduce);

		//$introduce = '<strong>简介</strong>'.trim($introduce[1][0]);
		//$introduce = strip_tags ($introduce);
        //$db->Query('set names gbk');
		$sql = "INSERT INTO `xueshan` (`id`,`name`,`type`,`picture`,`province`,`city`,`introduce`) ";
		$sql .= "VALUES ('','".$name."','".$type."','".$pic_name."','".$guide[3]."','".$guide[4]."','".$introduce."') ";
	    //echo $sql."\r\n";
		$res = $db->Query($sql);
	}
	//保存图片到本地
		 function GrabImage($url,$filename) 
		{ 
			ob_start(); 
			readfile($url); 
			$img = ob_get_contents(); 
			ob_end_clean(); 
			$size = strlen($img); 

			$fp2=@fopen($filename, "a"); 
			fwrite($fp2,$img); 
			fclose($fp2); 

			return $filename; 
		} 
}

$db = $Mysql->connect('temp');

$Snatch = new Snatch;

$type = '雪山';
$type = iconv('utf-8', 'gbk', $type);
$url = 'http://sodujia.kooxoo.com/s_Sight-Sight-%E9%9B%AA%E5%B1%B1.html';//雪山69
$start = 21;//起始页，必须设置
$end = 30;//结束页，必须设置

for($i=$start; $i<($end+1); $i++)
{
	$Snatch->process_page($url, $i, $MaxID, $MinID);
}

//$Snatch->getData('http://esf.focus.cn/esf/lease/435930.html');

echo 'ok';
?>