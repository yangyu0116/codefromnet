<?php
class base
{
	function get_ip()
	{
		global $_SERVER;
		if ( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ))
		{
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		elseif ( isset( $_SERVER["HTTP_CLIENT_IP"] ))
		{
			$realip = $_SERVER["HTTP_CLIENT_IP"];
		}
		else
		{
			$realip = $_SERVER["REMOTE_ADDR"];
		}
		return $realip;
	}

	function add_str( $str )
	{
		return addslashes( trim( $str ));
	}

	// +--------------------------------
	// |	字符串截取函数
	// +--------------------------------
	function substrs( $content, $length = '30' )
	{
		if ( $length && strlen( $content ) > $length )
		{
			$num = 0;
			for ( $i = 0; $i < $length - 3; $i++ )
			{
				if ( ord( $content[$i] ) > 127 )
				{
					$num++;
				}
			}
			$num % 2 == 1 ? $content = substr( $content, 0, $length - 4 ): $content =substr( $content, 0, $length - 3 );
		}
		return $content;
	}
	// +--------------------------------
	// |	创建无限目录
	// +--------------------------------
	function createdir( $dir )
	{
		if (  ! is_dir( $dir ))
		{
			$temp = explode( '/', $dir );
			$cur_dir = '';
			for ( $i = 0; $i < count( $temp ); $i++ )
			{
				$cur_dir .= $temp[$i].'/';
				if (  ! is_dir( $cur_dir ))
				{
					@mkdir( $cur_dir, 0777 );
				}
			}
		}
	}

	function deletedir( $file)
	{
		if (is_dir($file))
		{
			$handle = @opendir($file);
			while (false !== ($filename = @readdir($handle)))
			{
				if ($filename != "." && $filename != "..")
					base::deletedir($file . "/" . $filename);
			}
			@closedir($handle);
			@rmdir($file);
			return true;
		}
		else
		{
			@unlink($file);
		}
	}

	// +--------------------------------
	// |	取得指定长度的随机字符串
	// +--------------------------------
	function random( $length )
	{
		$chars ='0123456789ABCDEFGHIJ0123456789KLMNOPQRSTJ0123456789UVWXYZ0123456789abcdefghijJ0123456789klmnopqrstJ0123456789uvwxyz0123456789';
		$max = strlen( $chars );
		mt_srand(( double )microtime() * 1000000 );
		for ( $i = 0; $i < $length; $i++ )
		{
			$hash .= $chars[mt_rand( 0, $max )];
		}
		return $hash;
	}

	// +--------------------------------
	// |	cookie设置函数
	// +--------------------------------
	function phpsetcookie( $name, $value, $permanent = '' )
	{
		global $_SERVER, $SET;
		$path   = $SET['cookie_path'];
		$domain = $SET['cookie_domain'];
		if ( $permanent )
		{
			$expire = time() + $permanent;
		}
		else
		{
			$expire = time() + $SET['cookie_expire'] * 3600;
		}
		if ( $_SERVER['SERVER_PORT'] == '443' )
		{
			$secure = 1;
		}
		// 如果用SSL加密访问
		else
		{
			$secure = 0;
		}
		setcookie( $name, $value, $expire, $path, $domain, $secure );
	}

	// +--------------------------------
	// |	删除所有的HTML
	// +--------------------------------
	function ClearHtml( $html )
	{
		return trim( preg_replace( "/[><]/", "", $html ));
	}

	// +----------------------------------------
	// |	考虑php4的json_encode
	// +----------------------------------------
	function jsonencode( $data )
	{
		if ( function_exists( json_encode ))
		{
			return json_encode( $data );
		}
		else
		{
			global $json;
			if (  ! isset( $json ))
			{
				require_once( R_P.'/include/class.json.php' );
				$json = new Services_JSON();
			}
			return $json->encode( $data );
		}
	}

	// +--------------------------------
	// |	写入数据流（支持创建目录）
	// +--------------------------------
	function writetofile( $file_name, $data, $method = "w" )
	{
		$tempall = explode( '/', $file_name );
		for ( $i = 0; $i < count( $tempall ) - 1; $i++ )
		{
			$temp .= $tempall[$i]."/";
		}
		if ( substr( $temp, strlen( $temp ) - 1, strlen( $temp )) == '/' )
		{
			$temp = substr( $temp, 0, strlen( $temp ) - 1 );
		}
		if (  ! is_dir( $temp ))
		{
			base::createdir( $temp );
		}
		if ( $filenum = fopen( $file_name, $method ))
		{
			flock( $filenum, LOCK_EX );
			$file_data = fwrite( $filenum, $data );
			fclose( $filenum );
			return $file_data;
		}
		else
		{
			return false;
		}
	}

	// +--------------------------------
	// |	读取文件
	// +--------------------------------
	function readfromfile( $file_name ) // Read file
	{
		$filenum = fopen( $file_name, 'r' );
		if ( $filenum !== false )
		{
			flock( $filenum, LOCK_SH );
			$file_data = filesize( $file_name ) ? fread( $filenum, filesize( $file_name )): '';
			fclose( $filenum );
			return $file_data;
		}
		else
		{
			return false;
		}
	}

	// +----------------------------------------
	// |   把变量序列化到本地
	// +----------------------------------------
	function makeArrayCache( $cacheFile, &$myArray )
	{
		$string = serialize( $myArray );
		base::writetofile( $cacheFile, $string );
	}

	function bg()
	{
		static $bgcolor;
		$bgcolor = $bgcolor == 'showlist1' ? 'showlist2' : 'showlist1';
		return $bgcolor;
	}

	// +----------------------------------------
	// |   读取缓存文件
	// +----------------------------------------
	function getCacheFile( $cacheFile )
	{
		return function_exists( 'file_get_contents' ) ? unserialize(file_get_contents( $cacheFile )): unserialize( readfromfile( $cacheFile));
	}

	// +----------------------------------------
	// |    检测URL变量中是否存在非法字符
	// +----------------------------------------
	function checkAction($action)
	{
		if (is_array($action))
		{
			foreach($action as $val)
			{
				base::checkAction($val);
			}
		}
		else
		{
			if( !ereg("([0-9a-zA-Z_]+)", $action) && strlen($action) > 0)
			{
				base::purviewCheckDie("提交了非法参数");
			}
		}
	}

	// +----------------------------------------
	// |    错误输出/自动定向
	// +----------------------------------------
	function showmsg($show_message, $url_forward = '' , $wait = 1)
	{
		global $_SERVER;
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
		{
			ob_clean();
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Content-Type: text/html; charset=utf-8");
			echo charset::gb2utf8($show_message);
		}
		else
		{
			if ($url_forward == '')
			{
				$msg  = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
				$msg .= "<html><head><meta http-equiv=\"Content-Type\" content=text/html; charset=gb2312>";
				$msg .= "<script language='javascript'>window.alert('" . $show_message . "');history.go(-1);</script>";
				echo $msg;
			}
			else
			{
				include base::template('showmsg', 0, 1);
			}
		}
		exit();
	}

	function purviewCheckDie( $message='', $wait = 0)
	{
		global $_SERVER;
		$message || $message = "您没有权限进行此次操作";
		if ( $_SERVER[HTTP_REFERER]!="" && basename($_SERVER[HTTP_REFERER],"php")!="index.php?action=left")
		{
			base::showmsg("$message", "$_SERVER[HTTP_REFERER]", $wait);
		}
		else
		{
			base::showmsg("$message");
		}
	}

	function getLang( $key)
	{
		return isset($GLOBALS['lang'][$key]) ? $GLOBALS['lang'][$key] : $key;
	}

	function getGroup( $groupid)
	{
		static $usergroup = array();
		if( count( $usergroup) == 0)
		{
			@include( R_P."/cache/usergroup/usergroup.php");
		}
		return $usergroup[$groupid];
	}

	function language($languagepack)
	{
		global $lang;
		$languagepack = R_P."/lang/{$languagepack}_".$GLOBALS['SET']['lang'].".php";
		if ( file_exists($languagepack))
		{
			require $languagepack;
		}
	}

	function template( $file, $skin = 'task' , $tar_dir = 0)
	{
		if ( $tar_dir == 1 )
		{
			$tplfile = R_P.'/templates/'.$file.'.php';
			$objfile = C_P.'/templates/'.$file.'.tpl.php';
		}
		else
		{
			$tplfile = R_P.'/templates/'.$skin.'/'.$file.'.php';
			$objfile = C_P.'/templates/'.$skin.'/'.$file.'.tpl.php';
		}
		if ( !$skin) unset($skin);
		if (  ! is_dir( C_P.'/templates/'.$skin))
		{
			base::createdir( C_P.'/templates/'.$skin);
		}

		if ( ! file_exists( $tplfile ))
		{
			die( "怎么就找不到{$tplfile}这个文件呢" );
		}
		if ( @filemtime( $tplfile ) > @filemtime( $objfile ))
		{
			base::parse_template( $file, $skin, $tar_dir );
		}
		return $objfile;
	}

	function parse_template( $file, $skin, $tar_dir )
	{
		if ( $tar_dir == 1 )
		{
			$tplfile = R_P.'/templates/'.$file.'.php';
			$objfile = C_P.'/templates/'.$file.'.tpl.php';
		}
		else
		{
			$tplfile = R_P.'/templates/'.$skin.'/'.$file.'.php';
			$objfile = C_P.'/templates/'.$skin.'/'.$file.'.tpl.php';
		}
		if (  ! @$fp = fopen( $tplfile, 'r' ))
		{
			die( "template file({$tplfile}) not found or have no access!" );
		}
		$template = fread( $fp, filesize( $tplfile ));
		fclose( $fp );
		$var_regexp = "((\\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)(\[[a-zA-Z0-9_\-\.\"\'\[\]\$\x7f-\xff]+\])*)";
		$const_regexp = "([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)";
		$template = str_replace( "<?php die(); ?>", "", $template);
		$template = preg_replace( "/([\n\r]+)\t+/s", "\\1", $template );
		$template = preg_replace( "/\{lang\s+(.+?)\}/ies", "base::languagevar('\\1')",$template );
		$template = str_replace( "{LF}", "<?=\"\\n\"?>", $template);	

		$template = preg_replace("/\{(\\\$[a-zA-Z0-9_\[\]\'\"\$\.\x7f-\xff]+)\}/s", "<?=\\1?>", $template);
		$template = preg_replace("/$var_regexp/es", "base::addquote('<?=\\1?>')", $template);
		$template = preg_replace("/\<\?\=\<\?\=$var_regexp\?\>\?\>/es", "base::addquote('<?=\\1?>')", $template);	

		$template = preg_replace("/[\n\r\t]*\<\!\-\-\{template\s+([a-z0-9_]+)\}\-\-\>[\n\r\t]*/is", "<? include base::template('\\1'); ?>", $template);
		$template = preg_replace("/[\n\r\t]*\<\!\-\-\{template\s+(.+?)\}\-\-\>[\n\r\t]*/is", "<? include base::template(\\1); ?>", $template);
		$template = preg_replace("/[\n\r\t]*\<\!\-\-\{eval\s+(.+?)\}\-\-\>[\n\r\t]*/ies", "base::stripvtags('<? \\1 ?>','')", $template);
		$template = preg_replace("/[\n\r\t]*\{echo\s+(.+?)\}[\n\r\t]*/ies", "base::stripvtags('<? echo \\1; ?>','')", $template);
		$template = preg_replace("/[\n\r\t]*\{elseif\s+(.+?)\}[\n\r\t]*/ies", "base::stripvtags('<? } elseif(\\1) { ?>','')", $template);
		$template = preg_replace("/[\n\r\t]*\{else\}[\n\r\t]*/is", "<? } else { ?>", $template);

		for($i = 0; $i < 5; $i++)
		{
			$template = preg_replace("/[\n\r\t]*\{loop\s+(\S+)\s+(\S+)\}[\n\r]*(.+?)[\n\r]*\{\/loop\}[\n\r\t]*/ies", "base::stripvtags('<? if(is_array(\\1)) { foreach(\\1 as \\2) { ?>','\\3<? } } ?>')", $template);
			$template = preg_replace("/[\n\r\t]*\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}[\n\r\t]*(.+?)[\n\r\t]*\{\/loop\}[\n\r\t]*/ies", "base::stripvtags('<? if(is_array(\\1)) { foreach(\\1 as \\2 => \\3) { ?>','\\4\n<? } } ?>')", $template);
			$template = preg_replace("/[\n\r\t]*\{if\s+(.+?)\}[\n\r]*(.+?)[\n\r]*\{\/if\}[\n\r\t]*/ies", "base::stripvtags('<? if(\\1) { ?>','\\2<? } ?>')", $template);
		}	

		$template = preg_replace("/\{$const_regexp\}/s", "<?=\\1?>", $template);
		$template = preg_replace("/ \?\>[\n\r]*\<\? /s", " ", $template);

		if (!@$fp = fopen($objfile, 'w'))
		{
			die("no file {$objfile} access!");
		}

		flock($fp, 2);
		fwrite($fp, $template);
		fclose($fp);
	}

	function addquote($var)
	{
		return str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var));
	}

	function languagevar($var)
	{
		if (isset($GLOBALS[lang][$var]))
		{
			return $GLOBALS[lang][$var];
		}
		else
		{
			return "!$var!";
		}
	}

	function stripvtags($expr, $statement)
	{	 
		$expr = str_replace("\\\"", "\"", preg_replace("/\<\?\=(\\\$.+?)\?\>/s", "\\1", $expr));
		$statement = str_replace("\\\"", "\"", $statement);
		return $expr . $statement;
	}

	// +--------------------------------
	// |    前台会员取得cookie
	// +--------------------------------
	function getCookie()
	{
		global $user_info, $SET;
		$auth = trim($_COOKIE['php_auth']);
		parse_str( base::passport_decrypt( $auth, $SET['passport_key']), $user_info);
	}

	function passport_decrypt($txt, $key)
	{
		$txt = base::passport_key(base64_decode($txt), $key);
		$tmp = '';
		for($i = 0;$i < strlen($txt); $i++)
		{
			$md5 = $txt[$i];
			$tmp .= $txt[++$i] ^ $md5;
		}
		return $tmp;
	}

	function passport_key($txt, $encrypt_key) 
	{
		$encrypt_key = md5($encrypt_key);
		$ctr = 0;
		$tmp = '';
		for($i = 0; $i < strlen($txt); $i++) 
		{
			$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
			$tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
		}
		return $tmp;
	}

	function formatDate( $format, $dateline)
	{
		return date( $format, $dateline + $GLOBALS['SET']['unixtime']*3600);
	}
}
?>
