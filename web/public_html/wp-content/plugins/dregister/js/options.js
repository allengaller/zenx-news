window.addEvent('domready',function(){

/*-------------------------------------------------------------------------------*/	
/* VARS & OBJECTS -------------------------*/
/*-------------------------------------------------------------------------------*/	
	var PLUGIN_URL = $('plugin_url').getProperty('value');	
	

/*-------------------------------------------------------------------------------*/	
/* LISTENERS -------------------------*/
/*-------------------------------------------------------------------------------*/	

	//-- LISTENER Form Update
	function listener_update(listen, custom_data, onCompleteF){
	
		$('dr_form_update').set('send', {
			method: 'post',
			data: custom_data,
			onRequest: function(){
				
				$('message').addClass('hidden');
				$('message_error').addClass('hidden');
				
				$('wait').removeClass('hidden');
				document.location='#message';
			},
			onSuccess: function(responseText, responseXML) {									
				
				var response = JSON.decode(responseText);
				
				
				if (response.error){
				//Error
					$('message_error').removeClass('hidden');
					$('message_error').set('html',response.error);
					$('wait').addClass('hidden');
					$('message_error').fade(1);
					window.scrollTo($('message_error').getPosition().x, $('message_error').getPosition().y-10);				
				}else{
				//Success & Refresh
					$('wait').addClass('hidden');
					$('message').removeClass('hidden');					
					$('message').fade(1);
				}
				
					$('div_options_wrapper').set('html',response.content);
					listeners_start();					
					(function(){ $('message').fade(0); }).delay(5000);
			
				if (typeof(onCompleteF) =='function'){ onCompleteF(); }
			}
				
		});	
		
		// Send on listener calll
		if (listen==false){
			$('dr_form_update').send();
			return;
		}
		
		// Just sends when changes are saved
		$('dr_form_update').removeEvents();
		$('dr_form_update').addEvent('submit', function(e) {
			new Event(e).stop();			
			this.send();
		});		
	}
	
 	//-- LISTENER add custom field	--//
	function listener_add_custom_field(){
		$('dr_link_add_custom_field').removeEvents();	
		$('dr_link_add_custom_field').addEvent('click',function(){
		
			var input_add_field = new Element('input',{
								'type' : 'hidden',
								'name' : 'add_field',
								'value' : '1'
								});		
			input_add_field.inject($('div_options_wrapper'),'bottom');
			
			listener_update(false);					

		});
	}
			
 	//-- Listener delete field	--//
	function listener_delete_field(){
		$$(".field_delete").each(function(link,i){
						
			link.removeEvents();
			link.addEvent('click',function(){
				var field_id = link.getProperty('field_id');				
				$('tr_'+field_id).fade(0);
				(function(){ $('tr_'+field_id).dispose()}).delay(500);																												  
			});
			
		});
	}				
	
				
	
	
 	//-- Listener switch select type	--//
	function listener_selects(){
										
		$$(".select_field_type").each(function(select,i){
				
			select.removeEvents();
			select.addEvent('change',function(){			
			

				var field_id = select.getProperty('field_id');
				var selected_type = select.getProperty('value');	
								
				// Radio options
				if ( select.value=='radio'){

					var sub_refresh = new Request.HTML(
						{
						url: PLUGIN_URL + 'ajax_sub_add.php',
						method: 'post',
						data: 'nocache=' + new Date().getTime() + '&field_id=' + field_id + '&selected_type=' + selected_type,				
						onComplete: function(responseTree, responseElements, responseHTML, responseJavaScript){
							$('sub_placeholder_' + field_id).set('html',responseHTML);
							listener_add_subfield();
							listener_delete_subfield();	
						}
					}).send();	
													
				}else{
				// Nasconde le opzioni
					$('sub_placeholder_' + field_id).set('html','');
				}
								
			});
			
		});
		
	}				
	
 	//-- Listener add single subfield	--//
	function listener_add_subfield(){
		$$('.link_add_sub').removeEvents();	
		$$('.link_add_sub').each(function(link,i){
		
			link.addEvent('click',function(){
			
				var field_id = link.getProperty('field_id');
				var last_sub_id = $('sub_add_placeholder_'+field_id).getProperty('last_sub_id').toInt();
				var sub_id = last_sub_id.toInt() + 1;
				
				var sub_p = new Element('p',{
									'html':'#' + sub_id  + ' ',
									'id':'p_sub_' + field_id + '_' + sub_id
									});
				var sub_input = new Element('input',{
									'type' : 'text',
									'name' : 'fields[' + field_id + '][subs][' + sub_id +']'									
									});
				var a_delete = new Element('a',{
									'href' : 'javascript:void(0)'									
									});		
				var img_delete =  new Element('img',{
									'src' : PLUGIN_URL + 'img/delete.png',									
									'field_id' : field_id,
									'sub_id' : sub_id,
									'class' :'sub_delete'
									});		
			
			
				sub_p.inject($('sub_add_placeholder_'+field_id),'before');
				sub_input.inject(sub_p,'bottom');
				a_delete.inject(sub_input,'after');
				img_delete.inject(a_delete,'bottom');
				
				$('sub_add_placeholder_'+field_id).setProperty('last_sub_id',sub_id);
				
				listener_delete_subfield();				
			});
			
		});

	}
	
 	//-- Listener delete subfield	--//
	function listener_delete_subfield(){
		$$(".sub_delete").each(function(link,i){
						
			link.removeEvents();
			link.addEvent('click',function(){
				var field_id = link.getProperty('field_id');							
				var sub_id = link.getProperty('sub_id');							
				$('p_sub_'+ field_id + '_' + sub_id).fade(0);
				(function(){ $('p_sub_'+ field_id + '_' + sub_id).dispose()}).delay(500);																												  
			});
			
		});
	}		

/*-------------------------------------------------------------------------------*/		
/* EVENTI -------------------------*/
/*-------------------------------------------------------------------------------*/	

	//--   Avvio ---//
	function listeners_start(){
		listener_add_custom_field();
		listener_update();
		listener_delete_field();
		listener_selects();
		listener_add_subfield();
		listener_delete_subfield();
	}
	
	listeners_start();
	
	
});




