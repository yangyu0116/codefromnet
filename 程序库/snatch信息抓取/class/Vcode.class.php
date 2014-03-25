<?php
/*
 *名称:Vcode.class.php
 *作用:图形码验证的类（显示图形，保存验证码到$_SESSION['vCode']）
 *说明:
 *作者:KuaiYigang@xingmo.com
 *时间:2004-11-09
 *更新:2006-6-21
 */
session_start();
class Vcode
{

    var $x;
    var $y;
    var $numChars;
    var $Code;
    var $Width;
    var $Height;
    var $BG;
    var $colTxt;
    var $colBorder;
    var $numCirculos;

    function __construct()
    {
        $this->x = $x;
        $this->y = $y = "3";
        $this->numChars = $numChars = "4";
        $this->Code = $Code;
        $this->Width = $Width = "68";
        $this->Height = $Height = "20";
        $this->BG = $BG = "255,255,255";
        $this->colTxt = $colTxt = "0,0 0";
        $this->Border = $colBorder = "100,100,100";
        $this->numCirculos = $numCirculos = "800";
    }

    //Create base Image
    function createImage()
    {

        //Create a image
        $im = imagecreate ($this->Width, $this->Height) or die ("Cannot Initialize new GD image stream");
		//print_r($im);
        //Get the RGB color code
        $colorBG = explode(",", $this->BG);

        $colorBorder = explode(",", $this->Border);

        $colorTxt = explode(",", $this->colTxt);

        //put the background color on the image
        $imBG = imagecolorallocate ($im, $colorBG[0], $colorBG[1], $colorBG[2]);

        //put the border on the image
        $Border = ImageColorAllocate($im, $colorBorder[0], $colorBorder[1], $colorBorder[2]);
        $imBorder = ImageRectangle($im, 0, 0, $this->Width-1,$this->Height-1, $Border);

        //put the code color on the image
        $imTxt = imagecolorallocate ($im, $colorTxt[0], $colorTxt[1], $colorTxt[2]);

        //Drop 800 points
        for($i = 0; $i < $this->numCirculos; $i++)
        {
            $imPoints = imagesetpixel($im, mt_rand(0,$this->Width), mt_rand(0,$this->Height * 5), $Border);
        }

        //put the Code on image
		$str = $this->random(4, 1);
        for($i = 0; $i < strlen($str); $i++)
        {
            //get $x's location
            $this->x = 15 * $i + 5;

            //get the code
            //$this->Code.= (mt_rand(0,9));
			$this->Code.= $str[$i];

            $putCode = substr($this->Code, $i, "1");

            //put the code;
            $SetCode = imagestring($im, 5, $this->x, $this->y, $putCode,$imTxt);

        }
        return $im;

    }

	public function random($length, $numeric = 0) {
	mt_srand((double)microtime() * 1000000);
	if($numeric) {
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	} else {
		$hash = '';
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		//$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
	}

}

?>
