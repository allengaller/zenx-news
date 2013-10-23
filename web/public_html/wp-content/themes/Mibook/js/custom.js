// -- CUSTOM FUNCTIONS AND EFFECTS --

// -- NO CONFLICT MODE
var $s = jQuery.noConflict();

$s(document).ready(function(){

	//--Png Transparent
	//$s(document).pngFix();
								
	// -- HIDE IMAGES BEFORE LOADING	
	// -- NAVIGATION MENU	
	$s('.nav1 ul, .nav2 ul').css({display: "none"});
	$s('.nav1 li:has(ul), .nav2 li:has(ul)').addClass('has_child');
	$s('.nav1 li, .nav2 li').hover(function(){	
		$s(this).find('ul:first').css({visibility: "visible",display: "none"}).fadeIn(300);
	},
	function(){
		$s(this).find('ul:first').css({visibility: "visible",display: "none"});
	});	
	
	$s(".nav1 ul li:has(ul), .nav2 ul li:has(ul)").removeClass('has_child').addClass("arrow");
	
	$s(".nav1 ul li a, .nav2 ul li a").hover(
		function(){
			$s(this).animate({paddingLeft:"12px"},160);
		}, 
		function() {
			$s(this).animate({paddingLeft:"5px"},160);
		}
	);	
	
	// -- PRETTYPHOTO INIT	
	$s("a[rel^='prettyPhoto'], a[rel^='prettyPhoto[image]'], a[rel^='prettyPhoto[inline]']").prettyPhoto();
	
	//Adds a rel="prettyPhoto" tag to all linked image files
	$s(".entry-content p:has(img)").addClass("prettyPhoto"); 
	$s(".prettyPhoto a").attr({ 
		rel: "prettyPhoto[image]" 
		});	
	
	// -- ACCORDION	
	$s('h5.handle').click(function() {
		$s(this).next().slideToggle(300);
		$s(this).toggleClass("activehandle");
		return false;
	}).next().hide();
	
	
	// -- FAQ	
	$s('h5.question').click(function() {
		$s(this).next().slideToggle(300);
		$s(this).toggleClass("activeques");
		return false;
	}).next().hide();	
	
	
	// -- TOGGLE	
	$s('h5.toggle').click(function() {
		$s(this).next().slideToggle(300);
		$s(this).toggleClass("activetoggle");
		return false;
	}).next().hide();
	

	// Box Close Button	
	$s(".box").each(function(){
		$s(this).append('<span class="hide_box"></span>');
			$s(this).find('.hide_box').click(function(){
			$s(this).parent().hide();
		});
	});


	// -- TOP OF PAGE	
	$s('.roll_top').click(function(){ 
		$s('html, body').animate({scrollTop:0}, 500 ); 
		return false; 
	});//	
	
}) //* END DOCUMENT.READY *//



$s(window).load( function() {
	
	// -- SHOW IMAGES ON LOAD	

	
	// -- CYCLE SLIDER INIT	
	$s('.cycle_slider').cycle({ 
		fx:     'fade', 
		speed:  400, 
		timeout: 4000, 
		next: '.next_piece',  
		prev: '.prev_piece',
		sync: 1,
		pause: 1,
		cleartype: true,
		pager:  '.cycle_nav', 
		pagerAnchorBuilder: function(idx, slide) { 
			return '<li><a href="#"></a></li>'; 
		} 
	});

	
	// -- SHOW/HIDE SLIDER CONTROLS
	$s('.show_desc').fadeIn();
	$s('.controls').hide();
	$s('.cycle_wrap').hover(function(){
		$s('.controls').show();
	}, function() {
		$s('.controls').hide();
	});


	// -- NIVO SLIDER INIT
	$s('#nivo_slider').nivoSlider({
        effect:'random', // Specify sets like: 'fold,fade,sliceDown'
        slices:15, // For slice animations
        boxCols: 8, // For box animations
        boxRows: 4, // For box animations
        animSpeed:400, // Slide transition speed
        pauseTime:3000, // How long each slide will show
        startSlide:0, // Set starting Slide (0 index)
        directionNav:true, // Next & Prev navigation
        directionNavHide:true, // Only show on hover
        controlNav:true, // 1,2,3... navigation
        controlNavThumbs:true, // Use thumbnails for Control Nav
        controlNavThumbsFromRel:false, // Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', // Replace this with...
        controlNavThumbsReplace: '.jpg', // ...this in thumb Image src
        keyboardNav:true, // Use left & right arrows
        pauseOnHover:true, // Stop animation while hovering
        manualAdvance:false, // Force manual transitions
        captionOpacity:0.8, // Universal caption opacity
        prevText: 'Prev', // Prev directionNav text
        nextText: 'Next', // Next directionNav text
        beforeChange: function(){}, // Triggers before a slide transition
        afterChange: function(){}, // Triggers after a slide transition
        slideshowEnd: function(){}, // Triggers after all slides have been shown
        lastSlide: function(){}, // Triggers when last slide is shown
        afterLoad: function(){} // Triggers when slider has loaded
	});	


	// -- Foldify Images	
	$s(".foldify").append('<span class="fold_wrap"><span class="fold"></span></span>');
	$s(".fold_wrap").css({right:"-50px", bottom:"-50px"});
	$s(".fold").css({top:"-25px", left:"-25px"});
	$s(".foldify").each(function(){
		$s(this).hover(function(){
			$s(this).find(".fold_wrap").stop().animate({right:"0px", bottom:"0px"}, 300);
			$s(this).find(".fold").stop().animate({top:"0px", left:"0px"}, 300);
		}, function(){
			$s(this).find(".fold_wrap").stop().animate({right:"-50px", bottom:"-50px"}, 400);
			$s(this).find(".fold").stop().animate({top:"-25px", left:"-25px"}, 400);
		});	
	});
	
	
	// -- Random posts
	$s(function() {
		$s(".mod-item .random-post").hover(function(){
			$s(this).find(".boxCaption").stop().animate({
				top:0
			}, 200);
			}, function(){
			$s(this).find(".boxCaption").stop().animate({
				top:80
			}, 600);
		});
	});//Random posts
	
	
})// All end