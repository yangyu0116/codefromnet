<?php
//���⣨���ˣ�
require_once $_SERVER['DOCUMENT_ROOT'].'/config.ini.php';


class Snatch
{
	public $contents = '';

	//�õ�$left��$right�м�Ķ���
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

	//�õ�$left��$right֮��Ķ���(����$left��$right)
	function getValue2($str, $left, $right)
	{
		$pos1 = strpos($str, $left);
		if($pos1 === false) return;
		$pos2 = strpos($str, $right, $pos1);
		if($pos2 === false) return;
		$s = substr($str, $pos1, $pos2 + strlen($right) - $pos1);
		return $s;
	}

	//POST���ݣ��õ����ص�ҳ������
	function postPage($url, $postdata)
	{       
		$c = curl_init();
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($c, CURLOPT_VERBOSE, 1);				//��ʾ������Ϣ      
		//curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);  //֧���ض���   
		curl_setopt($c, CURLOPT_URL, $url);        
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST,  2);     
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, FALSE);    
		//curl_setopt($c, CURLOPT_USERAGENT,  $useragent);     
		curl_setopt($c, CURLOPT_POST, 1);     
		curl_setopt($c, CURLOPT_POSTFIELDS, $postdata);     
		curl_setopt($c, CURLOPT_HEADER, 1);	// Header ���ݷŵ��� $res ��       
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
			//echo $thumburl.'<br>';
			if($thumburl <> '')
			{
				$t1 = explode('/', $thumburl);
				$t2 = explode('.', $t1[2]);
				//echo $t2[0];
				if($t2[0] >($MinID-1) && $t2[0] < ($MaxID+1))
				{
					//�õ�����ҳ��ĵ�ַ
					//fwrite($h, 'http://esf.focus.cn/esf'.$thumburl."\n");					
					$thumburl = 'http://esf.focus.cn/esf'.$thumburl;
					//echo $thumburl.'<br>';
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

		$Districts = array('����', '����', '����', '����', '����', '����', '��̨', 'ʯ��ɽ', '��ɽ', '����', 'ͨ��' , '˳��', '��ƽ', '����', '����', '����', 'ƽ��' ,'��ͷ��');

		preg_match_all("/<th>�������ַ<\/th>\r\n	<td>\r\n(.*?)<\/td>/is", $contents, $Address);
		foreach($Districts as $key=>$District)
		{
			if(preg_match('/'.$District.'/', trim ($Address[1][0])))
			{
				$DistID = $key+1;
				//echo $DistID."\r\n";
			}
		}

		preg_match_all("/<th>����С��<\/th>\r\n	<td>\r\n(.*?)<\/td>/is", $contents, $Comm);
		$Char = new Char;

		//echo $Comm[1][0]."\r\n";
		$CommName = strip_tags(trim ($Comm[1][0]));
		//echo $CommName."\r\n";
		$CommName_1 = preg_replace('/�鿴¥������/', '', $CommName);
		$CommName_1 =  $Char->cnSubstr($CommName_1, 0, 6);

		$CommName =  $Char->cnSubstr($CommName_1, 0, 4);
		
		$db = $Mysql->connect($DB_COMM);

		$sql = "SELECT  `ID` FROM `community` WHERE 1 ";
		$sql .= "AND  `Name`LIKE '%".$CommName."%' ";
		$sql .= "LIMIT 1 ";
		$res = $db->GetAll($sql);
		//echo mysql_error();
		//echo $res[0]['ID']."\r\n";
		$CommID = $res ? $res[0]['ID'] : 0;
		//echo $CommID."\r\n";
		//echo trim ($Comm[1][0])."\r\n";

		preg_match_all("/<th>����������װ��<\/th>\r\n(.*?)<\/td>/is", $contents, $Fitment);
		//echo trim ($Fitment[1][0])."\r\n";
		if(preg_match('/��װ/', trim ($Fitment[1][0])))
		{
			$Fitment = '2';		
		}
		else
		{
			if(preg_match('/��װ/', trim ($Fitment[1][0])))
			{
				$Fitment = '1';		
			}
			else
			{
				if(preg_match('/����/', trim ($Fitment[1][0])))
				{
					$Fitment = '1';		
				}
			}
		}
		//echo $Fitment."\r\n";

		preg_match_all("/<th>���<\/th>\r\n	<td>\r\n		<font color=\"red\">(.*?)<\/font>/is", $contents, $Price);
		//echo trim ($Price[1][0])."\r\n";
		preg_match_all("/(.*?)Ԫ/is", trim ($Price[1][0]), $Price);
		$Price = $Price[1][0];
		//echo $Price."\r\n";

		preg_match_all("/<th>���������<\/th>\r\n	<td>\r\n(.*?)<\/td>/is", $contents, $Huxing);
		preg_match_all("/(.*?)��/is", trim ($Huxing[1][0]), $Room);
		preg_match_all("/��(.*?)��/is", trim ($Huxing[1][0]), $Hall);
		preg_match_all("/��(.*?)��/is", trim ($Huxing[1][0]), $Loo);
		preg_match_all("/\"red\">(.*?)�O/is", trim ($Huxing[1][0]), $Area);
		//echo 'Room:'.$Char->cnSubstr(trim ($Huxing[1][0]) , 0, 1)."\r\n";
		//echo 'Hall:'.$Char->cnSubstr(trim ($Huxing[1][0]) , 2, 1)."\r\n";
		//echo 'Loo:'.$Char->cnSubstr(trim ($Huxing[1][0]) , 4, 1)."\r\n";
		//echo trim($Huxing[1][0])."\r\n";
		//echo $Room[1][0]."\r\n";
		///echo $Hall[1][0]."\r\n";
		//echo $Loo[1][0]."\r\n";
		$Room = $Room[1][0];
		$Hall = $Hall[1][0];
		$Loo = $Loo[1][0];
		$Area = $Area[1][0];

		$Title = '����'.$CommName_1;
		if($Room<>'')
		{
			$Title .= $Room.'��';
		}
		if($Hall<>'')
		{
			$Title .= $Hall.'��';
		}

		preg_match_all("/<th>¥��<\/th>\r\n	<td>\r\n(.*?)<\/td>/is", $contents, $Louceng);
		//echo trim ($Louceng[1][0])."\r\n";
		preg_match_all("/��(.*?)��/is", trim ($Louceng[1][0]), $Floor);
		preg_match_all("/¥��(.*?)��/is", trim ($Louceng[1][0]), $FloorTotal);
		$Floor = trim($Floor[1][0]);
		$FloorTotal = trim($FloorTotal[1][0]);
		//echo $Floor."\r\n";
		//echo $FloorTotal."\r\n";

		preg_match_all("/<th>�Ҿ��豸<\/th>\r\n(.*?)<\/td>/is", $contents, $Jiaju);
		$Facility = '';
		if(preg_match('/ȼ��/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/ů��/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/��ˮ��/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/�յ�/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/�绰/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/�Ҿ�/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/����/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/����/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		if(preg_match('/ϴ�»�/', trim ($Jiaju[1][0])))
		{
			$Facility .= '1|';		
		}
		else
		{
			$Facility .= '|';
		}
		//echo $Facility."\r\n";
		//echo trim ($Jiaju[1][0])."\r\n";

		//echo $contents;
		if(preg_match('/˵��/', $contents))
		{
			preg_match_all("/<th>˵��<\/th>\r\n		<td>(.*?)<\/td>/is", $contents, $Content);
			//echo trim ($Content[1][0])."\r\n";
			$Content = $Content[1][0];
		}
		else
		{
			$Content = '';
		}
		//echo $Content."\r\n";

		//preg_match_all("/<th>��Ч��<\/th>\r\n(.*?)<\/td>/is", $contents, $ValidTime);
		//echo trim ($ValidTime[1][0])."\r\n";

		preg_match_all("/<th>ʱ��<\/th>\r\n(.*?)<script/is", $contents, $ValidTime);
		//echo trim ($ValidTime[1][0])."\r\n";
		//echo trim(getValue($ValidTime[1][0], 'style="display:none">', '</div>'));
		$PostTime = trim($this->getValue($ValidTime[1][0], 'style="display:none">', '</div>'));
		//echo $PostTime."\r\n";

		preg_match_all("/<th>��ϵ��<\/th>\r\n	<td>\r\n(.*?)<a href=\"/is", $contents, $Contact);
		//echo trim ($Contact[1][0])."\r\n";
		$Contact = trim ($Contact[1][0]);
		//echo $Contact."\r\n";

		preg_match_all("/<th>�����ʼ�<\/th>\r\n		<td>(.*?)<\/td>/is", $contents, $Email);
		//echo trim ($Email[1][0])."\r\n";
		//echo trim(getValue($Email[1][0], '">', '</a>'));
		$Email = trim($this->getValue($Email[1][0], '">', '</a>'));
		//echo $Email."\r\n";

		if(preg_match('/��ϵ�绰/', $contents))
		{
			preg_match_all("/<th>��ϵ�绰<\/th>\r\n		<td>(.*?)<\/td>/is", $contents, $Tel);
			$Tel = trim ($Tel[1][0]);
			//echo $Tel."\r\n";
		}
		else
		{
			if(preg_match('/С��ͨ/', $contents))
			{
				preg_match_all("/<th>С��ͨ<\/th>\r\n		<td>(.*?)<\/td>/is", $contents, $Tel);
				$Tel = trim ($Tel[1][0]);
				//echo $Tel."\r\n";
			}
		}

		preg_match_all("/<th>�ֻ�<\/th>\r\n		<td>(.*?)<\/td>/is", $contents, $Mobile);
		$Mobile = trim ($Mobile[1][0]);
		//echo $Mobile."\r\n";

		$db = $Mysql->connect('temp');
		$sql = "INSERT INTO `house` (`Pid`,`Title`, `AreaID`,`CityID`,`DistID`,`CommID`,`Fitment`,`Area`,`PriceType`,`Price`,`Room`,`Hall`,`Loo`,`Floor`,`FloorTotal`,`Facility`,`Content`,`PostTime`,`Contact`,`Email`,`Tel`,`Mobile`,`ValidPeriod`,`IfPersonal`) ";
		$sql .= "VALUES ('1','".$Title."','1', '1', '".$DistID."','".$CommID."','".$Fitment."','".$Area."','1','".$Price."','".$Room."','".$Hall."','".$Loo."','".$Floor."','".$FloorTotal."','".$Facility."','".$Content."','".$PostTime."','".$Contact."','".$Email."','".$Tel."', '".$Mobile."', '3', '1') ";
		//echo $sql."\r\n";
		
		$res = $db->Query($sql);
	}
}

$db = $Mysql->connect('temp');

$Snatch = new Snatch;

$url = 'http://rent.focus.cn/newesf/lease_frame.php';//�����˳��ⷿԴ����������
$start = 1;//��ʼҳ����������
$end = 3;//����ҳ����������
$MaxID = 10327928;//����ID����������
$MinID = 10325409;//��С��ID����������
//10211462-10206883,10137133-10133684,459256-451876,451869-442737,442732-441063,441061-438023,438021-437795,437778-435218
//$h = fopen('1.txt', 'w');
//fwrite($h, '');


for($i=$start; $i<($end+1); $i++)
{
	$Snatch->process_page($url, $i, $MaxID, $MinID);
}

//$Snatch->getData('http://esf.focus.cn/esf/lease/435930.html');

echo 'ok';
?>