/*
	[Discuz!] (C)2001-2007 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$RCSfile: post_editor.js,v $
	$Revision: 1.17 $
	$Date: 2007/07/30 00:38:39 $
*/

function checklength(theform) {
	var message = bbinsert && wysiwyg ? html2bbcode(getEditorContents()) : (parseurl(theform.message.value));
	var showmessage = postmaxchars != 0 ? lang['board_allowed'] + ': ' + postminchars + ' ' + lang['lento'] + ' ' + postmaxchars + ' ' + lang['bytes'] : '';
	alert('\n' + lang['post_curlength'] + ': ' + mb_strlen(message) + ' ' + lang['bytes'] + '\n\n' + showmessage);
}

if(!tradepost) {
	var tradepost = 0;
}

function validate(theform, previewpost) {
	if(!previewpost && ($('postsubmit').name == 'topicsubmit' || $('postsubmit').name == 'editsubmit' && isfirstpost) &&
		$('postsubmit').name != 'editsubmit' && tagrequired == 2 && $('tags').value == '') {
		relatekw(-1, -1, 'if($(\'tags\').value == \'\') {alert(lang[\'post_tag_isnull\']);$(\'postform\').tags.focus();} else {validate($(\'postform\'))}');
		return false;
	}
	var message = bbinsert && wysiwyg ? html2bbcode(getEditorContents()) : (parseurl(theform.message.value));
	if(($('postsubmit').name != 'replysubmit' && !($('postsubmit').name == 'editsubmit' && !isfirstpost) && theform.subject.value == "") || message == "") {
		alert(lang['post_subject_and_message_isnull']);
		if(special != 2) {
			theform.subject.focus();
		}
		return false;
	} else if(mb_strlen(theform.subject.value) > 80) {
		alert(lang['post_subject_toolong']);
		theform.subject.focus();
		return false;
	}
	if(tradepost) {
		if(theform.item_name.value == '') {
			alert(lang['post_trade_goodsname_null']);
			theform.item_name.focus();
			return false;
		} else if(theform.item_price.value == '') {
			alert(lang['post_trade_price_null']);
			theform.item_price.focus();
			return false;
		} else if(!parseInt(theform.item_price.value)) {
			alert(lang['post_trade_price_is_number']);
			theform.item_price.focus();
			return false;
		} else if(theform.item_costprice.value != '' && !parseInt(theform.item_costprice.value)) {
			alert(lang['post_trade_costprice_is_number']);
			theform.item_costprice.focus();
			return false;
		} else if(theform.item_number.value != '0' && !parseInt(theform.item_number.value)) {
			alert(lang['post_trade_amount_is_number']);
			theform.item_number.focus();
			return false;
		}
	}
	if(in_array($('postsubmit').name, ['topicsubmit', 'editsubmit'])) {
		if(theform.typeid && (theform.typeid.options && theform.typeid.options[theform.typeid.selectedIndex].value == 0) && typerequired) {
			alert(lang['post_type_isnull']);
			theform.typeid.focus();
			return false;
		}
		if(!previewpost && tagrequired == 2 && theform.tags.value == "" && isfirstpost) {
			alert(lang['post_tag_isnull']);
			theform.tags.focus();
			return false;
		}
		if(special == 3 && isfirstpost) {
			if(theform.rewardprice.value == "") {
				alert(lang['post_reward_credits_null']);
				theform.rewardprice.focus();
				return false;
			}
		} else if(special == 4 && isfirstpost) {
			if(theform.activityclass.value == "") {
				alert(lang['post_activity_sort_null']);
				theform.activityclass.focus();
				return false;
			} else if($('starttimefrom_0').value == "" && $('starttimefrom_1').value == "") {
				alert(lang['post_activity_fromtime_null']);
				return false;
			} else if(theform.activityplace.value == "") {
				alert(lang['post_activity_addr_null']);
				theform.activityplace.focus();
				return false;
			}
		} else if(special == 6 && isfirstpost && $('postsubmit').name == 'topicsubmit') {
			if(theform.vid.value == '') {
				alert(lang['post_video_uploading']);
				return false;
			} else if(theform.vsubject.value == '') {
				alert(lang['post_video_vsubject_required']);
				return false;
			} else if(theform.vtag.value == '') {
				alert(lang['post_video_vtag_required']);
				return false;
			} else if($('vclass') == '') {
				alert(lang['post_video_vclass_required']);
				return false;
			}
		}
	}

	if(!disablepostctrl && ((postminchars != 0 && mb_strlen(message) < postminchars) || (postmaxchars != 0 && mb_strlen(message) > postmaxchars))) {
		alert(lang['post_message_length_invalid'] + '\n\n' + lang['post_curlength'] + ': ' + mb_strlen(message) + ' ' + lang['bytes'] + '\n' +lang['board_allowed'] + ': ' + postminchars + ' ' + lang['lento'] + ' ' + postmaxchars + ' ' + lang['bytes']);
		return false;
	}
	theform.message.value = message;
	if(previewpost || $('postsubmit').name == 'editsubmit') {
		return true;
	} else if(in_array($('postsubmit').name, ['topicsubmit', 'replysubmit'])) {
		seccheck(theform, seccodecheck, secqaacheck, previewpost);
		return false;
	}
}

function seccheck(theform, seccodecheck, secqaacheck, previewpost) {
	if(!previewpost && (seccodecheck || secqaacheck)) {
		/*var url = 'ajax.php?inajax=1&action=';
		if(seccodecheck) {
			var x = new Ajax();
			x.get(url + 'checkseccode&seccodeverify=' + (is_ie && document.charset == 'utf-8' ? encodeURIComponent($('seccodeverify').value) : $('seccodeverify').value), function(s) {
				if(s != 'succeed') {
					alert(s);
					$('seccodeverify').focus();
				} else if(secqaacheck) {
					checksecqaa(url, theform);
				} else {
					postsubmit(theform);
				}
			});
		} else if(secqaacheck) {
			checksecqaa(url, theform);
		}*/
	} else {
		postsubmit(theform, previewpost);
	}
}

function checksecqaa(url, theform) {
	var x = new Ajax();
	var secanswer = $('secanswer').value;
	secanswer = is_ie && document.charset == 'utf-8' ? encodeURIComponent(secanswer) : secanswer;
	x.get(url + 'checksecanswer&secanswer=' + secanswer, function(s) {
		if(s != 'succeed') {
			alert(s);
			$('secanswer').focus();
		} else {
			postsubmit(theform);
		}
	});
}

function postsubmit(theform, previewpost) {
	if(!previewpost) {
		theform.replysubmit ? theform.replysubmit.disabled = true : theform.topicsubmit.disabled = true;
		theform.submit();
	}
}

function previewpost(){
	if(!validate($('postform'), true)) {
		$('subject').focus();
		return;
	}
	$("previewmessage").innerHTML = '<span class="bold"><span class="smalltxt">' + $('subject').value + '</span></span><br /><br /><span style="font-size: {MSGFONTSIZE}">' + bbcode2html($('postform').message.value) + '</span>';
	$("previewtable").style.display = '';
	window.scroll(0, 0);
}

function clearcontent() {
	if(wysiwyg && bbinsert) {
		editdoc.body.innerHTML = is_moz ? '<br />' : '';
	} else {
		textobj.value = '';
	}
}

function resizeEditor(change) {
	var editorbox = bbinsert ? editbox : textobj;
	var newheight = parseInt(editorbox.style.height, 10) + change;
    var newheight2 = parseInt(parent.document.getElementById("Editor").style.height, 10) + change;
	if(newheight >= 100) {
		editorbox.style.height = newheight + 'px';
		parent.document.getElementById("Editor").style.height=newheight2 + 'px';
	}
	/*var editorbox = bbinsert ? editbox : textobj;
	var newheight = parseInt(editorbox.style.height, 10) + change;
	if(newheight >= 100) {
		editorbox.style.height = newheight + 'px';
	}*/
}

function relatekw(subject, message, recall) {
	if(isUndefined(recall)) recall = '';
	if(isUndefined(subject) || subject == -1) subject = $('subject').value;
	if(isUndefined(message) || message == -1) message = getEditorContents();
	subject = (is_ie && document.charset == 'utf-8' ? encodeURIComponent(subject) : subject);
	message = (is_ie && document.charset == 'utf-8' ? encodeURIComponent(message) : message);
	message = message.replace(/&/ig, '', message).substr(0, 500);
	//ajaxget('relatekw.php?subjectenc=' + subject + '&messageenc=' + message, 'tagselect', '', '', '', recall);
}