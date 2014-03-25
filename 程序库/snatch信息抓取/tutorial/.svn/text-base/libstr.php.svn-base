<?php

//从字符串中获取子字符串，以第一个$start开始，以$start之后的第一个$end结束
function getValue($str, $start, $end) {
        $pos = strpos($str, $start);
        if($pos === false) return "";
        $a = $pos + strlen($start);
        $b = strpos($str, $end, $a);
        if($b === false) return "";
        return substr($str, $a, $b - $a);
}

//从字符串中获取前面的子字符串，以第一个$end结束
function getValueFront($str, $end) {
        $pos = strpos($str, $end);
        if($pos === false) return "";
        return substr($str, 0, $pos);
}

//从字符串中获取后面的的子字符串，以第一个$start开始
function getValueEnd($str, $start) {
        $pos = strpos($str, $start);
        if($pos === false) return "";
        return substr($str, $pos + strlen($start));
}

function charAt($str, $pos)
{
	return (substr($str, $pos, 1));
}

?>
