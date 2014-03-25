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


// database abstraction class
class cDatabase {
    var $db_host;
    var $db_username;
    var $db_password;
    var $default_db;
    var $sql_error_number;
    var $sql_error_name;
    var $db_type;
    var $link_id;
    var $debug;

    function cDatabase() // constructor
    {
        global $db_host, $db_username, $db_password, $default_db, $db_type, $db_use_pconnect;
        $this->db_host = DB_HOST;
        $this->db_username = DB_USERNAME;
        $this->db_password = DB_PASSWORD;
        $this->default_db = DEFAULT_DB;
        $this->db_type = DB_TYPE;
        $this->debug = FALSE;

        if ($db_use_pconnect) {
        	$this->pconnect($this->default_db);
        } else {
        	$this->connect($this->default_db);
        }

        if (($this->db_type != 'mysql') && ($this->db_type != 'postgres') && ($this->db_type != 'msql')) {
        	die("Invalid database type in config.inc.php");
        }

    }

    function affected_rows($result)
    {

        switch ($this->db_type) {
            case 'mysql':
                return mysql_affected_rows($this->result);
        	    break;
            case 'msql':
                return msql_affected_rows($this->result);
	            break;
	        default:
                echo 'cDatabase::affected_rows is not supported by ' . $this->db_type . '.';
    	        break;
        }

    }

    // msql does not have an auto_insert type like MySQL so we have to use a little trick
    // to get the appropriate value.

    function auto_insert($table_name = '')
    {

        switch ($this->db_type) {
            case 'mysql':
                $value = 'NULL';
	            break;
            case 'msql':
                $value = $this->query("SELECT _seq FROM $table_name");
	            break;
            case 'postgres':
                $value = '';
	            break;
        }

        if ($this->debug) echo "auto_insert is $value<br />";
        return $value;
    }

    function connect($db_name)
    {

        switch ($this->db_type) {
            case 'mysql':
                $this->link_id = mysql_connect($this->db_host, $this->db_username, $this->db_password) or $this->sql_error();
                mysql_select_db($db_name, $this->link_id) or $this->sql_error();
                if ($this->debug) echo 'Connected successfully to MySQL<br />';
                return 0;
	            break;
            case 'postgres':
                $this->link_id = pg_connect("dbname=$this->default_dbname user=$this->db_username password=$this->db_password")
                or $this->sql_error();
                if ($this->debug) echo 'Connected successfully to PostgreSQL<br />';
                return 0;
	            break;
            case 'msql':
                // you may have to fiddle with this line depending on how mSQL is set up on your server.
                $this->link_id = msql_connect() or $this->sql_error();
                msql_select_db($db_name) or $this->sql_error();
                return 0;
	            break;
        }

    }

    function insert_id()
    {

        switch ($this->db_type) {
            case 'mysql':
                $insert_id = mysql_insert_id($this->link_id);
	            break;
            case 'postgres':
	            break;
            case 'default':
                echo 'cDatabase::insert_id is not supported by ' . $this->db_type . '.';
	            break;
        }

        if ($this->debug) echo "Insert ID is: $insert_id<br />";
        return $insert_id;
    }

    function fetch_array($result, $row = '0')
    {

        switch ($this->db_type) {
            case 'mysql':
                return @mysql_fetch_array($result);
	            break;
            case 'postgres':
                return @pg_fetch_array($result, $row);
	            break;
            case 'msql':
                return @msql_fetch_array($result);
	            break;
        }

    }

    function fetch_object($result, $row = '0')
    {

        switch ($this->db_type) {
        	case 'mysql':
            	return @mysql_fetch_object($result);
                break;
            case 'postgres':
            	return @pg_fetch_object($result, $row);
                break;
            case 'msql':
            	return @msql_fetch_object($result);
                break;
        }

    }

    function fetch_row($result, $row = '')
    {

        switch ($this->db_type) {
            case 'mysql':
                return mysql_fetch_row($result);
	            break;
            case 'postgres':
                return pg_fetch_row($result, $row);
	            break;
            case 'msql':
                return msql_fetch_row($result);
	            break;
        }

    }

    function format_date()
    {

        switch ($this->db_type) {
            case 'mysql':
                return date('Y-m-d H:i:s');    // 2001-12-06 18:00:00
	            break;
            case 'postgres':
                return date('Y/m/d H:i:s T');  // 2001/12/06 18:00:00 PDT
	            break;
            case 'msql':
                return date('Y/m/d H:i:s T');
	            break;
        }

    }

    function num_rows($result)
    {

        switch ($this->db_type) {
            case 'mysql':
                $numrows = mysql_num_rows($result);
	            break;
            case 'postgres':
                $numrows = pg_numrows($result);
	            break;
            case 'msql':
                $numrows = msql_num_rows($result);
	            break;
	    }

        if ($this->debug) echo "num_rows is: $numrows<br />";
        return $numrows;
    }

    function pconnect($db_name)
    {

        switch ($this->db_type) {
            case 'mysql':
                $this->link_id = mysql_pconnect($this->db_host, $this->db_username, $this->db_password);
                if (!$this->link_id) $this->sql_error();            // database connection failed
                if (!mysql_select_db($db_name)) $this->sql_error(); // unable to select database
                return 0;
	            break;
            case 'postgres':
                $this->link_id = pg_pconnect("dbname=$this->default_dbname, user=$this->db_username, password=$this->db_password");
                if (!$this->link_id) $this->sql_error();            // database connection failed
	            break;
            case 'msql':
                $this->link_id = msql_pconnect($this->db_host, $this->db_username, $this->db_password);
                if (!$this->link_id) $this->sql_error();
                if (!msql_select_db($db_name, $this->link_id)) $this->sql_error();
                return 0;
	            break;
        }

    }

    function query($sql_query)
    {
        if ($this->debug) echo "SQL Query: $sql_query<br /><br />";

        switch ($this->db_type) {
            case 'mysql':
                $result = @mysql_query("$sql_query", $this->link_id);
	            break;
            case 'postgres':
                $result = @pg_exec($this->link_id, "$sql_query");
	            break;
            case 'msql':
                $result = @msql_query("$sql_query", $this->link_id);
	            break;
        }

        if (!($result)) $this->sql_error($sql_query);
        return $result;
    }

    function sql_error($query = FALSE)
    {
        global $admin_email;

        switch ($this->db_type) {
            case 'mysql':
                $this->sql_error_number = mysql_errno($this->link_id);
                $this->sql_error_name = mysql_error($this->link_id);
	            break;
            case 'postgres':
                $this->sql_error_name = pg_errormessage($this->link_id);
	            break;
            case 'msql':
                $this->sql_error_name = msql_error();
	            break;
        }

        echo "<br />There was an SQL error.  The error message is: <br /><b>$this->sql_error_name</b>" .
             "<br />Please notify the <a href=\"mailto:$admin_email\">site administrator</a>.<br />";
             if ($query) echo "The SQL Query that failed is: <b>$query</b>";
    }

}
?>
