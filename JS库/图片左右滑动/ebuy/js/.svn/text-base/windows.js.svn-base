function WindowPopUp(page, width, height, print){
	if(!(width > 0)) width = 300;
	if(!(height > 0)) height = 200;
	if(!(print > 0)) print = 0;
	var openWin = window.open(page,"popUpWin","toolbar=" + print + ",location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,left=300,top=200,width=" + width + ",height=" + height);
	openWin.focus();
}

function WindowPopUpNamedLoc(pageurl, pagename, width, height, location)
{
	var openWin = window.open(pageurl,pagename,"toolbar=1,location=" + location + ",directories=0,status=1,menubar=0,scrollbars=1,resizable=1,left=100,top=100,width=" + width + ",height=" + height);
	openWin.focus();
}

function WindowPopUpNamed(pageurl, pagename, width, height)
{
	var openWin = window.open(pageurl,pagename,"toolbar=1,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,left=100,top=100,width=" + width + ",height=" + height);
	openWin.focus();
}

function WindowPopUpFixed(page, width, height, print){
	if(!(width > 0)) width = 300;
	if(!(height > 0)) height = 200;
	if(!(print > 0)) print = 0;
	var openWin = window.open(page,"popUpWin","toolbar=" + print + ",location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=0,left=300,top=200,width=" + width + ",height=" + height);
	openWin.focus();
}

function WindowPopUpInfo(page, width, height){
	if(!(width > 0)) width = 300;
	if(!(height > 0)) height = 200;
	var openWin = window.open(page,"popUpWin","toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=1,left=300,top=200,width=" + width + ",height=" + height);
	openWin.focus();
}

function WindowPopUpHelp(page){
	var width = 675;
	var height = 575;
	var print = 1;
	var openWin = window.open(page, "popUpWinHelp","toolbar=" + print + ",location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,left=300,top=200,width=" + width + ",height=" + height);
	openWin.focus();
}

function WindowPopUpScroll(page, width, height){
	if(!(width > 0)) width = 300;
	if(!(height > 0)) height = 200;
	var openWin = window.open(page,"popUpWin","toolbar=1 ,location=1,directories=1,status=1,menubar=1,scrollbars=1,resizable=1,left=300,top=200,width=" + width + ",height=" + height);
	openWin.focus();
}

//pop up settings for Help Links.  Now only opening up individual help pages.
function WindowPopUpHelpIso(page){
	var width = 575;
	var height = 515;
	var print = 1;
	var openWin = window.open(page, "popUpWinHelp","toolbar=" + print + ",location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,left=300,top=200,width=" + width + ",height=" + height);
	openWin.focus();
}

//Simplified version defaults to 800x600
//sample link: <a href="page.aspx" onclick="popup(this);return false;">click me for annoying popups</a>
//Written by Jethro
function popup(href){
  var openWin = window.open(href,"popup","toolbar=1,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=1,width=800,height=600px");
  openWin.focus();
  return false;
}

