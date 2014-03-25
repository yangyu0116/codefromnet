function dialog(){
	var titile = '';
	var width = 300;
	var height = 180;
	var src = "";
	var path = "http://image2.sina.com.cn/blog/tmpl/v3/images/dialog/";
	var sFunc = '<input id="dialogOk" type="button" style="{width:62px;height:22px;border:0;background:url(\'http://image2.sina.com.cn/blog/tmpl/v3/images/dialog/smb_btn_bg.gif\');line-height:20px;" value="确认" onclick="new dialog().reset();" /> <input id="dialogCancel" type="button" style="{width:62px;height:22px;border:0;background:url(\'http://image2.sina.com.cn/blog/tmpl/v3/images/dialog/smb_btn_bg.gif\');line-height:20px;" value="取消" onclick="new dialog().reset();" />';
	var sClose = '<input type="image" id="dialogBoxClose" onclick="new dialog().reset();" src="' + path + 'dialogClose0.gif" border="0" width="17" height="17" onmouseover="this.src=\'' + path + 'dialogCloseF.gif\';" onmouseout="this.src=\'' + path + 'dialogClose0.gif\';" align="absmiddle" />';
	var sBody = '\
		<table id="dialogBodyBox" border="0" align="center" cellpadding="0" cellspacing="0">\
			<tr height="10"><td colspan="4"></td></tr>\
			<tr>\
				<td width="10"></td>\
				<td width="80" align="center" valign="absmiddle"><img id="dialogBoxFace" src="' + path + '3.gif" /></td>\
				<td id="dialogMsg" style="font-size:12px;"></td>\
				<td width="10"></td>\
			</tr>\
			<tr height="10"><td colspan="4" align="center"></td></tr>\
			<tr><td id="dialogFunc" colspan="4" align="center">' + sFunc + '</td></tr>\
			<tr height="10"><td colspan="4" align="center"></td></tr>\
		</table>\
	';
	var sBox = '\
		<table id="dialogBox" width="' + width + '" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #000;display:none;z-index:10;" alt="dialog">\
			<tr height="1" bgcolor="#D6E3EB"><td></td></tr>\
			<tr height="25" bgcolor="#6795B4">\
				<td>\
					<table onselectstart="return false;" style="-moz-user-select:none;" width="100%" border="0" cellpadding="0" cellspacing="0">\
						<tr>\
							<td width="6"></td>\
							<td id="dialogBoxTitle" onmousedown="new dialog().moveStart(event, \'dialogBox\')" style="color:#fff;cursor:move;font-size:12px;font-weight:bold;">&nbsp;</td>\
							<td id="dialogClose" width="27" align="right" valign="middle">\
								' + sClose + '\
							</td>\
							<td width="6"></td>\
						</tr>\
					</table>\
				</td>\
			</tr>\
			<tr height="2" bgcolor="#EDEDED"><td></td></tr>\
			<tr id="dialogHeight" style="height:' + height + '">\
				<td id="dialogBody" bgcolor="#ffffff">' + sBody + '</td>\
			</tr>\
			<tr>\
				<td height=30><iframe id="adframe" style="background:#FFFFFF;height:30px; width: 100%;" scrolling=no frameborder=0 src="/lm/iframe/20/20070406/16.html"></iframe></td>\
			</tr>\
		</table>\
		<iframe id="dialogBoxIframe" width="300px" style="position:absolute;display:none;" frameborder="0"></iframe>\
		<div id="dialogBoxShadow" style="display:none;z-index:9;"></div>\
	';
	var sBG = '\
		<div id="dialogBoxBG" style="position:absolute;top:0px;left:0px;width:100%;height:200px;background:url(http://image2.sina.com.cn/blog/tmpl/v3/images/blank.gif);"></div>\
	';
	function $(_sId){return document.getElementById(_sId)}
	this.show = function(){
		this.middle('dialogBox');
		this.shadow();
		$('adframe').src = '/lm/iframe/20/20070406/16.html';
		//$("dialogBoxBG").style.width = document.body.scrollWidth;
		//$("dialogBoxBG").style.height = document.body.scrollHeight;
	}
	this.reset = function(){$('dialogBox').style.display='none';$('dialogBoxBG').style.display='none';$('dialogBoxShadow').style.display = "none";$('dialogBoxIframe').style.display = "none";$('dialogBody').innerHTML = sBody;}
	this.html = function(_sHtml){$("dialogBody").innerHTML = _sHtml;this.show();}
	this.init = function(){
		$('dialogCase') ? $('dialogCase').parentNode.removeChild($('dialogCase')) : function(){};
		var oDiv = document.createElement('span');
		oDiv.id = "dialogCase";
		oDiv.innerHTML = sBG + sBox;
		document.body.appendChild(oDiv);
		//$('dialogBoxBG').style.height = document.body.scrollHeight;
	}
	this.button = function(_sId, _sFuc){
		if($(_sId)){
			$(_sId).style.display = '';
			if($(_sId).addEventListener){
				if($(_sId).act){$(_sId).removeEventListener('click', function(){eval($(_sId).act)}, false);}
				$(_sId).act = _sFuc;
				$(_sId).addEventListener('click', function(){eval(_sFuc)}, false);
			}else{
				if($(_sId).act){$(_sId).detachEvent('onclick', function(){eval($(_sId).act)});}
				$(_sId).act = _sFuc;
				$(_sId).attachEvent('onclick', function(){eval(_sFuc)});
			}
		}
	}
	this.shadow = function(){
		var oShadow = $('dialogBoxShadow');
		var oDialog = $('dialogBox');
		var oIframe = $('dialogBoxIframe');
		oShadow['style']['position'] = "absolute";
		oIframe['style']['position'] = "absolute";
		oShadow['style']['background']	= "#000";
		oShadow['style']['display']	= "";
		oIframe['style']['display']	= "";
		oShadow['style']['opacity']	= "0.2";
		oShadow['style']['filter'] = "alpha(opacity=20)";
		oShadow['style']['top'] = oDialog.offsetTop + 6;
		oShadow['style']['left'] = oDialog.offsetLeft + 6;
		oShadow['style']['width'] = oDialog.offsetWidth;
		oShadow['style']['height'] = oDialog.offsetHeight;
		oIframe['style']['top'] = oDialog.offsetTop;
		oIframe['style']['left'] = oDialog.offsetLeft;
		oIframe['style']['width'] = oDialog.offsetWidth;
		oIframe['style']['height'] = oDialog.offsetHeight;
	}
	this.open = function(_sUrl, _sMode){
		//this.__url = _sUrl;
		this.show();
		if(!_sMode || _sMode == "no" || _sMode == "yes"){
			$("dialogBody").innerHTML = "<iframe width='100%' id='frameEle' height='100%' src='" + _sUrl + "' frameborder='0' scrolling='" + _sMode + "'></iframe>";
		}
		$('frameEle').src = _sUrl;
	}
	this.showWindow = function(_sUrl, _iWidth, _iHeight, _sMode, _sTitle){
		var oWindow;
		var sLeft = (screen.width) ? (screen.width - _iWidth)/2 : 0;
		var iTop = -80 + (screen.height - _iHeight)/2;
		iTop = iTop > 0 ? iTop : (screen.height - _iHeight)/2;
		var sTop = (screen.height) ? iTop : 0;
		if(window.showModalDialog && _sMode == "m"){
			oWindow = window.showModalDialog(_sUrl,_sTitle,"dialogWidth:" + _iWidth + "px;dialogheight:" + _iHeight + "px");
		} else {
			oWindow = window.open(_sUrl, _sTitle, 'height=' + _iHeight + ', width=' + _iWidth + ', top=' + sTop + ', left=' + sLeft + ', toolbar=no, menubar=no, scrollbars=' + _sMode + ', resizable=no,location=no, status=no');
			this.reset();
		}
	}
	this.event = function(_sMsg, _sOk, _sCancel, _sClose){
		$('dialogFunc').innerHTML = sFunc;
		$('dialogClose').innerHTML = sClose;
		$('dialogBodyBox') == null ? $('dialogBody').innerHTML = sBody : function(){};
		$('dialogMsg') ? $('dialogMsg').innerHTML = _sMsg  : function(){};
		_sOk && _sOk != "" ? this.button('dialogOk', _sOk)| $('dialogOk').focus() : $('dialogOk').style.display = 'none';
		_sCancel && _sCancel != "" ? this.button('dialogCancel', _sCancel) : $('dialogCancel').style.display = 'none';
		//_sOk ? this.button('dialogOk', _sOk) : _sOk == "" ? function(){} : $('dialogCancel').style.display = 'none';
		//_sCancel ? this.button('dialogCancel', _sCancel) : _sCancel == "" ? function(){} : $('dialogCancel').style.display = 'none';
		_sClose ? this.button('dialogBoxClose', _sClose) : function(){};
		this.show();
		this.middle('dialogBox');
	}
	this.set = function(_oAttr, _sVal){
		var oShadow = $('dialogBoxShadow');
		var oDialog = $('dialogBox');
		var oHeight = $('dialogHeight');
		var oIframe = $('dialogBoxIframe');
		if(_sVal != ''){
			switch(_oAttr){
				case 'title':
					$('dialogBoxTitle').innerHTML = _sVal;
					title = _sVal;
					break;
				case 'width':
					oDialog['style']['width'] = _sVal;
					width = _sVal;
					break;
				case 'height':
					oHeight['style']['height'] = _sVal;
					height = _sVal;
					break;
				case 'src':
					if(parseInt(_sVal) > 0){
						$('dialogBoxFace') ? $('dialogBoxFace').src = path + _sVal + '.gif' : function(){};
					}else{
						$('dialogBoxFace') ? $('dialogBoxFace').src = _sVal : function(){};
					}
					src = _sVal;
					break;
			}
		}
		this.middle('dialogBox');
		oShadow['style']['top'] = oDialog.offsetTop + 6;
		oShadow['style']['left'] = oDialog.offsetLeft + 6;
		oShadow['style']['width'] = oDialog.offsetWidth;
		oShadow['style']['height'] = oDialog.offsetHeight;
		oIframe['style']['top'] = oDialog.offsetTop;
		oIframe['style']['left'] = oDialog.offsetLeft;
		oIframe['style']['width'] = oDialog.offsetWidth;
		oIframe['style']['height'] = oDialog.offsetHeight;
	}
	this.moveStart = function (e, _sId){
		function fixE(e) {
			if (typeof e == 'undefined') e = window.event;
			if (typeof e.layerX == 'undefined') e.layerX = e.offsetX;
			if (typeof e.layerY == 'undefined') e.layerY = e.offsetY;
			return e;
		}
		function getX(e){ return fixE(e).clientX; };
		function getY(e){	return fixE(e).clientY; };
		function drag(e){
			v = document.getElementById(_sId);
			var nX = getX(e);
			var nY = getY(e);
			var ll = v.rL + nX - v.oX;
			var tt = v.rT + nY - v.oY;
			v.style.left = ll + 'px';
			v.style.top  = tt + 'px';
			$('dialogBoxShadow').style.left = ll + 6 +'px';
			$('dialogBoxShadow').style.top = tt + 6 + 'px';
			$('dialogBoxIframe').style.left = ll + 'px';
			$('dialogBoxIframe').style.top = tt + 'px';
			return false;
		}
		function end() {
			document.onmousemove	= null;
			document.onmouseup		= null;
		}
		v = $(_sId);
		v.oX = getX(e);
		v.oY = getY(e);
		v.rL = parseInt(v.style.left ? v.style.left : 0);
		v.rT = parseInt(v.style.top  ? v.style.top  : 0);
		document.onmousemove = drag;
		document.onmouseup	 = end;
		return false;
	}
	this.hideModule = function(_sType, _sDisplay){
		var aIframe = parent.document.getElementsByTagName("iframe");aIframe=0;
		var aType = document.getElementsByTagName(_sType);
		var iChildObj, iChildLen;
		for (var i = 0; i < aType.length; i++){
			aType[i].style.display	= _sDisplay;
		}
		for (var j = 0; j < aIframe.length; j++){
			iChildObj = document.frames ? document.frames[j] : aIframe[j].contentWindow;
			iChildLen = iChildObj.document.body.getElementsByTagName(_sType).length;
			for (var k = 0; k < iChildLen; k++){
				iChildObj.document.body.getElementsByTagName(_sType)[k].style.display = _sDisplay;
			}
		}
	}
	this.middle = function(_sId){
		var obj = document.getElementById(_sId);
		var sClientWidth = getWinSize().width;
		var sClientHeight = parent ? getWinSize(parent).height - 200 : getWinSize().height ;
		var sScrollTop = parent ? parent.document.body.scrollTop : document.body.scrollTop;
		obj.style.display = "";
		obj.style.position = "absolute";
		obj.style.left = (sClientWidth - obj.offsetWidth)/2 + 'px';
		obj.style.top = (sClientHeight - obj.offsetHeight)/2 + sScrollTop + 'px';
	}
}
function getWinSize(_target) {
	var windowWidth, windowHeight;
	if(_target) target = _target.document;
	else	target = document;
	if (self.innerHeight) { // all except Explorer
		if(_target) target = _target.self;
		else	target = self;
		windowWidth = target.innerWidth;
		windowHeight = target.innerHeight;
	} else if (target.documentElement && target.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = target.documentElement.clientWidth;
		windowHeight = target.documentElement.clientHeight;
	} else if (target.body) { // other Explorers
		windowWidth = target.body.clientWidth;
		windowHeight = target.body.clientHeight;
	}
	return {width:parseInt(windowWidth),height:parseInt(windowHeight)};
}
function _error_msg_show(msg, click, icon, title)
{
    click = click ? click : ' ';
    icon = icon ? icon : '';
    title = title ? title : '系统提示信息';

    switch (icon)
    {
    case 'forbid':
        icon = 1;
        break;

    case 'succ':
        icon = 2;
        break;

    case 'smile':
        icon = 3;
        break;

    case 'forget':
        icon = 4;
        break;

    case 'sorry':
        icon = 5;
        break;

    case 'care':
        icon = 6;
        break;

    case '':
        icon = 5;
        break;
    }

    dg=new dialog();
    dg.init();
    dg.set('src', icon);
    dg.set('title', title);
    dg.event(msg, click, '', click);
}

function _win_error_msg_show(msg, click, icon, top, left, width, height)
{
    click = click ? click : ' ';
    icon = icon ? icon : '';
    title = '系统提示信息';
    top = top ? top : 80;
    switch (icon)
    {
    case 'forbid':
        icon = 1;
        break;

    case 'succ':
        icon = 2;
        break;

    case 'smile':
        icon = 3;
        break;

    case 'forget':
        icon = 4;
        break;

    case 'sorry':
        icon = 5;
        break;

    case 'care':
        icon = 6;
        break;

    case '':
        icon = 5;
        break;
    }
    dg=new dialog();
    dg.init();

    dg.set('src', icon);

    dg.set('title', title);
	
    if (width)
    {
        dg.set('width', width);
    }
    if (height)
    {
        dg.set('height', height);
    }

    dg.event(msg, click, '', click);

	
    if (left)
    {
         document.getElementById('dialogBox')['style']['left'] = left;
         document.getElementById('dialogBoxShadow')['style']['left'] = left;
    }
    if (top)
    {
	 document.getElementById('dialogBox')['style']['top'] = top;
	 document.getElementById('dialogBoxShadow')['style']['top'] = top;
    }

}

function _confirm_msg_show(msg, click_ok, click_no, title)
{
    click_ok = click_ok ? click_ok : ' ';
    click_no = click_no ? click_no : ' ';
    title = title ? title : '系统提示信息';

    dg=new dialog();
    dg.init();
    dg.set('src', 3);	// smile
    dg.set('title', title);
    dg.event(msg, click_ok, click_no, click_no);
}

function _win_confirm_msg_show(msg, click_ok, click_no, top, left, width, height)
{
    click_ok = click_ok ? click_ok : ' ';
    click_no = click_no ? click_no : ' ';
    title = '系统提示信息';
    top = top ? top : 80;

    dg=new dialog();
    dg.init();
    dg.set('src', 3);   // smile
    dg.set('title', title);

    if (width)
    {
        dg.set('width', width);
    }
    if (height)
    {
        dg.set('height', height);
    }

    dg.event(msg, click_ok, click_no, click_no);

    if (left)
    {
         document.getElementById('dialogBox')['style']['left'] = left;
         document.getElementById('dialogBoxShadow')['style']['left'] = left;
    }
    if (top)
    {
         document.getElementById('dialogBox')['style']['top'] = top;
         document.getElementById('dialogBoxShadow')['style']['top'] = top;
    }
}
