<?php
/*
 *名称:Editor.class.php
 *作用:初始化图文编辑器
 *说明:
 *开发:星模公司www.xingmo.com
 *时间:2005-3-23
 *更新:2007-8-9
 */
class Editor
{
	/*
	  *函数：show
	  *作用：显示图文编辑器
	  *输入：$FieldName（图文混排的字段）,$Value（图文混排的值）,ToolbarSet(Default,Basic,Custom)
	  *输出：返回图文编辑器
	  **
	  ******************************************
	  *－－制作－－日期－－
	  *KuaiYigang@xingmo.com  2004-12-12 19:26
	  ******************************************
	  *－－修改－－日期－－目的－－
	  *
	  */
	function show($FieldName, $Value, $ToolbarSet='Default', $Width= '100%', $Height='400')
	{
		global $INC;

		$a = strpos(dirname(__FILE__), 'class');
		$b = strlen($_SERVER['DOCUMENT_ROOT'])+1;
		if($a > $b)
		{
			$c = '/'.substr(dirname(__FILE__), $b, $a-$b-1).'/';
		}
		else
		{
			$c = '/';
		}

		require_once $INC.'/FCKeditor/fckeditor.php';
		$oFCKeditor = new FCKeditor($FieldName, $ToolbarSet) ;
		$oFCKeditor->BasePath = $c.'inc/FCKeditor/';
		$oFCKeditor->Value = $Value;
		$oFCKeditor->Width = $Width;
		$oFCKeditor->Height = $Height;
		$oFCKeditor->ToolbarSet = $ToolbarSet;//Default,Basic
		$str = $oFCKeditor->Create() ;
		return $str;
	}
}
?>