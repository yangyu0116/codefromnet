<?
//-----------------test ---------------------
$totalPage		= 100 ;					//�ܷ�ҳ����
$currentPage	= @$_GET['page']+0;		//��ǰҳ��
$url				= "?page";				//�ֶ�����
$halfPer			= 10;						//����֮һ��ÿҳ����Ϣ��
$imagePath		="images";				//��ҳͼƬĿ¼
$pageHtml		= page ( $totalPage , $currentPage,$url ,$halfPer,$imagePath);//���÷�ҳ����
echo $pageHtml ;
/**************************************************************************************************
�������� : 
	����� ( �������  phpyy@msn.com ,QQ:44922032)
���ʱ�� :
	2005-9-7
�������� :
	��ҳ���
��ѡ���� :
	totalPage �ܷ�ҳ����
	currentPage ��ǰҳ��
	url ��ҳ����
��ѡ���� :
	halfPer ����֮һ��ÿҳ����Ϣ��
******************************************************************************************************/
function page ( $totalPage , $currentPage,$url ,$halfPer=5)
{
	$total=$totalPage-1;
	$re="<td><a href=\"$url\" onclick=\"page=prompt('��{$totalPage}ҳ\\n�Զ�����ת���ڼ�ҳ��','');if(page>0&&page<$total)location.href=this.href+'='+(page-1);return false\">��ת</a></td>\n";
	$re .= ( $currentPage > 0 ) 
		? "<td><a href=\"$url=0\">��ҳ</a></td>\n<td><a href=\"$url=".($currentPage-1)."\">��һҳ</a></td>\n" 
		: "<td>��ҳ</td>\n<td>��һҳ</td>\n";
	for ( $i = $currentPage - $halfPer,$i > 0 || $i = 0 ,     $j = $currentPage + $halfPer, $j < $totalPage || $j = $totalPage;$i < $j ;$i++ )
	{
		$re .= $i == $currentPage 
			? "<td><b class=currentPage>[" . ( $i + 1 ) . "]</b></td>\n" 
			: "<td><a href=\"$url=$i\">" . ( $i + 1 ) . "</a></td>\n";
	}
	$re .= ( $currentPage < $total ) 
		? "<td><a href=\"$url=" . ( $currentPage + 1 ) . "\">��һҳ</a></td>\n<td><a href=\"$url=" . ( $total )."\">βҳ</a>\n</td>" 
		: "<td>��һҳ</td>\n<td>βҳ</td>\n";
	$re="<table style=text-align:center><tr>$re</tr></table>";
	return $re;
}

/*

SELECT 
	count(*) AS total 
FROM 
	`tbl`
WHERE 
	`id`='$id'  

////////////////////////////////////////////
SELECT 
	count(*) AS total 
FROM 
	`tbl`
WHERE 
	`id`='$id'  

ORDER BY
	`id` DESC
LIMIT 
	$start,$per
*/
/*
	function getCount ($tbl_name,$where)
	{
		$sql="
			SELECT 
			count(*) AS total 
		FROM 
			`$tbl_name`
		WHERE 
			$where
		";
		$result=$this->query ($sql);
		$row=$this->fetchRow($result);
		return  $row['total'];
	}
	function  getPage ( $tbl_name , $where )
	{
		$total=$this->getCount ($tbl_name,$where);
	}
}*/
?>