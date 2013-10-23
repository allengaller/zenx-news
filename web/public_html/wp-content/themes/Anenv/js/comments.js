jQuery(document).ready(function($) {
//社交分享
Ashare();
function Ashare() {
	var thelink = encodeURIComponent(document.location), thetitle = encodeURIComponent(document.title.substring(0, 60)), windowName = '分享到', param = getParamsOfShareWindow(600, 560),
	A_qzone = 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=' + thelink + '&title=', 
	A_tqq = 'http://v.t.qq.com/share/share.php?title=' + thetitle + '&url=' + thelink + '&site=', 
	A_sina = 'http://v.t.sina.com.cn/share/share.php?url=' + thelink + '&title=' + thetitle, 
	A_wangyi = 'http://t.163.com/article/user/checkLogin.do?info=' + thetitle + thelink, 
	A_renren = 'http://share.renren.com/share/buttonshare?link=' + thelink + '&title=' + thetitle, 
	A_kaixin = 'http://www.kaixin001.com/repaste/share.php?rtitle=' + thetitle + '&rurl=' + thelink, 
	A_xiaoyou = 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?to=pengyou&url=' + thelink + '&title=' + thetitle, 
	A_baidu = 'http://cang.baidu.com/do/add?it=' + thetitle + '&iu=' + thelink;
	$('.Ashare').each(
		function() {
			$(this).attr('title', windowName + $(this).text());
			$(this).click(
				function() {
					var httpUrl = eval($(this).attr('class')
						.substring(
							$(this).attr('class')
								.lastIndexOf('A_')));
					window.open(httpUrl, windowName, param);
				});
		});
function getParamsOfShareWindow(width, height) {
	return [
		'toolbar=0,status=0,resizable=1,width=' + width + ',height=' + height + ',left=',
			(screen.width - width) / 2, ',top=',
			(screen.height - height) / 2 ].join('');
}
}
//评论框编辑器
$('#comment-smiley').click(function(){
		if($('#smiley').html() == 0){
			$('#smiley').fadeIn();
		}else{
			$('#smiley').toggle();
		}
});
$(function() {
    function addEditor(a, b, c) {
        if (document.selection) {
            a.focus();
            sel = document.selection.createRange();
            c ? sel.text = b + sel.text + c: sel.text = b;
            a.focus()
        } else if (a.selectionStart || a.selectionStart == '0') {
            var d = a.selectionStart;
            var e = a.selectionEnd;
            var f = e;
            c ? a.value = a.value.substring(0, d) + b + a.value.substring(d, e) + c + a.value.substring(e, a.value.length) : a.value = a.value.substring(0, d) + b + a.value.substring(e, a.value.length);
            c ? f += b.length + c.length: f += b.length - e + d;
            if (d == e && c) f -= c.length;
            a.focus();
            a.selectionStart = f;
            a.selectionEnd = f
        } else {
            a.value += b + c;
            a.focus()
        }
    }
    var g = document.getElementById('comment') || 0;
    var h = {
        strong: function() {
            addEditor(g, '<strong>', '</strong>')
        },
        em: function() {
            addEditor(g, '<em>', '</em>')
        },
        del: function() {
            addEditor(g, '<del>', '</del>')
        },
        underline: function() {
            addEditor(g, '<u>', '</u>')
        },
        quote: function() {
            addEditor(g, '<blockquote>', '</blockquote>')
        },
        ahref: function() {
            var a = prompt('请输入链接地址', 'http://');
            var b = prompt('请输入链接描述','');
            if (a) {
                addEditor(g, '<a target="_blank" href="' + a + '"rel="external">' + b + '</a>','')
            }
        },
        img: function() {
            var a = prompt('请输入图片地址', 'http://');
            if (a) {
                addEditor(g, '<img src="' + a + '" alt="" />','')
            }
        },
        code: function() {
            addEditor(g, '<code>', '</code>')
        }
    };
    window['SIMPALED'] = {};
    window['SIMPALED']['Editor'] = h
});
//点击回复显示@用户名   
$('.reply').click(function() {    
var atid = '"#' + $(this).parent().attr("id") + '"';    
var atname = $(this).prevAll().find('strong:first').text();    
$("#comment").attr("value","@" + atname).focus();    
});    
$('.cancel-comment-reply a').click(function(){
$("#comment").attr("value",'');    
});    
});
// 链接复制
function copy_code(text) {
  if (window.clipboardData) {
    window.clipboardData.setData("Text", text)
	alert("已经成功将原文链接复制到剪贴板！");
  } else {
	var x=prompt('你的浏览器可能不能正常复制\n请您手动进行：',text);
  }
}
// 邮件
function initrequest(url){
	var http_request = false;
	//initialize vars
	var email=document.wr.email.value;
	var name=document.wr.name.value;
	var message=document.wr.message.value;
	var website=document.wr.website.value;
	var hint="";
	var msg="姓名: "+name+" \n网址: "+website+" \n邮箱: "+email+"\n\n"+"\n"+"邮件内容:\n"+message;
	var passData="email="+email+"&name="+name+"&message="+msg;
	if (window.XMLHttpRequest) { // Mozilla, Safari, ...
        http_request = new XMLHttpRequest();
            if (http_request.overrideMimeType) {
                http_request.overrideMimeType('text/xml');
            }
        } else if (window.ActiveXObject) { // IE
            try {
                http_request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {}
            }
        }
        if (!http_request) {
            alert('Error: Unable to initialize class');
            return false;
        }
        http_request.onreadystatechange = function() { sendrequest(http_request); };
        http_request.open('POST', url, true);
       	http_request.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		if (email && name && message)
		{
			http_request.send(passData);

		}else 
		{
			if (!email)
			{
				hint+="请填写电子邮件地址<br />";			
			}
			if (!name)
			{
				hint+="请填写您的昵称<br />";			
			}
			if (!message)
			{
				hint+="请填写您的留言<br />";			
			}	
			document.getElementById('hint').innerHTML=hint;				
		}		
}
function sendrequest(http_request) {
		if (http_request.readyState == 4) {
            if (http_request.status == 200) {
				document.getElementById('hint').innerHTML = http_request.responseText;	
				document.getElementById('form_name').value = '';
				document.getElementById('form_email').value = '';
				document.getElementById('form_website').value = '';
				document.getElementById('form_message').value = '';
			} 
			else {
				HideIndicator()
                document.getElementById('hint').innerHTML = '邮件没有发送成功，请稍后再试。谢谢！';
            }
        }
}