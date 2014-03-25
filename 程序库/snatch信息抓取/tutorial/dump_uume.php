<?php

require_once('libstr.php');
require_once('libdownload.php');
//require_once('./inc/h.inc.php');

set_time_limit(10000000);

function get_video($str)
{
	//flvurl=N1N5CHH.Pfs.3Vn.NV3/sPtCV/J44h4hJO/0B_J44h4hJO_Hi.IQs&
	$flvurl = getValue($str, 'flvurl=', '&');

//$flvurl = 'N1N5CHH.Pfs.3Vn.NV3/sPtCV/J44h4hJO/0B_J44h4hJO_Hi.IQs';

	$orig_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$encr_chars = 'XJenZC91f2GOFc8ilVBrboAkSIQqUsRtT63z4PEpuxMgvdyNwDKjHaLm0h5W7Y';


	$newurl = '';
	$len = strlen($flvurl);
	for($i = 0; $i < $len; $i ++){
		$c = charAt($flvurl, $i);
		$pos = strpos($orig_chars, $c);
		if($pos !== false){
			$c = charAt($encr_chars, $pos);
		}
		$newurl .= $c;
	}

	return "http://$newurl";

}

function get_name($str)
{
	//<title>老公你千万别砸我的车 - 中国最大的视频分享中心</title>

	$title = getValue($str, '<title>', '</title>');

	$name = str_replace('- 中国最大的视频分享中心', '', $title);

	return trim($name);
}

function get_tags($str)
{
/*
                          <span class="fcolor_01">标签：</span><span><a href="search.do?q=%CE%DE%C0%E5%CD%B7" class="lnk_04">无厘头</a>
                                                                <a href="search.do?q=%B8%E3%D0%A6" class="lnk_04">搞笑</a>                                    
                                                                <a href="search.do?q=%D7%D4%C5%C4" class="lnk_04">自拍</a>                                    
                                                                </span><br/><span class="fcolor_01">添加：</span><span class="fcolor_08">2006-07-27 17:08</span><br />
*/
	$subs = getValue($str, '标签：</span><span>', '</span>');

	$pos0 = 0;
	$tagname = '';

	while(1){

		$pos1 = strpos($subs, '<a href=', $pos0);
		if($pos1 === false) break;

		$pos2 = strpos($subs, '</a>', $pos1);
		if($pos2 === false) break;

		$s = substr($subs, $pos1, $pos2-$pos1+4);
		$tag = getValue($s, '>', '</a>');
		if($tagname != '') $tagname .= '@@@';
		$tagname .= $tag;

		$pos0 = $pos2;
	}       
	return $tagname;


}

/*
function insert_db($md5sum, $videoname, $indexurl, $videourl, $thumburl, $thumbmd5, $tagname, $source, $id)
{
	global $db;
	//
	$videoname = mysql_escape_string($videoname);
	$tagname = mysql_escape_string($tagname);


	$result = $db->query("INSERT INTO videodb (md5sum, videoname, indexurl, videourl, thumburl, thumbmd5, tagname, recordtime, source, id) VALUES ('$md5sum', '$videoname', '$indexurl', '$videourl', '$thumburl', '$thumbmd5', '$tagname', NOW(), '$source', $id) ON DUPLICATE KEY UPDATE id=0");
}
*/

function mydownload($src, $dest)
{
	$n = 0;
	while($n < 10){
		$r = copy($src, $dest);
		if($r !== false) return $r;
		print "retrying $src ...\n";
		$n ++;
	}
	return false;
}

function process_item($indexurl, $thumburl, $tagname)
{
	$str = file_get_contents($indexurl);
	$videourl = get_video($str);
	$videoname = get_name($str);
	$md5sum = md5($videourl);
	print "Video Name:$videoname\n";
	print "Video Url: $videourl\n";

	print "\n\n";
	//insert_db($md5sum, $videoname, $indexurl, $videourl, $thumburl, '', $tagname, "uume", 0);
}

function process_page($url)
{
	global $db;

	//获取页面内容
	$str = file_get_contents($url);

/*
<div class="video_list_box">
                        <div class="video_list_img">
                        <a href="play_7lPwjiQGnqjp" target="_self"><img id="list_img_19"  src="images/blank.gif" style="BACKGROUND: url(images/loading.gif) no-repeat center 50%"  name="http://p-dx29.io8.org/data/temp/20060727/up.uume.com8080/temp/1153989340611/little/03.jpg" alt=">ＴＥＳＴ" /></a>
                        </div>
                        <div class="video_list_title">
                        <a href="play_7lPwjiQGnqjp" target="_self" class="lnk_01">ＴＥＳＴ</a>
                    </div> 
                        <div class="video_list_info">
                          <span class="fcolor_01">标签：</span><span><a href="search.do?q=%CE%DE%C0%E5%CD%B7" class="lnk_04">无厘头</a>
                                                                <a href="search.do?q=%B8%E3%D0%A6" class="lnk_04">搞笑</a>                                    
                                                                <a href="search.do?q=%D7%D4%C5%C4" class="lnk_04">自拍</a>                                    
                                                                </span><br/><span class="fcolor_01">添加：</span><span class="fcolor_08">2006-07-27 17:08</span><br />
                          <span class="fcolor_01">观看：</span><span class="fcolor_08">35</span><br/>
                                <img src="images/star_orange01.gif" width="17" height="17" alt="" />
<img src="images/star_orange02.gif" width="17" height="17" alt="" />

                        </div>
                </div>
*/
	$pos0 = 0;

	while(1){
		//查找条目开始位置
		$pos1 = strpos($str, '<div class="video_list_box">', $pos0);
		if($pos1 === false) break;

		//查找条目结束位置， （这里仅截取有用信息部分，并非整个条目）
		$pos2 = strpos($str, '<span class="fcolor_01">观看：', $pos1);
		if($pos2 === false) break;


		//获取子字符串
		$subs = substr($str, $pos1, $pos2 - $pos1);


		//实际分析部分
		$thumburl = getValue($subs, ' name="', '"');
		$s = getValue($subs, '<div class="video_list_title">', '</div>');
		$indexurl = getValue($s, '<a href="', '"');
		$indexurl = "http://www.uume.com/$indexurl";


		$tagname = get_tags($subs);
		//查看此条目是否已经存在于数据库之中。主要目的是防止重复获取内容

/*
		$result = $db->query("SELECT * FROM videodb WHERE source='uume' AND indexurl='$indexurl'");
		if($db->num_rows($result) == 0){

*/
			print "Page Url:  $indexurl\n";
			print "Thumbnail: $thumburl\n";
			print "Tags:      $tagname\n";
			process_item($indexurl, $thumburl, $tagname);
			
/*
		}
*/
		//forward pointer
		$pos0 = $pos2;
	}

}

function logRecord($str)
{
	$fp = fopen("uumelog.txt", "a");

	fwrite($fp, $str);

	fclose($fp);
}


function dumpsite($n1, $n2)
{
	// 查看页面，确定总页数
	for($i=$n1; $i<=$n2; $i++){
		$url = "http://www.uume.com/videolist.jsp?id=1&page1=$i";
		print "=============Processing $url\n";
		logRecord("Page $i : $url\n");
		process_page($url);
	}
}


dumpsite(1, 164);
?>
