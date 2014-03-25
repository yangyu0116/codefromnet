<?php
/*
 *名称:vcode.php
 *作用:生成验证码
 *说明:
 *时间:2004-11-01
 *更新:2006-6-21
 */
require_once '../config.ini.php';
$Vcode = new Vcode;
header("Content-type:image/png");
$image = $Vcode->createImage();
$var = ($_GET['var'] <> '') ? $_GET['var'] : 'vCode';
$_SESSION[$var] = $Vcode->Code;
Imagepng($image);
Imagedestroy($image);
?>