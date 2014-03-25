/**
 * 设定当播放器加载页面时，是否自动播放媒体文件
 * true = 自动播放
 * false = 不要自动播放，等待使用者启动播放器
 */
var blnAutoStart = true;
/**
 * 设定曲目的预设播放顺序，是否随机(随机数/Random Playing)播放媒体
 * true = 随机播放
 * false = 循序播放
 */
var blnRndPlay = false; 
var intVolume = 80;	//默认音量
var blnAbs1stTrack = false;
var blnStatusBar = false; 	//是否在任务栏显示标题
var blnUseSmi = false;	//使用字幕功能,预留接口
var blnLoopTrk = true;	//默认循环播放
var blnShowMmInfo =false;

var objMmInfo = null;
var intMmCnt = 0;
var intSelMmCnt=0;
var intActMmCnt=0;
var intCurrActIdx=0;
var strCurrActTit="nontitle";
var strCurrMediaUrl="";
var strMmInfo ="SMusic Media Information";

var blnLonelyPlay=false;
var blnEnabled= false;
var blnEOT=false;
var arrSelMm=null;
var arrActMm=null;
var intSMusicStat=0;
var tidTLab=null;
var tidErr=null;
var tidMsg=null;
var intErrCnt=0;
var blnRept=false;
var blnExtMmUsed=false;
var strExtTitle="nontitle"

var intSupremeTrkIdx=0;
var blnAutoProc = true;
var blnElapse=true; 
var intDelay =500;
var disp2 = document.getElementById('disp2');
var musicobj;
var volSliderObj;
var dTitle;

for(var i=0; i<urlarr.length; i++) {
	mkList(urlarr[i][0], urlarr[i][1]);	//创建播放列表
}
/**
 * 初始化Windows Media Player 链接库建立环境设定
 */
function wmpInit() {
	musicobj = document.getElementById('SMusic');
	var wmpEnabled=musicobj.enabled;
	if(wmpEnabled) {
		intSMusicStat=0;
	} else {
		intSMusicStat=3;	//初始化Media Player OLE 错误
		blnEnabled=false;
	}

	var wmps = musicobj.settings;
	var wmpc = musicobj.ClosedCaption;
	

	wmps.autoStart=true;
	wmps.balance=0;
	wmps.enableErrorDialogs=false;
	wmps.invokeURLs = false;
	wmps.mute=false;
	wmps.playCount=1;
	wmps.rate=1;
	wmps.volume = intVolume;

	if(blnUseSmi) {
		wmpc.captioningID="capText";
		document.getElementById("capText").style.display="";
	}
}

/**
 * 创建 Multi-object-contents 的新数组
 */
function mkMmPath(u, t, f,s){
	this.mmUrl = u;
	var mmChkStr = u;
	mmChkStr = mmChkStr.toLowerCase();
	mmChkStr = mmChkStr.substring(mmChkStr.length - 4 , mmChkStr.length);
	switch(mmChkStr){
		case ".asx":
			this.mmeta="t";
			break;
		case ".wax":
			this.mmeta="t";
			break;
		case ".wvx":
			this.mmeta="t";
			break;
		case ".m3u":
			this.mmeta="t";
			break;
		default:
			this.mmeta="f";
 	}

	this.mmTit =t;
	this.mmDur =0;
	this.selMm=f;
	this.actMm=f;
	if(blnUseSmi) { this.mmSmi=s; }
}

/**
 * 给 Multi-object-contents数组附值
 */
function mkList(u,t,s,f){
	var cu=u;
	var ct=t;
	var cs=s;
	var cf=f;
	var idx=0;
	if(objMmInfo == null) {
		objMmInfo=new Array();
		idx=0;
	} else {
		idx=objMmInfo.length;
	}
	if(u=="" || u==null) { cu=""; }
	if(t=="" || t==null) { ct="nontitle"; }
	if(f=="f" || f=="F") {
		cf="f";
	} else{
		cf="t";
		intSelMmCnt=intSelMmCnt+1;
	}
	blnUseSmi ? objMmInfo[idx]=new mkMmPath(cu,ct,cf,cs):objMmInfo[idx]=new mkMmPath(cu,ct,cf);
	intActMmCnt=intSelMmCnt;
	intMmCnt=objMmInfo.length;
}

/**
 * 建立已选取播放项目(Selected Media)的数组
 */
function mkSel(){
//	arrSelMm=null;
	intSelMmCnt=0;
	var selidx = 0;

	var wmpEnabled=musicobj.enabled;
	if(!wmpEnabled){intSMusicStat=3; blnEnabled=false;return;} //Media Play OLE 出错
	if(intMmCnt<=0){intSMusicStat=1; blnEnabled=false; return;} //空的播放列表

	arrSelMm=new Array();
	for(var i=0; i<intMmCnt;i++) {
		if(objMmInfo[i].selMm =="t") {
			arrSelMm[selidx]=i;
			selidx=selidx+1;
		}
	}
	intSelMmCnt=arrSelMm.length;

	if(intSelMmCnt<=0) {
		blnEnabled=false;
		intSMusicStat=2;
		arrSelMm=null;
		return;
	} else{
		blnEnabled=true;
		mkAct();	//激活播入列表
	} 
}

/**
 * 激活已选择的播放列表
 */
function mkAct(){
	arrActMm=null;
	intActMmCnt=0;
	var selidx=0;
	var actidx=0;

	if(blnEnabled){
		arrActMm=new Array();
		for(var i=0; i<intSelMmCnt;i++){
			selidx=arrSelMm[i];
			if(objMmInfo[selidx].actMm=="t"){arrActMm[actidx]=selidx; actidx=actidx+1;}
		}
		intActMmCnt=arrActMm.length;
	} else { return; }
	if(intActMmCnt<=0) {
		blnEOT=true;
		arrActMm=null;
	} else { blnEOT=false; }
}

/**
 * 全部选取所有的播放清单项目
 */
function chkAllSel() {
	for(var i=0; i<intMmCnt; i++){
		objMmInfo[i].selMm="t";
		objMmInfo[i].actMm="t";
	}
	mkSel();
	dspList();
}

/**
 * 取消所有的媒体选择
 */
function chkAllDesel() {
	for(var i=0; i<intMmCnt; i++){
		objMmInfo[i].selMm="f";
		objMmInfo[i].actMm="f";
	}
	mkSel();
	dspList();
}
/**
 * 反向选择
 */
function reverseSel() {
	for(var i=0; i<intMmCnt; i++) {
		if(objMmInfo[i].selMm =="t") {
			objMmInfo[i].selMm="f";
			objMmInfo[i].actMm="f";
		} else {
			objMmInfo[i].selMm="t";
			objMmInfo[i].actMm="t";
		}
	}
	mkSel();
	dspList();
}
/**
 * 设置选取或不选取播放清单项目（反向选择）
 */
function chkItemSel(idx) {
	if(objMmInfo[idx].selMm =="t") {
		objMmInfo[idx].selMm="f";
		objMmInfo[idx].actMm="f";
	} else {
		objMmInfo[idx].selMm="t";
		objMmInfo[idx].actMm="t";
	}
	mkSel();
}

/**
 * 将某个已启用播放项目(Activated Media)冻结
 */
function chkItemAct(idx){
	objMmInfo[idx].actMm="f";
	mkAct();
}

/**
 * 激活未选择到播放列表的媒体
 */
function mkSelAct(){
	var idx=0;
	for(var i=0; i<intSelMmCnt; i++){
		idx=arrSelMm[i];
		objMmInfo[idx].actMm="t";
 	}
	mkAct();
}

/**
 * 将已选取播放项目(Selected Media)加入到已启用播放项目(Activated Media)
 */
function inLink(trk){
	var wmps= musicobj.playState;
	if(wmps==2 || wmps==3){musicobj.controls.stop();}
	blnExtMmUsed=false;

	if(isNaN(parseInt(trk))){
		etcMsg(6,trk);
		return;
	} else {
  		var innerIdx = parseInt(trk) - 1;
  		if(innerIdx<0 || innerIdx>=intMmCnt){
			etcMsg(6,trk);	return;
  		} else { 
			blnLonelyPlay=true; 
			intErrCnt=0;
			selMmPlay(innerIdx);
		}
	}
}

/**
 * 给Media Player附媒体地址
 * @param string url: 音乐的URL地址
 * @param string tit: 音乐标题
 */
function outLink(url , tit){
	var wmps= musicobj.playState;
	if(wmps==2 || wmps==3){musicobj.controls.stop();}
	blnExtMmUsed=true;

	var wmpEnabled=musicobj.enabled;
	var wmps=musicobj.settings;
	if(!wmpEnabled) {
		intSMusicStat=3;	//OLE错语(return void)
		waitMsg();
	} else {
		blnLonelyPlay=true;
		intErrCnt=0;
		strCurrMediaUrl=url;
		if(url==null || url=="") {etcMsg(5);return;} //Media URL Empty Error
		if(tit==null || tit==""){
			strExtTitle="nontitle";
		} else{ strExtTitle=tit; }
		strCurrActTit=strExtTitle;
		musicobj.URL=strCurrMediaUrl;
		if(!wmps.autoStart) { musicobj.controls.play(); }
		disp1.innerHTML= strCurrActTit;
		if(blnStatusBar){window.status=(strCurrActTit);}	//在状态栏显示标题
	}
}
/**
 * 初始化Media Player播放器
 */
function initMPlayer(){
	var re = new RegExp("(msie[^;^)^(]*)", "ig");
	if(navigator.userAgent.search(re) == -1) {
		alert("请使用IE浏览器访问，可能无法使用播放器功能！");
	}
	wmpInit();
	mkSel();
	blnLonelyPlay=false;
	blnExtMmUsed=false;
	blnRept ? imgChange('rept',1) : imgChange('rept',0);
	blnLoopTrk ? imgChange('tloop',1) : imgChange('tloop',0);
	blnRndPlay ? imgChange('pmode',1) : imgChange('pmode',0);
 	showTLab();
 	dTitle = document.getElementById('disp1');
 	dTitle.innerHTML="X-Space Music/Video Player";
 	if(blnStatusBar){window.status=('X-Space Music/Video Player');}
 	if(blnAutoStart){ startSMusic(); }
}

/**
 * 开始播放媒体
 */
function startSMusic() {
	var wmps= musicobj.playState;
	if(musicobj.settings.rate != 1.0){musicobj.settings.rate=1.0; return;}
	if(wmps==2){musicobj.controls.play(); return;}	//如果状态为中止，则激活播放
	if(wmps==3){return;}	//如是在播放状态，则直接退出

	blnLonelyPlay=false;
	if(!blnEnabled) { waitMsg();return; }
	if(blnEOT) { mkSelAct(); }
	if(intErrCnt>0) {
		intErrCnt=0;
		tidErr=setTimeout('retryPlay(),1000');
		return;
	}
	if(isNaN(intSupremeTrkIdx) || intSupremeTrkIdx >= intMmCnt) { intSupremeTrkIdx=0; }
	if(blnRndPlay) {
		rndPlay();
	} else {
		if(objMmInfo[intSupremeTrkIdx].selMm=="t" && objMmInfo[intSupremeTrkIdx].actMm=="t") {
			intCurrActIdx=intSupremeTrkIdx;
			selMmPlay(intSupremeTrkIdx);
		} else {
			intCurrActIdx=arrActMm[0];
			selMmPlay(intCurrActIdx);
		}
	}
}

/**
 * 处理播入媒体标题，如果媒体路径为空则跳到下一个媒体播放
 */
function selMmPlay(idx){
	clearTimeout(tidErr);
	if(intSMusicStat==3){blnEnabled=false;waitMsg();return;} // WindowsMedia OLE 错误
	blnExtMmUsed=false;
	intCurrActIdx=idx;
 	var trknum=idx+1;
 	var ctit =objMmInfo[idx].mmTit;
 	if(ctit=="nontitle") {ctit="正在获取标题或歌手";}
 	if(blnUseSmi){musicobj.ClosedCaption.SAMIFileName = objMmInfo[idx].mmSmi;}
 	strCurrMediaUrl=objMmInfo[idx].mmUrl;
	//如果媒体路径为空，则播放下一个媒体
 	if(strCurrMediaUrl=="" || strCurrMediaUrl==null){ etcMsg(4);setTimeout('playAuto()', 3000);return; }
 	musicobj.URL = strCurrMediaUrl;
 	var wmps=musicobj.settings;
 	if(!wmps.autoStart) { musicobj.controls.play(); }
 	if(blnAbs1stTrack && intCurrActIdx==intSupremeTrkIdx) {
 		strCurrActTit="[SupremeTrack:" + trknum + "] " + ctit;
 	} else { strCurrActTit= " "+ trknum + ". " + ctit; }
	dTitle.innerHTML = strCurrActTit;
	if(blnStatusBar) { window.status=(strCurrActTit); }
	chkItemAct(intCurrActIdx); 
}

/**
 * 使用wmp-obj播放媒体
 */
function wmpPlay() { musicobj.controls.play(); }

/**
 * 停止或等待播放
 */
function wmpStop(){
	intErrCnt=0;
	clearTimeout(tidErr);
	clearInterval(tidTLab);
	imgChange("stopt",1);
	imgChange("pauzt",0);
	showTLab();
	mkSelAct();
	musicobj.controls.stop();
	musicobj.close();
	dTitle.innerHTML="等待播放";
	if(blnStatusBar) {window.status=('等待播放');return true;}
}

/**
 * 暂停wmp-obj播放媒体
 */
function wmpPause() { musicobj.controls.pause(); }

/**
 * 暂停或播放媒体
 */
function wmpPP(){
	var wmps = musicobj.playState;
	var wmpc=musicobj.controls;
	clearInterval(tidTLab);
	clearTimeout(tidMsg);
	if (wmps == 2) {wmpc.play();}
	if (wmps == 3) {
		wmpc.pause();
 		disp2.innerHTML="暂停";
 		tidMsg=setTimeout('rtnTLab()',1500);
 	}
 	return;
}
/**
 * 后退
 */
function fastRew() {
	clearInterval(tidTLab);
	var wmpfr=musicobj.controls.isAvailable("FastReverse");
	if(wmpfr){musicobj.controls.fastReverse();
		disp2.innerHTML="FastRWD"
	} else {
		disp2.innerHTML="noReward";
	}
}
/**
 * 前进
 */
function fastFwd() {
	clearInterval(tidTLab);
	var wmpff=musicobj.controls.isAvailable("FastForward");
	if(wmpff){musicobj.controls.fastForward();
		disp2.innerHTML="FastFWD"
	} else {
		disp2.innerHTML="noForward"
	}
}

function endFwd(){
	if(musicobj.settings.rate >1.0) {
  		musicobj.settings.rate=1.0;
	} else {
		tidTLab=setInterval('showTLab()',1000);
	}
}

function endRew(){
	if(musicobj.settings.rate <1.0) {
		musicobj.settings.rate=1.0;
	} else {
		tidTLab=setInterval('showTLab()',1000);
	}
}

/**
 * 随机播放(Random Play)模式
 */
function rndPlay(){
	if(!blnEnabled) {waitMsg();return;}
	intErrCnt=0;
	if(blnAbs1stTrack){
		if(objMmInfo[intSupremeTrkIdx].selMm=="t" && objMmInfo[intSupremeTrkIdx].actMm=="t") {
			intCurrActIdx=intSupremeTrkIdx;
			selMmPlay(intSupremeTrkIdx);
		} else {
			var idx=Math.floor(Math.random() * intActMmCnt);
		 	intCurrActIdx= arrActMm[idx];
			selMmPlay(intCurrActIdx);
		}
 	} else {
		var idx=Math.floor(Math.random() * intActMmCnt);
	 	intCurrActIdx= arrActMm[idx];
		selMmPlay(intCurrActIdx);
	} 
}

/**
 * 对已启用播放项目进行“自动连续播放”的处理
 * 这是根据上面 blnAutoProc 的设定值而决定的动作。
 */
function playAuto(){
	var wmps=musicobj.playState;
	if(wmps>1 && wmps<10){return;}

	if(!blnAutoProc){wmpStop();return;}
	if(blnLonelyPlay){wmpStop(); return;} 
	if(!blnEnabled){wmpStop();return;}
	if(blnEOT) {
		if(blnLoopTrk) {
			startSMusic();
		} else { wmpStop(); }
 	} else {
		if(blnRndPlay) {
			rndPlay();
		} else {
			intErrCnt=0;
			var idx=intCurrActIdx;
	 		var blnFind=false;
			for(var i=0;i<intSelMmCnt;i++) {
				if(intCurrActIdx==arrSelMm[i]) {
					idx=i+1;
					blnFind=true;
				}
			}
			if(!blnFind) { return; }
			if(idx>=intSelMmCnt) {
				idx=0;
				intCurrActIdx=arrSelMm[idx];
			} else { intCurrActIdx=arrSelMm[idx]; }
			selMmPlay(intCurrActIdx); 
		}

	}
}

/**
 * 播放使用者在播放清单上所点选的单一曲目
 */
function selPlPlay(idx){
	var wmps= musicobj.playState;
	if(wmps==2 || wmps==3) { musicobj.controls.stop(); }
 	blnLonelyPlay=false; 
	intErrCnt=0;
	selMmPlay(idx);
}
/**
 * 播放上一首
 */
function playPrev(){
	var wmps= musicobj.playState;
	if(wmps==2 || wmps==3) { musicobj.controls.stop(); }
	blnLonelyPlay=false;
	if(!blnEnabled) { waitMsg();return; }
	if(blnEOT) { mkSelAct(); }
	intErrCnt=0;
	if(blnRndPlay) {
		rndPlay();
	} else {
		var idx=intCurrActIdx;
 		var blnFind=false;
		for(var i=0;i<intSelMmCnt;i++) {
			if(intCurrActIdx==arrSelMm[i]) {
				idx=i-1;
				blnFind=true;
			}
		}
		if(!blnFind) { startSMusic();return; }
		if(idx<0) {
			idx=intSelMmCnt-1;
			intCurrActIdx=arrSelMm[idx];
		} else { intCurrActIdx=arrSelMm[idx]; }
		selMmPlay(intCurrActIdx);
	}
}
/**
 * 播放下一首媒体
 */
function playNext(){
	var wmps= musicobj.playState;
	if(wmps==2 || wmps==3) { musicobj.controls.stop(); }
	blnLonelyPlay=false;
 	if(!blnEnabled){waitMsg();return;}
 	if(blnEOT){mkSelAct();}
	intErrCnt=0;
	if(blnRndPlay) {
		rndPlay();
	} else{
		var idx=intCurrActIdx;
 		var blnFind=false;
		for(var i=0;i<intSelMmCnt;i++) {
			if(intCurrActIdx==arrSelMm[i]) {
				idx=i+1;
				blnFind=true;
			}
		}
		if(!blnFind) { startSMusic();return; }
		if(idx>=intSelMmCnt) {
			idx=0;
			intCurrActIdx=arrSelMm[idx];
		} else {
			intCurrActIdx=arrSelMm[idx];
		}
		selMmPlay(intCurrActIdx);
	}
}

/**
 * 重试当前播放媒体
 */
function retryPlay(){
	var wmps=musicobj.settings;
	musicobj.URL=strCurrMediaUrl;
	if(!wmps.autoStart) { musicobj.controls.play(); }
}

/**
 * 重复播入当前媒体
 */
function chkRept(){
	var wmps=musicobj.playState;
	if(wmps == 3) { clearInterval(tidTLab); }
	if(blnRept) {
		musicobj.settings.playCount=1;
		blnRept=false;
		imgChange('rept',0);
		disp2.innerHTML="正常播放";
	} else {
		musicobj.settings.playCount=65535;
		blnRept=true;
		imgChange('rept',1);
		disp2.innerHTML="重复播放";
	}
	tidMsg= setTimeout('rtnTLab()',1000);
}
/**
 * 选择播放模式：随机、顺序播放
 */
function chgPMode(){
	var wmps=musicobj.playState;
	if(wmps == 3) { clearInterval(tidTLab); }
	if(blnRndPlay) {
		musicobj.settings.setMode("shuffle", false);
		blnRndPlay=false;
		imgChange('pmode',0);
		disp2.innerHTML="顺序播放";
	} else {
		musicobj.settings.setMode("shuffle", true); 
		blnRndPlay=true;
		imgChange('pmode',1);
		disp2.innerHTML="随机播放";
	}
	tidMsg=setTimeout('rtnTLab()',1000); 
}
/**
 * 循环播放
 */
function chgTrkLoop(){
	var wmps=musicobj.playState;
	if(wmps == 3) { clearInterval(tidTLab); }
	if(blnLoopTrk) {
		blnLoopTrk=false;
		imgChange('tloop',0);
		disp2.innerHTML="不循环播放";
	} else {
		blnLoopTrk=true;
		imgChange('tloop',1);
		disp2.innerHTML="循环播放";
	}
	tidMsg=setTimeout('rtnTLab()',1000); 
}
/**
 * 0(Undefined) 8(MediaChanging) 9(MediaLocating) 10(MediaConnecting) 11(MediaLoading)
 * 12(MediaOpening) 13(MediaOpen) 20(MediaWaiting) 21(OpeningUnknownURL)
 */
function evtOSChg(f) {
	if(f==8 && blnUseSmi){document.getElementById('capText').innerHTML="";}
	if(f==9){disp2.innerHTML="(Access)"; imgChange("playt",6); if(blnStatusBar){window.status=('(Wait...Media Locating)');}} //display 'buffering' image
	if(f==10){disp2.innerHTML="(Connect)"; imgChange("playt",6); if(blnStatusBar){window.status=('(Wait...Media Connecting)');}} //display 'buffering' image
	if(f==11){disp2.innerHTML="(Loading)"; imgChange("playt",6); if(blnStatusBar){window.status=('(Wait...Media Loading)');}} //display 'buffering' image
	if(f==12){disp2.innerHTML="(Opening)"; imgChange("playt",6); if(blnStatusBar){window.status=('(Wait...Media Opening)');}} //display 'buffering' image
	if(f==20){disp2.innerHTML="(Waiting)"; imgChange("playt",6); if(blnStatusBar){window.status=('(Wait...Media Waiting)');}} //display 'buffering' image
	if(f==21){disp2.innerHTML="(Opening)"; imgChange("playt",6); if(blnStatusBar){window.status=('(Wait...Unknown Media URL)');}} //display 'buffering' image
	if(f==13) {
		var strTitle = musicobj.currentMedia.getItemInfo("title");
		if(strTitle.length <=0) { strTitle = "Unknown" }
		var strAuthor = musicobj.currentMedia.getItemInfo("Author");
		if(strAuthor.length <=0) { strAuthor = "Unknown" }
		var strCopy = musicobj.currentMedia.getItemInfo("Copyright");
		if(strCopy.length <=0) { strCopy = "Unknown" }
		var strType = musicobj.currentMedia.getItemInfo("MediaType");
		var strBitrate = musicobj.currentMedia.getItemInfo("Bitrate");
		var strBandwidth =  musicobj.network.bandwidth;
		var strDur=musicobj.currentMedia.durationString;
		var strUrl =musicobj.currentMedia.sourceURL;


		strMmInfo= "Media Title : " + strTitle + "\n\n"
		strMmInfo= strMmInfo + "Media Author : " + strAuthor + "\n\n"
		strMmInfo= strMmInfo + "Media URL : " +strUrl + "\n\n"
		strMmInfo= strMmInfo + "Media Copyright : " + strCopy +"\n\n" 
		strMmInfo= strMmInfo + "Media Type : " +strType +"\n\n"
		strMmInfo= strMmInfo + "Media Duration : " +strDur +"\n\n"
		strMmInfo= strMmInfo + "Media Bitrate : " + parseInt(strBitrate/1000) + " KBit/sec \n\n"
		strMmInfo= strMmInfo + "Media Bandwidth : " + parseInt(strBandwidth/1000) + " KHz \n\n"
		strMmInfo= strMmInfo + " (C)Copyright SupeSite/X-Space  \n";
		if(blnShowMmInfo){alert(strMmInfo);}

		if(blnExtMmUsed){
			if(strExtTitle=="nontitle"){strExtTitle="LoadTitle";}
			strCurrActTit=strExtTitle + "(Info: " + strAuthor + " - " + strTitle + ")";
			dTitle.innerHTML = strCurrActTit;
			if(blnStatusBar){window.status=(strCurrActTit);}
			return;
		}

		var trknum=intCurrActIdx+1;
		var ctit = objMmInfo[intCurrActIdx].mmTit;
	
		if(ctit=="nontitle" && objMmInfo[intCurrActIdx].mmeta=="f"){ 
			objMmInfo[intCurrActIdx].mmTit = "(Title) " + strAuthor + " - " + strTitle;
			ctit="(Info) " + strAuthor + " - " + strTitle;
			if(blnAbs1stTrack && intCurrActIdx==intSupremeTrkIdx){strCurrActTit= "[SupremeTrack:" + trknum + "] " + ctit;}
			else{strCurrActTit= " "+ trknum + ". " + ctit; }
		}

		if(objMmInfo[intCurrActIdx].mmeta=="t") {
			if(ctit=="nontitle") {
				if(blnAbs1stTrack && intCurrActIdx==intSupremeTrkIdx) {
					strCurrActTit="[SupremeTrack:"+ trknum +"] " + " ASXmode (Title:" + strAuthor + "- " + strTitle + ")" ;
				} else {
					strCurrActTit= " "+trknum + ". " + " ASXmode (Title:" + strAuthor +"- "+strTitle+")";
				}
			} else {
				if(blnAbs1stTrack && intCurrActIdx==intSupremeTrkIdx) {
					strCurrActTit="[SupremeTrack:"+trknum+"] " + ctit + " (Title:" + strAuthor +"- "+strTitle+")";
				} else {
					strCurrActTit= " "+trknum + ". " + ctit + " (Title:" + strAuthor +"- "+strTitle+")";
				}
			}
		}
		dTitle.innerHTML = strCurrActTit;

	}
}
/**
 * 0(Undefined) 1(Stopped) 2 (Paused) 3(Playing) 4(ScanFowrd) 5(ScanReverse)
 * 6(Buffering) 7(Waitng) 8(MediaEnded) 9(Transitioning) 10(Ready)
 */
function evtPSChg(f){
	switch(f){
		case 1:
			evtStop();
			break;
		case 2:
			evtPause();
			break;
		case 3:
			evtPlay();
			break;
		case 7:
			evtWait();
			break;
		case 8:
			setTimeout('playAuto()', intDelay);
			break;
	}
}

function evtWmpBuff(f) {
//	disp1 = document.getElementById('disp1');
	if(f){ disp2.innerHTML = "Buffering";
		var msg="(Buffering) " + strCurrActTit;
		dTitle.innerHTML = msg;
		imgChange("playt",6);
		if(blnStatusBar){window.status=(msg);}
	} else { 
		dTitle.innerHTML = strCurrActTit;
		showTLab();
		imgtog('playt',3);
	}
}


function evtWmpError() {
	intErrCnt=intErrCnt+1;
	musicobj.Error.clearErrorQueue();
	imgChange("pauzt",0);
	imgChange("playt",0);
	if(intErrCnt<=3) {
		strCurrMediaUrl=musicobj.URL;
		disp2.innerHTML="重试("+intErrCnt+")";
		var msg="(重试:" + intErrCnt +") " +strCurrActTit;
		dTitle.innerHTML="<错误> " +strCurrActTit;
		if(blnStatusBar){window.status=(msg);}
		tidErr=setTimeout('retryPlay()',1000);
	} else{	
		clearTimeout(tidErr);
		intErrCnt=0;showTLab();
		var msg="正在读取播放媒体文件……";
		dTitle.innerHTML=msg;
		if(blnStatusBar){window.status=(msg);}	
		if(!blnLonelyPlay && blnAutoProc) { setTimeout('playAuto()',1000); }
	}
}

function evtWait() {
	disp2.innerHTML="(等待)";
	if(blnStatusBar){window.status=('(Wait...Media Waiting)');}
	imgChange("playt",6); //display 'buffering' image
}

function evtStop(){
	clearTimeout(tidErr);
	clearInterval(tidTLab);
	showTLab();
	intErrCnt=0;
	imgtog('vmute',3);
	imgChange("pauzt",0);
	imgChange("playt",0);
	dTitle.innerHTML="播放等待中……";
	if(blnStatusBar){window.status=('播放等待中……');return true;}
}

function evtPause(){
	imgChange("pauzt",1)
	imgChange("playt",0);
	imgChange("stopt",0);
	clearInterval(tidTLab);
	showTLab();
}

function evtPlay(){
	imgChange("pauzt",0)
	imgChange("playt",1);
	imgChange("stopt",0);
	imgtog('vmute',3); //recover abnormal 'mute' image
	tidTLab=setInterval('showTLab()',1000);
}

/**
 * 显示时间长度Displaying Timer label(Elapse,Lapse)
 */
function showTLab(){
	var ps=musicobj.playState;
	disp2 = document.getElementById('disp2');
	if(ps==2 || ps==3){
		var cp=musicobj.controls.currentPosition
		var cps=musicobj.controls.currentPositionString
		var dur=musicobj.currentMedia.duration;
		var durs=musicobj.currentMedia.durationString;
		if(isNaN(dur) || dur==0){durs="(AIR)";}
		if(blnElapse){disp2.innerHTML= cps+" | "+durs;
			var msg=strCurrActTit + " ("+cps+" | "+durs+ ")";
			if(ps==2){msg="(Pause) "+ msg;}
			if(blnStatusBar){window.status=(msg);return true;}
		} else {
			var lapse
			if(isNaN(dur) || dur==0) {
				strLapse="Live";
			} else {
				lapse=dur-cp;
				var strLapse=wmpTime(lapse);
			}
			disp2.innerHTML= strLapse + " | "+durs;
			var msg= strCurrActTit + " (" + strLapse + " | "+durs + ")";
			if(ps==2) { msg="(暂停) "+ msg; }
			if(blnStatusBar) { window.status=(msg);return true; }
		}

	} else {disp2.innerHTML="00:00 | 00:00"; }
}

/**
 * 时间显示模式
 */
function chgTimeFmt(){
	var wmps=musicobj.playState;
	if(wmps == 3) { clearInterval(tidTLab); }
	if(blnElapse) {
		blnElapse=false;
		disp2.innerHTML="倒计时";
	} else {
		blnElapse=true;
		disp2.innerHTML="顺计时";
	}
 	tidMsg=setTimeout('rtnTLab()',1000); 
}

/**
 * 显示时间指示器
 */
function rtnTLab(){
	clearTimeout(tidMsg);
	var wmps=musicobj.playState;
	wmps == 3 ? tidTLab=setInterval('showTLab()',1000) : showTLab();
}
/**
 * 计算时间长度
 */
function wmpTime(dur){
	if(isNaN(dur) || dur==0){return "Live";}
	var hh, min, sec, timeLabel
	hh = Math.floor(dur/3600);
	min = Math.floor(dur / 60)%60;
	sec = Math.floor(dur % 60);
	if (isNaN(min)){ return "00:00"; }
	if (isNaN(hh) || hh==0) {
		timeLabel="";
	} else {
 		if(hh >9) {
			timeLabel = hh.toString()+":";
		} else { timeLabel="0"+hh.toString() +":"; }
	}
	if ( min > 9 ) {
		timeLabel = timeLabel + min.toString() + ":";
	} else {
		timeLabel = timeLabel + "0" +min.toString() + ":";
	}
	if ( sec > 9 ) {
		timeLabel = timeLabel + sec.toString();
	} else {
		timeLabel = timeLabel + "0" + sec.toString();
	}
	return timeLabel;
}
/**
 * 静音
 */
function wmpMute() {
	var wmps=musicobj.playState;
	if(wmps == 3) { clearInterval(tidTLab); }
	var ps = musicobj.settings;
	if(!ps.mute) {
		ps.mute = true;
		disp2.innerHTML="静音";
		imgChange("vmute", 1);
	} else {
		ps.mute = false;
		disp2.innerHTML="取消静音";
		imgChange("vmute", 0)
	}
	tidMsg=setTimeout('rtnTLab()',1000);
}
/**
 * 显示音量
 */
function prnVol() { disp2.innerHTML= "音量. " + musicobj.settings.Volume + "%"; }
/**
 * 显示指定的消息
 */
function waitMsg(){
 var outMsg="";
 if(blnUseSmi){document.getElementById('capText').innerHTML="";}
 switch(intSMusicStat){
	case 1 :
		outMsg="对不起，没有找到播放媒体列表";
		dTitle.innerHTML=outMsg;
		if(blnStatusBar){window.status=(outMsg);return true;}
		break;
	case 2 :
		outMsg="请选择待播放的媒体文件";
		dTitle.innerHTML=outMsg;
		if(blnStatusBar){window.status=(outMsg); return true;}
		break;
	case 3 :
		outMsg="警告: 您本机的Windows Media Player有问题，请确认Media Player是否可用";
		dTitle.innerHTML=outMsg;
		if(blnStatusBar){window.status=(outMsg);return true;}
		break;

	default :
		outMsg="SupeSite/X-Space 媒体播放器";
		dTitle.innerHTML=outMsg;
		if(blnStatusBar){window.status=(outMsg);return true;}
 }
}

function etcMsg(f, e1, e2){
	var outMsg="";
	if(blnUseSmi){document.getElementById('capText').innerHTML="";}
	switch(f){
		case 4 :
			outMsg="警告: 媒体 "+ (intCurrActIdx+1) + ". 路径为空";
			dTitle.innerHTML=outMsg;
			if(blnStatusBar){window.status=(outMsg);return true;}
			break;
	
		case 5 :
			outMsg="警告: 媒体路径为空，或不正常路径";
			dTitle.innerHTML=outMsg;
			if(blnStatusBar){window.status=(outMsg);return true;}
			break;
		case 6 :
			outMsg="对不起，找不到媒体 No. " + e1 ;
			dTitle.innerHTML=outMsg;
			if(blnStatusBar){window.status=(outMsg);return true;}
			break;
		default :
			outMsg="SupeSite/X-Space 媒体播放器";
			dTitle.innerHTML=outMsg;
			if(blnStatusBar){window.status=(outMsg);return true;}
	}
}

function fullScreen(){
	var wmps=musicobj.playState;
	if(wmps==2 || wmps==3 ){ musicobj.fullscreen=true;}
}

/**
 * 当播放程序动作变更时，传回 playState 的状态值
 * 0(Undefined) 1(Stopped) 2 (Paused) 3(Playing) 4(ScanFowrd) 5(ScanReverse)
 * 6(Buffering) 7(Waitng) 8(MediaEnded) 9(Transitioning) 10(Ready)
 */
function chkWmpState(){
	return musicobj.playState;
}
/**
 * 当播放程序开启媒体档案准备播放时，传回 openState 的状态值
 * @return 0(Undefined) 8(MediaChanging) 9(MediaLocating) 10(MediaConnecting) 11(MediaLoading)12(MediaOpening) 13(MediaOpen) 20(MediaWaiting) 21(OpeningUnknownURL)
 */
function chkWmpOState(){
	return musicobj.openState;
}
/**
 * 检查使用者的联机状态
 * @return true(已联机到因特网) false(没有联机到因特网)
 */
function chkOnline() {
	return musicobj.isOnline;
}

/**
 * 音量调节功能
 */
document.onmouseup=function() { blnDragging=false; }
var sliderPosLeft;
var volSliderLength=48;
var blnDragging=false;
var mPosX;
var evtSrcObj;
var eobj;

/**
 * 初始化音量开关
 */
function initVol() {
	var ps=intVolume;
	if(isNaN(ps) || ps<0) { ps=0; }
	else if(ps>=100){ps=100;}
	volSliderObj = document.getElementById('volSlider');
	sliderPosLeft = parseInt(volSliderObj.style.left);
	volSliderObj.style.left = (sliderPosLeft + Math.floor(volSliderLength * ps/100)) + "px";;
}

function volTracking() {
	if (blnDragging) {	// && eobj.button==1
		musicobj.settings.Mute=false;
		imgChange("vmute", 0)
		var sliderLength= volSliderLength;
		var minLimit= 14;
		var maxLimit= 75;
		var mov =  sliderPosLeft + eobj.clientX - mPosX;
		if(mov <= minLimit){
			volSliderObj.style.left=minLimit + 'px';
			musicobj.settings.volume=0;
 			prnVol();
		}
		if(mov > maxLimit){
			volSliderObj.style.left=maxLimit + 'px';;
			musicobj.settings.volume=100;
 			prnVol();
		}
		if ((mov <= maxLimit) &&  (mov > minLimit )){
			volSliderObj.style.left = (sliderPosLeft + eobj.clientX - mPosX) + 'px';
			musicobj.settings.volume=Math.round(((mov-minLimit-2)/(sliderLength))*100);
 			prnVol();
		}

	}
	return false;
}
function setVol() {
	blnDragging=false;
}
function readyDrag(e) {
	if(document.layers){return false;}
	if(typeof e.srcElement != 'undefined') {
		evtSrcObj = e.srcElement.id;
	} else {
		evtSrcObj = e.target.id;
	}
	switch(evtSrcObj){
		case "volSlider" :
			mPosX=e.clientX;
			sliderPosLeft = parseInt(volSliderObj.style.left);
			blnDragging=true;
			eobj = e;
			document.onmouseup = setVol;
			volSliderObj.onmousemove = volTracking;
			break;
		case "procSlider" :
			moveProc();
			break;
		default :
			return false;
	}
}
/**
 * 媒体列表
 */
function playSel(){wmpStop();startSMusic();}

function dspList(){
	musicList = document.getElementById('xspace-mmList');
	if(intMmCnt >0 ){
		var list_num=0;
		document.getElementById('xspace-mmList').innerHTML='';
		for (var i=0; i < intMmCnt; i++) {
			list_num = i + 1;
			if(objMmInfo[i].selMm=="t") {
				elm=' <input type=checkbox  style="cursor:pointer;" onClick=chkItemSel('+ i +'); checked>' ;
			} else {
				elm = ' <input type=checkbox style="cursor:pointer;" onClick=chkItemSel('+ i +');>' ;
			}
			elm = elm + '&nbsp;' + list_num + '. ' 
			elm = elm + '<a href=javascript:selPlPlay(' + i + ');'
			elm = elm + ' onclick=\"this.blur();\">'
			if(objMmInfo[i].mmTit =="nAnT") {
				elm = elm + "(Info)Tracing Media Author-Titles";
			} else {
				elm = elm + objMmInfo[i].mmTit;
			}
			elm= elm+  '</a><br>';
			musicList.innerHTML=musicList.innerHTML+elm;
		}
	} else { musicList.innerHTML='<div align=center> 对不起，没有找到任何媒体文件 </div>'; }
}
