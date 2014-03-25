<?php
require_once('./inc/h.inc.php');

//echo "<?xml version=\"1.0\" encoding=\"GB2312\"?>\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">

<!-- begin header.inc.php -->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh_CN" lang="zh_CN">
<head>
 <title><?php echo  "新闻蚂蚁书签同步服务" ?></title>
  <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Cache-Control" content="no-cache" />
  <meta http-equiv="Content-Type" content="text/html" />
  <meta name="author" content="Com. Inc" />

  <style type="text/css">
   body {background-color: <?php echo BG; ?>;
         color: <?php echo TEXT; ?>;
         font-family: Arial, Verdana, Helvetica, Sans-Serif;
         font-size: 10pt; }

   A:link    {text-decoration: underline;
              color: <?php echo LINK; ?>; }
   A:visited {text-decoration: underline;
              color: <?php echo VLINK; ?>; }
   A:active  {text-decoration: underline;
              color: <?php echo ALINK; ?>; }
   A:hover   {text-decoration: underline;
              color: #FF0000}

   td, pre {font-family: Arial, Verdana, Helvetica, Sans-Serif;
            font-size: 10pt; }

   input, textarea, select, option
              {font-family: Verdana, Helvetica, Sans-Serif;
               font-size: 10pt; }

   input.timer {font-family: Verdana, Helvetica, Sans-Serif;
   				font-size: 12pt;
                font-weight: bold;
                border: 1px;
                border-style:  solid;
                border-color:  <?php echo FORM_BACKGROUND; ?>;
                background-color: <?php echo FORM_BACKGROUND; ?>; }

  .small     {font-family: Tahoma, Arial, Helvetica, Sans-Serif;
              font-size: 10pt; }

  .report   {font-family: Verdana, Arial, Helvetica, Sans-Serif;
              font-size: 8pt; }

  .report_list {color: #ff0000;
              font-weight: bold; }

  .smallbold {font-family: Tahoma, Arial, Helvetica, Sans-Serif;
              font-size: 8pt;
              color: #ff0000;
              font-weight: bold; }

  .normal {font-family: Arial, Helvetica, Sans-Sefif; }

  .form {font-family: Verdana, Helvetica, Sans-Serif;
         background-color: <?php echo FORM_BACKGROUND; ?>;
		 font-size: 12pt;
         border-width: 2px;
         border-style: <?php echo FORM_BORDER_STYLE; ?>;
         border-color: <?php echo FORM_BORDER_COLOR; ?>;
		 padding: 10px; }

  .help {font-family: Verdana, Helvetica, Sans-Serif;
         background-color: <?php echo HELP_BACKGROUND; ?>;
         color: <?php echo HELP_TEXT; ?>;
         font-size: 12pt;
         border-width: 1px;
         border-style: <?php echo HELP_BORDER_STYLE; ?>;
         border-color: <?php echo HELP_BORDER_COLOR; ?>;
		 padding: 10px; }

  .menu {font-family: Arial, Helvetica, Sans-Serif;
         background-color: <?php echo MENU_BACKGROUND; ?>;
		 font-size: 12pt;
         border-width: 1px;
         border-style: solid;
         border-color: <?php echo MENU_BORDER_COLOR; ?>;
		 padding: 12px; }

  .feedback  {color: #ff0000;
              font-weight: bold; }

  .header {font-family: Verdana, Helvetica, Sans-Serif;
		   font-size: 12pt;
           font-weight: bold;
           text-align: center; }
 </style>
</head>

<body <?php echo $onload; ?>>
 <table width="100%">
  <tr>
   <td><center><h1>新闻蚂蚁书签同步服务</h1></center></td>
  </tr>
  <tr>
   <!-- right page -->
   <td width="75%" align="center" valign="top">
<!-- end header.inc.php -->
