<?
####################################################################################
###                              请修改以下内容                                  ###
####################################################################################

//参数设置开始

$homepage_name = "集步网络在线";//网站名称
$email = "1028@1028.com.cn";//您的邮箱
$mailfrom = "";//默认邮件发送地址（此项可不填）
$subject = "";//默认邮件主题（此项可不填）
$message = "";//默认邮件内容（此项可不填）

$time = "3600";//设置统计时间（单位为秒，这里默认为1小时）
$num = "3";//设置在统计的时间内不允许重复发送所超过的次数，默认为3次
$closetime = "6000";//邮件成功发送后系统自动关闭的时间，时间太短用户可能看不完系统反馈信息（1000=1秒，注意这里和前面的时间单位不一样）
$center = "1";//是否将弹出的窗口居中，（1为是；0为否）
$guestip = "1";//是否在邮件中写入发送者的IP地址和发送时间（1为是；0为否）
$updata = "1";//是否允许上传附件？（1为是；0为否）
$filesize = "100";//限制文件的大小，这里的单位为K, 1M=1024K,这里必须设置，因为有时服务器处理不了那么大的文件，
                   //不然服务器会出错，一般服务器最大能处理2M，如果前面的选项关闭，此项不起作用，
$countfile = "count.txt";//用来统计数据的文件

//参数设置结束

####################################################################################
#################    以下内容不要修改，除非你知道你在干什么    #####################
####################################################################################


$ip=$HTTP_SERVER_VARS["REMOTE_ADDR"]; 
$ontime=time();
$gahob[ontime] = date("Y年m月d日 H时i分s秒",$ontime); 
if($to=="") $mailto=$email;
else $mailto=$to;

//清除已经过期的数据
$clearfile=file($countfile);
for($i=0;$i<sizeof($clearfile);$i++){
  $clearfile[$i]=trim($clearfile[$i]);
  $clearstr=explode("|",$clearfile[$i]);
  if(($ontime-$time)>=$clearstr[3]) {
  $findclearip=true;//如果找到过期的数据则清除
  }
  else $clearip.=$clearfile[$i]."\n";
}
if($findclearip){
$fp=fopen($countfile,"w");
flock($fp,2);
fwrite($fp,$clearip);
fclose($fp);
 }

if($job=="send"){
echo "<style type='text/css'>
<!--
body {font-size: 12px; background-color:#779EBB;text-decoration: none;line-height: 15pt;}
a:link       { color: #000000; text-decoration: none;}
a:visited    { color: #000000; text-decoration: none;}
a:active     { color: #000000; text-decoration: none;}
a:hover      { color: red; text-decoration: none;}
-->
</style>";

$sizeoffile=file($countfile);
for($i=0;$i<sizeof($sizeoffile);$i++){
  $sizeoffile[$i]=trim($sizeoffile[$i]);
  $ipexp=explode("|",$sizeoffile[$i]);
if(($ipexp[1]==$ip)&&(($ontime-$ipexp[0])<$time)&&($ipexp[2]>=$num)) {
echo "<script>
setTimeout('window.close();', $closetime); 
</script>
<div align=center><br><br><br>对不起，你在限定的时间内发送次数已经超过了".$num."次<br>
此次发送不成功！系统即将关闭！</div>";
exit;
}
}

$gahob[mailto] = $_POST["mailto"];
$gahob[subject] = $_POST["subject"];
$gahob[mailfrom] = $_POST["mailfrom"];
$gahob[message] = $_POST["message"];
if($guestip=="1")$gahob[message1]="该用户的IP地址是：".$ip."\n发信时间是：".$gahob[ontime];
else $gahob[message1] = "";
$url="mailto.php?to=$gahob[mailto]&mailfrom=$gahob[mailfrom]&subject=$gahob[subject]&message=$gahob[message]";

if (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$",$gahob[mailto])) {
  echo "<meta http-equiv=refresh content='3;URL=$url'>
<div align=center><br><br><br><br>邮件接收地址有错，请仔细检查!</div>";
  exit;
}
if ($gahob[mailfrom] != ""){
if (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$",$gahob[mailfrom])) {
  echo "<meta http-equiv=refresh content='5;URL=$url'>
<div align=center><br><br><br>邮件发送地址有错，请仔细检查!<br>
此项您可以不填，但是您的IP地址同样会被系统自动记录！<br>
对于真诚的您，填上又有何妨呢？</div>";
  exit;
}}
if($gahob[mailto] != "" && $gahob[subject] != "" && $gahob[message] != ""){
$boundary = uniqid( ""); 

$gahob[headers] = "From: $gahob[mailfrom]
content-type: multipart/mixed; boundary=\"$boundary\""; 

if ($mailfile_type) $mimetype = $mailfile_type; 
else $mimetype = "application/unknown"; 

$filename = $mailfile_name; 
$fp = fopen($mailfile, "r"); 

$filesize2=$filesize*1024;
$filesize3=filesize($mailfile);
if($filesize3 > $filesize2){
echo "<meta http-equiv=refresh content='5;URL=$url'>
<div align=center><br><br><br>对不起，您邮件中的附件体积大于了 $filesize K<br>
请将该文件压缩后在发送，如果是已经压缩过了的，<br>
那么建议您将压缩文件分割为几小块后再发送！<br>
<a href=\"http://www.gahob.com/bbs/read.php?forumid=6&filename=f_13\"  target=\"blank\" title=\"点击这里获得帮助\">如果您需要帮助，请点击此处</a><br>
<a href=\"javascript:self.close();\">如您不想发送了，请点击这里关闭窗口！</a>
</div>";//输出发送失败信息到浏览器！
exit;
}
if(!empty($mailfile)){
$read = fread($fp, $filesize3); 
$read = base64_encode($read); 
$read = chunk_split($read); 
}
$gahob[message2] = "--$boundary 
Content-type: text/plain; charset=iso-8859-1 
Content-transfer-encoding: 8bit 

$gahob[message] 

--$boundary 
Content-type: $mimeType; name=$filename 
Content-disposition: attachment; filename=$filename 
Content-transfer-encoding: base64 

$read 


$gahob[message1] 
--$boundary--"; 
if(mail($gahob[mailto], $gahob[subject], $gahob[message2], $gahob[headers])){
echo "<script>
setTimeout('window.close();', $closetime); 
</script>
<div align=center><br><br><br>
您的邮件已经成功发送，系统3秒后自动关闭，<br>
<br>
<a href=$url>如您还需要发送，请点击这里返回！</a>
</div>";//输出发送成功信息到浏览器！

//开始统计同一IP发送数量
$sizeoffile=file($countfile);
for($i=0;$i<sizeof($sizeoffile);$i++){
  $sizeoffile[$i]=trim($sizeoffile[$i]);
  $ipvar=explode("|",$sizeoffile[$i]);
  if($ipvar[1]==$ip) {
  $findip=true;
  $ipvar[2]=$ipvar[2]+1;//找到相同的IP后将计数器增加 1
  $inputip=$inputip.$ipvar[0]."|".$ipvar[1]."|".$ipvar[2]."|".$ontime."\n";
  }
  else $inputip=$inputip.$sizeoffile[$i]."\n";//没有找到相同的IP则复制原来的数据
}
if(!$findip){
 $inputip=$ontime."|".$ip."|1|".$ontime."\n".$inputip;//如果是新数据则写入新数据
 }
$fp=fopen("count.txt","w");
flock($fp,2);
fwrite($fp,$inputip);
fclose($fp);
//统计同一IP发送数量
exit;
} 

else {
echo "<meta http-equiv=refresh content='3;URL=$url'>
<div align=center><br><br><br>邮件发送失败！系统3秒后自动返回，<br>
<a href=\"javascript:self.close();\">如您不想发送了，请点击这里关闭窗口！</a>
</div>";//输出发送失败信息到浏览器！
exit;
}
}
else 
echo "<meta http-equiv=refresh content='1;URL=$url'>
<div align=center><br><br><br>请将信息填写完毕！
</div>";//输出提醒填写信息到浏览器！
exit;
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>【<?=$homepage_name;?>】邮件发送程序</title>
<style type="text/css">
<!--
td  { font-size: 12px; }

INPUT{font-family: 宋体; font-size: 9pt;HEIGHT: 18px;background-color:#D8E2EB;
BORDER-TOP-WIDTH: 1px; BORDER-TOP-COLOR: #cccccc; PADDING-TOP: 1px;
BORDER-LEFT-WIDTH: 1px; BORDER-LEFT-COLOR: #cccccc; PADDING-LEFT: 1px; 
BORDER-BOTTOM-WIDTH: 1px; BORDER-BOTTOM-COLOR: #cccccc; PADDING-BOTTOM: 1px; 
BORDER-RIGHT-WIDTH: 1px; BORDER-RIGHT-COLOR: #cccccc; PADDING-RIGHT: 1px;}
textarea {font-family: 宋体; font-size: 9pt;background-color:#D8E2EB;
BORDER-TOP-WIDTH: 1px; BORDER-TOP-COLOR: #cccccc; PADDING-TOP: 1px;
BORDER-LEFT-WIDTH: 1px; BORDER-LEFT-COLOR: #cccccc; PADDING-LEFT: 1px; 
BORDER-BOTTOM-WIDTH: 1px; BORDER-BOTTOM-COLOR: #cccccc; PADDING-BOTTOM: 1px; 
BORDER-RIGHT-WIDTH: 1px; BORDER-RIGHT-COLOR: #cccccc; PADDING-RIGHT: 1px;}

.input1 {BORDER-TOP-WIDTH: 1px; PADDING-RIGHT: 1px; PADDING-LEFT: 1px; BORDER-LEFT-WIDTH: 1px; 
			BORDER-LEFT-COLOR: #ffffff; BORDER-BOTTOM-WIDTH: 1px; BORDER-BOTTOM-COLOR: #666666; 
			PADDING-BOTTOM: 1px; BORDER-TOP-COLOR: #ffffff; PADDING-TOP: 1px; BORDER-RIGHT-WIDTH: 1px; 
			BORDER-RIGHT-COLOR: #666666;background-color:#bbbbbb; width=100;}

a:link       { color: #000000; text-decoration: none;}
a:visited    { color: #000000; text-decoration: none;}
a:active     { color: #000000; text-decoration: none;}
a:hover      { color: red; text-decoration: none;}
-->
</style>
<?
if ($center=="1"){
echo "<script language=\"javascript\">
<!--
	moveTo((screen.width-400)/2,(screen.height-250)/2);
	self.resizeTo(400,245)
//-->
</script>";
}
?>
</head>
<body bgcolor=#779EBB topmargin=0>
<script language=JavaScript1.2>
function sendmailto() {
 	if (theform.mailto.value==""){
 		alert("喂，收件地址都不填，那让谁来看邮件呢？");
		return false; 	}
	if (theform.subject.value==""){
 		alert("嗨，好象还没有写邮件主题哦 ，快补上!");
        return false; 	}
 	if (theform.message.value==""){
 		alert("怎么能这样呢？邮件内容都不写，难道说叫接收者看白板拉？我晕了！");
        return false; 	}
    if (theform.mailfrom.value=="") {
       if (confirm("“你的邮件”地址栏为空耶，此项你可以不填，但是要填就必须写正确的邮件地址！你需要补上你的邮件地址吗？")){
	      return false;}
	        SendMailPro();
			document.theform.submit();
            return true;}
     
  else {
	   SendMailPro();
      	document.theform.submit();
	}

}

function resetmail()
{
	document.theform.mailto.value="<?=$email?>";
	document.theform.mailfrom.value="";
	document.theform.subject.value="";
	document.theform.message.value="";
}
</script>

<table align="center" width="400" border="0" cellpadding="0" cellspacing="0">
 <tr> 
    <td width="400" height="13"></td>
  </tr>
  <tr>
    <td height="195" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <form method="post" action="mailto.php?job=send" enctype="multipart/form-data" name="theform">
          <tr> 
            <td width="79" height="4"></td>
            <td width="319"></td>
            <td width="2"></td>
          </tr>
          <tr> 
            <td height="25" align="right" valign="middle"><font title="请写入收件地址！
注意每个字符的大小写！" style="cursor:help">收件地址：</font></td>
            <td align="left" valign="middle"> <input name="mailto" type="text" value="<?=$mailto;?>" size="42"></td>
            <td></td>
          </tr>
          <tr> 
            <td height="25" align="right" valign="middle"><font title="请写入您的邮件！此项您可以不填，
但是您的IP地址同样会被系统自动记录！" style="cursor:help">您的邮件：</font></td>
            <td align="left" valign="middle"> <input name="mailfrom" type="text" value="<?=$mailfrom;?>" size="42"></td>
            <td></td>
          </tr>
          <tr> 
            <td height="25" align="right" valign="middle"><font title="请写入邮件主题！" style="cursor:help">邮件主题：</font></td>
            <td align="left" valign="middle"> <input name="subject" type="text" value="<?=$subject;?>" size="42"></td>
            <td></td>
          </tr>
          <tr> 
            <td height="25" align="right" valign="middle"><font title="请写入邮件内容！" style="cursor:help">邮件内容：</font></td>
            <td rowspan="2" align="left" valign="middle"> <textarea name="message" cols="40" rows="4"><?=$message;?></textarea></td>
            <td></td>
          </tr>
          <tr> 
            <td height="41"></td>
            <td></td>
          </tr>
          <tr> 
            <td height="25" align="right" valign="middle"><font title="<?
			if($updata=="1"){
			echo"附件上传功能被管理员打开！
您可以上传体积大小在".$filesize."K内的文件！";
			}else{
			echo"附件上传功能被管理员关闭！
请您先联系管理员！";
			}
			?>" style="cursor:help">上传附件：</font></td>
            <td align="left" valign="middle"> <? if($updata=="1"){
			echo "<input name=\"mailfile\" type=\"file\" size=\"31\">";
			}
			else echo "&nbsp;&nbsp;&nbsp;&nbsp;附件上传功能已被管理员关闭！";
			?></td>
            <td></td>
          </tr>
          <tr> 
            <td height="25"></td>
            <td valign="middle"> &nbsp; <input type="submit" value="发 送 邮 件" class=input1 onclick="javascript:sendmailto(); return false;"> 
              &nbsp; <input type="reset" class=input1 value="重 写 邮 件" onclick="javascript:resetmail(); return false;"> </td>
            <td></td>
          </tr>
        </form>
      </table></td>
  </tr>
  <tr>
    <td height="6"></td>
  </tr>
</table>
<script language=javascript><!--
function SendMailPro() {
	sending.style.visibility="visible";
	}
--></script>
<div id=sending style='position:absolute; top:66px; left:15px; z-index:10; width: 100%; visibility: hidden;'><TABLE WIDTH=260 BORDER=0 align=center CELLPADDING=0 CELLSPACING=0><TR><TD width=260 height=48 valign=top><TABLE WIDTH=100% height=70 BORDER=0 CELLPADDING=0 CELLSPACING=1 bgcolor=#990000><TR><td width=256 height=46 align=center valign=middle bgcolor=#D1E9CB>邮件正在发送,请稍候...</td></tr></table></td></tr></table></div>
</body>
</html>