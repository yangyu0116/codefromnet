<?php
/**
 *名称:Files.class.php
 *作用:文件相关的类
 *说明:
 *开发:星模公司www.xingmo.com
 *时间:2005-3-25
 **/
class Files
{
	/******************************************
	  *函数：upload($fileArray,$uploaddir,$filename)
	  *作用：上传文件函数
	  *输入：$_FILES['userfile'],$uploaddir,$filename(不带后缀)
	  *输出：$fullname（整个文件名）
	  **
	  ******************************************
	  *－－制作－－日期－－
	  *KuaiYigang@xingmo.com  2004-06-22 23:00
	  ******************************************
	  *－－修改－－日期－－目的－－
	  *
	  */
	public function upload($fileArray,$uploaddir,$filename)
	{
		//取得文件后缀
		$suffix = $this->getExt($fileArray['name']);

		//文件及路径
		if(!file_exists($uploaddir))
		{
			$this->mkdirAll($uploaddir,0777);
		}
		//chmod($uploaddir,0777);

		$fullname = $filename.".".$suffix;
		$uploadfile = $uploaddir.'/'.$fullname;
		if(move_uploaded_file($fileArray['tmp_name'], $uploadfile))
		{
			return $fullname;
		}
	}


	/******************************************
	*函数：getExt($file)
	*作用：取得文件后缀
	*输入：$_FILES['userfile']['name']
	*输出：$ext（文件后缀）
	**
	******************************************
	*－－制作－－日期－－
	*KuaiYigang@xingmo.com  2004-12-19 14:08
	******************************************
	*－－修改－－日期－－目的－－
	*
	*/
	public function getExt($file)
	{
		$temp =  explode('.', $file);
		$ext = strtolower(array_pop($temp));
		//$ext = strtolower( substr( $file, ( strrpos($file, '.') + 1 ) ) ) ;
		return $ext;
	}

	/******************************************
	*函数：mkdirAll($filepath)
	*作用：检查是否存在一个目录，如果不存在则创建之
	*输入：$filepath（目录路径,如$UPLOAD.'/1/2/3/4'）
	*输出：true OR false
	**
	******************************************
	*－－制作－－日期－－
	*KuaiYigang@xingmo.com  2005-5-23
	******************************************
	*－－修改－－日期－－目的－－
	*
	*/
	public function mkdirAll($filepath)
	{
		$temp = explode('/', $filepath);
		$path = $temp[0].'/';
		for($i=1; $i<count($temp); $i++)
		{
			$path .= $temp[$i].'/';
			if(!file_exists($path))
			{
				mkdir($path, 0777);
				chmod($path, 0777);
			}
		}
		return (file_exists($filepath)) ? true : false;
	}


	/******************************************
	*函数：checkPhoto
	*作用：检查是否可以上传上的图片
	*输入：$fileArray:$_FILES['file']
	*输出：true OR false
	**
	******************************************
	*－－制作－－日期－－
	*KuaiYigang@xingmo.com  2005-5-30
	******************************************
	*－－修改－－日期－－目的－－
	*
	*/
	public function checkPhoto($fileArray)
	{
		return (strtolower($this->getExt($fileArray['name'])) == 'jpg' || strtolower($this->getExt($fileArray['name'])) == 'jpeg' || strtolower($this->getExt($fileArray['name'])) == 'gif' || strtolower($this->getExt($fileArray['name'])) == 'png') ? true :false;
	}

	/******************************************
	*函数：checkFlash
	*作用：检查是否可以上传的flash
	*输入：$fileArray:$_FILES['file']
	*输出：true OR false
	**
	******************************************
	*－－制作－－日期－－
	*KuaiYigang@xingmo.com  2005-6-2
	******************************************
	*－－修改－－日期－－目的－－
	*
	*/
	public function checkFlash($fileArray)
	{
		return (strtolower($this->getExt($fileArray['name'])) == 'swf') ? true :false;
	}

	/******************************************
	*函数：uploadPhoto
	*作用：上传图片（限制了上传时文件的大小及上传后存在服务器上的文件大小，上传后存在一个临时目录）
	*输入：$fileArray:$_FILES['file'],$TempDir:上传后存放的临时目录,$filename:上传后存放在服务器上的文件名(不带后缀),$MaxUpload:最大可上传的文件大小,$MaxSave:最大在服务器上存放的大小
	*输出：'true|文件名' OR 'false'
	**
	******************************************
	*－－制作－－日期－－
	*KuaiYigang@xingmo.com  2006-4-21
	******************************************
	*－－修改－－日期－－目的－－
	*
	*/
	//俱乐部中使用
	public function uploadPhoto($fileArray, $TempDir, $filename, $MaxUpload, $MaxSave, $SmallWidth, $SmallHeight)
	{
		require 'Image.class.php';
		$Image = new Image;
		if($fileArray['error'] == 1)
		{
			return 'false|上传的文件过大';
		}
		elseif($fileArray['error'] == 0)
		{
			//return 'false|上传的文件过大';
		}
		else
		{
			return 'false|上传失败';
		}
		if($fileArray['size'] <= $MaxSave)
		{
			$fullname = $this->upload($fileArray,$TempDir,$filename);
			if($fullname)
			{
				$SmallPicName = $this->getSmallPicName($fullname, $SmallWidth, $SmallHeight);//小图片的高、宽
				$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$SmallPicName, $SmallWidth, $SmallHeight);

				return 'true|'.$fullname.'|'.$SmallPicName;
			}
			else
			{
				return 'false|上传失败';
			}
		}
		if(($fileArray['size'] > $MaxSave) && (filesize($fileArray['tmp_name']) <= $MaxUpload))
		{
			$fullname = $this->upload($fileArray,$TempDir,$filename);
			if($fullname)
			{
				$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$fullname, '1024', '768');
				if(filesize($TempDir.'/'.$fullname) <= $MaxSave)
				{
					$SmallPicName = $this->getSmallPicName($fullname, $SmallWidth, $SmallHeight);//小图片的高、宽
					$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$SmallPicName, $SmallWidth, $SmallHeight);

					return 'true|'.$fullname.'|'.$SmallPicName;
				}
				else
				{
					$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$fullname, '800', '600');
					if(filesize($TempDir.'/'.$fullname) <= $MaxSave)
					{
						$SmallPicName = $this->getSmallPicName($fullname, $SmallWidth, $SmallHeight);//小图片的高、宽
						$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$SmallPicName, $SmallWidth, $SmallHeight);

						return 'true|'.$fullname.'|'.$SmallPicName;
					}
					else
					{
						$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$fullname, '600', '480');
						if(filesize($TempDir.'/'.$fullname) <= $MaxSave)
						{
							$SmallPicName = $this->getSmallPicName($fullname, $SmallWidth, $SmallHeight);//小图片的高、宽
							$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$SmallPicName, $SmallWidth, $SmallHeight);

							return 'true|'.$fullname.'|'.$SmallPicName;
						}
						else
						{
							return 'false|上传的文件过大';				
						}					
					}				
				}
			}
			else
			{
				return 'false|上传失败';
			}
			
		}
		if($fileArray['size'] > $MaxUpload)
		{
			return 'false|上传的文件过大';
		}

	}
	
	//某社区中使用
	public function uploadPhoto2($fileArray, $TempDir, $filename, $MaxUpload, $MaxSave)
	{
		require_once 'Image.class.php';
		$Image = new Image;
		$Photo = array();
		if($fileArray['error'] == 1)
		{
			return false;
		}
		elseif($fileArray['error'] == 0)
		{
		}
		else
		{
			return false;
		}
		if($fileArray['size'] <= $MaxSave)
		{
			$fullname = $this->upload($fileArray,$TempDir,$filename);
			$Exif = new Exif($TempDir.'/'.$fullname);//2006-8-8增加
			$Photo[0] = $Exif->getImageInfo();//2006-8-8增加
			if($fullname)
			{
				$Photo[1] = $fullname;//2006-8-8增加
				$Photo = serialize($Photo);//2006-8-8增加
				return $Photo;//2006-8-8修改
			}
			else
			{
				return false;
			}
		}
		if(($fileArray['size'] > $MaxSave) && (filesize($fileArray['tmp_name']) <= $MaxUpload))
		{
			$fullname = $this->upload($fileArray,$TempDir,$filename);
			$Exif = new Exif($TempDir.'/'.$fullname);//2006-8-8增加
			$Photo[0] = $Exif->getImageInfo();//2006-8-8增加
			
			if($fullname)
			{				
				$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$fullname, '1024', '768');
				clearstatcache();
				if(filesize($TempDir.'/'.$fullname) <= $MaxSave)
				{
					$Photo[1] = $fullname;//2006-8-8增加
					$Photo = serialize($Photo);//2006-8-8增加
					return $Photo;//2006-8-8修改
				}
				else
				{				
					$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$fullname, '800', '600');
					clearstatcache();
					if(filesize($TempDir.'/'.$fullname) <= $MaxSave)
					{
						
						$Photo['FullName'] = $fullname;//2006-8-8增加
						$Photo = serialize($Photo);//2006-8-8增加
						return $Photo;//2006-8-8修改
					}
					else
					{
						$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$fullname, '600', '480');
						clearstatcache();
						if(filesize($TempDir.'/'.$fullname) <= $MaxSave)
						{
							$Photo[1] = $fullname;//2006-8-8增加
							$Photo = serialize($Photo);//2006-8-8增加
							return $Photo;//2006-8-8修改
						}
						else
						{
							return false;
						}					
					}				
				}
			}
			else
			{
				return false;
			}
			
		}
		if($fileArray['size'] > $MaxUpload)
		{
			return false;
		}

	}


	//得到缩小后的图片的名称,比如原文件是123.gif,缩小到100*50后的文件名是123_100_50.gif
	public function getSmallPicName($filename, $width, $height)
	{
		$full_length  = strlen($filename);
        $type_length  = strlen($this->getExt($filename));
        $name_length  = $full_length-$type_length;
        $name         = substr($filename,0,$name_length-1);
        return $name."_".$width."_".$height.".".$this->getExt($filename);
	}

	//下载文件,$FilePath:文件路径,$FileName:文件名称
	public function download($FilePath, $FileName, $type=1)
	{
		if($type == 1)
		{
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
			header("Content-Type: application/force-download");
			header( "Content-Disposition: attachment; filename=".$FileName);
			header( "Content-Description: File Transfer");
			@readfile($FilePath);
		}
		if($type == 2)
		{
			$filesize = filesize($FilePath);
			$imagesize = getimagesize($FilePath);
			$filetype = $imagesize['mime'];
			ob_end_clean();
			header('Cache-control: max-age=31536000');
			header('Expires: '.gmdate('D, d M Y H:i:s', time() + 31536000).' GMT');
			header('Content-Encoding: none');
			header('Content-Disposition: attachment; filename='.$FileName);
			header('Content-Type: '.$filetype);
			@$fp = fopen($FilePath, 'rb');
			@flock($fp, 2);
			$file = @fread($fp, $filesize);
			@fclose($fp);
			echo $file;
		}
	}

	//查看图片,$FilePath:文件路径
	public function displayPic($FilePath, $type=2)
	{
		if($type == 1)
		{
			$imagesize = getimagesize($FilePath);
			$filetype = $imagesize['mime'];
			header('Content-Type: '.$filetype);
			$pic = file_get_contents($FilePath);
			echo $pic;
			flush();
		}
		if($type == 2)
		{
			$imagesize = getimagesize($FilePath);
			$filetype = $imagesize['mime'];
			$filesize = filesize($FilePath);
			//ob_end_clean();
			//header('Cache-control: max-age=31536000');
			//header('Expires: '.gmdate('D, d M Y H:i:s', time() + 31536000).' GMT');
			//header('Content-Encoding: none');
			//header('Content-Disposition: attachment; filename='.$attach['filename']);
			header('Content-Type: '.$filetype);
			@$fp = fopen($FilePath, 'rb');
			@flock($fp, 2);
			$pic = @fread($fp, $filesize);
			@fclose($fp);
			echo $pic;
		}
	}
	//删除非空目录
	function remove_directory($dir) 
	{
	  if ($handle = opendir("$dir")) {
	   while (false !== ($item = readdir($handle))) {
		 if ($item != "." && $item != "..") {
		   if (is_dir("$dir/$item")) {
			 remove_directory("$dir/$item");
		   } else {
			 unlink("$dir/$item");
			 //echo " removing $dir/$item<br>\n";
		   }
		 }
	   }
	   closedir($handle);
	   rmdir($dir);
	   //echo "removing $dir<br>\n";
	}
}


}
?>