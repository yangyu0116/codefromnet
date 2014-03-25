<?
set_time_limit(0);
include_once("cprogbar.php");

$progbar=new CProgbar("test");

if ($op=="progbar")
{		
	$progbar->init(100,"_parent");
	
	if ($cur==$done)
	{
		$progbar->full();
		$progbar->text("Done.","#FFFFFF","","BOLD");
		exit();
	}
	else
	{
		$progbar=new CProgbar("test",(100*$cur/$done));
		$progbar->step();
	}
	
	$cur++;
	sleep(1);
	die("<SCRIPT>location.href='".basename($PATH_TRANSLATED)."?op=progbar&done=$done&cur=$cur'</SCRIPT>");
}
?>
<HTML>
<HEAD>
<TITLE>CProgBar Iframe Example</TITLE>
<STYLE>
BODY,P,TD,DIV,SPAN
{
	font-family:Arial;
	font-size:11px;
}
</STYLE>
<script>
function run_progbar()
{
	document.frames['ProgbarCtrl'].location.href='<?=basename($PATH_TRANSLATED)?>?op=progbar&done=10&cur=0';
}
</script>
</HEAD>
		
<BODY>
<p><b>Test</b><br><?=$progbar->show()?><p>
<input onclick='run_progbar()' class='button' type='button' value='Run'>
<iframe style='display:none' name='ProgbarCtrl' width=100% height=100></iframe>
</BODY>
</HTML>
