<?php
/**
 *����:Files.class.php
 *����:�ļ���ص���
 *˵��:
 *����:��ģ��˾www.xingmo.com
 *ʱ��:2005-3-25
 **/
class Files
{
	/******************************************
	  *������upload($fileArray,$uploaddir,$filename)
	  *���ã��ϴ��ļ�����
	  *���룺$_FILES['userfile'],$uploaddir,$filename(������׺)
	  *�����$fullname�������ļ�����
	  **
	  ******************************************
	  *���������������ڣ���
	  *KuaiYigang@xingmo.com  2004-06-22 23:00
	  ******************************************
	  *�����޸ģ������ڣ���Ŀ�ģ���
	  *
	  */
	public function upload($fileArray,$uploaddir,$filename)
	{
		//ȡ���ļ���׺
		$suffix = $this->getExt($fileArray['name']);

		//�ļ���·��
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
	*������getExt($file)
	*���ã�ȡ���ļ���׺
	*���룺$_FILES['userfile']['name']
	*�����$ext���ļ���׺��
	**
	******************************************
	*���������������ڣ���
	*KuaiYigang@xingmo.com  2004-12-19 14:08
	******************************************
	*�����޸ģ������ڣ���Ŀ�ģ���
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
	*������mkdirAll($filepath)
	*���ã�����Ƿ����һ��Ŀ¼������������򴴽�֮
	*���룺$filepath��Ŀ¼·��,��$UPLOAD.'/1/2/3/4'��
	*�����true OR false
	**
	******************************************
	*���������������ڣ���
	*KuaiYigang@xingmo.com  2005-5-23
	******************************************
	*�����޸ģ������ڣ���Ŀ�ģ���
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
	*������checkPhoto
	*���ã�����Ƿ�����ϴ��ϵ�ͼƬ
	*���룺$fileArray:$_FILES['file']
	*�����true OR false
	**
	******************************************
	*���������������ڣ���
	*KuaiYigang@xingmo.com  2005-5-30
	******************************************
	*�����޸ģ������ڣ���Ŀ�ģ���
	*
	*/
	public function checkPhoto($fileArray)
	{
		return (strtolower($this->getExt($fileArray['name'])) == 'jpg' || strtolower($this->getExt($fileArray['name'])) == 'jpeg' || strtolower($this->getExt($fileArray['name'])) == 'gif' || strtolower($this->getExt($fileArray['name'])) == 'png') ? true :false;
	}

	/******************************************
	*������checkFlash
	*���ã�����Ƿ�����ϴ���flash
	*���룺$fileArray:$_FILES['file']
	*�����true OR false
	**
	******************************************
	*���������������ڣ���
	*KuaiYigang@xingmo.com  2005-6-2
	******************************************
	*�����޸ģ������ڣ���Ŀ�ģ���
	*
	*/
	public function checkFlash($fileArray)
	{
		return (strtolower($this->getExt($fileArray['name'])) == 'swf') ? true :false;
	}

	/******************************************
	*������uploadPhoto
	*���ã��ϴ�ͼƬ���������ϴ�ʱ�ļ��Ĵ�С���ϴ�����ڷ������ϵ��ļ���С���ϴ������һ����ʱĿ¼��
	*���룺$fileArray:$_FILES['file'],$TempDir:�ϴ����ŵ���ʱĿ¼,$filename:�ϴ������ڷ������ϵ��ļ���(������׺),$MaxUpload:�����ϴ����ļ���С,$MaxSave:����ڷ������ϴ�ŵĴ�С
	*�����'true|�ļ���' OR 'false'
	**
	******************************************
	*���������������ڣ���
	*KuaiYigang@xingmo.com  2006-4-21
	******************************************
	*�����޸ģ������ڣ���Ŀ�ģ���
	*
	*/
	//���ֲ���ʹ��
	public function uploadPhoto($fileArray, $TempDir, $filename, $MaxUpload, $MaxSave, $SmallWidth, $SmallHeight)
	{
		require 'Image.class.php';
		$Image = new Image;
		if($fileArray['error'] == 1)
		{
			return 'false|�ϴ����ļ�����';
		}
		elseif($fileArray['error'] == 0)
		{
			//return 'false|�ϴ����ļ�����';
		}
		else
		{
			return 'false|�ϴ�ʧ��';
		}
		if($fileArray['size'] <= $MaxSave)
		{
			$fullname = $this->upload($fileArray,$TempDir,$filename);
			if($fullname)
			{
				$SmallPicName = $this->getSmallPicName($fullname, $SmallWidth, $SmallHeight);//СͼƬ�ĸߡ���
				$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$SmallPicName, $SmallWidth, $SmallHeight);

				return 'true|'.$fullname.'|'.$SmallPicName;
			}
			else
			{
				return 'false|�ϴ�ʧ��';
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
					$SmallPicName = $this->getSmallPicName($fullname, $SmallWidth, $SmallHeight);//СͼƬ�ĸߡ���
					$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$SmallPicName, $SmallWidth, $SmallHeight);

					return 'true|'.$fullname.'|'.$SmallPicName;
				}
				else
				{
					$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$fullname, '800', '600');
					if(filesize($TempDir.'/'.$fullname) <= $MaxSave)
					{
						$SmallPicName = $this->getSmallPicName($fullname, $SmallWidth, $SmallHeight);//СͼƬ�ĸߡ���
						$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$SmallPicName, $SmallWidth, $SmallHeight);

						return 'true|'.$fullname.'|'.$SmallPicName;
					}
					else
					{
						$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$fullname, '600', '480');
						if(filesize($TempDir.'/'.$fullname) <= $MaxSave)
						{
							$SmallPicName = $this->getSmallPicName($fullname, $SmallWidth, $SmallHeight);//СͼƬ�ĸߡ���
							$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$SmallPicName, $SmallWidth, $SmallHeight);

							return 'true|'.$fullname.'|'.$SmallPicName;
						}
						else
						{
							return 'false|�ϴ����ļ�����';				
						}					
					}				
				}
			}
			else
			{
				return 'false|�ϴ�ʧ��';
			}
			
		}
		if($fileArray['size'] > $MaxUpload)
		{
			return 'false|�ϴ����ļ�����';
		}

	}
	
	//ĳ������ʹ��
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
			$Exif = new Exif($TempDir.'/'.$fullname);//2006-8-8����
			$Photo[0] = $Exif->getImageInfo();//2006-8-8����
			if($fullname)
			{
				$Photo[1] = $fullname;//2006-8-8����
				$Photo = serialize($Photo);//2006-8-8����
				return $Photo;//2006-8-8�޸�
			}
			else
			{
				return false;
			}
		}
		if(($fileArray['size'] > $MaxSave) && (filesize($fileArray['tmp_name']) <= $MaxUpload))
		{
			$fullname = $this->upload($fileArray,$TempDir,$filename);
			$Exif = new Exif($TempDir.'/'.$fullname);//2006-8-8����
			$Photo[0] = $Exif->getImageInfo();//2006-8-8����
			
			if($fullname)
			{				
				$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$fullname, '1024', '768');
				clearstatcache();
				if(filesize($TempDir.'/'.$fullname) <= $MaxSave)
				{
					$Photo[1] = $fullname;//2006-8-8����
					$Photo = serialize($Photo);//2006-8-8����
					return $Photo;//2006-8-8�޸�
				}
				else
				{				
					$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$fullname, '800', '600');
					clearstatcache();
					if(filesize($TempDir.'/'.$fullname) <= $MaxSave)
					{
						
						$Photo['FullName'] = $fullname;//2006-8-8����
						$Photo = serialize($Photo);//2006-8-8����
						return $Photo;//2006-8-8�޸�
					}
					else
					{
						$Image->Resize($TempDir.'/'.$fullname, $TempDir.'/'.$fullname, '600', '480');
						clearstatcache();
						if(filesize($TempDir.'/'.$fullname) <= $MaxSave)
						{
							$Photo[1] = $fullname;//2006-8-8����
							$Photo = serialize($Photo);//2006-8-8����
							return $Photo;//2006-8-8�޸�
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


	//�õ���С���ͼƬ������,����ԭ�ļ���123.gif,��С��100*50����ļ�����123_100_50.gif
	public function getSmallPicName($filename, $width, $height)
	{
		$full_length  = strlen($filename);
        $type_length  = strlen($this->getExt($filename));
        $name_length  = $full_length-$type_length;
        $name         = substr($filename,0,$name_length-1);
        return $name."_".$width."_".$height.".".$this->getExt($filename);
	}

	//�����ļ�,$FilePath:�ļ�·��,$FileName:�ļ�����
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

	//�鿴ͼƬ,$FilePath:�ļ�·��
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
	//ɾ���ǿ�Ŀ¼
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