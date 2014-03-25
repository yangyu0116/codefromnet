<?php
/**
 +------------------------------------------------------------------------------
 * 关键词替换类
 +------------------------------------------------------------------------------
 * @作者：		qimeng <songlv@163.com>
 * @版权声明：	本类只供PHP爱好者学习研究，严禁用于商业用途，否则作者将保留追究法律责任的权利
 * @使用方法：
 *
 *			$badwordfile	= 'badword.src.php';//关键词数组所在文件名
 *			$cachefile	= 'badword.aim.php'; //编译后的目标文件名
 *			$keyword= new keyword($badwordfile,$cachefile);
 *			$myword=$keyword->replace($str,1);
 *
 +------------------------------------------------------------------------------
 */

class keyword{

	var $cachefile=''; //编译文件名
	var $rword='';//编译后的关键词数组

	/**
     +----------------------------------------------------------
     * 构造函数
     +----------------------------------------------------------
     * @access	public
	 * @para	badwordfile		string		关键词数组所在文件名
	 * @para	cachefile		string		编译后的目标文件名
     +----------------------------------------------------------
     */
	function keyword($badwordfile,$cachefile='./cache/badword.aim.php'){
		$this->$cachefile=$cachefile;
		//如果存在编译的文件 直接包含
		if (file_exists($this->$cachefile)){
			include($cachefile);
			$this->rword  = $_badwordcache;


		}else{//否则 重新生成
			include($badwordfile);
			$this->rword	=	$this->format_word($badword);
			echo count($badword);
		}
	}


	/**
     +----------------------------------------------------------
     * 过滤关键字
     +----------------------------------------------------------
     * @access	public
	 * @para	article		string		文章内容
	 * @para	type		bool		$type=1 标红 $type=2 换成 *
	 * @return	type		string		文章内容替换结果
     +----------------------------------------------------------
     */
	function replace($article,$type=1){
		$len=strlen($article);
		$begin=$end=array();
		for($i=0;$i<$len;$i++){
			if($n=$this->find_keyword($article,$this->rword,$i)){

				$begin[]=$i;
				$end[]=$i+$n;
				//换成*
				if($type==2){
					for($n;$n>0;$n--){
						$article{$i}='*';
						$i++;
					}
				}
				$i=$i+$n;
			}
		}
		//标红
		if($type==1){
			$len=count($begin);
			for($k=$len;$k>=0;$k--){
				if($end[$k])$article=$this->insertstr($article,$end[$k],'</font>');
				if($begin[$k])$article=$this->insertstr($article,$begin[$k],'<font color=red>');
			}
		}
		return	$article;
	}

	/**
     +----------------------------------------------------------
     * 递归查找指定位置是否有关键词
     +----------------------------------------------------------
     * @access	public
     +----------------------------------------------------------
     */
	function find_keyword($article,$rword,$i,$pos=1) {
		if($pos>20)Return false;
		if($rword['key'][$article{$i}]['val']==1)Return $pos;
		if(empty($rword['key'][$article{$i}]['key']))Return false;
		$pos++;
		$rword=$rword['key'][$article{$i}];
		return	$this->find_keyword($article,$rword,$i+1,$pos);

	}


	/**
     +----------------------------------------------------------
     * 将关键词数组转换成符合格式的数组
     +----------------------------------------------------------
     * @access	public
     +----------------------------------------------------------
     */
	function format_word($badword){
		$word=array();
		foreach($badword as $k=>$v){
			$temp='$word';
			$len=strlen($v);
			for($i=0;$i<$len;$i++){
				$temp.="['key']['".$v{$i}."']";
			}
			eval($temp.="['val']=1;");

		}
		if($this->cachefile){
			$fh = fopen($this->cachefile, 'wb') or die("Error!!");
			fwrite($fh, "<?php\r\n\$_badwordcache=".var_export($word,1).";");

		}
		return	$word;
	}


	/**
     +----------------------------------------------------------
     * 指定位置插入字符
     +----------------------------------------------------------
     * @access	public
     +----------------------------------------------------------
     */

	function insertstr($str,$pos,$instr){
		return	substr($str,0,$pos).$instr.substr($str,$pos,strlen($str));
	}


}