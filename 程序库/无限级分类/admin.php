<?
include_once './func.php'; //���뺯����,���ݿ���Ϣ��conn.php���
$id=$_GET['id'];
//���溯��������ʾ��ID�������¼�����,�Ա���еķ�ʽ�ݹ���ʾ.
?>
<table width="80%"  border="0" align="center">
  <tr>
    <td><a href="index.php">�����ܲ˵�</a><? shownav($id); ?></td>
  </tr>
</table>
<hr width="80%">
<table width="80%"  border="1" align="center">
  <tr align="center" bgcolor="#99CC00">
    <td colspan="2">����������</td>
  </tr>
 <? $rs=$db->query("select * from news where tid='$id'");
 while($row=$db->getarray($rs)){ ?>
  <tr>
    <td width="100" align="right">����:</td>
    <td><?=$row['title']?></td>
  </tr>
  <tr>
    <td width="100" align="right">����:</td>
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
    <td colspan="2">��������Ϣ</td>
  </tr>
 <? $rs=$db->query("select * from menu where id='$id'");
$row=$db->getarray($rs); 
$path=$row['pathint'];
?>
  <tr>
    <td width="100" align="right">����ID</td>
    <td><?=$row['id']?>&nbsp;</td>
  </tr>
  <tr>
    <td width="100" align="right">������ID:</td>
    <td><?=$row['fid']?>&nbsp;</td>
  </tr>
  <tr>
    <td width="100" align="right">������:</td>
    <td><?=$row['name']?>&nbsp;</td>
  </tr>
  <tr>
    <td width="100" align="right">������Ե��:</td>
    <td><?=$row['pathint']?>&nbsp;</td>
  </tr>
  <tr>
    <td width="100" align="right">�ַ���Ե��:</td>
    <td><?=$row['pathchar']?>&nbsp;</td>
  </tr>
</table>
<p align="center"><a href="?action=del&path=<?=$path?>" onClick="return confirm('�����ȷ���Լ��ڸ�ʲô,�Ǿͼ���.')">ɾ���˷���</a>(ע�����ɾ���˷���������ӷ���)
  <? } ?>
</p>
<hr width="80%">
<table width='80%'  border='1' align='center'>
<tr align='center' bgcolor='#9CCF00'>
<td colspan='6'>�˷����¼�����</td>
</tr>
<? showsun($id); //�ݹ���ú�����ʾ��ID�����ӷ��� ?>
</table>
<hr width="80%">
<form name="form1" method="post" action="">
  <table width="80%"  border="1" align="center">
    <tr align="center" bgcolor="#9CCF00">
      <td>�ڴ˷���������·���</td>
    </tr>
    <tr>
      <td align="center">������:
      <input name="typename" type="text" id="typename">
      <input type="submit" name="add" value="�ύ"></td>
    </tr>
  </table>
</form>
<form name="form2" method="post" action="">
  <table width="80%"  border="1" align="center">
    <tr align="center" bgcolor="#9CCF00">
      <td>�޸Ĵ˷�����</td>
    </tr>
    <tr>
      <td align="center">������:
      <input name="updatetype" type="text" id="updatetype">
      <input type="submit" name="update" value="����"></td>
    </tr>
  </table>
</form>
<? if(!sun($id)){ ?>
<form name="form3" method="post" action="">
  <table width="80%"  border="1" align="center">
    <tr align="center" bgcolor="#9CCF00">
      <td>�ڴ˷������������(������ӷ���,����ʾ���±�)</td>
    </tr>
    <tr>
      <td align="center"><p>����:
          <input name="title" type="text" id="title" size="60">
</p>
      <p>����:
        <textarea name="concent" cols="59" rows="4" id="concent"></textarea>
</p>
      <p>
        <input name="insert" type="submit" id="insert" value="����">
      </p></td>
    </tr>
  </table>
</form>
<? } ?>
<? 
if($_POST['add']=='�ύ'){
add($id); //�ڴ˷����½����ӷ���
}
if($_POST['update']=='����'){
update($id,$row['fid'],$row['name']); //���븸����,����ø��������Ե��,����Ӿ���,����,���õ���������¾���Ե��.���滻����������Ե��
}
if($_POST['insert']=='����'){
insert($id); //�ڴ˷����½����ӷ���
}
/*ɾ��һ�������Լ����������������,����ô�ͳ�����ǳ��鷳,Ҫ��ɾ����ID,��ɾ����ID�����ķ���...ֱ���ݹ�ɾ����������.
�����˼·�Ǹ�����Ե����ɾ��,������ö�*/
if($_GET['action']=='del'){
$path=$_GET['path'];
$db->query("delete from menu where pathint like'$path%'");
echo "<script>location.href='index.php'</script>";
}
?>