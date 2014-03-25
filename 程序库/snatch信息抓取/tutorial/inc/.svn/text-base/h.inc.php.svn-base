<?php
/* 
 *  Copyright 2001-2002 by Com System Inc., all rights reserved.
 *
 *  These coded instructions, statements, and computer programs are the
 *  property of Com System Inc. and are protected by copyright laws.  
 *  Copying, modification, distribution and use without Com System 
 *  Inc.'s permission are prohibited. 
 *
 */

    require_once('./inc/config.inc.php');      // configuration vars
    require_once('./inc/ctable.inc.php');      // table class
    require_once('./inc/cform.inc.php');       // form class
    require_once('./inc/cdatabase.inc.php');   // database class
    require_once('./inc/cuser.inc.php');       // user class
    require_once('./inc/functions.inc.php');   // misc. functions

    $db = new cDatabase;
    $base = basename($PHP_SELF);

    if(count($_POST) > 0) {
	    foreach($_POST as $key => $val) {
		    $$key=mysql_escape_string($val);
	    }
    }
    if(count($_GET) > 0) {
	foreach($_GET as $key => $val) {
		$$key=mysql_escape_string($val);
	}
    }
    if(count($_SESSION) > 0) {
	foreach($_SESSION as $key => $val) {
		$$key=mysql_escape_string($val);
	}
    }
    //    session_start();                             // start session variable tracking

?>
