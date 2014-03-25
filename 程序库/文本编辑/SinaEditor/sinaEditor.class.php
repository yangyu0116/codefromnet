<?php
/**
 * Title:新浪博客编辑器PHP版封装类
 * coder:gently
 * Date:2007年11月9日
 * Power by ZendStudio.Net
 * http://www.zendstudio.net/
 * 您可以任意使用和传播，但请保留本段信息！
 *
 */
class sinaEditor{
	var $BasePath;
	var $Width;
	var $Height;
	var $eName;
	var $Value;
	var $AutoSave;
	function sinaEditor($eName){
		$this->eName=$eName;
		$this->BasePath='.';
		$this->AutoSave=false;
		$this->Height=460;
		$this->Width=630;
	}
	function __construct($eName){
		$this->sinaEditor($eName);
	}
	function create(){
		$ReadCookie=$this->AutoSave?1:0;
		print <<<eot
		<textarea name="{$this->eName}" id="{$this->eName}" style="display:none;">{$this->Value}</textarea>
		<iframe src="{$this->BasePath}/Edit/editor.htm?id={$this->eName}&ReadCookie={$ReadCookie}" frameBorder="0" marginHeight="0" marginWidth="0" scrolling="No" width="{$this->Width}" height="{$this->Height}"></iframe>
eot;
	}
}