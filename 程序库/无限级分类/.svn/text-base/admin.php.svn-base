<?
include_once './func.php'; //载入函数集,数据库信息在conn.php里改
$id=$_GET['id'];
//下面函数用来显示此ID的所有下级分类,以表格行的方式递归显示.
?>
<table width="80%"  border="0" align="center">
  <tr>
    <td><a href="index.php">返回总菜单</a><? shownav($id); ?></td>
  </tr>
</table>
<hr width="80%">
<table width="80%"  border="1" align="center">
  <tr align="center" bgcolor="#99CC00">
    <td colspan="2">本分类文章</td>
  </tr>
 <? $rs=$db->query("select * from news where tid='$id'");
 while($row=$db->getarray($rs)){ ?>
  <tr>
    <td width="100" align="right">标题:</td>
    <td><?=$row['title']?></td>
  </tr>
  <tr>
    <td width="100" align="right">内容:</td>
    <td><?=$row['concent']?></td>
  </tr>
  <? } ?>
</table>
<? 
if(!empty($_GET['id']))
{ ?>
<hr width="80%">
<table width="80%"  border="1" align="center">
  <tr align="center" bgcolor="#9CCF00">
    <td colspan="2">本分类信息</td>
  </tr>
 <? $rs=$db->query("select * from menu where id='$id'");
$row=$db->getarray($rs); 
$path=$row['pathint'];
?>
  <tr>
    <td width="100" align="right">分类ID</td>
    <td><?=$row['id']?>&nbsp;</td>
  </tr>
  <tr>
    <td width="100" align="right">父分类ID:</td>
    <td><?=$row['fid']?>&nbsp;</td>
  </tr>
  <tr>
    <td width="100" align="right">分类名:</td>
    <td><?=$row['name']?>&nbsp;</td>
  </tr>
  <tr>
    <td width="100" align="right">数字亲缘树:</td>
    <td><?=$row['pathint']?>&nbsp;</td>
  </tr>
  <tr>
    <td width="100" align="right">字符亲缘树:</td>
    <td><?=$row['pathchar']?>&nbsp;</td>
  </tr>
</table>
<p align="center"><a href="?action=del&path=<?=$path?>" onClick="return confirm('如果你确定自己在干什么,那就继续.')">删除此分类</a>(注意这会删除此分类的所有子分类)
  <? } ?>
</p>
<hr width="80%">
<table width='80%'  border='1' align='center'>
<tr align='center' bgcolor='#9CCF00'>
<td colspan='6'>此分类下级分类</td>
</tr>
<? showsun($id); //递归调用函数显示此ID所有子分类 ?>
</table>
<hr width="80%">
<form name="form1" method="post" action="">
  <table width="80%"  border="1" align="center">
    <tr align="center" bgcolor="#9CCF00">
      <td>在此分类下添加新分类</td>
    </tr>
    <tr>
      <td align="center">分类名:
      <input name="typename" type="text" id="typename">
      <input type="submit" name="add" value="提交"></td>
    </tr>
  </table>
</form>
<form name="form2" method="post" action="">
  <table width="80%"  border="1" align="center">
    <tr align="center" bgcolor="#9CCF00">
      <td>修改此分类名</td>
    </tr>
    <tr>
      <td align="center">分类名:
      <input name="updatetype" type="text" id="updatetype">
      <input type="submit" name="update" value="改名"></td>
    </tr>
  </table>
</form>
<? if(!sun($id)){ ?>
<form name="form3" method="post" action="">
  <table width="80%"  border="1" align="center">
    <tr align="center" bgcolor="#9CCF00">
      <td>在此分类下添加文章(如果有子分类,则不显示以下表单)</td>
    </tr>
    <tr>
      <td align="center"><p>标题:
          <input name="title" type="text" id="title" size="60">
</p>
      <p>内容:
        <textarea name="concent" cols="59" rows="4" id="concent"></textarea>
</p>
      <p>
        <input name="insert" type="submit" id="insert" value="发表">
      </p></td>
    </tr>
  </table>
</form>
<? } ?>
<? 
if($_POST['add']=='提交'){
add($id); //在此分类下建立子分类
}
if($_POST['update']=='改名'){
update($id,$row['fid'],$row['name']); //传入父分类,先求得父分类的亲缘树,再相加旧名,新名,即得到本分类的新旧亲缘树.再替换子孙分类的亲缘树
}
if($_POST['insert']=='发表'){
insert($id); //在此分类下建立子分类
}
/*删除一个分类以及它的所有子孙分类,如果用传统方法非常麻烦,要先删除此ID,再删除父ID是它的分类...直至递归删除所有子孙.
这里的思路是根据亲缘树来删除,程序简便得多*/
if($_GET['action']=='del'){
$path=$_GET['path'];
$db->query("delete from menu where pathint like'$path%'");
echo "<script>location.href='index.php'</script>";
}
?>