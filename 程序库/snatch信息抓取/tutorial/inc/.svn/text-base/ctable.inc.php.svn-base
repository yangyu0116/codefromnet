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



// cTable class for outputting html tables

class cTable {
	var $_border_color;
    var $_bg_color;
    var $_cellpadding;
    var $_cellspacing;
    var $_center;
    var $_colspan;
    var $_header_color;
    var $_header_text;
    var $_table_string;
    var $_td_bg_color;

	function cTable()
    {
        // set some defaults as defined in config.inc.php
        $this->set_bg_color(TABLE_BORDER);
        $this->set_header_color(TABLE_HEADER);
        $this->set_cellspacing(1);
        $this->set_cellpadding(5);
        $this->set_width('100%');
	    $this->set_center(0);
    }

    // whether or not to center text in each <td>
    // 0 for not centered, 1 for centered
    function set_center($center)
    {
    	$this->_center = $center;
    }

    function draw()
    {
    	echo "<table bgcolor=\"$this->_bg_color\" width=\"$this->_width\" cellspacing=\"$this->_cellspacing\" cellpadding=\"$this->_cellpadding\">";

        if ($this->_header_text) {
        	echo "<tr>\n";
            echo " <td class=\"header\" bgcolor=\"$this->_header_color\" colspan=\"$this->_colspan\"><center>$this->_header_text</center></td>\n";
            echo "</tr>\n";
        }

        foreach ($this->_table_string as $table_string) {
        	echo $table_string;
        }

        echo "</table><br /><br />\n";
    }

    function set_border_color($color)
    {
    	$this->_border_color = $color;
    }

    function set_bg_color($color)
    {
    	$this->_bg_color = $color;
    }

    function set_colspan($colspan)
    {
    	$this->_colspan = $colspan;
    }

    function set_header_color($color)
    {
    	$this->_header_color = $color;
    }

    function set_cellpadding($cellpadding)
    {
    	$this->_cellpadding = $cellpadding;
    }

    function set_cellspacing($cellspacing)
    {
    	$this->_cellspacing = $cellspacing;
    }

    function set_width($width)
    {
    	$this->_width = $width;
    }

    function set_header_text($header_text)
    {
    	$this->_header_text = $header_text;
    }

    function set_td_bg_color($color)
    {
    	$this->_td_bg_color = $color;
    }

    function tr_start()
    {
    	$this->_table_string[] = "<tr>\n";
    }

    function tr_end()
    {
    	$this->_table_string[] = "</tr>\n";
    }

    function td($data, $colspan = '', $color = '', $css_class = 'small', $width = '', $valign = 'top')
    {
    	if ($colspan) $append = " colspan=\"$colspan\"";
        $append .= $color ? " bgcolor=\"$color\"" : " bgcolor=\"$this->_td_bg_color\"";
        if ($width) $append .= " width=\"$width\"";
        if ($valign) $append .= " valign=\"$valign\"";
        $string = "<td$append><span class=\"$css_class\">";
        if ($this->_center) $string .= '<center>';
        $string .= $data;
        if ($this->_center) $string .= '</center>';
        $string .= "</span></td>\n";
    	$this->_table_string[] = $string;
    }

    function th($data, $colspan = '', $color = '', $css_class = 'small', $width = '', $valign = 'top')
    {
    	if ($colspan) $append = " colspan=\"$colspan\"";
        if ($width) $append .= " width=\"$width\"";
        if ($valign) $append .= " valign=\"$valign\"";
        $string = "<th $append bgcolor=\"$this->_header_color\"><span class=\"$css_class\">";
        if ($this->_center) $string .= '<center>';
        $string .= $data;
        if ($this->_center) $string .= '</center>';
        $string .= "</span></th>\n";
    	$this->_table_string[] = $string;
    }
}
?>
