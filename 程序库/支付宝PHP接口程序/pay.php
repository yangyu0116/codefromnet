<?
error_reporting(0);
$aliname=$_POST["aliname"]; 
$aliZipCode=$_POST["aliZipCode"]; 
$aliPhone=$_POST["aliPhone"]; 
$aliaddress=$_POST["aliaddress"]; 
$aliorder=$_POST["aliorder"]; 
$alimailtype=$_POST["alimailtype"]; 
$alimoney=$_POST["alimoney"]; 
$alimob=$_POST["alimob"]; 
$alibody=$_POST["alibody"];
?>
<?
require_once("alipay_config.php");
require_once("alipay.php");


$cmd			=	'0001';
$subject		=	"订单号：".$aliorder;
$body			=	'商品介绍';
$order_no		=	$aliorder;
$price			=	$alimoney;
$url			=	'www.basedsoft.cn';
$type			=	'1';
$number			= 	'1';
$transport		=	$alimailtype;
$ordinary_fee		=	'0.00';
$express_fee		=	'0.00';
$readonly		=	'true';
$buyer_msg		=	$alibody;
$seller			=	$selleremail;
$buyer			=	'';
$buyer_name		=	$aliname;
$buyer_address		=	$aliaddress;
$buyer_zipcode		=	$aliZipCode;
$buyer_tel		=	$aliPhone;
$buyer_mobile		=	$alimob;
$partner		=	'2088002043457436';

$geturl	= new alipay;
$link	= $geturl->geturl
	(
	$cmd,$subject,$body,$order_no,$price,$url,$type,$number,$transport,
	$ordinary_fee,$express_fee,$readonly,$buyer_msg,$seller,$buyer,
	$buyer_name,$buyer_address,$buyer_zipcode,$buyer_tel,$buyer_mobile,$partner,
	$interfaceurl,$payalikey
	);
?>
<HTML>
<HEAD>
<TITLE>创软支付宝付款PHP版</TITLE>
<LINK href="Admin_Style.css" rel=stylesheet>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
</HEAD>

<BODY>
<TABLE class=border id=table1 style="FONT-SIZE: 9pt" height=185 cellSpacing=0 
cellPadding=0 width=492 align=center border=0>
  <TBODY>
  <TR>
    <TD class=topbg height=30>
      <DIV align=center><STRONG>支付宝付款PHP版</STRONG></DIV></TD></TR>
  <TR>
    <TD style="BORDER-LEFT: #e4e4e4 1px solid; BORDER-BOTTOM: #e4e4e4 1px solid" colSpan=3 height=150>
      <TABLE style="FONT-SIZE: 9pt" height=137 width="100%" align=center bgColor=#ffffff>
        <TBODY>
        <TR class=tdbg>
          <TD width="14%">订单号码：</TD>
          <TD width="86%"><? echo $aliorder; ?></TD></TR>
        <TR class=tdbg>
          <TD width="14%">收 货 人：</TD>
          <TD width="86%"><? echo $aliname; ?></TD></TR>
        <TR class=tdbg>
          <TD width="14%">付款金额：</TD>
          <TD width="86%"><b><? echo $alimoney; ?></b></TD></TR>
        <TR class=tdbg>
          <TD width="14%">收货地址：</TD>
          <TD width="86%"><? echo $aliaddress; ?></TD></TR>
        <TR class=tdbg>
          <TD>物流方式：</TD>
          <TD><? echo $alimailtype; ?> （1.平邮 2.快递 3.虚拟物品）</TD></TR>
        <TR class=tdbg>
          <TD>联系电话：</TD>
          <TD><? echo $aliPhone; ?></TD></TR>
        <TR class=tdbg>
          <TD>邮政编码：</TD>
          <TD><? echo $aliZipCode; ?></TD></TR>
        <TR class=tdbg>
          <TD>手机号码：</TD>
          <TD><? echo $alimob; ?></TD></TR>
        <TR class=tdbg>
          <TD>客户留言：</TD>
          <TD><? echo $alibody; ?></TD></TR>
        <TR class=tdbg>
          <TD></TD>
          <TD><input type="button" name="Submit21" onclick="javascript:history.go(-1)" value="返回修改订单">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $link?>" target="_blank"><img src="<?php echo $imgurl?>" alt="<?php echo $imgtitle?>" border="0" align='absmiddle' border='0'/></a> </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
  
</BODY></HTML>