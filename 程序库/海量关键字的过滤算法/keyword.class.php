<?php
/**
 +------------------------------------------------------------------------------
 * �ؼ����滻��
 +------------------------------------------------------------------------------
 * @���ߣ�		qimeng <songlv@163.com>
 * @��Ȩ������	����ֻ��PHP������ѧϰ�о����Ͻ�������ҵ��;���������߽�����׷���������ε�Ȩ��
 * @ʹ�÷�����
 *
 *			$badwordfile	= 'badword.src.php';//�ؼ������������ļ���
 *			$cachefile	= 'badword.aim.php'; //������Ŀ���ļ���
 *			$keyword= new keyword($badwordfile,$cachefile);
 *			$myword=$keyword->replace($str,1);
 *
 +------------------------------------------------------------------------------
 */

class keyword{

	var $cachefile=''; //�����ļ���
	var $rword='';//�����Ĺؼ�������

	/**
     +----------------------------------------------------------
     * ���캯��
     +----------------------------------------------------------
     * @access	public
	 * @para	badwordfile		string		�ؼ������������ļ���
	 * @para	cachefile		string		������Ŀ���ļ���
     +----------------------------------------------------------
     */
	function keyword($badwordfile,$cachefile='./cache/badword.aim.php'){
		$this->$cachefile=$cachefile;
		//������ڱ�����ļ� ֱ�Ӱ���
		if (file_exists($this->$cachefile)){
			include($cachefile);
			$this->rword  = $_badwordcache;


		}else{//���� ��������
			include($badwordfile);
			$this->rword	=	$this->format_word($badword);
			echo count($badword);
		}
	}


	/**
     +----------------------------------------------------------
     * ���˹ؼ���
     +----------------------------------------------------------
     * @access	public
	 * @para	article		string		��������
	 * @para	type		bool		$type=1 ��� $type=2 ���� *
	 * @return	type		string		���������滻���
     +----------------------------------------------------------
     */
	function replace($article,$type=1){
		$len=strlen($article);
		$begin=$end=array();
		for($i=0;$i<$len;$i++){
			if($n=$this->find_keyword($article,$this->rword,$i)){

				$begin[]=$i;
				$end[]=$i+$n;
				//����*
				if($type==2){
					for($n;$n>0;$n--){
						$article{$i}='*';
						$i++;
					}
				}
				$i=$i+$n;
			}
		}
		//���
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
     * �ݹ����ָ��λ���Ƿ��йؼ���
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
     * ���ؼ�������ת���ɷ��ϸ�ʽ������
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
     * ָ��λ�ò����ַ�
     +----------------------------------------------------------
     * @access	public
     +----------------------------------------------------------
     */

	function insertstr($str,$pos,$instr){
		return	substr($str,0,$pos).$instr.substr($str,$pos,strlen($str));
	}


}