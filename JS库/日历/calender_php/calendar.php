<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh" dir="ltr">
<head>
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <title>日历</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
/* Calendar */
table.calendar {
    width:              100%;
}
table.calendar td {
    text-align:         center;
}
table.calendar td a {
    display:            block;
}

table.calendar td a:hover {
    background-color:   #CCFFCC;
}

table.calendar th {
    background-color:   #D3DCE3;
}

table.calendar td.selected {
    background-color:   #FFCC99;
}

img.calendar {
    border:             none;
}
form.clock {
    text-align:         center;
}
/* end Calendar */

</style>
<script type="text/javascript" language="javascript" src="tbl_change.js"></script>
<script type="text/javascript" language="javascript">
//<![CDATA[
var month_names = new Array("一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月");
var day_names = new Array("周日","周一","周二","周三","周四","周五","周六");
var submit_text = "执行";
//]]>
</script>
</head>
<body onLoad="initCalendar();">
<div id="calendar_data"></div>
<div id="clock_data"></div>
</body>
</html>