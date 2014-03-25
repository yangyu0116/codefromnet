<?php
//求租（个人）
//require_once $_SERVER['DOCUMENT_ROOT'].'/config.ini.php';
require_once '/server/www/ihomes/new/config.ini.php';
//require_once '/server/www/new/config.ini.php';

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

	function process_page($url, $page, $MaxID, $MinID)
	{  
		//$str = file_get_contents($url);  
		$str = $this->postPage($url, '_pageIndex='.$page.'&q_role=person');
		$pos0 = 0;
		while(1)
		{      
			$left1 = '<a href="http://esf.focus.cn/esf';
			$right1 = '" target="_blank">';
			$pos1 = strpos($str, $left1, $pos0);
			if($pos1 === false) break;
			$pos2 = strpos($str, $right1, $pos1);
			if($pos2 === false) break;
			$subs = substr($str, $pos1, $pos2 + strlen($right1) - $pos1);
			$thumburl = $this->getValue($subs, $left1, $right1);
			//$h = fopen('1.txt', 'a');
			if($thumburl <> '')
			{
				$t1 = explode('/', $thumburl);
				$t2 = explode('.', $t1[2]);
				if($t2[0] >($MinID-1) && $t2[0] < ($MaxID+1))
				{
					//得到最终页面的地址
					//fwrite($h, 'http://esf.focus.cn/esf'.$thumburl."\n");
					$thumburl = 'http://esf.focus.cn/esf'.$thumburl;
					$this->getData($thumburl);
				}
			}
			$pos0 = $pos2;
		}
	}

	function getData($url)
	{
		global $Mysql;
		global $DB_COMM;

		$contents = file_get_contents($url);

		$Districts = array('海淀', '朝阳', '东城', '西城', '崇文', '宣武', '丰台', '石景山', '房山', '大兴', '通州' , '顺义', '昌平', '密云', '怀柔', '延庆', '平谷' ,'门头沟');

		preg_match_all("/<th>城区与地址<\/th>\r\n	<td>\r\n(.*?)<\/td>/is", $contents, $Address);
		foreach($Districts as $key=>$District)
		{
			if(preg_match('/'.$District.'/', trim ($Address[1][0])))
			{
				$DistID = $key+1;
				//echo $DistID.'<br>';
			}
		}
		//echo trim ($Address[1][0]).'<br>';

		preg_match_all("/<th>所在小区<\/th>\r\n	<td>\r\n(.*?)<\/td>/is", $contents, $Comm);
		$Char = new Char;
		
		//echo $Comm[1][0]."\r\n";
		$CommName = strip_tags(trim ($Comm[1][0]));
		//echo $CommName."\r\n";
		$CommName_1 = preg_replace('/查看楼盘详情/', '', $CommName);
		$CommName_1 =  $Char->cnSubstr($CommName_1, 0, 6);

		$CommName =  $Char->cnSubstr($CommName_1, 0, 4);
		
		$db = $Mysql->connect($DB_COMM);

		$sql = "SELECT  `ID` FROM `community` WHERE 1 ";
		$sql .= "AND  `Name`LIKE '%".$CommName."%' ";
		$sql .= "LIMIT 1 ";
		$res = $db->GetAll($sql);
		//echo mysql_error();
		//echo $res[0]['ID'].'<br>';
		$CommID = $res[0]['ID'];
		//echo trim ($Comm[1][0]).'<br>';

		preg_match_all("/<th>价格<\/th>\r\n	<td>\r\n		<font color=\"red\">(.*?)<\/font>/is", $contents, $Price);
		//echo trim ($Price[1][0]).'<br>';
		$RentPrice = 0;
		if(preg_match('/500元以下/', trim ($Price[1][0])))
		{
			$RentPrice = 1;
		}
		if(preg_match('/500-1000元/', trim ($Price[1][0])))
		{
			$RentPrice = 2;
		}
		if(preg_match('/1000-1500元/', trim ($Price[1][0])))
		{
			$RentPrice = 3;
		}
		if(preg_match('/1500-2000元/', trim ($Price[1][0])))
		{
			$RentPrice = 4;
		}
		if(preg_match('/2000-3000元/', trim ($Price[1][0])))
		{
			$RentPrice = 5;
		}
		if(preg_match('/3000-4000元/', trim ($Price[1][0])))
		{
			$RentPrice = 6;
		}
		if(preg_match('/4000-6000元/', trim ($Price[1][0])))
		{
			$RentPrice = 7;
		}
		if(preg_match('/6000-10000元/', trim ($Price[1][0])))
		{
			$RentPrice = 8;
		}
		if(preg_match('/10000元以上/', trim ($Price[1][0])))
		{
			$RentPrice = 9;		
		}
		//echo $RentPrice.'<br>';

		preg_match_all("/<th>户型<\/th>\r\n	<td>\r\n(.*?)<\/td>/is", $contents, $Huxing);
		preg_match_all("/(.*?)室/is", trim ($Huxing[1][0]), $Room);
		preg_match_all("/室(.*?)厅/is", trim ($Huxing[1][0]), $Hall);
		preg_match_all("/厅(.*?)卫/is", trim ($Huxing[1][0]), $Loo);
		//echo 'Room:'.$Char->cnSubstr(trim ($Huxing[1][0]) , 0, 1).'<br>';
		//echo 'Hall:'.$Char->cnSubstr(trim ($Huxing[1][0]) , 2, 1).'<br>';
		//echo 'Loo:'.$Char->cnSubstr(trim ($Huxing[1][0]) , 4, 1).'<br>';
		//echo trim($Huxing[1][0]).'<br>';
		//echo $Room[1][0].'<br>';
		//echo $Hall[1][0].'<br>';
		//echo $Loo[1][0].'<br>';
		$Room = $Room[1][0];
		$Hall = $Hall[1][0];
		$Loo = $Loo[1][0];

		$Title = '求租'.$CommName_1;
		if($Room<>'')
		{
			$Title .= $Room.'室';
		}
		if($Hall<>'')
		{
			$Title .= $Hall.'厅';
		}

		//preg_match_all("/<th>楼层<\/th>\r\n	<td>\r\n(.*?)<\/td>/is", $contents, $Louceng);
		//echo trim ($Louceng[1][0]).'<br>';

		preg_match_all("/<th>家具设备<\/th>\r\n(.*?)<\/td>/is", $contents, $Jiaju);
		$Facility = '';
		if(preg_match('/燃气/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/暖气/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/热水器/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/空调/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/电话/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/家具/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/电视/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/冰箱/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/洗衣机/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		//echo $Facility.'<br>';
		//echo trim ($Jiaju[1][0]).'<br>';

		//echo $contents;
		if(preg_match('/说明/', $contents))
		{
			preg_match_all("/<th>说明<\/th>\r\n		<td>(.*?)<\/td>/is", $contents, $Content);
			//echo trim ($Content[1][0]).'<br>';
			$Content = $Content[1][0];
		}
		else
		{
			$Content = '';
		}

		//preg_match_all("/<th>有效期<\/th>\r\n(.*?)<\/td>/is", $contents, $ValidTime);
		//echo trim ($ValidTime[1][0]).'<br>';

		preg_match_all("/<th>时间<\/th>\r\n(.*?)<script/is", $contents, $ValidTime);
		//echo trim ($ValidTime[1][0]).'<br>';
		//echo trim(getValue($ValidTime[1][0], 'style="display:none">', '</div>'));
		$PostTime = trim($this->getValue($ValidTime[1][0], 'style="display:none">', '</div>'));

		preg_match_all("/<th>联系人<\/th>\r\n	<td>\r\n(.*?)<a href=\"/is", $contents, $Contact);
		//echo trim ($Contact[1][0]).'<br>';
		$Contact = trim ($Contact[1][0]);

		preg_match_all("/<th>电子邮件<\/th>\r\n		<td>(.*?)<\/td>/is", $contents, $Email);
		//echo trim ($Email[1][0]).'<br>';
		//echo trim(getValue($Email[1][0], '">', '</a>'));
		$Email = trim($this->getValue($Email[1][0], '">', '</a>'));

		preg_match_all("/<th>联系电话<\/th>\r\n		<td>(.*?)<\/td>/is", $contents, $Tel);
		$Tel = trim ($Tel[1][0]);
		//echo $Tel."\r\n";

		preg_match_all("/<th>手机<\/th>\r\n		<td>(.*?)<\/td>/is", $contents, $Mobile);
		//echo trim ($Mobile[1][0]).'<br>';
		$Mobile = trim ($Mobile[1][0]);

		$db = $Mysql->connect('ihomes_temp');
		$sql = "INSERT INTO `house` (`Pid`,`Title`, `AreaID`,`CityID`,`DistID`,`CommID`,`RentPrice`,`Room`,`Hall`,`Loo`,`Facility`,`Content`,`PostTime`,`Contact`,`Email`,`Tel`,`Mobile`,`ValidPeriod`,`IfPersonal`) ";
		$sql .= "VALUES ('3','".$Title."','1', '1', '".$DistID."','".$CommID."','".$RentPrice."','".$Room."','".$Hall."','".$Loo."','".$Facility."','".$Content."','".$PostTime."','".$Contact."','".$Email."','".$Tel."','".$Mobile."', '3', '1') ";
		
		$res = $db->Query($sql);
	}
}

$db = $Mysql->connect('ihomes_temp');

$Snatch = new Snatch;

$url = 'http://rent.focus.cn/newesf/hire_frame.php';//（个人求租房源）必须设置
$start = 1;//起始页，必须设置
$end = 3;//结束页，必须设置
$MaxID = 10327826;//最大的ID，必须设置
$MinID = 10310835;//最小的ID，必须设置
//10211006-10143973,10135105-10102034,43459-42949,42947-42285,42281-42146,42145-41950,42024-41949,41948-41690

//$h = fopen('1.txt', 'w');
//fwrite($h, '');


for($i=$start; $i<($end+1); $i++)
{
	$Snatch->process_page($url, $i, $MaxID, $MinID);
}


//$Snatch->getData('http://esf.focus.cn/esf/hire/41765.html');

echo 'ok';
?>