/*
Author: yinheli
Update: 2009/04/11
Author URI: http://philna.com/
*/
(function(){
if(!window.YHLJSPS) window['YHLJSPS']={};
function isCompatible(other) {
	if( other===false 
		|| !Array.prototype.push
		|| !Object.hasOwnProperty
		|| !document.createElement
		|| !document.getElementsByTagName
		) {
		alert('TR- if you see this message isCompatible is failing incorrectly.');
		return false;
	}
	return true;
}

function $(id){
return document.getElementById(id);
}

var xmlHttp;
function getXmlHttpObject(){
	var xmlHttp = null;
	try {
		xmlHttp = new XMLHttpRequest();
	} catch(e) {
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch(e) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}
function setStyle(element, key, value) {
	element.style[key] = value;
}

function addEvent(node,type,listener){
	if(!isCompatible()) { return false }
	if(node.addEventListener){
	node.addEventListener(type,listener,false);
	return true;
	}else if(node.attachEvent){
	node['e'+type+listener]=listener;
	node[type+listener]=function(){
		node['e'+type+listener](window.event);
		}
		node.attachEvent('on'+type,node[type+listener]);
		return true;
	}
}

function insertAfter(node, referenceNode) {
    if(!(node = $(node))) return false;
    if(!(referenceNode = $(referenceNode))) return false;
    
    return referenceNode.parentNode.insertBefore(node, referenceNode.nextSibling);
};

function preventDefault(eventObject) {
	eventObject = eventObject || getEventObject(eventObject);
	if(eventObject.preventDefault) {
		eventObject.preventDefault();
	} else {
		eventObject.returnValue = false;
	}
}

function formToRequestString(form_obj,val){
	var query_string='';
	var and='&';
	for (i=0;i<form_obj.length ;i++ ){
		e=form_obj[i];
		if (e.name!='' && e.type!='submit'){
			if (e.type=='select-one'){
				element_value=e.options[e.selectedIndex].value;
			}else if (e.type=='checkbox' || e.type=='radio'){
				if (e.checked==false){
					break;	
				}element_value=e.value;
			}else{
				element_value=e.value;
			}
			query_string+=and+encodeURIComponent(e.name)+'='+encodeURIComponent(element_value);
		}
	}
	return query_string;
}

function setopacity(node,opacity){
setStyle(node, 'opacity', opacity);
setStyle(node, 'MozOpacity', opacity);
setStyle(node, 'KhtmlOpacity', opacity);
setStyle(node, 'filter', 'alpha(opacity=' + opacity * 100 + ')');
return;
}

function stateChangeListener(){
var r_msg=$('ps_msg');
var the_form=$('post_submit_form');

	if(xmlHttp.readyState==1){
	r_msg.innerHTML='数据载入中,请稍候...';
	setopacity(the_form,0.8);
	$('post_submit').disabled=true;
	window.scrollTo(0,r_msg.offsetTop+15);
	}else if(xmlHttp.readyState==4 && xmlHttp.status==200){
	r_msg.innerHTML=xmlHttp.responseText;
	setopacity(the_form,1);
	setTimeout(function(){$('post_submit').disabled=false;},1000);
	}else if(xmlHttp.status!=200){
		alert('呃 出错了 (建议您保存好文章再刷新浏览器.)  错误信息:'+xmlHttp.statusText);
	}
}

function submitactiontype(type){
var A=formToRequestString($('post_submit_form'))+'&'+encodeURIComponent($(type).name)+'='+encodeURIComponent($(type).value);
return A;
}

function ps_submit(action){
	xmlHttp = getXmlHttpObject();
	if (xmlHttp == null) {
		alert ("Oop! Browser does not support HTTP Request.")
		return;
	}
	var url=window.location.href;
	if(action=='post_submit'){
		var senddata=submitactiontype(action);
	}
	if(action=='post_review'){
		var senddata=submitactiontype(action);
	}
	xmlHttp.onreadystatechange=function(){
		stateChangeListener();
	}
	xmlHttp.open("POST", url, true);
	xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	xmlHttp.send(senddata);
}

function initps(){
	addEvent($('post_submit'),'click',function(W3CEvent){
		ps_submit(action='post_submit');
		//alert(action);
		preventDefault(W3CEvent);
	}); 
	addEvent($('post_review'),'click',function(W3CEvent){
		ps_submit(action='post_review');
		//alert(action);
		preventDefault(W3CEvent);
	}); 
}
if (document.addEventListener) {
	document.addEventListener("DOMContentLoaded", initps, false);

} else if (/MSIE/i.test(navigator.userAgent)) {
	document.write('<script id="__ie_onload_for_post_posts" defer src="javascript:void(0)"></script>');
	var script = $('__ie_onload_for_post_posts');
	script.onreadystatechange = function() {
		if (this.readyState == 'complete') {
			initps();
		}
	}

} else if (/WebKit/i.test(navigator.userAgent)) {
	var _timer = setInterval( function() {
		if (/loaded|complete/.test(document.readyState)) {
			clearInterval(_timer);
			initps();
		}
	}, 10);
} else {
	window.onload = function(e) {
		initps();
	}
}

})();