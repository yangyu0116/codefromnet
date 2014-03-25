<HTML>
<HEAD>
<TITLE>CProgBar Example</TITLE>
<STYLE>
BODY,P,TD,DIV,SPAN
{
	font-family:Arial;
	font-size:11px;
}
</STYLE>
</HEAD>
<BODY>
<p><b>CProgBar Example</b></p>
<?
set_time_limit(0);
include_once("cprogbar.php");

$err=0;
$progbar=new CProgbar("test1");
print("<p><b>Test 1</b><br>".$progbar->show()."<p>");
$progbar->init();
for($i=0; $i<100; $i++) 
{
	if (rand(1,10)==9) 
	{
		$err=1;
		$progbar->error("Error");
		break;
	}
	$progbar->step();
	sleep(1);
}
if (!$err)
{
	$progbar->full();
	$progbar->text("Done");
}

$progbar=new CProgbar("test2");
print("<p><b>Test 2</b><br>".$progbar->show()."<p>");
$progbar->init(10);
for($i=0; $i<10; $i++) 
{
	$progbar->step();
	sleep(1);
}
$progbar->full();
$progbar->text("Done");
?>
</BODY>
</HTML>