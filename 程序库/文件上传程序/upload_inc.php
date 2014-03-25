<?
	class upload_class
	{
		
		var $upload_name='upload_file';		//	表单对象名
		var $to_filepath;		//	上传后的目录及文件名
		var $to_fileexp="";
		var $upload_max_size=10485760;	//	最大文件大小
		var $upload_overwrite=1;	//	是否替换同名
		var $upload_err=0;
		var $upload_format=".jpg,.gif";
		
		function upload_file(){
			$u_obj			=$this->upload_name;
			$file_size_max	=$this->upload_max_size;
			$upload_file=$_FILES[$u_obj]['tmp_name'];
			$upload_file_size=$_FILES[$u_obj]['size'];
			
			if($upload_file){
				$this->to_fileexp=strtolower(strrchr($_FILES[$u_obj]['name'],"."));
				$to_file_name	=$this->to_filepath.$this->to_fileexp;
				
				if ($upload_file_size > $file_size_max) {
					$this->upload_err=9;		//大小
					return;
				}

				if (strpos($this->upload_format,$this->to_fileexp)===false) {
					$this->upload_err=8;		//格式
					return;
				}				
				if (file_exists($to_file_name) && !$this->upload_overwrite) {
					$this->upload_err=7;		//已经存在
					return;
				}				
				if (!move_uploaded_file($upload_file,$to_file_name)) {
					$this->upload_err=6;		//"复制文件失败"
					return;
				}		
				$this->upload_err=1;		
			}else{
				$this->upload_err=0;
				return;
			}
		}
		function upload_class($upload_obj,$upload_dir,$upload_tofile){
			$this->upload_name=$upload_obj;
			$this->to_filepath=$upload_dir.$upload_tofile;
			$this->mkdirectory($upload_dir);
		}
		function upload_size(){
			return $_FILES[$this->upload_name]['size'];
		}
	
		function mkdirectory($newstr){
			$i=0;
			do {
			   $dir = $newstr;
			   while (!is_dir($dir)) {
			   		if ($i>100){
			   			break;
			   		}
			       $basedir = dirname($dir);
			       if ($basedir == '/' || is_dir($basedir))
			           @mkdir($dir,0777);
			       else
			           $dir=$basedir;

			       $i++;
			   }
			} while ($dir !=$newstr);
		}
		function upload_err(){
			switch($this->upload_err){
				case 1:
					$err_info= "文件上传成功!";
					break;
				case 9:
					$err_info="文件大小不符合要求!";
					break;	
				case 8:
					$err_info="格式不符";
					break;	
				case 7:
					$err_info="文件已经存在!";
					break;	
				case 6:
					$err_info="复制文件出错!";
					break;	
				default:
					$err_info="上传文件失败!";
					break;
			}
			return $err_info;
		}
	}
?>