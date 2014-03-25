<?
include("./conn.php"); //载入DB类,数据库信息在conn.php里改
//此函数递归显示所有分类
function showmenu($fid = 0){
	global $db_password,$db_username,$db_database,$db_hostname; //连接数据库
	$db=new dbClass("$db_username","$db_password","$db_database","$db_hostname");
	$db->connect();
	$db->select();
	
    $query = "select * from menu where fid = ". $fid; //第一次找出一级分类,以后递归调用,显示所有分类
    $rs = $db->query($query);
                
    if(mysql_num_rows($rs) > 0){
         while ($row = $db->getarray($rs)){        
         if(sun($row['id'])){//判断有没有子分类
             $img = "<img id = 'img".$row['id']."' src='./jia.jpg' onclick='showhidden(".$row['id'].")'/>"; //显示+或-号图标,当点击时击活js函数
         }else{
             $img = "&nbsp;&nbsp;&nbsp;&nbsp;"; //没有子分类,就不显示+,-号图片,显示空格串
         }
                
         $path = explode(":",$row['pathint']);
         if(count($path) > 1){
              for($i=1;$i<count($path);$i++){ //分类级别越深,空格串越多.
                  $space .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
              }
         }
         echo $space.$img; //先输出空图片,再输出+或-号.(当然若无子分类,也是空格串)
		 echo "<a class='menu' href = 'admin.php?id=".$row['id']."'>";
         echo $row['name']."</a><br>"; //输出分类名
         $space = ""; //一层目录显示结束后,初始化$space
         if(sun($row['id'])){ //判断有否子分类                                       
             $hidden_div  = "style='display:none'"; //初始化风格为不显示子分类                                              
             echo "<div id = 'div".$row['id']."' ".$hidden_div.">";                                        
             showmenu($row['id']); //关键部分,递归调用,显示下级目录
             echo "</div>";
         }                                                
     }
  }                
} 
//此函数判断是否有子分类
function sun($fid){
	global $db_password,$db_username,$db_database,$db_hostname; //连接数据库
	$db=new dbClass("$db_username","$db_password","$db_database","$db_hostname");
	$db->connect();
	$db->select();
	
    $query = "select * from menu where fid = ". $fid;
    if($db->getcount($query) > 0){ //getcount方法是取得记录数
    	return true;
    }else{
        return false;
    }
        
}
//显示所有子分类信息
function showsun($id){ 
	global $db_password,$db_username,$db_database,$db_hostname; //连接数据库
	$db=new dbClass("$db_username","$db_password","$db_database","$db_hostname");
	$db->connect();
	$db->select();
	
	$rs=$db->query("select * from menu where fid='$id'");
	while($row=$db->getarray($rs)){
		echo "<tr>";
		echo "<td align='right'>下级分类ID:</td>";
		echo "<td>".$row['id']."</td>";
		echo "<td align='right'>分类名:</td>";
		echo "<td><a href='?id=".$row['id']."'>".$row['name']."</a></td>";
		echo "<td align='right'>字符亲缘:</td>";
		echo "<td>".$row['pathchar']."</td>";
		echo "</tr>";
		showsun($row['id']);
	}
}
//在本分类下建立新分类
function add($id){ 
	global $db_password,$db_username,$db_database,$db_hostname; //连接数据库
	$db=new dbClass("$db_username","$db_password","$db_database","$db_hostname");
	$db->connect();
	$db->select();
	
	$name=$_POST['typename'];
	$db->query("insert into menu(fid,name) values('$id','$name')"); //插入新分类,但两个亲缘树字段未建立,因为必须先得到这句insert后的ID值
	$lid=mysql_insert_id();
	$rs=$db->query("select * from menu where id='$id'");//找出父分类的亲缘树
	$row=$db->getarray($rs); 
	$pathint=$row['pathint'].":".$lid; //父分类的亲缘树在上文己得到
	$pathchar=$row['pathchar'].":".$name;
	$db->query("update menu set pathint='$pathint',pathchar='$pathchar' where id='$lid'");
	echo "<script>location.href='index.php'</script>"; //若没这句,一刷新就重复添加
}
//发表文章
function insert($id){ 
	global $db_password,$db_username,$db_database,$db_hostname; //连接数据库
	$db=new dbClass("$db_username","$db_password","$db_database","$db_hostname");
	$db->connect();
	$db->select();
	
	$title=trim($_POST['title']);
	$concent=$_POST['concent'];
	$db->query("insert into news(tid,title,concent) values('$id','$title','$concent')");
	echo "<script>location.href='index.php'</script>";
}
//修改分类名,奶奶的,为了字符亲缘树的统一问题搞得这么麻烦.正考虑省略掉这个字段的优劣影响
function update($id,$fid,$oldname){ 
	global $db_password,$db_username,$db_database,$db_hostname; //连接数据库
	$db=new dbClass("$db_username","$db_password","$db_database","$db_hostname");
	$db->connect();
	$db->select();
	$newname=$_POST['updatetype'];//新分类名
	$db->query("update menu set name='$newname' where id='$id'"); //改名
	
	//下面必须解决数据统一性问题,这个分类名改了,它的子分类字符串亲缘树也必须相应改变,思路是用将其子分类字符串亲缘树替换
	$rs=$db->query("select * from menu where id='$fid'"); //先确定父分类的亲缘树
	$row=$db->getarray($rs);
	$fpath=$row['pathchar']; //父亲缘树
	$old=$fpath.":".$oldname; //本分类的老亲缘树
	$new=$fpath.":".$newname; //本分类的新亲缘树
	//搜索表中所有包含老树的记录,替换成新树.这样子孙就一网打尽了
	$rs=$db->query("select * from menu where pathchar like'$oldpath%'");
	while ($row=$db->getarray($rs)){
		$tid=$row['id'];
		$newpath=str_replace($old,$new,$row['pathchar']); //将子孙分类(包括自己)的亲缘树替换
		$db->query("update menu set pathchar='$newpath' where id='$tid'");
	}
	echo "<script>location.href='index.php'</script>";
}
//以下函数根据字符亲缘树显示导航条,字符亲缘树就在这发挥作用
function shownav($id){
	global $db_password,$db_username,$db_database,$db_hostname; //连接数据库
	$db=new dbClass("$db_username","$db_password","$db_database","$db_hostname");
	$db->connect();
	$db->select();
	
	$rs=$db->query("select * from menu where id='$id'");
	$row=$db->getarray($rs);
	$pathchar=$row['pathchar'];
	$path=explode(":",$pathchar);
	$pathint=$row['pathint'];
	$pathid=explode(":",$pathint);
	$i=1;
	for($i;$i<count($path);$i++){
		echo "-<a href='?id=".$pathid[$i]."'>".$path[$i]."</a>"; //显示导航
	}
}
?>   