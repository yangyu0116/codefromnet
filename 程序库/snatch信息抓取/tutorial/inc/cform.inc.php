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

// cForm class for outputting html forms

class cForm {
    var $_action;
    var $_method;
    var $_name;
    var $_form_string;
	var $_javascript;

    function cForm()
    {
        global $PHP_SELF;
        // set some defaults
        $this->set_action($PHP_SELF);
        $this->set_method('post');
		$this->_form_string[] = ' ';
		$this->_javascript[] = ' ';
    }

    function add_text($text, $breaks)
    {
        $string = $text;

        for ($i = 0; $i < $breaks; $i++) {
            $string .= '<br />';
        }

        $this->_form_string[] = $string;
    }

    function add_feedback($text, $breaks) {                                    -        $string = "<span class=\"feedback\">" . addslashes($text) . "</span>\n";

        for ($i = 0; $i < $breaks; $i++) {
            $string .= '<br />';
        }

        $this->_form_string[] = $string;
   }

   function add_javascript($js)
    {
        $this->_javascript[] = $js;
    }

    function checkbox($name, $value, $breaks, $checked = '')
    {
        $string = "<input type=\"checkbox\" name=\"$name\"";
        if ($checked) $string .= " checked=\"checked\"";
        $string .= " value=\"$value\" />\n";

        for ($i = 0; $i < $breaks; $i++) {
            $string .= '<br />';
        }

        $this->_form_string[] = $string;
    }

    function draw($enctype = '', $submit_func = '')
    {
        global $PHP_SELF, $strings;

        if (!$this->_action) {
            $this->set_action($PHP_SELF);
        }

        echo "<div class=\"form\">\n";
        echo "<form method=\"$this->_method\" action=\"$this->_action\"";

        if ($this->_name) {
            echo " name=\"$this->_name\"";
        }

        if (isset($enctype)) {
            echo " enctype=\"$enctype\"";
        }

        echo ">\n";

        foreach ($this->_form_string as $form_string) {
            echo $form_string;
        }

		foreach ($this->_javascript as $javascript) {
			echo $javascript;
		}

        echo "<input type=\"submit\" name=\"submit\" value=\"$strings[BUTTON_SUBMIT]\" $submit_func />\n";
        echo "</form>\n";
        echo "</div><br /><br />\n";
    }

    function file($name, $max_size, $breaks)
    {
        $string = "<input type=\"file\" name=\"$name\"";
        $string .= " />\n";
		$string .= "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$max_size\">\n";

        for ($i = 0; $i < $breaks; $i++) {
            $string .= '<br />';
        }

        $this->_form_string[] = $string;
    }

    function hidden($name, $value)
    {
        $string = "<input type=\"hidden\" name=\"$name\" value=\"$value\" />\n";
        $this->_form_string[] = $string;
    }

    function input($name, $breaks, $value = '', $maxlength = '', $addon = '')
    {
        $string = "<input type=\"text\" name=\"$name\"";

        if (isset($value)) {
            $string .= " value = \"$value\"";
        }

        if (isset($maxlength)) {
            $string .= " maxlength=\"$maxlength\"";
        }

        if (isset($addon)) {
            $string .= " $addon ";
        }
        $string .= " />\n";

        for ($i = 0; $i < $breaks; $i++) {
            $string .= '<br />';
        }

        $this->_form_string[] = $string;
    }

    function password($name, $breaks, $value = '', $maxlength = '')
    {
        $string = "<input type=\"password\" name=\"$name\"";
        if ($value) $string .= " value = \"$value\"";
        if ($maxlength) $string .= " maxlength=\"$maxlength\"";
        $string .= " />\n";

        for ($i = 0; $i < $breaks; $i++) {
            $string .= '<br />';
        }

        $this->_form_string[] = $string;
    }

    function select($name, $values, $breaks, $selected = '')
    {
        $string .= "<select name=\"$name\">\n";

        foreach($values as $value) {
            $string .= '   <option';
            if ($selected == $value) $string .= " selected=\"selected\"";
            $string .= ">$value</option>\n";
        }

        $string .= "</select>\n";

        for ($i = 0; $i < $breaks; $i++) {
            $string .= '<br />';
        }

        $this->_form_string[] = $string;
    }

    function adv_select($name, $values, $breaks, $selected = '', $jsfunc = '')
    {
        $string .= "<select name=\"$name\" $jsfunc >\n";

        foreach($values as $value => $desc) {
            $string .= '   <option';
            if ($selected == $value) $string .= " selected=\"selected\"";
            $string .= " value = \"$value\"> $desc\n";
        }

        $string .= "</select>\n";

        for ($i = 0; $i < $breaks; $i++) {
            $string .= '<br />';
        }

        $this->_form_string[] = $string;
    }

    function add_extra($string)
    {
        $this->_form_string[] = $string;
    }

    function set_action($action)
    {
        $this->_action = $action;
    }

    function set_method($method)
    {
        $this->_method = $method;
    }

    function set_name($name)
    {
        $this->_name = $name;
    }

    function textarea($name, $breaks, $value = '', $rows = 10, $cols = 60)
    {
        $string = "<textarea name=\"$name\" rows=\"$rows\" cols=\"$cols\">";
        $string .= $value;
        $string .= "</textarea>\n";

        for ($i = 0; $i < $breaks; $i++) {
            $string .= '<br />';
        }

        $this->_form_string[] = $string;
    }

}
?>
