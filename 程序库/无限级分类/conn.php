<?
global $db_username,$db_password,$db_database,$db_hostname,$db;
$db_username="xinye"; //�������ݿ���û���
$db_password="040040"; //�������ݿ������
$db_database="menu"; //���ݿ���
$db_hostname="localhost"; //��������ַ

class dbClass{ //��ʼ���ݿ���
var $username;
var $password;
var $database;
var $hostname;
var $result;
var $link;


function dbClass($username,$password,$database,$hostname="localhost"){
$this->username=$username;
$this->password=$password;
$this->database=$database;
$this->hostname=$hostname;
}
function connect(){ //������������������ݿ�
$this->link=mysql_connect($this->hostname,$this->username,$this->password) or die("�������ݿ�ʧ��");
return $this->link;
}
function select(){ //�����������ѡ�����ݿ�
mysql_select_db($this->database,$this->link);
}

function query($sql){ //������������ͳ���ѯ��䲢���ؽ�������á�
if($this->result=mysql_query($sql,$this->link)) return $this->result;
else {
//��������ʾSQL���Ĵ�����Ϣ����Ҫ����ƽ׶�������ʾ����ʽ���н׶οɽ��������ע�͵���
echo "SQL������ <font color=red>$sql</font> <BR><BR>������Ϣ�� ".mysql_error();
return false;
}
}
/*
�������º������ڴӽ��ȡ�����飬һ���� while()ѭ����$db->query($sql) ���ʹ�ã����磺
$result=$db->query("select * from xzy_teachfl order by tpx");
while($row=$db->getarray($result)){
echo "$row[id] ";
}
*/
function getarray($result){
return @mysql_fetch_array($result);
}

/*
�������º�������ȡ��SQL��ѯ�ĵ�һ�У�һ�����ڲ�ѯ�������������Ƿ���ڣ����磺
�����û��ӱ��ύ���û���$username������$password�Ƿ����û���user���У�����������Ӧ�����飺
if($user=$db->getfirst("select * from user where username='$username' and password='$password' "))
echo "��ӭ $username ������ID�� $user[id] ��";
else
echo "�û������������";
*/
function getfirst($sql){
return @mysql_fetch_array($this->query($sql));
}

/*
�������º������ط��ϲ�ѯ���������������������ڷ�ҳ�ļ����Ҫ�õ������磺
$totlerows=$db->getcount("select * from mytable");
echo "���� $totlerows ����Ϣ��";
*/
function getcount($sql){
return @mysql_num_rows($this->query($sql)); 
}

function getid(){ //�����������ȡ�øղ����е�id
return mysql_insert_id();
}
}

/*
������Ҫ����������Щ��������Լ����������Ҫ��Ҳ�����Լ������ȥ��
������Ϊ��ʹ�ø���Ķ������������ݿ⣬��������Ӳ�ѡ������ݿ�ɣ�
*/
$db=new dbClass("$db_username","$db_password","$db_database","$db_hostname");
$db->connect();
$db->select();
mysql_query("set names 'gbk'") ;//�ַ���
?>