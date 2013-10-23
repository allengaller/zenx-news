$(document).ready(function(){
	// 滑动到顶部
	$(window).scroll(function () {
		if ($(this).scrollTop() > 600) {
			$('#back_top').fadeIn();
		} else {
			$('#back_top').fadeOut();
		}
	});
	$('#back_top a').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 400);
		return false;
	});

	var t_li = $(" #J_tabbtn li")
	var c_li = $(" #J_tabcon .tabcon")
		t_li.hover(function(){
			var i = t_li.index($(this));
			function way(){
				t_li.removeClass("current").eq(i).addClass("current");
				c_li.hide().eq(i).show();
				}
				timer=setTimeout(way,200);
			},function(){
		clearTimeout(timer);
	});

	//首页幻灯片
	$('#J_silidArea').slide({
		effect: 'scroll',
		direction: 'y',
		delay: 0,
		speed: 'normal',
		contentCls: 'Slide_list',
		//hasTriggers: false,
		//controlThumbs: true,
		//pauseOnScroll: true,
		//caption: true,
		evtype: 'mouse' // mouse/click
	});
	
	//免费主题 旋转木马效果
	$('#J_goods').slide({
		effect: 'scroll',
		speed: 'normal',
		interval: 8000,
		//hasTriggers: false,
		contentCls: 'goods_list',
		prevBtnCls:'goods_prev',
        nextBtnCls:'goods_next'

	});
	// 字体调整
	$('.post_meta li.fontSize span').click(function(){
		var $p_size = $('.post_content p').css('font-size');//alert ($p_size);
		var textFontSize = parseFloat($p_size,10);//alert (textFontSize);
		var $cName = $(this).attr('id');//alert ($cName);
		
		if($cName == "fontBig"){
			if(textFontSize <= 20){
				textFontSize += 2;
			}
			//alert ('bigger');
		}else if($cName == "fontSmall"){
			if(textFontSize >= 14){
				textFontSize -= 2;
			}
		}
		$('.post_content p').css('font-size',textFontSize + 'px');
	});

	$('.sticky_list:last,.gravatarComment li:last').css({"border-bottom":"none"});
	$("#search").focus(function(){
		var txt_value = $(this).val();
		if(txt_value==this.defaultValue){
			$(this).val("");
		}
	});

	$("#search").blur(function(){
		var txt_value = $(this).val();
		if(txt_value==""){
			$(this).val(this.defaultValue);
		}
	});
	
	$("#J_search").focus(function(){
		var txt_value = $(this).val();
		if(txt_value==this.defaultValue){
			$(this).val("");
		}
	});

	$("#J_search").blur(function(){
		var txt_value = $(this).val();
		if(txt_value==""){
			$(this).val(this.defaultValue);
		}
	});
	

	$("#J_g_search").focus(function(){
		$(this).removeClass('googleimg');
	});
	$("#J_g_search").blur(function(){
		$(this).addClass('googleimg');
	});


	$("#J_rssMail").focus(function(){
		var txt_value = $(this).val();
		if(txt_value==this.defaultValue){
			$(this).val("");
		}
	});
	$("#J_rssMail").blur(function(){
		var txt_value = $(this).val();
		if(txt_value==""){
			$(this).val(this.defaultValue);
		}
	});

	//灯箱(Lightbox)效果
	$('.fancybox').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		prevEffect : 'none',
		nextEffect : 'none',
		//closeBtn  : false,
		helpers : {
			title : {type : 'inside'},
			buttons	: {}
		},
		afterLoad : function() {
			this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
		}
	});
	
	$('dl.services dd').hover(function(){
		$('a', this).stop().animate({bottom:'0'},{queue:false,duration:200});
	}, function() {
		$('a', this).stop().animate({bottom:'-150px'},{queue:false,duration:200});
	});
	
	//fixed
	$('.sticky_list:first').css('border-top','none');
	$('.tabcon').find('li:last').css('border-bottom','none');
	$('.tabcon').find('li:first').css('border-top','none');
	
	//侧栏跟随   
    var oDiv=document.getElementById("float");   
    var H=0,iE6;   
    var Y=oDiv;   
    while(Y){H+=Y.offsetTop;Y=Y.offsetParent};   
    iE6=window.ActiveXObject&&!window.XMLHttpRequest;   
    if(!iE6){   
        window.onscroll=function()   
        {   
            var s=document.body.scrollTop||document.documentElement.scrollTop;   
            if(s>H){
				oDiv.className="div1 div2";
				if(iE6){oDiv.style.top=(s-H)+"px";};
				$('#float').slideDown('slow');
				
			}else{
				oDiv.className="div1";
				$('#float').slideUp('slow');
			}       
        };   
    }
//end
});
//tabs
function setContentTab(name, curr, n) {
	for (i = 1; i <= n; i++) {
		var menu = document.getElementById(name + i);
		var cont = document.getElementById("con_" + name + "_" + i);
		menu.className = i == curr ? "current" : "";
		if (i == curr) {
			cont.style.display = "block";
		} else {
			cont.style.display = "none";
		}
	}
}