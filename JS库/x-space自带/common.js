/******************************************************************************
  SupeSite/X-Sapce - common js for SS/XS
  Copyright 2001-2006 Comsenz Inc. (http://www.comsenz.com)
*******************************************************************************/
function getbyid(id) {
	if (document.getElementById) {
		return document.getElementById(id);
	} else if (document.all) {
		return document.all[id];
	} else if (document.layers) {
		return document.layers[id];
	} else {
		return null;
	}
}

function getTipDiv(e) {
	if(getbyid("xspace-tipDiv")) {
		divElement = getbyid("xspace-tipDiv");
	} else {
		var divElement = document.createElement("DIV");
		divElement.id = "xspace-tipDiv";
		document.body.appendChild(divElement);
	}
	divElement.className = "xspace-ajaxdiv";
	divElement.style.cssText = "width:400px;";
		
	var offX = 4;
	var offY = 4;
	var width = 0;
	var height = 0;
	var scrollX = 0;
	var scrollY = 0;  
	var x = 0;
	var y = 0;
		
	if (window.innerWidth) width = window.innerWidth - 18;
	else if (document.documentElement && document.documentElement.clientWidth) 
		width = document.documentElement.clientWidth;
	else if (document.body && document.body.clientWidth) 
		width = document.body.clientWidth;
		
	
	if (window.innerHeight) height = window.innerHeight - 18;
	else if (document.documentElement && document.documentElement.clientHeight) 
		height = document.documentElement.clientHeight;
	else if (document.body && document.body.clientHeight) 
		height = document.body.clientHeight;
	

	if (typeof window.pageXOffset == "number") scrollX = window.pageXOffset;
	else if (document.documentElement && document.documentElement.scrollLeft)
		scrollX = document.documentElement.scrollLeft;
	else if (document.body && document.body.scrollLeft) 
		scrollX = document.body.scrollLeft; 
	else if (window.scrollX) scrollX = window.scrollX;
				
	  
	if (typeof window.pageYOffset == "number") scrollY = window.pageYOffset;
	else if (document.documentElement && document.documentElement.scrollTop)
		scrollY = document.documentElement.scrollTop;
	else if (document.body && document.body.scrollTop) 
		scrollY = document.body.scrollTop; 
	else if (window.scrollY) scrollY = window.scrollY;
		
	x=e.pageX?e.pageX:e.clientX+scrollX;
	y=e.pageY?e.pageY:e.clientY+scrollY;

	if(x+divElement.offsetWidth+offX>width+scrollX){
		x=x-divElement.offsetWidth-offX;
		if(x<0)x=0;
	}else x=x+offX;
	if(y+divElement.offsetHeight+offY>height+scrollY){
		y=y-divElement.offsetHeight-offY;
		if(y<scrollY)y=height+scrollY-divElement.offsetHeight;
	}else y=y+offY;

	divElement.style.left = x+"px";
	divElement.style.top = y+"px";
	
}

function tagshow(e, tagname) {

	getTipDiv(e);
	var x = new Ajax('statusid', 'XML');
		
	x.get(siteUrl+'/batch.tagshow.php?tagname='+tagname, function(s){
		divElement = getbyid("xspace-tipDiv");
		divElement.innerHTML = s.lastChild.firstChild.nodeValue;
	});
}

function joinfriend(uid) {
	var x = new Ajax('statusid', 'XML');
		
	x.get(siteUrl+'/batch.common.php?action=joinfriend&uid='+uid, function(s){
		alert(s.lastChild.firstChild.nodeValue);
	});
}

function deletetrack(itemid) {
	var x = new Ajax('statusid', 'XML');

	x.get(siteUrl+'/batch.track.php?action=delete&itemid='+itemid, function(s){
		alert(s.lastChild.firstChild.nodeValue);
	});
}

function taghide() {
	var tip = getbyid("xspace-tipDiv");
	tip.style.display = 'none';
}

function addFirstTag() {
	var lists=new Array;
	lists=document.getElementsByTagName('ul');
	for(i=0;i<lists.length;i++){
		lists[i].firstChild.className+=' first-child';
	}
}

function setTab(area,id) {
	var tabArea=document.getElementById(area);

	var contents=tabArea.childNodes;
	for(i=0; i<contents.length; i++) {
		if(contents[i].className=='tabcontent'){contents[i].style.display='none';}
	}
	document.getElementById(id).style.display='';

	var tabs=document.getElementById(area+'tabs').getElementsByTagName('span');
	for(i=0; i<tabs.length; i++) { tabs[i].className=''; }
	document.getElementById(id+'tab').className='active';
}

function ColExpIntro(obj) {
	var thisIntro=obj.parentNode.getElementsByTagName('p')[0];
	if(thisIntro.style.display=='none'){
		thisIntro.style.display='';
	}else{
		thisIntro.style.display='none';
	}
}
function ColExpAllIntro(obj) {
	var ctrlText=document.getElementById('ColExpAllIntroText');
	var Intros=obj.parentNode.parentNode.getElementsByTagName('p');
	if(ctrlText.innerHTML=='显示摘要'){
		ctrlText.innerHTML='隐藏摘要';
		for(i=0;i<Intros.length;i++){
			Intros[i].style.display='';
		}
	}else{
		ctrlText.innerHTML='显示摘要';
		for(i=0;i<Intros.length;i++){
			Intros[i].style.display='none';
		}
	}
}

function OpenWindow(url, winName, width, height) {
	xposition=0; yposition=0;
	if ((parseInt(navigator.appVersion) >= 4 )) {
		xposition = (screen.width - width) / 2;
		yposition = (screen.height - height) / 2;
	}
	theproperty= "width=" + width + ","
	+ "height=" + height + ","
	+ "location=0,"
	+ "menubar=0,"
	+ "resizable=1,"
	+ "scrollbars=1,"
	+ "status=0,"
	+ "titlebar=0,"
	+ "toolbar=0,"
	+ "hotkeys=0,"
	+ "screenx=" + xposition + "," //仅适用于Netscape
	+ "screeny=" + yposition + "," //仅适用于Netscape
	+ "left=" + xposition + "," //IE
	+ "top=" + yposition; //IE 
	window.open(url, winName, theproperty);
}

function joinfavorite(itemid) {
	var x = new Ajax('statusid', 'XML');
	x.get(siteUrl + '/batch.common.php?action=joinfavorite&itemid='+itemid, function(s) {
		alert(s.lastChild.firstChild.nodeValue);
	});
}

function showajaxdiv(action, url, width) {
	var x = new Ajax('statusid', 'XML');
	x.get(url, function(s) {
		if(getbyid("xspace-ajax-div-"+action)) {
			var divElement = getbyid("xspace-ajax-div-"+action);
		} else {
			var divElement = document.createElement("DIV");
			divElement.id = "xspace-ajax-div-"+action;
			divElement.className = "xspace-ajaxdiv";
			document.body.appendChild(divElement);
		}
		divElement.style.cssText = "width:"+width+"px;";
		var userAgent = navigator.userAgent.toLowerCase();
		var is_opera = (userAgent.indexOf('opera') != -1);
		var clientHeight = scrollTop = 0; 
		if(is_opera) {
			clientHeight = document.body.clientHeight /2;
			scrollTop = document.body.scrollTop;
		} else {
			clientHeight = document.documentElement.clientHeight /2;
			scrollTop = document.documentElement.scrollTop;
		}
		divElement.innerHTML = s.lastChild.firstChild.nodeValue;
		divElement.style.left = (document.documentElement.clientWidth /2 +document.documentElement.scrollLeft - width/2)+"px";
		divElement.style.top = (clientHeight +　scrollTop - divElement.clientHeight/2)+"px";
		
	});	
}


function getMsg() {
	if (GetCookie('readMsg')!='1') {
		var msgDiv = document.createElement('div');
		msgDiv.id = 'xspace-sitemsg';
		msgDiv.innerHTML = "<h6><a href='javascript:;' onclick='closeMsg();' class='xspace-close'>关闭</a>公告:</h6><div>"+siteMsg+"<p class='xspace-more'><a href='"+siteUrl+"/index.php?action_announcement' target='_blank'>MORE</a></p></div>";
		document.body.insertBefore(msgDiv,document.body.firstChild);
		
		showMsg();
	}
}
function floatMsg() {
	window.onscroll = function() {
		document.getElementById('xspace-sitemsg').style.bottom = '10px';
		document.getElementById('xspace-sitemsg').style.background = '#EEF0F6';
	}
}
function showMsg() {
	var vh = document.getElementById('xspace-sitemsg').style.bottom;
	if (vh=='') {vh='-180px'}
	var vhLen = vh.length-2;
	var vhNum = parseInt(vh.substring(0,vhLen));
	
	if (vhNum<10) {
		document.getElementById('xspace-sitemsg').style.bottom = (vhNum+5)+'px';
		showvotetime = setTimeout("showMsg()",1);
	} else {
		floatMsg();
	}
}
function closeMsg() {
	document.getElementById('xspace-sitemsg').style.display = 'none';
	CreatCookie('readMsg','1');
}


/*Cookie操作*/
function CreatCookie(sName,sValue){
	var expires = function(){ //Cookie保留时间
		var mydate = new Date();
		mydate.setTime(mydate.getTime + 3*30*24*60*60*1000);
		return mydate.toGMTString();
	}
	document.cookie = sName + "=" + sValue + ";expires=" + expires;
}
function GetCookieVal(offset) {//获得Cookie解码后的值
	var endstr = document.cookie.indexOf (";", offset);
	if (endstr == -1)
	endstr = document.cookie.length;
	return unescape(document.cookie.substring(offset, endstr));
}
function GetCookie(sName) {//获得Cookie
	var arg = sName + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while (i < clen)
	{
		var j = i + alen;
		if (document.cookie.substring(i, j) == arg)
		return GetCookieVal (j);
		i = document.cookie.indexOf(" ", i) + 1;
		if (i == 0) break;
	}
	return null;
}

function DelCookie(sName,sValue){ //删除Cookie
	document.cookie = sName + "=" + escape(sValue) + ";expires=Fri, 31 Dec 1999 23:59:59 GMT;";
}

//显示工具条
function hidetoolbar() {
	window.parent.document.getElementById("toolbarframe").style.display="none";
}
function showtoolbar() {
	document.getElementById("toolbarframe").style.display = "block";
}
function mngLink(obj) {
	var wrap = window.parent.document.getElementById('wrap');
	if(wrap == null) {
		alert('本按钮仅对拖拽模板有效！');
		return false;
	}
	if (wrap.className=='') {
		wrap.className = 'hidemnglink';
		obj.innerHTML = '显示编辑按钮';
	} else {
		wrap.className = '';
		obj.innerHTML = '隐藏编辑按钮';
	}
}

//复制URL地址
function setCopy(_sTxt){
	if(navigator.userAgent.toLowerCase().indexOf('ie') > -1) {
		clipboardData.setData('Text',_sTxt);
		alert ("网址“"+_sTxt+"”\n已经复制到您的剪贴板中\n您可以使用Ctrl+V快捷键粘贴到需要的地方");
	} else {
		prompt("请复制网站地址:",_sTxt); 
	}
}

//加入收藏
function addBookmark(site, url){
	if(navigator.userAgent.toLowerCase().indexOf('ie') > -1) {
		window.external.addFavorite(url,site)
	} else if (navigator.userAgent.toLowerCase().indexOf('opera') > -1) {
		alert ("请使用Ctrl+T将本页加入收藏夹");
	} else {
		alert ("请使用Ctrl+D将本页加入收藏夹");
	}
}

//评分
function setRate(value) {
	getbyid('xspace-ratevalue').value = value;
	getbyid('xspace-rates').className = 'xspace-rates'+value;
}

function adclick(id) {
	var x = new Ajax('statusid', 'XML');
	x.get(siteUrl + '/batch.common.php?action=adclick&id='+id, function(s){});
}
function display(id) {
	dobj = getbyid(id);
	if(dobj.style.display == 'none' || dobj.style.display == '') {
		dobj.style.display = 'block';
	} else {
		dobj.style.display = 'none';
	}
}


//显示隐藏媒体
function addMediaAction(div) {
	var medias = getbyid(div).getElementsByTagName('kbd');
	for (i=0;i<medias.length;i++) {
		if(medias[i].className=='showvideo' || medias[i].className=='showflash') {
			medias[i].onclick = function() {showmedia(this,400,400)};
		}
	}
}
function showmedia(Obj, mWidth, mHeight) {
	var mediaStr, smFile;
	if ( Obj.tagName.toLowerCase()=='a' ) { smFile = Obj.href; } else { smFile = Obj.title; }
	var smFileType = Obj.className.toLowerCase();

	switch(smFileType){
		case "showflash":
			mediaStr="<p style='text-align: right; margin: 0.3em 0; width: 400px;'>[<a href='"+smFile+"' target='_blank'>全屏观看</a>]</p><object codeBase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='400' height='260'><param name='movie' value='"+smFile+"'><param name='quality' value='high'><param name='AllowScriptAccess' value='never'><embed src='"+smFile+"' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='400' height='260'></embed></OBJECT>";
			break;
		case "showvideo":
			mediaStr="<object width='400' classid='CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6'><param name='url' value='"+smFile+"' /><embed width='400' type='application/x-mplayer2' src='"+smFile+"'></embed></object>";
	}
	
	var mediaDiv = document.getElementById(escape(smFile.toLowerCase()));
	
	if (mediaDiv) {
		Obj.parentNode.removeChild(mediaDiv);
	} else {
		mediaDiv = document.createElement("div");
		mediaDiv.id = escape(smFile.toLowerCase());
		mediaDiv.innerHTML = mediaStr;
		Obj.parentNode.insertBefore(mediaDiv,Obj.nextSibling);
	}
	return false;
}

//改变文章字体大小
function doZoom(size) {
	getbyid('articlebody').style.fontSize = size+'px';
}
//打印
function doPrint(){
	var csslink = document.getElementsByTagName('link');
	for (i=0; i<csslink.length; i++) {
		if (csslink[i].rel=='stylesheet') {
			csslink[i].disabled=true;
		}
	}

	printCSS = document.createElement("link");
	printCSS.id = 'printcss';
	printCSS.type = 'text/css';
	printCSS.rel = 'stylesheet';
	printCSS.href = siteUrl+'/css/print.css';
	
	var docHead = document.getElementsByTagName('head')[0];
	var mainCSS = csslink[0];
	docHead.insertBefore(printCSS,mainCSS);
	
	var articleTitle = document.getElementsByTagName('h1')[0];
	var cancelPrint = document.createElement("p");
	cancelPrint.id = 'cancelPrint';
	cancelPrint.style.textAlign = 'right';
	cancelPrint.innerHTML = "<a href='javascript:cancelPrint();' target='_self'>返回</a>&nbsp;&nbsp;<a href='javascript:window.print();' target='_self>打印</a>";
	getbyid('articledetail').insertBefore(cancelPrint,articleTitle);
	
	window.print();
}
function cancelPrint() {
	if (printCSS) {
		document.getElementsByTagName('head')[0].removeChild(printCSS);
	}
	
	var csslink = document.getElementsByTagName('link');
	for (i=0; i<csslink.length; i++) {
		if (csslink[i].rel=='stylesheet') {
			csslink[i].disabled=false;
		}
	}

	if (getbyid('cancelPrint')) {
		getbyid('articledetail').removeChild(getbyid('cancelPrint'));
	} 
}

//添加文章中的图片链接
function addImgLink(divID) {
	var msgarea = getbyid(divID);
	var imgs = msgarea.getElementsByTagName('img');
	for (i=0; i<imgs.length; i++) {
		if (imgs[i].parentNode.tagName.toLowerCase() != 'a') {
			imgs[i].title = '点击图片可在新窗口打开';
			imgs[i].style.cursor = 'pointer';
			imgs[i].onclick = function() { window.open(this.src); }
		}
	}
}
