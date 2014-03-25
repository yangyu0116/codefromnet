/**
 * @author FlashSoft
 */
function JsLoader(){
	this.load = function(url, charset){
		var ss = document.getElementsByTagName("script");
		for(var i = 0;i < ss.length; i++){
			if(ss[i].src && ss[i].src.indexOf(url) != -1) {
				this.onsuccess();
				return;
			}
		}
		var s = document.createElement("script");
		s.type= "text/javascript";
		s.src = url;
		s.charset = charset ? charset : "utf-8";
		var head = document.getElementsByTagName("head")[0];
		head.appendChild(s);

		
		var self = this;
		s.onload = s.onreadystatechange = function() {
			if(this.readyState && this.readyState == "loading")return;
			self.onsuccess();
		}
		s.onerror = function() {
			head.removeChild(s);
			self.onfailure();
		}
	};
	this.onsuccess=function(){};
	this.onfailure=function(){};
}

document.write('<style>\
.BusinessCardDIV * {color:#5D5D5D;;line-height: 14px;font-size: 12px;font-family:"宋体";}\
.BusinessCardDIV a:hover{color:#FF0000;text-decoration:underline;}\
.BusinessCardDIV a {color:#7569BF;}\
</style>');
function getPageSize() {
	var xScroll, yScroll;
	
	if (window.innerHeight && window.scrollMaxY) {	
		xScroll = document.body.scrollWidth;
		yScroll = window.innerHeight + window.scrollMaxY;
	}
	else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	}
	else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}
	
	var windowWidth, windowHeight;
	if (self.innerHeight) {	// all except Explorer
		windowWidth = self.innerWidth;
		windowHeight = self.innerHeight;
	}
	else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	}
	else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}	
	
	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	}
	else { 
		pageHeight = yScroll;
	}

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){	
		pageWidth = windowWidth;
	}
	else {
		pageWidth = xScroll;
	}

	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight) 
	return arrayPageSize;
}
function addHTML(oParentNode, sHTML) {
	if(window.addEventListener) {// for MOZ
		var oRange = oParentNode.ownerDocument.createRange();
		oRange.setStartBefore(oParentNode);
		var oFrag = oRange.createContextualFragment(sHTML);
		oParentNode.appendChild(oFrag);
	}
	else {// for IE5+
		oParentNode.insertAdjacentHTML("BeforeEnd", sHTML);
	}
}
var bcDialog = {};
bcDialog.show = function (sURL, nWidth, nHeight) {
	var pageSize = getPageSize();
	document.getElementById("bcDialogFrameBox").innerHTML = '<iframe id="bcDialogFrame" style="position:absolute; top: 0px; left: 0px;" frameBorder="0" scrolling="no">';
	document.getElementById("bcDialogBox").style.display = "";
	document.getElementById("bcDialogShadow").style.width = pageSize[0];
	document.getElementById("bcDialogShadow").style.height = pageSize[1];
	document.getElementById("bcDialogFrame").style.left	= (pageSize[0] - nWidth)/2;
	document.getElementById("bcDialogFrame").style.top	= document.body.scrollTop + (pageSize[3] - nHeight) / 2;
	document.getElementById("bcDialogFrame").style.width = nWidth;
	document.getElementById("bcDialogFrame").style.height = nHeight;
	document.getElementById("bcDialogFrame").contentWindow.document.location = sURL;

};

bcDialog.show2 = function (sURL, nWidth, nHeight) {
	var bcwin = window.open(sURL, "bc_window","resizable=no, location=yes, status=yes, width=" + nWidth + ", height=" + nHeight + ", left=" + (window.screen.availWidth - nWidth) / 2 + ", top="+(window.screen.availHeight - nHeight) / 2+", location=no");
};
bcDialog.hidden = function () {
	document.getElementById("bcDialogBox").style.display = "none";
}
bcDialog.create = function () {
	var str = '\
		<div style="position:absolute; background:#000; top: 0px; left: 0px;display:none;" id="bcDialogBox" onclick="bc.rtn(event);">\
			<div style="position:absolute; background:#000; top: 0px; left: 0px; filter:alpha(opacity=20);-moz-opacity:0.2;opacity: 0.2;" id="bcDialogShadow"></div>\
			<div id="bcDialogFrameBox"></iframe></div>\
		</div>\
	';
	addHTML(document.body, str);
}
bcDialog.reSize = function (nWidth, nHeight) {
	var pageSize = getPageSize();
	document.getElementById("bcDialogFrame").style.left	= (pageSize[0] - nWidth)/2;
	document.getElementById("bcDialogFrame").style.top	= document.body.scrollTop + (pageSize[3] - nHeight) / 2;
	document.getElementById("bcDialogFrame").style.width = nWidth;
	document.getElementById("bcDialogFrame").style.height = nHeight;
}

var card_data;
function BusinessCard() {
	var _this = this;
	var isLoad = true;
	var timer;
	var udata;
	var bcHome, bcName,bcNick,bcPhoto,bcFLD,bcSED,bcDIV,CT1,CT2,CT3,CT4,bcB,bcV,bcB2,bcQ,bcP;
	var sAction = null;
	var showMode = false;
	var uid = null;
	this.createLog = function (csAction) {
		sAction = sAction != "" && sAction != null ? sAction : "error";
		csAction = csAction != "" && csAction != null ? csAction : "error";
		
		addHTML(document.body, "<img style='display: none;' src='http://stat.blog.sina.com.cn/i.html?card&" + sAction + "&" + csAction + "&" + new Date().valueOf() + "'>");
		sAction = null;
		csAction = null;
		//alert();
		return false;
	};
	this.create = function () {
		var sBC = '\
		<div style="position:absolute;left:0px;top:0px;display:none;" id="BusinessCardDIV" onclick="bc.rtn(event)" class="BusinessCardDIV">\
		<div style="position:absolute;left:4px;top:4px; width: 310px; height: 160px; background:#000;filter: alpha(opacity=10);-moz-opacity: 0.1;"></div>\
		<div style="position:absolute; width: 310px; height: 160px;"><img src="http://image2.sina.com.cn/blog/tmpl/v3/images/datong/card/bg.gif" onerror="this.src=this.src"/></div>\
		<table width="310" height="160" border="0" cellpadding="0" cellspacing="0" style="position:absolute;left:0px;top:0px;">\
		<tr>\
		<td width="70" height="138"><table width="100%" height="138" border="0" cellpadding="0" cellspacing="0">\
		<tr>\
		<td height="10"><img width="1" height="1" /></td>\
		</tr>\
		<tr>\
		<td height="60" align="right"><a id="BusinessCardPhotoLink" target="_blank" onclick="bc.createLog(\'headpic\');"><img src="http://image2.sina.com.cn/blog/tmpl/v3/images/default_icon.jpg" alt="用户头像" width="60" height="60" id="BusinessCardPhoto" border="0"/></a></td>\
		</tr>\
		<tr>\
		<td align="right" valign="top" style="padding-top: 7px; padding-right: 3px; color: #7469bd;"><a href="javascript:void(0);" onclick="bc.createLog(\'home\');" target="_blank" id="BusinessCardHome" target="_blank">进入主页</a></td>\
		</tr>\
		</table></td>\
		<td width="15">&nbsp;</td>\
		<td width="215"><table width="100%" height="138" border="0" cellpadding="0" cellspacing="0">\
		<tr>\
		<td height="10"><img width="1" height="1" /></td>\
		</tr>\
		<tr>\
		<td height="30"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">\
		<tr>\
		<td width="206" valign="top" style="padding-left: 2px;" id="BusinessCardNick">读取中……</td>\
		<td width="9" valign="top"><a href="javascript:void(0)" id="BusinessCardClose"><img border="0" src="http://image2.sina.com.cn/blog/tmpl/v3/images/datong/card/close.gif" alt="关闭" width="9" height="9" onclick="bc.hidden();"></a></td>\
		</tr>\
		<tr>\
		<td colspan="2" valign="bottom" style="padding-left: 2px;" id="BusinessCardName">读取中……</td>\
		</tr>\
		</table></td>\
		</tr>\
		<tr>\
		<td height="13">&nbsp;</td>\
		</tr>\
		<tr>\
		<td height="65">\
		<table width="100%" height="65" border="0" cellpadding="0" cellspacing="0" class="BusinessCardDIVBlue">\
		<tr>\
		<td width="160" height="70" valign="top">\
		<div id="BusinessCardCT1" style="display: none;" style="color:#7e7e7e;"></div>\
		<div id="BusinessCardCT2" style="display: none;">读取中……</div>\
		<div id="BusinessCardCT3" style="display: none;">读取中……</div>\
		<div id="BusinessCardCT4" style="display: none;">读取中……</div>\
		</td>\
		<td width="55" align="right" valign="bottom"><a href="javascript:void(0)" id="BusinessCardFLD" style="display: none;" onclick="bc.createLog();"><img src="http://image2.sina.com.cn/blog/tmpl/v3/images/datong/card/friend_invite.gif" alt="加为好友" width="50" height="17" border="0"></a><br /><a href="javascript:void(0)" onclick="bc.createLog();" id="BusinessCardSend" style="display: none;"><img src="http://image2.sina.com.cn/blog/tmpl/v3/images/datong/card/send.gif" alt="发纸条" width="50" height="17" style="margin-top: 5px;" border="0"></a></td>\
		</tr>\
		</table></td>\
		</tr>\
		<tr>\
		<td>&nbsp;</td>\
		</tr>\
		</table></td>\
		<td>&nbsp;</td>\
		</tr>\
		<tr>\
		<td colspan="4" align="center" valign="top" style="color: #7469bd;"><a href="javascript:void(0)" id="BusinessCardLinkB" onclick="bc.createLog(\'home2\');" target="_blank">博客</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0)" onclick="bc.createLog(\'otherpr\');" id="BusinessCardLinkV" target="_blank">播客</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0)" id="BusinessCardLinkB2" target="_blank" onclick="bc.createLog(\'otherpr\');">论坛</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0)" id="BusinessCardLinkQ" target="_blank" onclick="bc.createLog(\'otherpr\');">圈子</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0)" id="BusinessCardLinkP" target="_blank" onclick="bc.createLog(\'otherpr\');">相册</a></td>\
		</tr>\
		</table>\
		</div>\
		';
		addHTML(document.body, sBC);

		bcClose = document.getElementById("BusinessCardClose");
		bcHome = document.getElementById("BusinessCardHome");
		
		bcName = document.getElementById("BusinessCardName");
		bcNick = document.getElementById("BusinessCardNick");
		bcPhoto = document.getElementById("BusinessCardPhoto");
		bcPhotoA = document.getElementById("BusinessCardPhotoLink");
		
		
		bcFLD = document.getElementById("BusinessCardFLD");
		bcSED = document.getElementById("BusinessCardSend");

		bcDIV = document.getElementById("BusinessCardDIV");
		CT1 = document.getElementById("BusinessCardCT1");
		CT2 = document.getElementById("BusinessCardCT2");
		CT3 = document.getElementById("BusinessCardCT3");
		CT4 = document.getElementById("BusinessCardCT4");

		bcB = document.getElementById("BusinessCardLinkB");
		bcV = document.getElementById("BusinessCardLinkV");
		bcB2 = document.getElementById("BusinessCardLinkB2");
		bcQ = document.getElementById("BusinessCardLinkQ");
		bcP = document.getElementById("BusinessCardLinkP");

	}
	this.rtn = function (e) {
		if(e.stopPropagation) {
			e.stopPropagation();
		}
		else {
			e.cancelBubble = true;
		}
	}
	this.hidden = function () {
		bcDIV.style.display = "none";
		clearInterval(timer);
	}
	this.show = function (u, e, f, a) {
		uid = u;
		showMode = false;
		sAction = a;
		var pageSize = getPageSize();
		bcNick.innerHTML = "读取中……";
		bcName.innerHTML = "读取中……";
		bcPhoto.src = "http://image2.sina.com.cn/blog/tmpl/v3/images/default_icon.jpg";
		bcSED.style.display = "none";
		bcFLD.style.display = "none";
		bcHome.style.display = "none";
		bcB.href = "http://blog.sina.com.cn/u/" + u;
		bcV.href = "http://you.video.sina.com.cn/m/" + u;
		bcB2.href = "http://bbs.service.sina.com.cn/forum/disprofile.php?uid=" + u;
		bcQ.href = "http://q.sina.com.cn/mygroup.php?uid=" + u;
		bcP.href = "http://photo.sina.com.cn/u/" + u;

		bcClose.style.display = e == 0 ? "none" : "";


		bcDIV.style.display = "";
		var fL, fT;
		
		var x, y, w, h, ox, oy;
		if(f && f.frameElement) {
			elem = f.frameElement;
			pos = [elem.offsetLeft, elem.offsetTop];
			parentNode = elem.offsetParent;
			if (parentNode != elem) {
				while (parentNode) {
					 pos[0] += parentNode.offsetLeft;
					 pos[1] += parentNode.offsetTop;
					 parentNode = parentNode.offsetParent;
				}
			}
			fL = pos[0] - document.body.scrollLeft;
			fT = pos[1] - document.body.scrollTop;
			
			x = e == 0 ? 0 : e.clientX + fL;
			y = e == 0 ? 0 : e.clientY + fT;

		}
		else {
			fT = fL = 0;
			x = e == 0 ? 0 : e.clientX;
			y = e == 0 ? 0 : e.clientY;
		}

		ox = pageSize[2];
		oy = pageSize[3];

		if(x > ox || y > oy)return false;

		w = 310;
		h = 160;

		if((x + w) > ox) x = x - w;
		if((y + h) > oy) y = y - h;

		//alert("y:" + y + "\nscrollTop:" + document.body.scrollTop + "\nframeTop:" + fT + "\nframeOffsetTop:" + f.frameElement.offsetTop);
		bcDIV.style.left = (x + document.body.scrollLeft + 3) + "px";
		bcDIV.style.top = (y + document.body.scrollTop + 3) + "px";
		

		this.rtn(e);

		CT1.style.display = CT2.style.display = CT3.style.display = CT4.style.display = "none";
		if(isLoad == true) {
			CT3.style.display = "";
		}
		var timeoutNum = 4; // 超期时间[单位秒]

		var t = 0;
		card_data = null;
		var jl = new JsLoader();
		jl.onsuccess = function(){
			if(window["card_data"] != null) {
				_this.writeData(e);
			}
			else {
				this.onfailure();
			}
		}
		jl.onfailure = function(){
			CT4.style.display = CT2.style.display = CT3.style.display = CT1.style.display = "none";
			if(isLoad == true) {
				CT4.style.display = "";
			}
		}
		jl.load("http://util.blog.sina.com.cn/ui?t=c&" + u + "&" + new Date().valueOf(), "gb2312");
		//jl.load("d.js?t=c&" + u + "&" + new Date().valueOf(), "gb2312");
	
		return false;
	}
	this.show2 = function (u, e, f, a) {
		this.show(u, e, f, a);
		showMode = true;
	}
	this.writeData = function (e) {
		if(card_data.length > 0) {// 有数据时候
			var udata = card_data[0];
			if(udata["url"] != "") {// 产品用户
				bcHome.href = "http://blog.sina.com.cn/" + udata["url"];
				bcNick.innerHTML = "昵&nbsp;&nbsp;&nbsp;&nbsp;称<b>:</b>&nbsp;<b><a  onclick='bc.createLog(\"nick\");' style='color:#5D5D5D;' target='_blank' href='http://blog.sina.com.cn/" + udata["url"] + "'>" + udata["nick"] + "</a></b>";
				bcPhotoA.href = "http://blog.sina.com.cn/" + udata["url"];
				bcName.innerHTML = "会员编码<b>:</b>&nbsp;<b><a onclick='bc.createLog(\"loginname\");' style='color:#5D5D5D;' target='_blank' href='http://blog.sina.com.cn/u/" + udata["uid"] + "'>" + udata["uid"] + "</a></b>";
				bcPhoto.src = udata["photo"] == "" ? "http://image2.sina.com.cn/blog/tmpl/v3/images/default_icon.jpg" :"http://upic.album.sina.com.cn/pic_4/" + udata["photo"];
				bcPhoto.alt = udata["nick"] + "的博客";


				if(e == 0) {
					bcFLD.style.display = "none";
				}
				else {
					
					bcFLD.style.display = "";
				}
				bcSED.style.display = "";
				bcHome.style.display = "";

//				bcB.href = "http://blog.sina.com.cn/u/" + udata["uid"];
//				bcV.href = "http://v.blog.sina.com.cn/m/" + udata["uid"];
//				bcB2.href = "http://bbs.service.sina.com.cn/forum/disprofile.php?uid=" + udata["uid"];
//				bcQ.href = "http://q.sina.com.cn/mygroup.php?uid=" + udata["uid"];
				//bcP.href = "" + udata["uid"];

				
				bcSED.onclick = function () {
					if(e == 0) {
						//window.location = "http://v35.blog.sina.com.cn/myblog/message/send_message_mail.php?toid=" + udata["uid"];
						
					}
					if(showMode) {
						bcDialog.show2("http://v35.blog.sina.com.cn/myblog/message/send_message.php?toid=" + udata["uid"], 278, 100);
						bc.hidden();
					}
					else {
						bcDialog.show("http://v35.blog.sina.com.cn/myblog/message/send_message.php?toid=" + udata["uid"], 278, 100);
						bc.hidden();
					}
				}
				bcFLD.onclick = function () {
					if(e == 0) {}
					if(showMode) {
						bcDialog.show2("http://v35.blog.sina.com.cn/control/friend/add_friend.php?opid=" + udata["uid"], 278, 258);
						bc.hidden();
					}
					else {
						bcDialog.show("http://v35.blog.sina.com.cn/control/friend/add_friend.php?opid=" + udata["uid"], 278, 258);
						bc.hidden();
					}
				}
				
				// 读取文章
				var nPage = udata.article;
				var str = '最新文章更新:\
					<table width="160" border="0" cellspacing="0" cellpadding="0">\
					';
				for(var i = 0; i < nPage.length; i ++ ) {
					var sSplit = nPage[i].name.split("|");
					var sTxt = "";
					var sTxt2 = "";
					if(sSplit.length > 1) {
						sTxt = sSplit[0] + "...";
						sTxt2 = sSplit.join("");
					}
					else {
						sTxt2 = sTxt = sSplit.join("");
					}
					str += '\
					<tr>\
					<td height="18" valign="bottom" style="background-image:url(http://image2.sina.com.cn/blog/tmpl/v3/images/datong/card/dot.gif); background-repeat:no-repeat; padding-left: 8px; color: #3e2db0;" title="'+sTxt2+'"><a onclick="bc.createLog(\'article\');" href="http://blog.sina.com.cn/'+nPage[i].url+'" target="_blank" >' + sTxt + '</a></td>\
					</tr>\
					';
				}
				str += '</table>';
				if(nPage.length == 0) {
					CT1.innerHTML = "暂时没有内容更新";
				}
				else {
					CT1.innerHTML = "";
					addHTML(CT1, str);
				}
				CT2.style.display = CT3.style.display = CT4.style.display = "none";
				CT1.style.display = "";
				
				isLoad = true;
			}
			
		}
		else {// 裸用户
			udata = {uid: uid};
			bcHome.href = "";
			bcNick.innerHTML = "";
			bcName.innerHTML = "会员编码<b>:</b>&nbsp;<b><a  onclick='bc.createLog(\"loginname\");' style='color:#5D5D5D;' target='_blank' href='http://blog.sina.com.cn/u/" + udata["uid"] + "'>" + udata["uid"] + "</a></b>";
			bcPhoto.src = "http://image2.sina.com.cn/blog/tmpl/v3/images/default_icon.jpg";
			bcPhotoA.href = "";

			if(e == 0) {
				bcFLD.style.display = "none";
			}
			else {
				
				bcFLD.style.display = "";
			}
			CT1.style.display = CT2.style.display = CT3.style.display = CT4.style.display = "none";
			bcSED.style.display = "";
			bcHome.style.display = "none";

			
//				bcB.href = "http://blog.sina.com.cn/u/" + udata["uid"];
//				bcV.href = "http://v.blog.sina.com.cn/" + udata["uid"];
//				bcB2.href = "http://bbs.service.sina.com.cn/forum/disprofile.php?uid=" + udata["uid"];
//				bcQ.href = "http://q.sina.com.cn/mygroup.php?uid=" + udata["uid"];
//				bcP.href = "http://photo.sina.com.cn/u/" + udata["uid"];

			isLoad = false;
		}
	}
}
var bc;
bc = new BusinessCard();
bc.create();
bcDialog.create();
function hid() {
	bc.hidden();
}
if(typeof(bcView) == "undefined") {
	if(document.addEventListener) {
		document.addEventListener("click", hid, false);
	}
	else {
		document.attachEvent("onclick", hid);
	}
}
