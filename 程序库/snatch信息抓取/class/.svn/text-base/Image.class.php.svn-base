<?php
/*
 *名称:Image.class.php
 *作用:公共处理类
 *说明:
 功  能：利用PHP的GD库生成高质量的缩略图
 运行环境:PHP5.01/GD2
 类说明：可以选择是/否裁图。
 如果裁图则生成的图的尺寸与您输入的一样。
 原则：尽可能多保持原图完整
 如果不裁图，则按照原图比例生成新图
 原则：根据比例以输入的长或者宽为基准
 参 数：$img:源图片地址
 $wid:新图的宽度
 $hei:新图的高度
 $c:是否裁图，1为是，0为否
 *开发:星模公司www.xingmo.com
 *时间:2005-4-23
 */
class Image
{
    //图片类型
    var $type;
    //实际宽度
    var $width;
    //实际高度
    var $height;
    //改变后的宽度
    var $resize_width;
    //改变后的高度
    var $resize_height;
    //是否裁图
    var $cut;
    //源图象
    var $srcimg;
    //目标图象地址
    var $dstimg;
    //临时创建的图象
    var $im;

    //$img:源图片,$dst_img:图片目标地址,$wid:剪裁到的宽度,$hei:剪裁到的高度,$c:是否截图(一般不用)
	function Resize($img, $dst_img, $wid, $hei,$c=0)
    {
        $this->srcimg = $img;

		$pic = @getimagesize($this->srcimg);
        $this->width = $pic[0];
        $this->height = $pic[1];

		/*
		if(($this->width  > $wid && $wid > 0) || ($this->height  > $hei && $hei > 0))
		{
			$this->resize_width = $wid;
			$this->resize_height = $hei;
		}
		else
		{
			$this->resize_width = $this->width;
			$this->resize_height = $this->height;
		}*/

		if($this->width <= $wid && $this->height <= $hei)
		{
			$this->resize_width = $this->width;
			$this->resize_height = $this->height;
		}
		else
		{
			if($hei > 0)
			{
				if(($this->width / $this->height) < ($wid/$hei))
				{
					$this->resize_width = round($this->width * $hei / $this->height);
					$this->resize_height = $hei;
				}
				if(($this->width / $this->height) == ($wid/$hei))
				{
					$this->resize_width = $wid;
					$this->resize_height = $hei;
				} 
				if(($this->width / $this->height) > ($wid/$hei))
				{
					if($wid > 0)
					{
						$this->resize_width = $wid;
						$this->resize_height = round($this->height * $wid / $this->width);
					}
					else
					{
						if($this->height < $hei)
						{
							$this->resize_width = $this->width;
							$this->resize_height = $this->height;
						}
						else
						{
							$this->resize_width = round($this->width * $hei / $this->height);
							$this->resize_height = $hei;
						}
					}
				}
			}
			else
			{
				if($this->width < $wid)
				{
					$this->resize_width = $this->width;
					$this->resize_height = $this->height;
				}
				else
				{
					$this->resize_width = $wid;
					$this->resize_height = round($this->height * $wid / $this->width);
				}
			}
		}
        
        $this->cut = $c;
        //图片的类型
        $this->type = strtolower(substr(strrchr($this->srcimg,"."),1));
        //初始化图象
        $this->initi_img();
        //目标图象地址
        //$this -> dst_img();
		$this->dstimg = $dst_img;
        //--
		
        //生成图象
        $this->newimg();
        ImageDestroy ($this->im);
    }
    function newimg()
    {
        //改变后的图象的比例
        $resize_ratio = ($this->resize_width)/($this->resize_height);
        //实际图象的比例
        $ratio = ($this->width)/($this->height);
        if(($this->cut)=="1")
        //裁图
        {
            if($ratio>=$resize_ratio)
            //高度优先
            {
                $newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width,$this->resize_height, (($this->height)*$resize_ratio), $this->height);
                ImageJpeg ($newimg,$this->dstimg);
            }
            if($ratio<$resize_ratio)
            //宽度优先
            {
                $newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, $this->resize_height, $this->width, (($this->width)/$resize_ratio));
                ImageJpeg ($newimg,$this->dstimg);
            }
        }
        else
        //不裁图
        {
			/*
            if($ratio>=$resize_ratio)
            {
                $newimg = imagecreatetruecolor($this->resize_width,($this->resize_width)/$ratio);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, ($this->resize_width)/$ratio, $this->width, $this->height);
                ImageJpeg ($newimg,$this->dstimg);
            }
            if($ratio<$resize_ratio)
            {
                $newimg = imagecreatetruecolor(($this->resize_height)*$ratio,$this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, ($this->resize_height)*$ratio, $this->resize_height, $this->width, $this->height);
				echo $newimg.'<br>';
				echo $this->dstimg.'<br>';
                ImageJpeg ($newimg,$this->dstimg);
            }
			*/
			$newimg = imagecreatetruecolor($this->resize_width, $this->resize_height);
			imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, $this->resize_height, $this->width, $this->height);
			ImageJpeg ($newimg,$this->dstimg);
        }
    }
    //初始化图象
    function initi_img()
    {
        if($this->type=="jpg")
        {
            $this->im = imagecreatefromjpeg($this->srcimg);
        }
        if($this->type=="gif")
        {
            $this->im = imagecreatefromgif($this->srcimg);
        }
        if($this->type=="png")
        {
            $this->im = imagecreatefrompng($this->srcimg);
        }
    }

	/*
    //图象目标地址
    function dst_img()
    {
        $full_length  = strlen($this->srcimg);
        $type_length  = strlen($this->type);
        $name_length  = $full_length-$type_length;
        $name         = substr($this->srcimg,0,$name_length-1);
        $this->dstimg = $name."_small.".$this->type;
    }
	*/


	//返回:width="",height=""
	/*
	function DisplaySize($file,$w_size,$h_size)
    {
		if(file_exists($file)) 
		{
			@$image_size = getimagesize($file);

			if($w_size > $h_size) {  //设定图像宽大于高
				if($image_size[0] >= $image_size[1] && $image_size[0] >= $w_size)
				{
					if(($image_size[0]/$image_size[1])<=($w_size/$h_size))
					{
						return("height=\"".$h_size."\"");
					} else {
						return("width=\"".$w_size."\"");
					}
				}
				if($image_size[0] < $image_size[1] && $image_size[1] >= $h_size)
				{
					return("height=\"".$h_size."\"");
				}
				if($image_size[0] <= $w_size && $image_size[1] <= $h_size)
				{
					return ("");
				}
			} elseif($w_size == $h_size) { //设定图像宽等于高
				if($image_size[0] >= $image_size[1] && $image_size[0] >= $w_size)
				{
					return ("width=\"".$w_size."\"");
				}
				if($image_size[0] < $image_size[1] && $image_size[1] > $h_size)
				{
					return ("height=\"".$h_size."\"");
				}
				if($image_size[0] <= $w_size && $image_size[1] <= $h_size)
				{
					return ("");
				}
			} else { //设定图像宽小于高
				if($image_size[1] >= $image_size[0] && $image_size[1] >= $h_size)
				{
					if(($image_size[0]/$image_size[1])<=($w_size/$h_size))
					{
						return("height=\"".$h_size."\"");
					} else {
						return("width=\"".$w_size."\"");
					}
				}
				if($image_size[1] < $image_size[0] && $image_size[0] >= $w_size)
				{
					return("width=\"".$w_size."\"");
				}
				if($image_size[0] <= $w_size && $image_size[1] <= $h_size)
				{
					return ("");
				}
			}
		}
	}
	*/
	//返回:width="" height=""
	function DisplaySize($file,$w_size,$h_size)
    {
		//if(file_exists($file)) 
		//{
			@$image_size = getimagesize($file);

			if($image_size[0] <= $w_size && $image_size[1] <= $h_size)
			{
				return 'width="'.$image_size[0].'" height="'.$image_size[1].'"';
			}
			else
			{
				if(($image_size[0] / $image_size[1]) < ($w_size/$h_size))
				{
					return 'width="'.round($image_size[0] * $h_size / $image_size[1]).'" height="'.$h_size.'"';
				}
				if(($image_size[0] / $image_size[1]) == ($w_size/$h_size))
				{
					return 'width="'.$w_size.'" height="'.$h_size.'"';
				}
				if(($image_size[0] / $image_size[1]) > ($w_size/$h_size))
				{
					return 'width="'.$w_size.'" height="'.round($image_size[1] * $w_size / $image_size[0]).'"';
				}
			}
		//}
	}

	//返回: 50,60 
	//注：50是宽，60是高
	function getWidthHeight($file,$w_size,$h_size)
    {
		//if(file_exists($file)) 
		//{
			@$image_size = getimagesize($file);

			if($image_size[0] <= $w_size && $image_size[1] <= $h_size)
			{
				return $image_size[0].','.$image_size[1];
			}
			else
			{
				if(($image_size[0] / $image_size[1]) < ($w_size/$h_size))
				{
					return round($image_size[0] * $h_size / $image_size[1]).','.$h_size;
				}
				if(($image_size[0] / $image_size[1]) == ($w_size/$h_size))
				{
					return $w_size.','.$h_size;
				}
				if(($image_size[0] / $image_size[1]) > ($w_size/$h_size))
				{
					return $w_size.','.round($image_size[1] * $w_size / $image_size[0]);
				}
			}
		//}
	}

	/*
	*函数:rotateImage
	*作用:旋转一个图片
	*输入:$ImageDir(文件地址，如c:\123.jpg或/usr/123.jpg)，$Degree（旋转角度，逆时针）
	*输出:true OR false
	*
	*
	*－－制作－－日期－－
	*KuaiYigang@xingmo.com  2006-5-29
	*
	*－－修改－－日期－－目的－－
	*
	*/
	public function rotateImage($ImageDir, $Degree)
	{	
		header('Content-type: image/jpeg');// Content type
		$source = imagecreatefromjpeg($ImageDir);// Load
		$rotate = imagerotate($source, $Degree, 0);// Rotate
		imagejpeg($rotate, $ImageDir); // Output
	}


	//如果不存在某图片的小图片，则生成之，返回小图片的文件名
	//$ImageDir : 大图片的完整路径
	public function createSmallPic($ImageDir, $Width, $Height)
	{
		global $URL_COMM;
		if(is_readable($ImageDir))
		{
			$Files = new Files;
			$PicName = basename($ImageDir);
			$Dir = dirname($ImageDir);
			$SmallPic = $Files->getSmallPicName($PicName, $Width, $Height);
			if(!(is_readable($Dir.'/small/'.$SmallPic)))
			{
				$Files->mkdirAll($Dir.'/small');
				$this->Resize($ImageDir, $Dir.'/small/'.$SmallPic, $Width, $Height);
			}
		}

		if(is_readable($Dir.'/small/'.$SmallPic))
		{
			return $SmallPic;
		}
		else
		{
			return false;
		}
	}

	public function WriteWords($FromImage, $Words, $Owner, $OwnerID)
	{
		global $UPLOAD;
		global $ROOT;
		$obj = new Gb2utf8();
		$Files = new Files;

		$im = imagecreatefromjpeg($FromImage);
		$white = imagecolorallocate($im, 255, 255, 255);
		$grey = imagecolorallocate($im, 128, 128, 128);
		$black = imagecolorallocate($im, 0, 0, 0);

		$font = $ROOT.'/fonts/simhei.ttf';
		$obj->gb = $Words;
		$obj->Convert();
		imagettftext($im, 16, 0, 2, 30, $black, $font, $obj->utf8);		

		$OwnerLower = ($Owner == 'Comm') ? 'comm' : 'club';
		$Logo = 'logo_'.time().'.jpg';
		$Files->mkdirAll($UPLOAD.'/'.$OwnerLower.'/'.$OwnerID);
		ImagePNG($im, $UPLOAD.'/'.$OwnerLower.'/'.$OwnerID.'/'.$Logo);
		ImageDestroy($im);

		return $Logo;
	}
}
?>