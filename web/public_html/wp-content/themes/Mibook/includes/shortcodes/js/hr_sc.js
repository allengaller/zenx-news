// HR Short Code

(function() {  
     tinymce.create('tinymce.plugins.hr', {  
        init : function(ed, url) {  
             ed.addButton('hr', {  
                title : 'Insert a Horizontal rule',  
                image : url+'/images/hr.png',  
                onclick : function() {  
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'HR Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ss_hr-form' );					
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
	tinymce.PluginManager.add('hr', tinymce.plugins.hr);  
	jQuery(function(){
		var form = jQuery('<div id="ss_hr-form"><table id="ss_hr-table" class="form-table">\
			<tr>\
				<td><h3>Options for inserting a horizontal rule</h3></td>\
			</tr>\
			<tr>\
				<th><label for="ss_hr-style">HR Style</label></th>\
				<td><select name="style" id="ss_hr-style">\
					<option value="hr">Single line</option>\
					<option value="dhr">Double line</option>\
					<option value="hr_3d">3D Bar</option>\
					<option value="hr_strip">Diagonal Strip</option>\
					<option value="hr_dotted">Single dotted line</option>\
					</select><br /><br/>\
				<small>Select a style for horizontal rule.</small></td>\
			</tr>\
			</table>\
		<p class="submit">\
			<input type="button" id="ss_hr-submit" class="button-primary" value="Insert HR" name="submit" />\
		</p>\
		</div>');		
		var table = form.find('table');
		form.appendTo('body').hide();
		form.find('#ss_hr-submit').click(function(){
			var value = table.find('#ss_hr-style').val();
			var shortcode = '[' + value + ']';

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
	});
 })();