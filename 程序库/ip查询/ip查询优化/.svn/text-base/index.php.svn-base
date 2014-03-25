<?php
mysql_connect('localhost','root','root');
mysql_select_db('text');

function getmicrotime()
{ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
}
//¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ªÊý¾Ý¿âË³Ðò²éÕÒ¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª

$start_time = getmicrotime();

for ($i = 0; $i < 1000; $i++){
	$ip = rand(1002242048,4294967295);
	$sql = "select * from `cdb_overseasips` where 1 ";
	$sql .= "and $ip between start_ip_long and end_ip_long ";
	$query = mysql_query($sql);
	/*
	while ($rt = mysql_fetch_row($query)){
		echo '<pre>';
		print_r ($rt);
		echo '</pre>';
	}
	*/
}

$end_time = getmicrotime();

echo '<hr>';
echo 'Êý¾Ý¿âË³Ðò²éÕÒ<br>';
echo '¿ªÊ¼Ê±¼ä£º'.$start_time.'<br>';
echo '½áÊøÊ±¼ä£º'.$end_time.'<br>';
echo 'Ö´ÐÐÊ±¼ä£º'.($end_time-$start_time);
echo '<hr>';

//¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª°´IPÍ··ÖÎÄ¼þ²éÕÒ¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª

$start_time = getmicrotime();

for ($i = 0; $i < 1000; $i++){
	$ip = rand(1002242048,4294967295);
	$ip = long2ip($ip);
	$ipdataFile = 'ipdata/'.substr($ip,0,strpos($ip,'.')).'.txt';
	!file_exists($ipdataFile) && $ipdataFile='ipdata/0.txt';
	$fh = fopen($ipdataFile,'r');
	while (!feof($fh)){
		$ipdata = fgets($fh);
		$arrip = explode("\t",$ipdata);
		if(($ip >= $arrip[1]) && ($ip <= $arrip[2])){
			break;
		}
	}
	fclose($fh);
}

$end_time = getmicrotime();

echo '<hr>';
echo '°´IPÍ··ÖÎÄ¼þ²éÕÒ<br>';
echo '¿ªÊ¼Ê±¼ä£º'.$start_time.'<br>';
echo '½áÊøÊ±¼ä£º'.$end_time.'<br>';
echo 'Ö´ÐÐÊ±¼ä£º'.($end_time-$start_time);
echo '<hr>';
//¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¶þ·Ö·¨²éÕÒ¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª¡ª
/*
$start_time = getmicrotime();
include('ipcache.php');
$min = 0;
$max = count($_IP);
$found = 0;

while ( $min <= $max )
{
	$ip = rand(1002242048,4294967295);
    $mid = intval(($min + $max) / 2);
    if     ($ip <= $_IP[$mid][2] && $b >= $_IP[$mid][1]) {$found = 1; break;}
    elseif ($ip > $_IP[$mid][2]) $min = $mid + 1;
    else   $max = $mid - 1;
}
if($found == 1) {printf("ÕÒµ½Î»ÖÃÊÇ£º%d",$mid+1);printf("\n");}
else printf("Not found");

$end_time = getmicrotime();

echo '<hr>';
echo '¶þ·Ö·¨²éÕÒ<br>';
echo $start_time.'<br>';
echo $end_time.'<br>';
echo $end_time-$start_time;
echo '<hr>';
*/

//ipÌø×ª
$curIP = $_SERVER['REMOTE_ADDR'];
if (strcmp($curIP, "200.200.200.1") >= 0 && strcmp($curIP, "200.200.200.255") <= 0){
   header("Location: cmblog.com");
}
else{
   header("Location: bbs0.com");
}

?>