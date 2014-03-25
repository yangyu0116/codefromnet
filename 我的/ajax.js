function AddVote(id){
	var url = 'http://test.cn/index.php?action=vote';
	var param = '';
	param = 'test=' + id ;
	send_request(url,AddVoteResponse,param);
}

function AddVoteResponse(){
	var result = http_request.responseText;

	if (result == '') {
		alert('·Ç·¨²Ù×÷');
	} else {
		alert(result);
	}
	return false;
}

function send_request(url,callback,data){
	http_request = createXMLHttp();
	if (typeof(http_request) == 'undefined') {
		window.alert("Can't creat XMLHttpRequest Object.");
		return false;
	}
	nowtime	 = new Date().getTime();
	url		+= (url.indexOf('?', 0) == -1) ? '?' : '&';
	url		+= 'nowtime=' + nowtime;
	if (typeof(data) == 'undefined') {
		http_request.open('GET',url,true);
		http_request.send(null);
	} else {
		var request = data;
		http_request.open('POST',url,true);
		http_request.setRequestHeader('Content-Length', request.length);
		http_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
		http_request.send(request);
	}
	if (typeof(callback) == 'function') {
		http_request.onreadystatechange = function () {
			if (http_request.readyState == 4) {
				if (http_request.status == 200 || http_request.status == 304) {
					callback(http_request);
				} else {
					alert("Error loading page\n" + http_request.status + ':' + http_request.statusText);
				}
			}
		}
	}
}
function createXMLHttp() {
	if (window.XMLHttpRequest) {
		var objXMLHttp = new XMLHttpRequest();
		if (objXMLHttp.readyState == null) {
			objXMLHttp.readyState = 0;
			objXMLHttp.addEventListener(
			"load",
			function () {
				objXMLHttp.readyState = 4;
				if (typeof(objXMLHttp.onreadystatechange) == "function") {
					objXMLHttp.onreadystatechange();
				}
			},
			false
			);
		}
		return objXMLHttp;
	} else if (s_XMLHttpNameCache != null) {
		return new ActiveXObject(s_XMLHttpNameCache);
	} else {
		var MSXML = [
			'MSXML2.XMLHTTP.6.0',
			'MSXML2.XMLHTTP.5.0',
			'MSXML2.XMLHTTP.4.0',
			'MSXML2.XMLHTTP.3.0',
			'MsXML2.XMLHTTP.2.6',
			'MSXML2.XMLHTTP',
			'Microsoft.XMLHTTP.1.0',
			'Microsoft.XMLHTTP.1',
			'Microsoft.XMLHTTP'
		];
		var n = MSXML.length;
		for (var i = 0; i < n; i++) {
			try {
				objXMLHttp = new ActiveXObject(MSXML[i]);
				s_XMLHttpNameCache = MSXML[i];
				return objXMLHttp;
			}
			catch(e) {}
		}
		return null;
	}
}


