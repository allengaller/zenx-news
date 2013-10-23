jQuery(document).ready(function(){
		
	jQuery('.mycolor').each(function()
	{
		myCol = jQuery(this);
		myId = myCol.attr("id");	
		newId = '#'+myId;	
		old_color = jQuery(newId).val();
		jQuery(newId).next('.picker_ico').find('div').css({'backgroundColor':'#'+old_color, 'borderColor':'#'+old_color}); 
		jQuery(newId).ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				jQuery(el).val(hex);
				jQuery(el).ColorPickerHide();	
			},
			onBeforeShow: function () {
				prevcol = jQuery(this).val();
				ico_id = jQuery(this).next('.picker_ico').attr("id");
				newicoid = '#'+ico_id;	
				jQuery(newicoid).find('div').css({'backgroundColor':'#'+prevcol, 'borderColor':'#'+prevcol}); 	
				jQuery(this).ColorPickerSetColor(this.value);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				jQuery(newicoid).find('div').css({'backgroundColor':'#'+hex, 'borderColor':'#'+hex});
				jQuery(newicoid).prev('input').attr('value', hex);
			}	
		})	
		.bind('keyup', function(){
			jQuery(this).ColorPickerSetColor(this.value);
		});	
	});


	jQuery(".tabbed").hide();
	jQuery("ul.tabs li:first").addClass("active");
	jQuery(".tabbed:first").fadeIn();
	jQuery("ul.tabs li").click(function() {
		jQuery("ul.tabs li").removeClass("active");
		jQuery(this).addClass("active");
		jQuery(".tabbed").hide();		
		var currentTab = jQuery(this).find("a").attr("href");
		jQuery(currentTab).fadeIn();
		return false;
	});	
	
}) // document.ready