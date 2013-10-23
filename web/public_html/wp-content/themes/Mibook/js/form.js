	var $s = jQuery.noConflict();
	$s(document).ready(function(){	
		$s("#contactform").validate({		
			//set the rules for the field names
			rules: {
				username: {
					required: true,
					minlength: 2
				},
				email: {
					required: true,
					email: true
				},				
				url: {
					url:true
				},				
				comment: {
					required: true,
					minlength: 5
				}
			},	
		
			//hide errors forever. We just need element highlighting
			errorPlacement: function(error, element) {
				error.hide();
			},

			//Submit the Form  
			submitHandler: function() {			
			//Post the form values via ajax post 
				$s.post($s("#contactform").attr('action'), $s("#contactform").serialize()+'&ajax=1', function(result){				
						$s('#contactform').remove();		//hide comment form
						$s('#mail_success').fadeIn(500);	//Show mail success div			
				});			
			}		
		});
})