<?php
/** * Smarty plugin 
* @package Smarty 
* @subpackage plugins 
*/
/** * Smarty plugin 
* 
* Type:    modifier<br> 
* Name:    substring<br> 
* Date:    Dec 10, 2004 
* Purpose: substring 
* 
* @version 1.0 
* @author  Bo Wang 
* @param   string 
* @param   integer 
* @param   integer 
* @return  string 
*/

/*
function smarty_modifier_substring($string, $from, $length = null)
{    
	preg_match_all('/[\x80-\xff]?./', $string, $match);
	if(is_null($length))    
	{        
		$result = implode('', array_slice($match[0], $from));
	}
	else
	{       
		$result = implode('', array_slice($match[0], $from, $length));
	}    
	return $result;
}
*/

/*
function smarty_modifier_substring($string, $from, $length = null)
{    
	preg_match_all('/[\x80-\xff]?./', $string, $match);
	if(is_null($length))    
	{        
		$result = implode('', array_slice($match[0], $from));
	}
	else
	{     
		if(count($match[0]) > $length)
		{
			$result = implode('', array_slice($match[0], $from, $length-3));
			$result .= '...';
		}
		else
		{
			$result = implode('', array_slice($match[0], $from, $length));
		}
	}    
	return $result;
}
*/

function smarty_modifier_substring($string, $from, $length = null, $etc = '')
{    
	preg_match_all('/[\x80-\xff]?./', $string, $match);
	if(is_null($length))    
	{        
		$result = implode('', array_slice($match[0], $from));
	}
	else
	{     
		if((count($match[0]) > ($length+$from)) && $etc <> '')
		{
			$result = implode('', array_slice($match[0], $from, $length-3));
			$result .= $etc;
		}
		else
		{
			$result = implode('', array_slice($match[0], $from, $length));
		}
	}    
	return $result;
}

/*
function smarty_modifier_substring($string, $from, $length = null)
{    
	preg_match_all('/[\x80-\xff]?./', $string, $match);
	if(is_null($length))    
	{        
		$result = implode('', array_slice($match[0], $from));
	}
	else
	{     
		if(count($match[0]) > $length)
		{
			$result = implode('', array_slice($match[0], $from, $length-3));
			$result .= '...';
		}
		else
		{
			$result = implode('', array_slice($match[0], $from, $length));
		}
	}    
	return $result;
}
*/
?>
