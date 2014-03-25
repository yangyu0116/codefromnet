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

require_once('./inc/h.inc.php');

//Given a username and password, return that users privs.
//If password does not match, or no user is found
//returns 0. Users with no privs will also
//return 0.
function check_user($usrname, $passwd) {
  $result=db_query("select user_level from users where username='$usrname' AND 
		user_password=password('$passwd')");
  if ($myrow=mysql_fetch_array($result)) {
    return $myrow[0]; 
  }
  else {
    return 0;
  }
}

//Does the username exist?
function user_exists($username) {
  $result=db_query("select user_id from users where username='$username'");
  if ($myrow=mysql_fetch_array($result)) {
    return TRUE;
  }
  else {
    return FALSE;
  }                 
}

//Return the privs for specified username
function get_user_privs($username) {
  $result=db_query("SELECT user_level from users where username='$username'");
  if ($p=mysql_fetch_array($result)) {
    return $p[0];
  }
  else {
    return 0;
  }
}

//add user into database
function add_user($username, $password, $name, $email) {
    db_query("INSERT INTO users (username, user_desc, user_password, user_email, user_level) VALUES 
    ('$username', '$name', password('$password'), '$email', '1')");
}

//Change Password
function change_passwd($username, $oldpass, $newpass, $newpassconfirm) { 
$result=db_query("UPDATE users SET user_password=password('$newpass') WHERE 
 username='$username' AND user_password=password('$oldpass')");
return mysql_affected_rows(); 
}
//Random password generator.
function random_passwd() {
  mt_srand((double) microtime() * 1000000);
  return substr(crypt(mt_rand(1,1000000)),1,8);
}

//mail password to user
function mail_passwd($username, $newpass) {
   $userinfo=mysql_fetch_array(db_query("SELECT user_email, user_desc from users 
   where username='$username'")); 
   $message=$userinfo[1].",\n\n";
   $message.="This is your new account information...\n";
   $message.="user: $username \n";
   $message.="pass: $newpass \n";
   //mail($userinfo[0], "ÄúµÄÕÊºÅ", $message, "From:$WEBMASTER\r\n");
}
//format Timestamp
function format_date($timestamp) {
  $Y=substr($timestamp,0,4);
  $M=substr($timestamp,4,2);
  $D=substr($timestamp,6,2);
  $H=substr($timestamp,8,2);
  $I=substr($timestamp,10,2);
  $S=substr($timestamp,12,2);   
  $stamp=mktime($H,$I,$S,$M,$D,$Y);
  return date("F d, Y", $stamp)." at ".date("g:i a T", $stamp);
}

// makes sure the user is an admin.  If the user isn't an admin, the ip and username
// of the person accessing the page is logged to the security log
function admin_access_check()
{
    global $user, $db, $PHP_SELF, $HTTP_SERVER_VARS;
    global $strings;

    if ($user->access_level != ACCESS_ADMIN) {
        // record page and date into security log
        $date = $db->format_date();
        $my_user_id = ($user->user_id) ? "$user->user_id" : "0";
        $ip = getenv('REMOTE_ADDR');
        $page = $PHP_SELF . '?' . $HTTP_SERVER_VARS['QUERY_STRING'];
        $db->query("INSERT INTO security (user_id, username, ip, event, date) VALUES ($my_user_id, '$user->username', '$ip', 'ÊÔÍ¼·ÃÎÊ$page', '$date')");
        // tell them no...
        quit($strings['ERROR_ADMIN']);
    }

}

function user_access_check($id)
{
    global $user, $db, $PHP_SELF, $HTTP_SERVER_VARS;
    global $strings;

	if(empty($id))
		$id=0;

    if (($user->access_level != ACCESS_ADMIN) && ($user->user_id != $id)) {
        // record page and date into security log
        $date = $db->format_date();
        $my_user_id = ($user->user_id) ? "$user->user_id" : "0";
        $ip = getenv('REMOTE_ADDR');
        $row = $db->fetch_object($db->query("SELECT username FROM users WHERE user_id = $id"));
        $page = $row->username . "µÄ" . $PHP_SELF . '?' . $HTTP_SERVER_VARS['QUERY_STRING'];
        $db->query("INSERT INTO security (user_id, username, ip, event, date) VALUES ($my_user_id, '$user->username', '$ip', 'ÊÔÍ¼·ÃÎÊÊôÓÚ$page', '$date')");
        // tell them no...
        quit($strings['ERROR_ADMIN']);
    }
}

function ip_access_check($id)
{
    global $user, $db, $PHP_SELF, $HTTP_SERVER_VARS;
    global $strings;

	if(empty($id))
		$id=0;

	$row = $db->fetch_object($db->query("SELECT ipownerid FROM ipmap WHERE ip_id = $id"));

    if (($user->access_level != ACCESS_ADMIN) && ($user->user_id != $row->ipownerid)) {
        // record page and date into security log
        $date = $db->format_date();
        $my_user_id = ($user->user_id) ? "$user->user_id" : "0";
        $ip = getenv('REMOTE_ADDR');
        $row = $db->fetch_object($db->query("SELECT username FROM users WHERE user_id = $id"));
		if(empty($row->username))
        	$page = "Î´·ÖÅäµÄ" . $PHP_SELF . '?' . $HTTP_SERVER_VARS['QUERY_STRING'];
		else
        	$page = $row->username . "µÄ" . $PHP_SELF . '?' . $HTTP_SERVER_VARS['QUERY_STRING'];
        $db->query("INSERT INTO security (user_id, username, ip, event, date) VALUES ($my_user_id, '$user->username', '$ip', 'ÊÔÍ¼·ÃÎÊÊôÓÚ$page', '$date')");
        // tell them no...
        quit($strings['ERROR_ADMIN']);
    }
}


// log security log
function log_security($log_user, $log_message)
{
    global $user, $db;
    global $strings;

    // record page and date into security log
    $date = $db->format_date();
    $my_user_id = ($user->user_id) ? "$user->user_id" : "0";
    $ip = getenv('REMOTE_ADDR');
	$db->query("INSERT INTO security (user_id, username, ip, event, date) VALUES ($my_user_id, '$log_user', '$ip', '$log_message','$date')");
}

// makes sure the user is logged in.  If not, the script exits.
function logged_in_check()
{
    global $user, $strings;
    if (!$user->IS_LOGGED_IN) quit($strings[ERROR_LOGGED_IN]);
}

// html <a href> wrapper
function make_href($url, $text, $title = '')
{
	$link = "<a href=\"$url\"";
    if ($title) $link .= " title=\"$title\"";
    $link .= ">$text</a>";
    return $link;
}

// http redirect wrapper
function redirect($url)
{
    header('Location: ' . ABSOLUTE_PATH . $url);
    exit;
}


// alternates returning table_light and table_dark
function table_highlight($counter)
{
    if (($counter % 2) == 0) return TABLE_LIGHT;
    else return TABLE_DARK;
}

// make sure the header and footer are included when we exit
function quit($error_message)
{
	global $strings;
	require_once('./inc/header.inc.php');
    echo "<div class=\"form\">\n";
    echo "<span class=\"error\"><b>$error_message</b></span>\n";
    echo "</div>\n";
    require_once('./inc/footer.inc.php');
	exit;
}

// verfies passed email address is in the format *@*.*
function verify_email($email)
{

    if (ereg("^[^@ ]+@[^@ ]+\.[^@ ]+$", $email)) {
        return TRUE;
    } else {
        return FALSE;
    }

}

// self explanatory I hope
function am_pm($hour)
{   
    return ($hour < 12) ? 'am' : 'pm';
}

// converts dates between different formats.
// It expects a date that strototime() understands. 
function convert_date($date, $format = DATE_FORMAT)
{   
    // $date_format is defined in config.inc.php.
    if (empty($date)) return;

    switch ($format) {
        case 'us12':
            return date('m/d/y g:i a', strtotime($date));
            break;
        case 'us24':
			return date('m/d/y H:i', strtotime($date));
            break;
        case 'eu12':
            return date('d/m/y g:i a', strtotime($date));
            break;
        case 'eu24':
            return date('d/m/y H:i', strtotime($date)); 
            break;
        case 'verbose':
            return date('D M jS, Y @ g:ia', strtotime($date));
            break;
        case 'mysql':
            return date('Y-m-d H:i:s', strtotime($date));
            break;
        case 'mysql_hours':
            return date('H:i a', strtotime($date));
            break;
        default:
            // none specified, just return us12.
            return date('m/d/y h:i a', strtotime($date));
    }

}
// returns an array with a list of all ip
function get_all_ip()
{   
    global $db,$strings;
    $count = 0;
    $result = $db->query('SELECT ip_id,ipaddr FROM ipmap ORDER BY ipaddr ASC');

    while (@extract($db->fetch_array($result), EXTR_PREFIX_ALL, 'db')) {
       	$iplist[$db_ip_id] = $db_ipaddr;
		$count ++;
    }

	$iplist[-1] = $strings[IPMAP_NOTASSIGNED];
    
    return $iplist;
}
// returns an array with a list of all users
function get_all_users($not_include_admin = 0)
{   
    global $db,$strings;
    $count = 0;
    $result = $db->query('SELECT user_id,username FROM users ORDER BY username ASC');

    while (@extract($db->fetch_array($result), EXTR_PREFIX_ALL, 'db')) {
		if(($not_include_admin == 0) || ($db_username != "admin")) {
        	$users[$db_user_id] = $db_username;
			$count ++;
		}
    }

	$users[-1] = $strings[IPMAP_NOTASSIGNED];
    return $users;
}
/*
function str_split($str, $len=1)
{
  if ($len < 1) return false;
  $tmp_str = array();
  for ($offset = 0; $offset < strlen($str); $offset += $len)
  {
   $tmp_str[] = substr($str, $offset, $len);
  }
  return $tmp_str;
}
*/
// test for ip addresses between 1.0.0.0 and 255.255.255.255
function testIP($a, $allowzero=FALSE) {
    $t = explode(".", $a);
    
    if (sizeof($t) != 4)
       return 1;
    
    for ($i = 0; $i < 4; $i++) {
        // first octet may not be 0
        if ($t[0] == 0 && $allowzero == FALSE)
           return 1;
        if ($t[$i] < 0 or $t[$i] > 255)
           return 1;
        if (!is_numeric($t[$i]))
           return 1;
    };
    return 0;
}

// convert ip to long
function myip2long($a) {
    $inet = 0.0;
    $t = explode(".", $a);
    for ($i = 0; $i < 4; $i++) {
        $inet *= 256.0;
        $inet += $t[$i];
    };
    return $inet;
}

// convert revert ip to long
function myip2long_r($a) {
    $inet = 0.0;
    $t = explode(".", $a);
    for ($i = 3; $i >= 0; $i --) {
        $inet *= 256.0;
        $inet += $t[$i];
    };
    return $inet;
}


// convert long to ip
function mylong2ip($n) {
    $t=array(0,0,0,0);
    $msk = 16777216.0;
    $n += 0.0;
    if ($n < 1)
        return('&nbsp;');
    for ($i = 0; $i < 4; $i++) {
        $k = (int) ($n / $msk);
        $n -= $msk * $k;
        $t[$i]= $k;
        $msk /=256.0;
    };
    $a=join('.', $t);
    return($a);
}

// convert long to ip
function mylong2ip_r($n) {
    $t=array(0,0,0,0);
    $msk = 16777216.0;
    $n += 0.0;
    if ($n < 1)
        return('&nbsp;');
    for ($i = 0; $i < 4; $i++) {
        $k = (int) ($n / $msk);
        $n -= $msk * $k;
        $t[$i]= $k;
        $msk /=256.0;
    };
    //$a=join('.', $t);
    $a = $t[3] . "." . $t[2] . "." . $t[1] . "." . $t[0];
    return($a);
}

function xml_return($ret) {
	global $smerr;
	echo "<newsants>\n";
	echo "<ret>" . $smerr[$ret] . "</ret>\n";
	echo "</newsants>\n";
	exit();
}




?>
