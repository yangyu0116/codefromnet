<?
//-----------------test ---------------------
$totalPage		= 100 ;					//总分页数量
$currentPage	= @$_GET['page']+0;		//当前页码
$url				= "?page";				//分而链接
$halfPer			= 10;						//二分之一的每页的信息数
$imagePath		="images";				//分页图片目录
$pageHtml		= page ( $totalPage , $currentPage,$url ,$halfPer,$imagePath);//调用分页函数
echo $pageHtml ;
/**************************************************************************************************
程序作者 : 
	朱武杰 ( 纯粹误会  phpyy@msn.com ,QQ:44922032)
完成时间 :
	2005-9-7
函数功能 :
	分页输出
必选参数 :
	totalPage 总分页数量
	currentPage 当前页码
	url 分页链接
可选参数 :
	halfPer 二分之一的每页的信息数
******************************************************************************************************/
function page ( $totalPage , $currentPage,$url ,$halfPer=5)
{
	$total=$totalPage-1;
	$re="<td><a href=\"$url\" onclick=\"page=prompt('共{$totalPage}页\\n自定义跳转到第几页：','');if(page>0&&page<$total)location.href=this.href+'='+(page-1);return false\">跳转</a></td>\n";
	$re .= ( $currentPage > 0 ) 
		? "<td><a href=\"$url=0\">首页</a></td>\n<td><a href=\"$url=".($currentPage-1)."\">上一页</a></td>\n" 
		: "<td>首页</td>\n<td>上一页</td>\n";
	for ( $i = $currentPage - $halfPer,$i > 0 || $i = 0 ,     $j = $currentPage + $halfPer, $j < $totalPage || $j = $totalPage;$i < $j ;$i++ )
	{
		$re .= $i == $currentPage 
			? "<td><b class=currentPage>[" . ( $i + 1 ) . "]</b></td>\n" 
			: "<td><a href=\"$url=$i\">" . ( $i + 1 ) . "</a></td>\n";
	}
	$re .= ( $currentPage < $total ) 
		? "<td><a href=\"$url=" . ( $currentPage + 1 ) . "\">下一页</a></td>\n<td><a href=\"$url=" . ( $total )."\">尾页</a>\n</td>" 
		: "<td>下一页</td>\n<td>尾页</td>\n";
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