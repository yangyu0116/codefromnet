// JavaScript Document
function $(str){
	return document.getElementById(str);
}
var shLeftID = 1;
function hide_show(obj){
	if (shLeftID == 1) {
		window.top.document.getElementById("mainFrame").cols = "13,*";
		document.getElementById("info_tree_left").style.display = "none";
		obj.title = "�����ʾ����";
		shLeftID = 0;
	}
	else
	{
		window.top.document.getElementById("mainFrame").cols = "300,*";
		document.getElementById("info_tree_left").style.display = "block";
		obj.title = "�����������";
		shLeftID = 1;
	}
}
/*����չ������ԭ*/
var ofullscreen = 1;
function fullsrceenRestore() {
	if (ofullscreen == 1){
		window.top.topframeset.rows = "53,*,0";
		document.getElementById("yourPosition").title="˫�����»�ԭ";
		document.getElementById("headTop").style.display="none";
		document.getElementById("fullSrceenImg").title="������»�ԭ";
		document.getElementById("fullSrceenImg").src = "images/main_restore_overicon_portal.gif";
		ofullscreen = 0;
	}
	else {
		window.top.topframeset.rows = "113,*,26";
		document.getElementById("headTop").style.display="";
		document.getElementById("yourPosition").title="˫������չ��";
		document.getElementById("fullSrceenImg").title ="�������չ��";
		document.getElementById("fullSrceenImg").src = "images/fullscreen.gif";
		ofullscreen = 1;
	}
}
/*��꾭���任ͼ��*/
function changeBgImage(status)
{
	var frameCols = window.top.document.getElementById("mainFrame").cols;
	var frameRows = window.top.topframeset.rows;
	if(status==0)
	{	
		if(frameCols == "300,*")
		{
			document.getElementById("hideshow_img").src = "images/hideMouseover.gif";
		}
		else
		{
			document.getElementById("hideshow_img").src = "images/showMouseover.gif";
		}
		return;
	}	
	else if(status == 1)
	{
		if(frameCols == "300,*")
		{
			document.getElementById("hideshow_img").src = "images/hideNormal.gif";	
		}
		else
		{
			document.getElementById("hideshow_img").src = "images/showNormal.gif";
		}
		return;
	}
	else if(status == 2)
	{
		if(frameRows =="113,*,26")
		{
			document.getElementById("fullSrceenImg").src = "images/fullscreenMouseOver.gif";
		}
		else
		{
			document.getElementById("fullSrceenImg").src = "images/main_restore_overicon_portal_MouseOver.gif";
		}
	}
	else
	{
		if(frameRows =="113,*,26")
		{
			document.getElementById("fullSrceenImg").src = "images/fullscreen.gif";
		}
		else
		{
			document.getElementById("fullSrceenImg").src = "images/main_restore_overicon_portal.gif";
		}	
	}
}
/*ѡ�*/
function sortChange(obj,itemContentName,n)
{
	var nav = document.getElementById(obj).getElementsByTagName("li");
	var navLength = nav.length;
	for(i=0; i<navLength; i++){
		nav[i].className = "oldTitle";
	}
	nav[n-1].className = "currentTitle";
	for(i=1;i<4 ;i++){
		document.getElementById(itemContentName+i).style.display = "none";	
	}
	document.getElementById(itemContentName+n).style.display = "block";
}
function setTab(obj,num)
{
	obj.blur();
	for(i=1;i<=9;i++)
	{
		if(i == num)
		{
			document.getElementById("n_"+i).className="curt_nav";
			continue;
		}
		document.getElementById("n_"+i).className="old_nav";
	}
}
//����Ƥ��
function changeSkin(num)
{
	document.getElementById("s_img").src="skinImg\/"+num+".gif";
	document.getElementById("s_href").href="skinImg\/"+num+".gif";
}
//չ��-����
var aa = 0;
function s_h1(obj,div)
{
	if(aa==0)
	{
		obj.src="images/gif-0829.gif";
		obj.alt="�������";
		$(div).style.display="block";
		aa=1;
	}
	else
	{
		obj.src="images/gif-0828.gif";
		obj.alt="���չ��";
		$(div).style.display="none";
		aa=0;
	}
}
//չ��-����
var bb = 0;
function s_h2(obj,div)
{
	if(bb==0)
	{
		obj.src="images/gif-0829.gif";
		obj.alt="�������";
		$(div).style.display="block";
		bb=1;
	}
	else
	{
		obj.src="images/gif-0828.gif";
		obj.alt="���չ��";
		$(div).style.display="none";
		bb=0;
	}
}
//չ��-����
var cc = 0;
function s_h3(obj,div)
{
	if(cc==0)
	{
		obj.src="images/gif-0829.gif";
		obj.alt="�������";
		$(div).style.display="block";
		cc=1;
	}
	else
	{
		obj.src="images/gif-0828.gif";
		obj.alt="���չ��";
		$(div).style.display="none";
		cc=0;
	}
}
//�Զ�ѡ�񸸼���ѡ��
function selParent(obj,ckbox)
{
	if(obj.checked)
		document.getElementById(ckbox).checked = true;
}
//��ʾƤ��ѡ���б�
function showSkinList()
{
	alert("aaa");
	document.getElementById("skinList").style.display="block";
}
//Ƥ��ѡ��
function skin(cssName)
{
	document.getElementById("skinStyle").href = "style/"+cssName;
	document.getElementById("skinList").style.display="none";
}