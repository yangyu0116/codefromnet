<?php
/*
 *����:Image.class.php
 *����:����������
 *˵��:
 ��  �ܣ�����PHP��GD�����ɸ�����������ͼ
 ���л���:PHP5.01/GD2
 ��˵��������ѡ����/���ͼ��
 �����ͼ�����ɵ�ͼ�ĳߴ����������һ����
 ԭ�򣺾����ܶౣ��ԭͼ����
 �������ͼ������ԭͼ����������ͼ
 ԭ�򣺸��ݱ���������ĳ����߿�Ϊ��׼
 �� ����$img:ԴͼƬ��ַ
 $wid:��ͼ�Ŀ��
 $hei:��ͼ�ĸ߶�
 $c:�Ƿ��ͼ��1Ϊ�ǣ�0Ϊ��
 *����:��ģ��˾www.xingmo.com
 *ʱ��:2005-4-23
 */
class Image
{
    //ͼƬ����
    var $type;
    //ʵ�ʿ��
    var $width;
    //ʵ�ʸ߶�
    var $height;
    //�ı��Ŀ��
    var $resize_width;
    //�ı��ĸ߶�
    var $resize_height;
    //�Ƿ��ͼ
    var $cut;
    //Դͼ��
    var $srcimg;
    //Ŀ��ͼ���ַ
    var $dstimg;
    //��ʱ������ͼ��
    var $im;

    //$img:ԴͼƬ,$dst_img:ͼƬĿ���ַ,$wid:���õ��Ŀ��,$hei:���õ��ĸ߶�,$c:�Ƿ��ͼ(һ�㲻��)
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
        //ͼƬ������
        $this->type = strtolower(substr(strrchr($this->srcimg,"."),1));
        //��ʼ��ͼ��
        $this->initi_img();
        //Ŀ��ͼ���ַ
        //$this -> dst_img();
		$this->dstimg = $dst_img;
        //--
		
        //����ͼ��
        $this->newimg();
        ImageDestroy ($this->im);
    }
    function newimg()
    {
        //�ı���ͼ��ı���
        $resize_ratio = ($this->resize_width)/($this->resize_height);
        //ʵ��ͼ��ı���
        $ratio = ($this->width)/($this->height);
        if(($this->cut)=="1")
        //��ͼ
        {
            if($ratio>=$resize_ratio)
            //�߶�����
            {
                $newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width,$this->resize_height, (($this->height)*$resize_ratio), $this->height);
                ImageJpeg ($newimg,$this->dstimg);
            }
            if($ratio<$resize_ratio)
            //�������
            {
                $newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
                imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, $this->resize_height, $this->width, (($this->width)/$resize_ratio));
                ImageJpeg ($newimg,$this->dstimg);
            }
        }
        else
        //����ͼ
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
    //��ʼ��ͼ��
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
    //ͼ��Ŀ���ַ
    function dst_img()
    {
        $full_length  = strlen($this->srcimg);
        $type_length  = strlen($this->type);
        $name_length  = $full_length-$type_length;
        $name         = substr($this->srcimg,0,$name_length-1);
        $this->dstimg = $name."_small.".$this->type;
    }
	*/


	//����:width="",height=""
	/*
	function DisplaySize($file,$w_size,$h_size)
    {
		if(file_exists($file)) 
		{
			@$image_size = getimagesize($file);

			if($w_size > $h_size) {  //�趨ͼ�����ڸ�
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
			} elseif($w_size == $h_size) { //�趨ͼ�����ڸ�
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
			} else { //�趨ͼ���С�ڸ�
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
	//����:width="" height=""
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

	//����: 50,60 
	//ע��50�ǿ�60�Ǹ�
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
	*����:rotateImage
	*����:��תһ��ͼƬ
	*����:$ImageDir(�ļ���ַ����c:\123.jpg��/usr/123.jpg)��$Degree����ת�Ƕȣ���ʱ�룩
	*���:true OR false
	*
	*
	*���������������ڣ���
	*KuaiYigang@xingmo.com  2006-5-29
	*
	*�����޸ģ������ڣ���Ŀ�ģ���
	*
	*/
	public function rotateImage($ImageDir, $Degree)
	{	
		header('Content-type: image/jpeg');// Content type
		$source = imagecreatefromjpeg($ImageDir);// Load
		$rotate = imagerotate($source, $Degree, 0);// Rotate
		imagejpeg($rotate, $ImageDir); // Output
	}


	//���������ĳͼƬ��СͼƬ��������֮������СͼƬ���ļ���
	//$ImageDir : ��ͼƬ������·��
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