<?php


class cUser
{
    var $IS_LOGGED_IN;
    var $userid;
    var $username;
    var $email;
    var $error_message;
    var $debug;

    // min and max lengths for username and password defined in config.inc.php
    var $min_password_length;
    var $max_password_length;
    var $min_username_length;
    var $max_username_length;

    function cUser()
    {
        $this->IS_LOGGED_IN = FALSE;
        $this->debug = FALSE;
        $this->min_password_length = 5;
        $this->max_password_length = 13;
        $this->min_username_length = 4;
        $this->max_username_length = 13;
    }

    function authenticate($username, $password)
    {
        global $db;

        if ($this->verify_password($username, $password)) {
            $row = $db->fetch_object($db->query("SELECT * FROM na_user WHERE username = '$username'"));
            $this->userid      = $row->userid;
            $this->username     = $row->username;
	    $this->title	= $row->usertitle;
	    $this->joindate	= $row->joindate;
	    $this->email		= $row->email;
	    $this->IS_LOGGED_IN = TRUE;
            return TRUE;
        } else {
        	return FALSE;
        }

    }

    function fetch_user_salt($length = 3)
    {
	    $salt = '';
	    for ($i = 0; $i < $length; $i++)
	    {
		    $salt .= chr(rand(32, 126));
	    }
	    return $salt;
    }

    function change_password($username, $old_password, $password1, $password2)
    {
    	global $strings, $db;

        if ($this->verify_password($username, $old_password)) {

            if ($password1 != $password2) {
                $this->error($strings['ERROR_PASSWORDS']);
                return FALSE;
            }

            if ((strlen($password1) < $this->min_password_length) || (strlen($password1) > $this->max_password_length)) {
                $this->error($strings['ERROR_PASSWORD_TOO_SHORT']);
                return FALSE;
            }
	   $salt = $this->fetch_user_salt();
	   $hashedpassword = md5(md5($password1) . $salt);	
		
           $query = "UPDATE na_user SET password = '$hashedpassword', salt = '$salt'  WHERE username = '$username'";
            $db->query($query);
            return TRUE;
        } else {
            return FALSE;
        }

    }

    function error($message)
    {
        $this->error_message = $message;
        return TRUE;
    }

    function logout()
    {
        $this->IS_LOGGED_IN = FALSE;
        $this->username     = '';
        $this->title  = '';
        $this->joindate  = '';
        $this->email        = '';
        return TRUE;
    }
    
    function mail_request($email) 
    {
        global $db;
        $result = $db->query("SELECT userid FROM na_user WHERE email = '$email'");
        if (!$db->num_rows($result)) {
            return FALSE;
        } else {
	    list($userid) = $db->fetch_array($result);
	    $db->query("DELETE FROM na_useractivation WHERE userid = $userid AND type = 1 ");
            $activateid = mt_rand(0,100000000);
	    $db->query(" INSERT INTO na_useractivation (userid, dateline, activationid, type, usergroupid) VALUES($userid, '" . time() . "', '$activateid' , 1, 2) ");
	    $subject = "[新闻蚂蚁]您在新闻蚂蚁的注册资料";
            $message = "您好,\n\n

给您发送此邮件是因为您忘记了在 新闻蚂蚁用户论坛 的账号密码, 并要求重新设置。
如果您没有发出这个请求, 就请忽略它。本信息在24小时后将自动失效。\n\n
重新设置密码, 请点击下面的链接:\n
http://syncmark.newsants.com/lost_password.php?a=pwd&u=$userid&i=$activateid\n\n
当您访问这个页面的时候, 您的密码将被重新设置, 新密码会通过邮件提供给您。\n
您的用户名是: $username
	";
            $header = "From: 新闻蚂蚁技术支持<support@newsants.com>\r\n";

            if (!mail($email, $subject, $message, $header)) {
                return FALSE;
            } else {
		return FALSE;
	    } 
		
	}
    }
	
    // mails lost password to user
    function mail_password($username, $email)
    {
        global $db;
        $result = $db->query("SELECT email FROM na_user WHERE username = '$username' AND email = '$email'");

        if (!$db->num_rows($result)) {
            $this->error("The username or email address is incorrect.");
            return FALSE;
        } else {
            $password = $this->make_password();
            list($email) = $db->fetch_array($result);
            $subject = "[新闻蚂蚁]您的新密码";
            $message = "您的密码被系统重置为:\n" .
                       "用户名: $username \n 密码: $password";
            $header = "From: 新闻蚂蚁技术支持<support@newsants.com>\r\n";

            if (!mail($email, $subject, $message, $header)) {
                $this->error("Failed to send email.");
                return FALSE;
            } else {
		$salt = $this->fetch_user_salt();
	   	$hashedpassword = md5(md5($password) . $salt);	
                $query = "UPDATE na_user SET password = '$hashedpassword',salt = '$salt' WHERE username = '$username' AND email = '$email'";
                $db->query($query);
		return TRUE;
            }
        }
    }

    // makes a random password
    function make_password($length = 7)
    {
        // thanks to benjones@superutility.net for this code
        mt_srand((double) microtime() * 1000000);

        for ($i=0; $i < $length; $i++) {
            $which = rand(1, 3);
            // character will be a digit 2-9
            if ( $which == 1 ) $password .= mt_rand(0,10);
            // character will be a lowercase letter
            elseif ( $which == 2 ) $password .= chr(mt_rand(65, 90));
            // character will be an uppercase letter
            elseif ( $which == 3 ) $password .= chr(mt_rand(97, 122));
        }

        return $password;
    }

    // registers a new user
    function register($username, $password1, $password2, $email, $ip)
    {
    	global $strings;
        global $db;
        if ($this->debug) echo "Username: $username";

        if ((strlen($username) < $this->min_username_length) || (strlen($username) > $this->max_username_length)) {
            $this->error($strings['ERROR_USERNAME_TOO_SHORT']);
            return FALSE;
        }

        if ($password1 != $password2) {
            $this->error($strings['ERROR_PASSWORDS']);
            return FALSE;
        }

        if ((strlen($password1) < $this->min_password_length) || (strlen($password1) > $this->max_password_length)) {
            $this->error($strings['ERROR_PASSWORD_TOO_SHORT']);
            return FALSE;
        }

        $result = $db->query("SELECT * FROM na_user WHERE username = '$username'");

        if ($db->num_rows($result)) {
            $this->error($strings['ERROR_USERNAME_TAKEN']);
            return FALSE;
        }

        $result = $db->query("SELECT * FROM na_user WHERE email = '$email'");

        if ($db->num_rows($result)) {
            $this->error($strings['ERROR_EMAIL_TAKEN']);
            return FALSE;
        }

	$salt = $this->fetch_user_salt();
        $hashedpassword = md5(md5($password1) . $salt);
	$now = time();

        $query = "INSERT INTO na_user (username, salt, password, passworddate, email, parentemail, showvbcode, usertitle, joindate, daysprune, lastvisit, lastactivity, usergroupid, timezoneoffset, options, maxposts, threadedmode, startofweek, ipaddress, pmpopup, referrerid, reputationlevelid, reputation, autosubscribe, birthday, birthday_search) VALUES ('$username', '$salt', '$hashedpassword', NOW(), '$email', '', 1, '初级会员', $now , 0, $now, $now, 3, '8', 3143, -1, 0, 1, '$ip', 0, 0, 5, 10, -1, '', '') ";
        $db->query($query);
        return TRUE;
    }

    // updates user account info
    function update($userid, $username, $email)
    {
    	global $strings;
        global $db;
        if ($this->debug) echo "Username: $username";

        if ((strlen($username) < $this->min_username_length) || (strlen($username) > $this->max_username_length)) {
            $this->error($strings['ERROR_USERNAME_TOO_SHORT']);
            return FALSE;
        }

        $result = $db->query("UPDATE na_user SET username  = '$username', email = '$email' WHERE userid = $userid");
        return TRUE;
    }

    function verify_password($username, $password)
    {
    	global $strings;
        global $db;
        $result = $db->query("SELECT password,salt FROM na_user WHERE username = '$username'");

        if (!$db->num_rows($result)) {
            $this->error($strings['ERROR_PASSWORD_INCORRECT']);
            return FALSE;
        }

	$row = $db->fetch_object($result);	
        $hashedpassword = md5(md5($password) . $row->salt);        

       	$query = "SELECT * FROM na_user WHERE username = '$username' AND password = '$hashedpassword'";
        $result = $db->query($query);

        if ($db->num_rows($result)) {
            return TRUE;
        } else {
            $this->error($strings['ERROR_PASSWORD_INCORRECT']);
            return FALSE;
        }

    }

}
