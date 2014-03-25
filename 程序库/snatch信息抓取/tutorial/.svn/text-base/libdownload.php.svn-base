<?php

function download_curl($url)
{
	$c = curl_init();

	curl_setopt($c, CURLOPT_URL, $url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($c, CURLOPT_HTTPHEADER, array(
			'Accept: */*',
			'Accept-Language: en-US',
			'Accept-Encoding: gzip, deflate',
			'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
			'Host: www.dailymotion.com',
			'Connection: Keep-Alive'));

	//$proxy = "24.17.93.191:50050";
	//curl_setopt($c, CURLOPT_PROXY, $proxy);
	curl_setopt($c,CURLOPT_HEADER, 0);
	$res = curl_exec($c);
	curl_close($c);

	return $res;
}

function download_php($url)
{
	$n = 0;
	while($n < 10){
		$r = file_get_contents($url);
		if($r !== false) return $r;
		print "retrying $src ...\n";
		$n ++;
	}
	return false;
}

//注意，用了临时文件，不能使用多次，否则请自定义文件名，或者使用随机文件名
function download_wget($url)
{
	$cmd = "wget -q \"$url\" -O tmp.dat";
	system($cmd);
	return file_get_contents("tmp.dat");
}

?>
