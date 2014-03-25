/**
 * @author stan
 */
//interface paras
//http://blog.sina.com.cn/control/blog/customize_theme.php?css=f10,k0,e10,d10,c10,b10,m10&theme=4
//base 

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
function $(x) {return typeof(x) == 'string' ? document.getElementById(x) : x};
function $C(tagName) { return document.createElement(tagName)};
function $addEvent2(elm, func, evType, useCapture) {
	var elm = $(elm);
	if(typeof useCapture == 'undefined') useCapture = false;
	if(typeof evType == 'undefined')  evType = 'click';
try{
	if (elm.addEventListener) {
		elm.addEventListener(evType, func, useCapture);
		return true;
	}
	else if (elm.attachEvent) {
		var r = elm.attachEvent('on' + evType, func);
		return true;
	}
	else {
		elm['on' + evType] = func;
	}
}catch(e){};
};
Sina = {};
Sina.util = {};
Sina.util.Drag = {
	init : function (_root,_handle) {
		var o = this;
		var blk = $(_root);
		blk.hdl = $(_handle);
		if(blk.hdl == null || _handle == 'undefined') blk.hdl = o.blk;
		blk.hdl.onmousedown = start;
		function start (e) {
			var o = Sina.util.Drag; v = blk;
			v.oX = o.getX(e);
			v.oY = o.getY(e);
			v.depth = v.style.zIndex;
			v.style.zIndex = 10000;
			v.rL = parseInt(v.style.left ? v.style.left : 0);
			v.rT = parseInt(v.style.top  ? v.style.top  : 0);
			document.onmousemove = drag;
			document.onmouseup	 = end;
			return false;
		};
		function drag (e) {
			var o = Sina.util.Drag; var v = blk;
			var nX = o.getX(e);
			var nY = o.getY(e);
			var ll = v.rL + nX - v.oX;
			var tt = v.rT + nY - v.oY;
			v.style.left = ll + 'px';
			v.style.top  = tt + 'px';
			return false;
		};
		function end () {
			v.style.zIndex = v.depth ;
			document.onmousemove	= null;
			document.onmouseup		= null;
		};
	},
	fixE : function (e) {
		if (typeof e == 'undefined') e = window.event;
		if (typeof e.layerX == 'undefined') e.layerX = e.offsetX;
		if (typeof e.layerY == 'undefined') e.layerY = e.offsetY;
		return e;
	},
	getX : function (e){ 
		return this.fixE(e).clientX; 
	},
	getY : function (e){ 
		return this.fixE(e).clientY; 
	}	
}
trace = function(){};
//progress
var TPLINIT = true;
function saveTpl(code){
	if(!TPLINIT) return;
	TPLINIT = false;
	var theme = code.split('_')[0];
	var sid = code.split('_')[1];
	//rm
	//setRightMark(theme,sid)
	trace("sid : "+sid);
	var paraStr = conf.data[theme].conf[sid];
	var paraArr = paraStr.split(',');
	for(var i=0;i<paraArr.length;i++){
		paraArr[i] = paraArr[i].replace(/([a-z])(\d+)/ig,function($0,$1,$2){
			return $1 + (parseInt($2) - 1);
		});
	}
	paraStr = paraArr.join(',');
	$('saveForm').action = 'http://v35.blog.sina.com.cn/control/blog/customize_theme.php?index';
	$('saveForm').theme.value = theme;
	$('saveForm').css.value = paraStr;
	$('saveForm').submit();
	//var url = 'http://blog.sina.com.cn/control/blog/customize_theme.php?css=' + paraStr + '&theme=' + theme+'&index';
	//trace(theme+" : "+paraStr);
	//$('tplIframe').src = url;
}
function initDom(){
	var css = $C('div');
	css.innerHTML = tplCssStyle;
	document.body.appendChild(css);
	/*
	if(document.all){ 
		window.style = tplCssStyle; 
		document.createStyleSheet("javascript:style"); 
	}else{ 
		var style = document.createElement('style'); 
		style.type = 'text/css'; 
		style.innerHTML = tplCssStyle;
		document.getElementsByTagName('head')[0].appendChild(style); 
	} 
	*/
	var tpl_cont = $C('div');
	tpl_cont.innerHTML = struc;
	tpl_cont.id='tpl_cont';
	tpl_cont.style.display = "none";
	document.body.appendChild(tpl_cont);
	//var iframeData = $C('iframe');
	//iframeData.style.display = "none";
	//iframeData.name = "tplIframe";
	//document.body.appendChild(iframeData);
}
function initData(){
	var Data = newConf.data;
//	trace(Data.length);
	for(var i=0;i<Data.length;i++){
		var groupDiv = $C('div');
		groupDiv.className = 'group';
		groupDiv.innerHTML ='\
			<div class="unactive" id="tpl_tab'+ i +'"><span>'+ Data[i].name +'</span></div>\
			<div class="tpl_list_div" id="tpl_box'+i+'"></div>\
		';
		$('tpl_tabs').appendChild(groupDiv);
		setEvent(i);
	}
		$addEvent2('change_btn',function(){
			show_tpl();
			return false;
		},'click')
		$addEvent2('close_btn',function (){
			$('tpl_cont').style.display = 'none';
			var lr = document.location.href;
			if(/\?tmpl/.test(lr)){
				document.location.href = lr.substr(0,lr.indexOf('?'));
			}
		},'click');
		$addEvent2('diy_btn',function(){
			window.open("/control/theme/step1.html","","width=538,height=525,left=" + (window.screen.width-538)/2 + ",top=" + (window.screen.height-525)/2);
		},'click');
		var shining = setInterval(function(){
			$('tpl_msgs').style.color = ($('tpl_msgs').style.color == '#428eff') ? '#005aff' : '#428eff';
		},500);
}
function show_tpl(){
	$('tpl_cont').style.display = '';
	try{
		$('tpl_cont').style.left = (getWinSize().width - 378)/2+'px';
		$('tpl_cont').style.top = '210px';
	}catch(e){};
        if(typeof initOpenFlag == 'undefined'){
               initOpen(initCodes);
               Sina.util.Drag.init('tpl_cont','tpl_titl');
        }
	window.setTimeout(function(){
		setRightMark(getInitTheme(THEME),parseInt(sBanner));
	},500);
}
function initOpen(initCodes){
	trace('initCode : '+initCodes);
	for(var i in initCodes)
		inju(initCodes[i]);
	initOpenFlag = true;
}
function setEvent(id){
	$('tpl_box'+id).style.display = 'none';
	$addEvent2('tpl_tab'+id,function(){
		var tab = $('tpl_tab'+id);
		if(tab.className == 'active')
			setO(id,false);
		else
			setO(id,true);
		/*
		//limited
		if(checkO(id)){
			setO(id,false)
		}else{
			for(var i=0;i<conf.data.length;i++){
				setO(i,false);
			}
			setO(id,true);
		}
		*/
		listPics(id);
	},'click');
}
function setO(id,iso){
	$('tpl_tab'+id).className = iso == true ? 'active' : 'unactive';
	$('tpl_box'+id).style.display = iso == true ? '' : 'none';
	shadow();
}
function checkO(id) {
	return $('tpl_box'+id).style.display == '';
}
function inju(id){
	setO(id,true);
	listPics(id);
}
function shadow(){
	var shadowHeight = 259;
	for(var i=0;i<newConf.data.length;i++){
		if($('tpl_tab'+i).className == 'active'){
			var Data = newConf.data[i].conf;
			var row = Math.ceil(Data.length/5);
			shadowHeight += row*60;
			shadowHeight += 5;
		}
	}
	$('tpl_shad').style.height = shadowHeight;
}
function listPics(theme){
	var Data = newConf.data[theme].conf;
	trace(Data.length);
	var tab = $('tpl_tab'+theme);
	var box = $('tpl_box'+theme);
	if(tab.alt == 'init') return true;;
	tab.alt = 'init';
	var table = $C('table');
	table.border = 0;
	table.cellspacing = 0;
	table.cellpadding = 0;
	var tbody = $C('tbody');
	var row = Math.ceil(Data.length/5);
	for(var i=0;i<row;i++){
		var tr = $C('tr');
		for(var j=0;j<5;j++){
			var td = $C('td');
			var id = i*5+j;
			if(id>=Data.length) break;
			var a = $C('a');
			var cfg = Data[id];
			a.alt = cfg.oTheme+'_'+cfg.oid;
			a.href = 'javascript:;';
			a.innerHTML = '<span><div style="width:60px;height:50px;border:2px solid #FFFFFF;border-bottom:none;background:url(http://image2.sina.com.cn/blog/tmpl/v3/images/templateChange/tpl/'+cfg.oTheme+'/'+(cfg.oid+1)+'.gif) no-repeat;"></div></span>';
			a.onclick = function(){
				saveTpl(this.alt);
				this.blur();
			};
			td.appendChild(a);
			tr.appendChild(td);
		}
		tbody.appendChild(tr);
	};
	table.appendChild(tbody);
	box.appendChild(table);
}
function setRightMark(theme,id){
	var id = parseInt(id);
	var vid = null;
	var dataArr = newConf.data[theme].conf;
	for(var i=0;i<dataArr.length;i++){
		if(dataArr[i].cfg.indexOf('b'+id+',') != -1 && dataArr[i].oTheme == (parseInt(THEME)-1)){
			vid = i;
			trace('##rm_id : '+vid);
			break;
		}
	}
	removeNode('rm_cont');
	if(vid == null) return;
	var rm = $C('div');
	rm.className = 'right_mark';
	rm.style.display = "none";
	rm.innerHTML = '<img id="right_mark" src="http://image2.sina.com.cn/blog/tmpl/v3/images/templateChange/tpl/right_mark.gif" border="none">';
	rm.id = "rm_cont";
	rm.style.position = 'absolute';
	rm.style.left = (vid%5)*71 + 53 + 'px';
	rm.style.top = Math.floor(vid/5)*61 + 65 + 'px';
	rm.style.display = "";
	$('tpl_box'+theme).appendChild(rm);
}
function removeNode(s){
	if($(s)){
		$(s).innerHTML = '';
		$(s).removeNode ? $(s).removeNode() : $(s).parentNode.removeChild($(s));
	}
}
var struc = '\
<div id="tpl_list">\
	<div id="tpl_titl"><input type="button" id="close_btn" style="width:17px;height:17px;left:350px;" /></div>\
	<div id="tpl_msgs">\
		<!--<img src="http://image2.sina.com.cn/blog/tmpl/v3/images/templateChange/tpl/t_90.gif" />-->\
		一键更换您的模版，点击图片后将自动保存！\
	</div>\
	<div id="tpl_tabs">\
	</div>\
	<div id="tpl_diy_div"><img src="http://image2.sina.com.cn/blog/tmpl/v3/images/templateChange/tpl/blueArr.gif" align="absmiddle" /><a href="javascript:;" id="diy_btn">进入自定义模板</a></div>\
</div>\
<div id="tpl_shad">2</div>\
<form id="saveForm" name="saveForm" method="post" target="tplIframe">\
	<input name="index" type="hidden" value="" />\
	<input name="theme" type="hidden" value="" />\
	<input name="css" type="hidden" value="" />\
</form>\
<iframe name="tplIframe" style="display:none"></iframe>\
';
var tplCssStyle = '\
<div style="display:none">.</div>\
<style>\
#tpl_cont { position:absolute; left:100px; top:100px; width:378px; height:200px; overflow:visible; z-index:1}\
#tpl_list { position:absolute; left:0px; top:0px; background:#FFFFFF; border:1px solid #000000; width:373px; z-index:20;}\
#tpl_shad { position:absolute; left:6px; top:4px; background:#000000; width:373px; height:300px;filter:alpha(opacity=12);-moz-opacity:0.12;opacity:0.12;}\
#tpl_titl { background:url("http://image2.sina.com.cn/blog/tmpl/v3/images/templateChange/tpl/t_03.gif"); height:31px; padding-right:5px;}\
#tpl_titl input { background:url("http://image2.sina.com.cn/blog/tmpl/v3/images/templateChange/tpl/t_15.gif"); width:17px; height:17px; border:none; position:absolute; top:6px; cursor:pointer}\
#tpl_msgs { font-size:12px; text-align:center; padding-top:5px}\
#tpl_tabs { padding:0px 5px}\
#tpl_tabs .active{ text-align:left; background:url("http://image2.sina.com.cn/blog/tmpl/v3/images/templateChange/tpl/t_07.gif") no-repeat; width:360px; height:19px; cursor:pointer;}\
#tpl_tabs .unactive{ text-align:left; background:url("http://image2.sina.com.cn/blog/tmpl/v3/images/templateChange/tpl/t_14.gif") no-repeat; width:360px; height:19px; cursor:pointer;}\
#tpl_tabs .unactive span, .active span{ font-size:12px; color:#000000; margin-left:17px; line-height:20px;}\
#tpl_tabs .group{ position:relative; margin:4px 0px; } \
#tpl_tabs .tpl_list_div {margin-top:3px; text-align:left;}\
#tpl_tabs .tpl_list_div table{padding:0px;}\
#tpl_tabs .tpl_list_div tr {padding:0px;}\
#tpl_tabs .tpl_list_div td {padding:0px;}\
#tpl_tabs .tpl_list_div a { float:left; border:2px solid #FFFFFF; margin-right:2px; cursor:pointer;}\
#tpl_tabs .tpl_list_div a span { float:left; height:54px; border:1px solid #CACACC;}\
#tpl_tabs .tpl_list_div a span div { width:60px; height:50px; border:2px solid #FFFFFF;}\
#tpl_tabs .tpl_list_div a:hover {/* border:2px solid #FFB301;*/}\
#tpl_tabs .right_mark { }\
#tpl_tabs .right_mark img { width:20px; height:20px;}\
#tpl_diy_div { text-align:left;padding:8px 0 8px 8px;}\
#tpl_diy_div img {margin-right:8px;}\
#tpl_diy_div a { text-decoration:underline; color:#597CA4}\
</style>\
';
var conf = {
	'data' : [
		{
			'name' : '朴素',
			'conf' : [
				'f1,k1,e1,d1,c1,b1,m1',
				'f8,k7,e2,d2,c7,b2,m9',
				'f5,k4,e3,d7,c9,b3,m10',
				'f4,k2,e4,d2,c7,b4,m4',
				'f4,k1,e1,d4,c2,b5,m1',
				'f2,k3,e5,d1,c5,b6,m5',
				'f6,k8,e5,d8,c4,b7,m6',
				'f7,k3,e1,d5,c2,b8,m5',
				'f2,k8,e6,d6,c6,b9,m6',
				'f1,k9,e5,d5,c4,b10,m8'
			]
		},
		{
			'name' : '灰色轨迹',
			'conf' : [
				'f1,k1,e1,d1,c1,b1,m1',
				'f1,k3,e8,d2,c2,b2,m14',
				'f1,k4,e2,d7,c6,b3,m14',
				'f1,k1,e9,d5,c2,b4,m7',
				'f1,k1,e7,d6,c5,b5,m5',
				'f1,k5,e12,d2,c8,b6,m2',
				'f1,k3,e3,d4,c2,b7,m4',
				'f1,k3,e11,d1,c2,b8,m9',
				'f1,k3,e5,d7,c2,b9,m9',
				'f1,k7,e9,d1,c1,b10,m12',
				'f1,k3,e1,d1,c7,b11,m11',
				'f1,k3,e11,d4,c10,b12,m9',
				'f1,k9,e1,d5,c8,b13,m8'
			]
		},
		{
			'name' : '轻描淡写',
			'conf' : [
				'f1,k8,e1,d2,c1,b1,m8',
				'f2,k1,e4,d3,c2,b2,m2',
				'f3,k3,e3,d1,c3,b3,m9',
				'f4,k2,e5,d4,c4,b4,m7',
				'f1,k9,e10,d5,c8,b5,m3',
				'f4,k2,e2,d7,c7,b8,m9',
				'f7,k6,e13,d8,c10,b9,m9',
				'f5,k3,e3,d9,c6,b10,m7',
				'f3,k3,e,3,d10,c3,b11,m1',
				'f6,k1,e3,d6,c6,b7,m4'
			]
		},
		{
			'name' : '野蛮丫头',
			'conf' : [
				'k5,e1,d11,b1,m1',
				'k2,e2,d5,b2,m7',
				'k7,e7,d2,b3,m4',
				'k3,e5,d4,b4,m3',
				'k9,e9,d1,b5,m6',
				'k5,e5,d1,b6,m7',
				'k5,e4,d7,b7,m10',
				'k8,e5,d2,b8,m9',
				'k9,e3,d3,b9,m3',
				'k10,e4,d1,b10,m4'
			]
		},
		{
			'name' : '节日',
			'conf' : [
				'f1,k8,e1,d1,c1,b1,m1',
				'f2,k9,e3,d3,c2,b2,m2',
				'f3,k5,e5,d5,c3,b3,m5',
				'f5,k3,e12,d4,c5,b4,m4',
				'f8,k6,e1,d1,c8,b6,m6',
				'f9,k5,e6,d7,c7,b7,m9',
				'f10,k6,e2,d2,c10,b10,m6',
				'f11,k6,e11,d11,c11,b11,m11',
				'f12,k2,e12,d12,c12,b12,m12',
				'f13,k6,e13,d13,c13,b13,m13'
			]
		},
		{
			'name' : '魔兽风格',
			'conf' : [
				'f1,k1,e1,d1,c1,b1,m1',
				'f2,k2,e2,d2,c2,b2,m2',
				'f3,k5,e3,d3,c3,b3,m3',
				'f4,k7,e4,d4,c4,b4,m4',
				'f5,k7,e5,d5,c5,b5,m5',
				'f6,k5,e6,d6,c6,b6,m6',
				'f7,k8,e7,d7,c7,b7,m7',
				'f8,k1,e8,d8,c8,b8,m8',
				'f9,k7,e9,d9,c9,b9,m9',
				'f10,k9,e10,d10,c10,b10,m10'
			]
		},
		{
			'name' : '足球',
			'conf' : [
				'f1,k1,e1,d1,c1,b1,m1',
				'f3,k2,e2,d4,c1,b2,m10',
				'f2,k7,e10,d5,c4,b4,m39',
				'f9,k9,e14,d10,c10,b8,m47',
				'f10,k3,e4,d8,c9,b9,m9',
				'f9,k2,e5,d4,c7,b12,m4',
				'f5,k10,e13,d8,c3,b5,m34',
				'f3,k1,e3,d2,c7,b15,m2',
				'f2,k2,e7,d7,c8,b7,m7',
				'f6,k2,e3,d4,c1,b17,m12'
			]
		},
		{
			'name' : '音乐旋风',
			'conf' : [
				'f1,k1,e1,d1,c1,b1,m1',
				'f2,k1,e9,d7,c2,b9,m21',
				'f5,k8,e6,d6,c6,b23,m37',
				'f1,k4,e1,d5,c8,b20,m32',
				'f3,k3,e3,d15,c4,b32,m29',
				'f3,k7,e5,d9,c5,b25,m16',
				'f3,k5,e6,d3,c6,b5,m10',
				'f2,k2,e2,d7,c2,b21,m3',
				'f6,k10,e5,d6,c6,b12,m35',
				'f3,k5,e5,d3,c5,b27,m14',
				'f3,k3,e3,d7,c3,b15,m6',
				'f9,k2,e6,d3,c9,b2,m20',
				'f3,k7,e5,d3,c6,b22,m25',
				'f3,k3,e4,d7,c3,b4,m11',
				'f3,k7,e6,d3,c5,b3,m34',
				'f1,k4,e8,d4,c10,b33,m12',
				'f6,k3,e5,d3,c6,b14,m28',
				'f1,k4,e10,d4,c10,b31,m15',
				'f4,k5,e7,d6,c6,b6,m7',
				'f3,k2,e3,d14,c3,b13,m42',
				'f4,k5,e7,d6,c7,b16,m23',
				'f7,k1,e3,d3,c4,b18,m22',
				'f3,k7,e5,d3,c5,b30,m18',
				'f5,k8,e5,d3,c6,b24,m17',
				'f8,k9,e6,d3,c5,b26,m19',
				'f3,k3,e3,d3,c3,b34,m44',
				'f4,k1,e7,d3,c7,b7,m36',
				'f1,k4,e1,d5,c8,b35,m49',
				'f11,k1,e11,d3,c11,b36,m51',/* nokia 1 */
				'f12,k1,e12,d5,c12,b37,m52'/* nokia 2 */
			]
		}
	]
};
var newConf = {
	data : [
		{
			name : '浪漫温馨',
			ln : [0,2]
		},
		{
			name : '活泼可爱',
			ln : [3]
		},
		{
			name : '另类空间',
			ln : [1]
		},
		{
			name : '魔兽风格',
			ln : [5]
		},
		{
			name : '音乐旋风',
			ln : [7]
		},
		{
			name : '足球世界',
			ln : [6]
		},
		{
			name : '节日表情',
			ln : [4]/*,
			conf : [
				{
					oTheme:4,
					oid:0
				}
			]
			*/
		}
	]
};
function createNewConf(){
	for(var i=0;i<newConf.data.length;i++){
		var ln = newConf.data[i].ln;
		trace(ln);
		var sConf = [];
		for(var j=0;j<ln.length;j++){
			var arr = conf.data[parseInt(ln[j])].conf.length;
			for(var k=0;k<arr;k++){
				var tmp = {};
				tmp.oTheme = ln[j];
				tmp.oid = k;
				tmp.cfg = conf.data[ln[j]].conf[k];
				sConf.push(tmp);
			}
		}
		newConf.data[i].conf = sConf;
	}
}
createNewConf();
//star
initCodes = [];
function getInitTheme(theme){
	var theme = parseInt(theme) - 1;
	for(var i=0;i<newConf.data.length;i++){	
		if(newConf.data[i].ln.join('').indexOf(theme) != -1){
                        return i;
                }	
	}
}
initCodes.push(getInitTheme(THEME));
function initTpl(){
	initDom();
	initData();
	var lr = window.location.href;
	trace("location : "+lr);
	if(/\?tmpl/.test(lr)){
		show_tpl();
	}
}
initTpl();


