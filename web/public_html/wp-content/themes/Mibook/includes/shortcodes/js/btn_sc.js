// Button Short Code

(function() {  
     tinymce.create('tinymce.plugins.btn', {  
        init : function(ed, url) {  
             ed.addButton('btn', {  
                title : 'Insert a Button',  
                image : url+'/images/btn.png',  
                onclick : function() {  
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Button Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ss_btn-form' );					
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
	tinymce.PluginManager.add('btn', tinymce.plugins.btn);  
	jQuery(function(){
		var form = jQuery('<div id="ss_btn-form"><table id="ss_btn-table" class="form-table">\
			<tr>\
				<td><h3>Options for inserting a Button</h3></td>\
			</tr>\
			<tr>\
				<th><label for="ss_btn-text">Button Text</label></th>\
				<td><input type="text" id="ss_btn-text" name="text" value="" /><br />\
				<small>Enter a button text.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ss_btn-link">Button links to</label></th>\
				<td><input type="text" id="ss_btn-link" name="link" value="" /><br />\
				<small>Enter the full URL of the target.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ss_btn-color">Button Style</label></th>\
				<td><select name="color" id="ss_btn-color">\
					<option value="">Default (Line Button)</option>\
					<option value="aqua">Aqua</option>\
					<option value="crimson">Crimson</option>\
					<option value="dimGrey">Dim Grey</option>\
					<option value="paleVioletRed">Pale Violet Red</option>\
					<option value="peru">Peru</option>\
					<option value="plum">Plum</option>\
					<option value="purple">Purple</option>\
					<option value="rosyBrown">Rosy Brown</option>\
					<option value="royalBlue">Royal Blue</option>\
					<option value="salmon">Salmon</option>\
					<option value="sandyBrown">Sandy Brown</option>\
					<option value="seaGreen">Sea Green</option>\
					<option value="skyBlue">Sky Blue</option>\
					<option value="slateGrey">Slate Grey</option>\
					<option value="steelBlue">Steel Blue</option>\
					<option value="tan">Tan</option>\
					<option value="teal">Teal</option>\
					<option value="tomato">Tomato</option>\
					<option value="turquoise">Turquoise</option>\
					<option value="yellowGreen">Yello Green</option>\
				</select><br /><br/>\
				<small>Select a button style.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ss_btn-size">Button Size</label></th>\
				<td><select name="size" id="ss_btn-size">\
					<option value="">Default (small)</option>\
					<option value="size-m">Size 1</option>\
					<option value="size-l">Size 2</option>\
					<option value="size-xl">Size 3</option>\
					<option value="size-xxl">Size 4</option>\
				</select><br /><br/>\
				<small>Select a size for button. Note: The default line button will use only small size.</small></td>\
			</tr>\
			</table>\
		<p class="submit">\
			<input type="button" id="ss_btn-submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');		
		var table = form.find('table');
		form.appendTo('body').hide();
		form.find('#ss_btn-submit').click(function(){
			var options = { 
				'link' : '',			
				'color' : '',
				'size' : ''
				};
			var shortcode = '[btn';			
			for( var index in options) {
				var value = table.find('#ss_btn-' + index).val();
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			var btn_text = table.find('#ss_btn-text').val();
			shortcode += ']' + btn_text + '[/btn]';
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
	});
 })();