<?php
mysql_connect('localhost','root','root');
mysql_select_db('test');

$sql = "select * from `cdb_overseasips` order by `start_ip_long` asc ";
$query = mysql_query($sql);
while ($rt = mysql_fetch_row($query)){
	$ipdataFile = 'ipdata/'.substr($rt[3],0,strpos($rt[3],'.')).'.txt';
	$fh = fopen($ipdataFile,'a+');
	fwrite($fh,implode("\t",$rt)."\r\n");
	fclose($fh);
}
echo 'input successfully by yangyu';

?>