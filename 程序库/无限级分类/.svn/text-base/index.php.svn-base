<?
include("./func.php"); //载入函数集,数据库信息在conn.php里改
?>   
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无限级分类演示</title>
<script language="javascript" type="text/javascript">
        function showhidden(id){
                //alert(bottom);
                var div_hidden = "div"+id;
                var img_show = "img"+id;
                if(getid(div_hidden).style.display == "none"){
                        getid(div_hidden).style.display = "block";                        
                        getid(img_show).src = "./jian.jpg";
                }else{
                        getid(div_hidden).style.display = "none";
                        getid(img_show).src = "./jia.jpg";
                }
        }
        function getid(input_name){
                return document.getElementById(input_name);        
        }  
</script>
<style>
body{
        BACKGROUND: #FEFEFE no-repeat right bottom;
        FONT-FAMILY: 'Lucida Grande','Lucida Sans Unicode','宋体','新宋体',arial,verdana,sans-serif;
        COLOR: #666;
        FONT-SIZE:13px;
        LINE-HEIGHT:140%;
        padding:0px;
}
a.menu:hover{
        background-color:#B5DAFB;
        border:1px solid #0066CC;
}
a.menu,a.menu:visited{
        text-decoration : none;
        COLOR: #666;
}

</style>
</head>
<body>
<b>分类列表</b>
<div>
<?
showmenu(); //显示无限级菜单                                      
?>
<hr />
<p>说明:显示菜单使用递归函数,js代码部分参考了phpchina上的文章.conn.php是数据库类,func.php是函数集,index.php是菜单显示,admin.php包含发表文章,添加分类,修改分类,删除分类等功能,已经解决所知的数据一致性问题.</p>
<p>这种无限级分类的思路网络上很多,本演示只是更进一步演示如何应用到实际的系统中.</p>
<p>参考文章:<a href='http://www.phpchina.com/bbs/viewthread.php?tid=25245' target="_blank">http://www.phpchina.com/bbs/viewthread.php?tid=25245</a> (wangyl <span 
class="smalltxt">(['磊'])</span>)</p>
<p> <a href="http://www.phpchina.com/12823/viewspace_4468.html" target="_blank">http://www.phpchina.com/12823/viewspace_4468.html</a> ( <strong>kukat</strong>) </p>
<p>安装说明:建立menu数据库,将menu.sql文件导入.自己修改conn.php的数据库参数,其他没啥好说的了</p>
</div>
</body>
</html>
