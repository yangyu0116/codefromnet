<?php

/*************************************************
recognise - 通用验证码识别类 适用于字母数字类
Author: Songlv <songlv@163.com>
*************************************************/
class recognise{

	public $word_width		=	8;//字符宽度
	public $word_height		=	10;//字符高度
	public $offset_x		=	6;//水平偏移
	public $offset_y		=	3;//垂直偏移
	public $word_spacing	=	1;//字间距
	public $red				=	127;//红色阈值
	public $green			=	127;//绿色阈值
	public $blue			=	127;//蓝色阈值
	public $alpha			=	65;//透明度阈值

	public  $dataRec;				//保存当前验证码每位的二值数据
	private	$imageFile;				//验证码文件
	private $dataArray;
	private $imageSize;
	private $data;
	private $numStringArray;
	

	//验证码样例数据
	public $keys			=	array(
		'0'=>'00011000001111000110011011000011110000111100001111000011011001100011110000011000',
		'1'=>'10011000001110000111100000011010000110000001100000011000000110000001100001111110',
		'2'=>'00111100011001101100001100000011000001100000110000011000001100000110000011111111',
		'3'=>'01111100110001100000001100000110000111000000011000000011000000111100011001111100',
		'4'=>'00000110000011100001111000110110011001101100011011111111000001100000011000000110',
		'5'=>'11111110110000001100000011011100111001100000001100000011110000110110011000111100',
		'6'=>'00111100011001101100001011000000110111001110011011000011110000110110011000111100',
		'7'=>'11111111000000110000001100000110000011000001100000110010011000001100001011000000',
		'8'=>'00111100011001101100001101100110001111000110011011000011110000110110011000111100',
		'9'=>'00111100011001101100001111000011011001110011101100000011010000110110011000111100',
	);	
	
	public function setImage($Image){
		$this->imageFile = $Image;
	}

	//去除噪点，提取二值数据
	public function makeData(){
		$res = imagecreatefromstring(file_get_contents($this->imageFile));
		$this->imageSize = getimagesize($this->imageFile);
		$data = array();
		for($i=0; $i < $this->imageSize[1]; ++$i){
			for($j=0; $j < $this->imageSize[0]; ++$j){
				$rgb = imagecolorat($res,$j,$i);
				$rgbarray = imagecolorsforindex($res, $rgb);
				//print_r($rgbarray );
				if($rgbarray['red'] <=$this->red && $rgbarray['green']<=$this->green	&&  $rgbarray['blue'] <=$this->blue &&  $rgbarray['alpha']<$this->alpha){
					$data[$i][$j]=1;
				}else{
					$data[$i][$j]=0;
				}
			}
		}
		$this->dataArray = $data;
	}

	//根据样例数据进行相似度最佳匹配
	public function process(){
		$result="";
		// 查找4个数字
		$data = array("","","","");
		for($i=0;$i<4;++$i){
			$x = ($i*($this->word_width+$this->word_spacing))+$this->offset_x;
			$y = $this->offset_y;
			for($h = $y; $h < ($this->offset_y+$this->word_height); ++ $h){
				for($w = $x; $w < ($x+$this->word_width); ++$w){
					$data[$i].=$this->dataArray[$h][$w];
				}
			}
		}
		$this->dataRec	=	$data;
		foreach($data as $numKey => $numString){
			$max=0.0;
			$num = 0;
			foreach($this->keys as $key => $value){
				$percent=0.0;
				similar_text($value, $numString,$percent);
				if(intval($percent) > $max){
					$max = $percent;
					$num = $key;
					if(intval($percent) > 95)	break;
				}
			}
			$result.=$num;
		}
		$this->data = $result;
		return $result;
	}
	//显示二值图像，做为分析验证码RGB阈值时使用
	public function drawPic(){
		for($i=0; $i<$this->imageSize[1]; ++$i){
	        for($j=0; $j<$this->imageSize[0]; ++$j){
				if($this->dataArray[$i][$j]){
					echo	'■';
				}else{
					echo	'□';
				}
	        }
		    echo "\n<br>";
		}
	}

	

}
?>