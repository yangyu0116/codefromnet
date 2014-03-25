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
	//<title>�Ϲ���ǧ������ҵĳ� - �й�������Ƶ��������</title>

	$title = getValue($str, '<title>', '</title>');

	$name = str_replace('- �й�������Ƶ��������', '', $title);

	return trim($name);
}

function get_tags($str)
{
/*
                          <span class="fcolor_01">��ǩ��</span><span><a href="search.do?q=%CE%DE%C0%E5%CD%B7" class="lnk_04">����ͷ</a>
                                                                <a href="search.do?q=%B8%E3%D0%A6" class="lnk_04">��Ц</a>                                    
                                                                <a href="search.do?q=%D7%D4%C5%C4" class="lnk_04">����</a>                                    
                                                                </span><br/><span class="fcolor_01">��ӣ�</span><span class="fcolor_08">2006-07-27 17:08</span><br />
*/
	$subs = getValue($str, '��ǩ��</span><span>', '</span>');

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

	//��ȡҳ������
	$str = file_get_contents($url);

/*
<div class="video_list_box">
                        <div class="video_list_img">
                        <a href="play_7lPwjiQGnqjp" target="_self"><img id="list_img_19"  src="images/blank.gif" style="BACKGROUND: url(images/loading.gif) no-repeat center 50%"  name="http://p-dx29.io8.org/data/temp/20060727/up.uume.com8080/temp/1153989340611/little/03.jpg" alt=">�ԣţӣ�" /></a>
                        </div>
                        <div class="video_list_title">
                        <a href="play_7lPwjiQGnqjp" target="_self" class="lnk_01">�ԣţӣ�</a>
                    </div> 
                        <div class="video_list_info">
                          <span class="fcolor_01">��ǩ��</span><span><a href="search.do?q=%CE%DE%C0%E5%CD%B7" class="lnk_04">����ͷ</a>
                                                                <a href="search.do?q=%B8%E3%D0%A6" class="lnk_04">��Ц</a>                                    
                                                                <a href="search.do?q=%D7%D4%C5%C4" class="lnk_04">����</a>                                    
                                                                </span><br/><span class="fcolor_01">��ӣ�</span><span class="fcolor_08">2006-07-27 17:08</span><br />
                          <span class="fcolor_01">�ۿ���</span><span class="fcolor_08">35</span><br/>
                                <img src="images/star_orange01.gif" width="17" height="17" alt="" />
<img src="images/star_orange02.gif" width="17" height="17" alt="" />

                        </div>
                </div>
*/
	$pos0 = 0;

	while(1){
		//������Ŀ��ʼλ��
		$pos1 = strpos($str, '<div class="video_list_box">', $pos0);
		if($pos1 === false) break;

		//������Ŀ����λ�ã� ���������ȡ������Ϣ���֣�����������Ŀ��
		$pos2 = strpos($str, '<span class="fcolor_01">�ۿ���', $pos1);
		if($pos2 === false) break;


		//��ȡ���ַ���
		$subs = substr($str, $pos1, $pos2 - $pos1);


		//ʵ�ʷ�������
		$thumburl = getValue($subs, ' name="', '"');
		$s = getValue($subs, '<div class="video_list_title">', '</div>');
		$indexurl = getValue($s, '<a href="', '"');
		$indexurl = "http://www.uume.com/$indexurl";


		$tagname = get_tags($subs);
		//�鿴����Ŀ�Ƿ��Ѿ����������ݿ�֮�С���ҪĿ���Ƿ�ֹ�ظ���ȡ����

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
	// �鿴ҳ�棬ȷ����ҳ��
	for($i=$n1; $i<=$n2; $i++){
		$url = "http://www.uume.com/videolist.jsp?id=1&page1=$i";
		print "=============Processing $url\n";
		logRecord("Page $i : $url\n");
		process_page($url);
	}
}


dumpsite(1, 164);
?>
