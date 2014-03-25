<?php
// gets parameters
if(isset($_GET['path'])) {
   define(EML_FILE_PATH,$_GET['path']);
} else {
   define(EML_FILE_PATH,'./eml/');
}
$filename = $_GET['filename'] ? $_GET['filename'] : '';
if ($filename == '') $filename = '1.eml'; 
$eml_file = EML_FILE_PATH.$filename;

if (!($content = fread(fopen(EML_FILE_PATH.$filename, 'rb'), filesize(EML_FILE_PATH.$filename))))
    die('File not found ('.EML_FILE_PATH.$filename.')');


$content = str_replace("\r", "", $content);
$seperator = "------=_";
$content = explode($seperator, $content);

$items = array();
$keyid = 0;
foreach($content as $item) {
  if(substr($item, 0, 9) == "NextPart_") {
      $title = substr($item, 0, strpos($item, "\n"));
  } elseif (substr($item, 0, 18) == "    [Content-Type]") {
      $title = substr($item, 0, strpos($item, ""));
  } else {
      $title="Headers";
  }
  $item = substr($item, strpos($item, "\n")+1);

  if(substr(trim($item), 0, 4) == "id <") {$item = substr($item, strpos($item, "\n")+1);}

  $header = substr($item, 0, strpos($item, "\n\n"));
  $body = substr($item, strpos($item, "\n\n")+2);
  $headerlines = explode("\n", $header);
  foreach($headerlines as $line) {
    if(substr($line, 0, 1) == "\t") {
	  $headers[$linetitle] .= "\n".$line;
	} else {
	  $linetitle = substr($line, 0, strpos($line, ":"));
	  $headers[$linetitle] = substr($line, strpos($line, ":")+1);
	}
  }
  $ct_end = strpos($headers['Content-Type'], ";") ? strpos($headers['Content-Type'], ";") : strlen($headers['Content-Type']);
  $contenttype = trim(substr($headers['Content-Type'], 0, $ct_end));
  if($contenttype == "text/plain") {
    $keyname = "text";
  } else {
    $keyname = $keyid;
  }
  $items[$keyname] = array("partname" => $title, "headers" => $headers, "content-type" => $contenttype, "body" => $body);
  if(isset($plaintext) && $plaintext === true) {
    $items[0] = array("partname" => "Headers", "headers" => $headers, "content-type" => $contenttype, "body" => $body);
  }
  unset($headers);
  $keyid++;
}

foreach($items as $key=>$part) {
	
  if($part['content-type'] != "" && (
	 $part['content-type'] == 'image/gif' ||
	 $part['content-type'] == 'image/jpeg')) {
		 
		 $attachments_name = EML_FILE_PATH.'img/'.str_replace('"','',getValue($part['headers']['Content-Disposition'],'filename=',''));
		 		 //！！！！！！！！！！！！！！！！debug！！！！！！！！！！！！！！！！！！！！！！！！！！
		 echo '<pre>';
		 print_r ($part['body']);
		 echo '</pre>';
		 exit();
		 //！！！！！！！！！！！！！！！！debug！！！！！！！！！！！！！！！！！！！！！！！！！！

		 $part['body'] = trim(base64_decode(str_replace(chr(0),'',$part['body'])));

		 file_put_contents($attachments_name, $part['body']);

		 //writeover($attachments_name,base64_decode($part['body']));
	}
}
die('yangyu');  //！！！！！！debug！！！！！！
  



function getValue($str, $left, $right){
	$len1 = strlen($left);
	$pos1 = strpos($str, $left);
	if($pos1 === false) return;
	if ($right == '') {
		$s = substr($str, $pos1+strlen($left));
	} else{
		$pos2 = strpos($str, $right, $pos1+strlen($left));
		if ($pos2 === false){
			return false;
		}
		$s = substr($str, $pos1+strlen($left), $pos2-($pos1+strlen($left)));
	}	
	return $s;
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