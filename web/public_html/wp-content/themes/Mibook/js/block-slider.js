jQuery.fn.prepare_slider = function(){	
		var x_pos = 0;
		var li_items_n = 0;	
		var right_clicks = 0;		
		var left_clicks = 0;					
		var li_col = jQuery("#block-slider-list > li");		
		var li_width = li_col.outerWidth(true);		
		var viewWindow = Math.round(jQuery('#block-slider').width()/li_width);
		
		li_col.each(function(index){			
			x_pos += jQuery(this).outerWidth(true);
			li_items_n++;								
		})	
		
		right_clicks = li_items_n - viewWindow;
		total_clicks = li_items_n - viewWindow;		
		
		jQuery('#block-slider-list').css('position','relative');
		jQuery('#block-slider-list').css('left','0px');
		jQuery('#block-slider-list').css('width', x_pos+'px');
		
		var is_playing = false;
		var completed = function() { is_playing = false; }
		
		jQuery('#left-but').click( function(){									
			cur_offset = jQuery('#block-slider-list').position().left;
			if (!is_playing){						
				if (left_clicks > 0) {
						is_playing = true; jQuery('#block-slider-list').animate({'left': cur_offset + li_width + 'px'}, 800, "linear", completed); 
						right_clicks++; 
						left_clicks--;
					} 
					else {
						is_playing = true;
						jQuery('#block-slider-list').animate({'left':    -li_width*total_clicks	+ 'px'}, 800, "linear", completed); 
						right_clicks = 0;
						left_clicks = total_clicks;
					}
			}
		});		

		jQuery('#right-but').click( function(){
			if (!is_playing){			
				cur_offset = jQuery('#block-slider-list').position().left;			
			 	if (right_clicks > 0) {
						is_playing = true; 
						jQuery('#block-slider-list').animate({'left': cur_offset - li_width + 'px'},800, "linear", completed );
						right_clicks--; left_clicks++; 
				} 
				else { 
						is_playing = true; jQuery('#block-slider-list').animate({'left':    0	+ 'px'},800, "linear", completed ); 
						left_clicks = 0;
						right_clicks = total_clicks;
					}			 
			}
		});	
		
	}


//////////////////////////////////////////////////////////   
   
   jQuery.noConflict();
	jQuery(window).bind('load', function(){
		jQuery().prepare_slider(); 
		
		//===============
		var slider_link = jQuery('#right-but');
		var slider_link_index = 1;
		var slider_count = jQuery('#block-slider-list > li').size();	

		function slider_intro(){
			if(slider_link_index <= slider_count){
				slider_link.trigger('click');
				slider_link_index++;
				setTimeout(function(){slider_intro()}, 5000); //select change time
			}
		}
		setTimeout(function(){slider_intro()}, 5000)


		//===============
		jQuery('#left-but').hover(
		   function () {
			 jQuery(this).addClass("over");
		   },
		   function () {
			 jQuery(this).removeClass("over");
		   })
		
		jQuery('#right-but').hover(
		   function () {
			 jQuery(this).addClass("over");
		   },
		   function () {
			 jQuery(this).removeClass("over");
		   })
		

		
		//===============
		jQuery("#block-slider .block-grid li").hover(function(){
			jQuery(this).find(".boxCaption").stop().animate({
				top:0
			}, 200);
			}, function(){
			jQuery(this).find(".boxCaption").stop().animate({
				top:80
			}, 600);
		});
		
		
		
	});	