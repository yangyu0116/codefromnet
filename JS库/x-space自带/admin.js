

function addtag(inputid, htmlid) {
	var tagtext = document.getElementById(htmlid).innerHTML;
	var tag = document.getElementById(inputid).value;
	
	if(checktag(tag)) {
		newtag = '<input type="button" name="tagnamebtn[]" value="'+tag+'" onclick="deletetag(this)"><input type="hidden" name="tagname[]" id="tagnameid'+tag+'" value="'+tag+'">';
		document.getElementById(htmlid).innerHTML += newtag;
	}
	document.getElementById(inputid).value = '';
}

function addtagname(tagname, htmlid) {
	var tagtext = document.getElementById(htmlid).innerHTML;
	var tag = tagname;
	if(checktag(tag)) {
		newtag = '<input type="button" name="tagnamebtn[]" value="'+tag+'" onclick="deletetag(this)"><input type="hidden" name="tagname[]" id="tagnameid'+tag+'" value="'+tag+'">';
		document.getElementById(htmlid).innerHTML += newtag;
	}
}


function deletetag(thebtn) {
	if(confirm('确定删除TAG: '+thebtn.value+'?')) {
		document.getElementById('tagnameid'+thebtn.value).disabled = true;
		thebtn.disabled = true;
		thebtn.style.display = "none";
	}
}

function checktag(Sting) {

	if(Sting.length < 2 || Sting.length > 10) {
		alert('TAG长度不符合要求');
		return false;
	}
	//常用的符号
	var compStr = "§№☆★○●◎◇◆□■△▲※→←↑↓〓＃＆＠＼︿＿￣〖〗【】（）〔〕｛｝．’‘”“》《〉〈〕〔‘’“”々～‖∶”’‘｜¨ˇˉ·－…！？：；，、。  ~!@#$%^&*()+={}|[]\\:;\"'<,>?/";
    var length2 = Sting.length;
	
	for (var iIndex=0;iIndex<length2;iIndex++) {
		var temp1 = compStr.indexOf(Sting.charAt(iIndex));
		if(temp1>=0){
			alert('TAG名中包含非法字符');
			return false;
		}
	}
	return true;
}

function checkall(form, prefix, checkall) {
	var checkall = checkall ? checkall : 'chkall';
	for(var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if(e.name != checkall && (!prefix || (prefix && e.name.match(prefix)))) {
			e.checked = form.elements[checkall].checked;
		}
	}
}

function ShowHide(id) {
	if ( itm = document.getElementById(id) ) {
		if (itm.style.display == 'none'){
			itm.style.display = '';
		} else {
			itm.style.display = 'none';
		}
	}
}

function changevalue(id, value) {
	var obj = document.getElementById(id);
	obj.value = value;
}

function validate(theform) {
	var btn = document.getElementById("thevaluesubmit");
	if(btn) btn.disabled = true;
	
	//标题
	var subject = document.getElementById("subject");
	if(subject) {
		if (subject.value.length < 2 || subject.value.length > 80) {
			alert("您输入的标题长度不符合要求(2~80)，请检查确认。");
			subject.focus();
			if(btn) btn.disabled = false;
			return false;
		}
	}
	
	//标题
	var catid = document.getElementById("catid");
	if(catid) {
		if (catid.value<1) {
			alert("请为您的信息选择一个系统分类");
			catid.focus();
			if(btn) btn.disabled = false;
			return false;
		}
	}

	//文件后缀名
	var fileext = document.getElementById("fileext");
	if(fileext) {
		if (fileext.value.length < 1 || fileext.value.length > 15) {
			alert("您输入的文件后缀名长度不符合要求，请检查确认。");
			fileext.focus();
			if(btn) btn.disabled = false;
			return false;
		}
	}

	//名称
	var name = document.getElementById("name");
	if(name) {
		if (name.value.length < 1 || name.value.length > 50) {
			alert("您输入的名称长度不符合要求，请检查确认。");
			name.focus();
			if(btn) btn.disabled = false;
			return false;
		}
	}

	//组名称
	var groupname = document.getElementById("groupname");
	if(groupname) {
		if (groupname.value.length < 1 || groupname.value.length > 50) {
			alert("您输入的组名称长度不符合要求，请检查确认。");
			groupname.focus();
			if(btn) btn.disabled = false;
			return false;
		}
	}

	//用户名称
	var username = document.getElementById("username");
	if(username) {
		if (username.value.length < 1 || username.value.length > 30) {
			alert("您输入的用户名称长度不符合要求，请检查确认。");
			username.focus();
			if(btn) btn.disabled = false;
			return false;
		}
	}
	
	//类型名称
	var typename = document.getElementById("typename");
	if(typename) {
		if (typename.value.length < 1 || typename.value.length > 30) {
			alert("您输入的名称长度不符合要求，请检查确认。");
			typename.focus();
			if(btn) btn.disabled = false;
			return false;
		}
	}
	
	//类型名称
	var field = document.getElementById("field");
	if(field) {
		if (field.value.length < 1 || field.value.length > 30) {
			alert("您输入的名称长度不符合要求，请检查确认。");
			field.focus();
			if(btn) btn.disabled = false;
			return false;
		}
	}
	
	//空间名称
	var spacename = document.getElementById("spacename");
	if(spacename) {
		if (spacename.value.length < 1 || spacename.value.length > 30) {
			alert("您输入的空间名称长度不符合要求，请检查确认。");
			spacename.focus();
			if(btn) btn.disabled = false;
			return false;
		}
	}
	
	//空间名称
	var importtext = document.getElementById("importtext");
	if(importtext) {
		if (importtext.value.length < 1 || importtext.value.length > 30) {
			alert("您输入的导入文本长度不符合要求，请检查确认。");
			importtext.focus();
			if(btn) btn.disabled = false;
			return false;
		}
	}
	
	//页面自定义
	if(typeof window.thevalidate == 'function') {
		if(thevalidate(theform)) {
			return true;
		} else {
			if(btn) btn.disabled = false;
			return false;
		}
	}

	return true;
}

function listsubmitconfirm(theform) {
	theform.listsubmit.disabled = true;
	if(confirm("您确定要执行本操作吗？")) {
		theform.listsubmit.disabled = false;
		return true;
	} else {
		theform.listsubmit.disabled = false;
		return false;
	}
}

function getid(id) {
	return document.getElementById(id);
}

function uploadFile(mode) {
	var theform = document.getElementById("theform");
	var msg = document.getElementById("divshowuploadmsg");
	var msgok = document.getElementById("divshowuploadmsgok");
	var oldAction = theform.action;
	var oldonSubmit = theform.onSubmit;
	msgok.style.display = 'none';
	msg.style.display = '';
	msg.innerHTML = "正在上传中，请您稍等......";
	theform.action = siteUrl + "/batch.upload.php?mode=" + mode;
	theform.onSubmit = "";
	theform.target = "phpframe";
	theform.submit();
	theform.action = oldAction;
	theform.onSubmit = oldonSubmit;
	theform.target = "";
	if(mode ==2) {
		delpic();
	}
	return false;
}

function attacheditsubmit(aid) {
	var theform = document.getElementById("theform");
	var oldAction = theform.action;
	var oldonSubmit = theform.onSubmit;
	theform.action = siteUrl + "/batch.upload.php?editaid=" + aid;
	theform.onSubmit = "";
	theform.target = "phpframe";
	theform.submit();
	theform.action = oldAction;
	theform.onSubmit = oldonSubmit;
	theform.target = "";
	return false;
}

/**
 * showmenu/hidemenu 会用hideshowtags取代
 */
function showmenu(id) {
	var thismenu=document.getElementById(id);
	thismenu.style.display="block";
}
function hidemenu(id) {
	var thismenu=document.getElementById(id);
	thismenu.style.display="none";
}
/**
 * 隐藏并显示上传DIV中的指定标签
 * @param string id: 待显示的标签ID
 */
function hideshowtags(upid,id) {
	//获取上传DIV对象
	var uploadobj = getbyid(upid).getElementsByTagName('div');
	for(var i=0; i< uploadobj.length; i++) {
		if(uploadobj[i].id.indexOf('upload') != -1) {
			uploadobj[i].style.display = "none";
		}
	}
	var showtagobj = getbyid(id);
	showtagobj.style.display = "block";
}
/***************批量上传调用开始***********************/
/**
 * 插入一个预览图片
 * @param object obj: 上传文本框对象
 */
function insertimg(obj) {
	var childnum = getbyid("batchdisplay").getElementsByTagName("input");	//获取上传控制个数
	var upallowmax = getbyid("uploadallowmax").value;
	//判断是否超过限制
	if(upallowmax < childnum.length ) {
		alert("一次允许最多上传"+ upallowmax +"个");
		return false;
	}
	//获取最高ID
	var id =getmaxid();
	//添加默认的DIV
	var pichtml = '';
	var src = obj.value;
	
	//判断文件类型
	var patn = /\.jpg$|\.jpeg$|\.gif$|\.png$|\.bmp$/i;
	var filetype = 'file';
	if(patn.test(src)){
		filetype = 'image';
		
	}
	
	var temp_title = src.substr(src.lastIndexOf('\\')+1);
	if(src.lastIndexOf('.') != -1){
		temp_title = temp_title.substr(0,(src.substr(src.lastIndexOf('\\')+1)).lastIndexOf('.'));
	}
	pichtml += '<div class="picspace" id="pic_space_' + id + '">';
	pichtml += '<div class="delimg" onmouseover="mouseoverpic(' + id + ', 1)" id="del_pic_button'  + id + '"><img src="./admin/images/pic_delete.gif" width="18" height="17" border="0" onclick="delpic('+id+');" title="取消上传"></div>';
	pichtml += '<div class="picbox" onmouseover="mouseoverpic(' + id + ', 1)" onmouseout="mouseoutpic(' + id + ', 1)">';
	if (navigator.userAgent.toLowerCase().indexOf('ie') < 0 || filetype != 'image') {
		pichtml += '<img src="admin/images/upload_file.gif" alt="upload file" class="nopreview" />';
	} else {
		pichtml += '<img src="' + src + '" id="pic_item_id_' + id + '" onload="javascript:if(this.width>105){this.height*=105/this.width;this.width=105};if(this.height>105){this.width*=105/this.height;this.height=105};" />';
	}
	pichtml += '</div>';
	pichtml += '<div class="pictext" id="pic_text_' + id + '">';
	pichtml += '<label id="label_pic_' + id + '" title="'+getStrbylen(temp_title,40)+'" onmouseover="mouseoverpic(' + id + ', 0)" onmouseout="mouseoutpic(' + id + ', 0)"><span id="pic_' + id + '">'+getStrbylen(temp_title,16)+'</span><input id="pic_input_' + id + '" type="text" name="picname[]" value="'+temp_title+'"/></label>';
	pichtml += '</div><div style="display:none;"><input type="text" name="title[]" value="'+ temp_title +'" id="pic_title_' + id + '" /><input type="text" name="thumb[]" value="'+ (getbyid('uploadthumb2') == null?"":getbyid('uploadthumb2').value) +'"/></div>';
	pichtml += '</div>';

	// 把图片框加到pic_space_main中去
	var picmain = getbyid("batchpreview");
	picmain.innerHTML = picmain.innerHTML + pichtml;
	obj.style.display = 'none';	//隐藏当前的上传对象
	var newid = id+1;	//获取下一个最大的上传ID并创建新的上传控件
	addupload(newid);	//创建一个新的上传控制
}
/**
 * 添加一个新的上传对象控件
 * @param int newid: 新的上传控件ID后缀
 */
function addupload(newid) {
	//两种生成方式，解决浏览器之间的兼容性问题
	try{
		//IE模式下的创建方式,解决常规setAttribute设置属性带来的一些未知的错误
		var uploadHTML = document.createElement("<input type=\"file\" size=\"1\" id=\"batch_" + newid + "\" name=\"batchfile[]\" onchange=\"insertimg(this)\" class=\"fileinput\">");
		getbyid("batchdisplay").appendChild(uploadHTML);
	}catch(e) {
		//非IE模式则须要用下列的常规setAttribute设置属性，否则生成的结果不能正常初始化
		var uploadobj = document.createElement("input");
		uploadobj.setAttribute("name", "batchfile[]");
		uploadobj.setAttribute("onchange", "insertimg(this)");
		uploadobj.setAttribute("type", "file");
		uploadobj.setAttribute("id", "batch_" + newid);
		uploadobj.setAttribute("class", "fileinput")
		getbyid("batchdisplay").appendChild(uploadobj);
	}
}
/**
 * 得到页面中可用的最大ID号
 * 写这个函数主要是因为不能通过图片的个数来计算可用的最大ID号.
 * 图片是可以取消的,如果取消,则通过图片个数算出的最大ID号会与已有图片的ID号重叠.
 */
function getmaxid() {
	var items = getbyid("batchdisplay").getElementsByTagName("input");
	var count = items.length;
	var id = 0;
	for (var i=0; i<count; i++) {
		if(items[i].id.substr(0, 6) == "batch_") {
			tmp_id = new Number(items[i].id.substr(6));
			if(id < tmp_id) {
				id = tmp_id;
			}
		}
	}
	if(id == 0) {
		return 1;
	}
	id = new Number(id);
	return id;
}
/**
 * 截取指定字符串长度
 * @param string str: 要截取的字符串
 * @param int len: 要截取的长度
 * @return 
 */
function getStrbylen(str, len) {
	var num = 0;
	var strlen = 0;
	var newstr = "";
	var laststrlen = 1;
	var obj_value_arr = str.split("");
	for(var i = 0; i < obj_value_arr.length; i ++) {
		if(i < len && num + byteLength(obj_value_arr[i]) <= len) {
			num += byteLength(obj_value_arr[i]);
			strlen = i + 1;
		}
	}
	if(str.length > strlen) {
		if(byteLength(str.charAt(strlen-1)) == 1){
			laststrlen = 2;
		}
		newstr = str.substr(0, strlen-laststrlen) + '…';
	} else {
		newstr = str;
	}
	return newstr;
}
/**
 * 判断中英问混排时候的长度
 * @param string sStr: 混排的字符串
 */
function byteLength (sStr) {
	aMatch = sStr.match(/[^\x00-\x80]/g);
	return (sStr.length + (! aMatch ? 0 : aMatch.length));
}
/**
 * 鼠标移到预览图事件
 * @param int id: 操作对象ID反缀
 * @param int optype: 操作类型
 */
function mouseoverpic(id,optype) {
	if(optype == 1) {
		var delpicbutton = getbyid("del_pic_button" + id);
		if(delpicbutton.style.display != "block") {
			delpicbutton.style.display="block";
		}
	} else if(optype == 0) {
		getbyid("pic_" + id).style.display = "none";
		getbyid("pic_input_" + id).style.display = "block";
	}
}
/**
 * 鼠标移出预览图事件
 * @param int id: 操作对象ID反缀
 * @param int optype: 操作类型
 */
function mouseoutpic(id, optype) {
	if(optype == 1) {
		var delpicbutton = getbyid("del_pic_button" + id);
		delpicbutton.style.display="none";
	} else if(optype == 0) {
		var picobj = getbyid("pic_" + id);
		var inputobj = getbyid("pic_input_" + id);
		var labelobj = getbyid("label_pic_" + id);
		picobj.style.display = "block";
		inputobj.style.display = "none";
		//判断是否为空，如果为空则取默认的文件名称
		var re = /\s/ig;
   		var result = inputobj.value.replace(re, "");
		if(result == "") {
			inputobj.value = getbyid("pic_title_" + id).value;
		}
		picobj.innerText = inputobj.value;
		labelobj.title = inputobj.value;
	}
}
/**
 * 删除全部预览图或其中的某一张
 * @param int pid: 要删除的预览图ID后缀，如没有填写则删除全部的预览图
 */
function delpic(pid) {
	//判断是否有传删除的图片ID，如果没有则删除全部的图片
	if(typeof pid != "undefined") {
		getbyid("batchpreview").removeChild(getbyid("pic_space_"+pid));
		//删除相对应的上传控件
		getbyid("batchdisplay").removeChild(getbyid("batch_" + pid));
	} else {
		//获取全部图片对象
		var previewobj = getbyid("batchpreview");
		var allobj = previewobj.getElementsByTagName("div");
		for(var i = allobj.length - 1; 0<=i; i--) {
			if(allobj[i].id.indexOf("pic_space_") != -1) {
				previewobj.removeChild(allobj[i]);
			}
		}
		var bdisplay = getbyid("batchdisplay");
		var allupobj = bdisplay.getElementsByTagName("input");
		for(var i = allupobj.length - 1; 0<=i; i--) {
			bdisplay.removeChild(allupobj[i]);
		}
		addupload(1);
	}
	return false;
}
/***************批量上传调用结束***********************/
//显示工具条
function hidetoolbar() {
	window.parent.document.getElementById("toolbarframe").style.display="none";
}
function hidetoolbarOpera() {
	if (navigator.userAgent.toLowerCase().indexOf('opera') > -1) {
		window.parent.document.getElementById("toolbarframe").style.display="none";
	}
}

function showtoolbar() {
	document.getElementById("toolbarframe").style.display = "block";
}
