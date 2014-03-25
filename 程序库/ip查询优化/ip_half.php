<?php
mysql_connect('localhost','root','root');
mysql_select_db('test');

$sql = "select * from `cdb_overseasips` order by `start_ip_long` asc ";
$query = mysql_query($sql);
while ($rt = mysql_fetch_row($query)){
	$array[] = $rt;
}

$writecache = "\$_IP = array (\r\n";
foreach ($array as $value) {
			$writecache .= N_var_export($value).",\r\n";
}
$writecache .= ");\r\n";
writeover('ipcache.php',"<?php\r\n$writecache?>");

echo 'input successfully by yangyu';


function N_var_export($input,$f = 1,$t = null) {
	$output = '';
	if (is_array($input)) {
		$output .= "array(\r\n";
		foreach ($input as $key => $value) {
			$output .= $t."\t".N_var_export($key,$f,$t."\t").' => '.N_var_export($value,$f,$t."\t");
			$output .= ",\r\n";
		}
		$output .= $t.')';
	} elseif (is_string($input)) {
		$output .= $f ? "'".str_replace(array("\\","'"),array("\\\\","\'"),$input)."'" : "'$input'";
	} elseif (is_int($input) || is_double($input)) {
		$output .= "'".(string)$input."'";
	} elseif (is_bool($input)) {
		$output .= $input ? 'true' : 'false';
	} else {
		$output .= 'NULL';
	}
	return $output;
}
function writeover($filename,$data,$method="rb+",$iflock=1,$check=1,$chmod=1){
	$check && strpos($filename,'..')!==false && exit('Forbidden');
	touch($filename);
	$handle = fopen($filename,$method);
	$iflock && flock($handle,LOCK_EX);
	fwrite($handle,$data);
	$method=="rb+" && ftruncate($handle,strlen($data));
	fclose($handle);
	$chmod && @chmod($filename,0777);
}
?>