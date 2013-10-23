// Frame Short Code

(function() {  
     tinymce.create('tinymce.plugins.frame', {  
        init : function(ed, url) {  
             ed.addButton('frame', {  
                title : 'Insert an image with styles',  
                image : url+'/images/frame.png',  
                onclick : function() {  
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Image Frame Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ss_frame-form' );					
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
	tinymce.PluginManager.add('frame', tinymce.plugins.frame);  
	jQuery(function(){
		var form = jQuery('<div id="ss_frame-form"><table id="ss_frame-table" class="form-table">\
			<tr>\
				<td><h3>Options for inserting an image frame</h3></td>\
			</tr>\
			<tr>\
				<th><label for="ss_frame-src">Image URL</label></th>\
				<td><input type="text" id="ss_frame-src" name="src" value="" /><br />\
				<small>Enter the full URL of source image. You can copy from media library.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ss_frame-width">Image Width</label></th>\
				<td><input type="text" id="ss_frame-width" name="width" value="100" /><br />\
				<small>Enter a width(px) for image. Eg: 200</small></td>\
			</tr>\
			<tr>\
				<th><label for="ss_frame-height">Image Height</label></th>\
				<td><input type="text" id="ss_frame-height" name="height" value="100" /><br />\
				<small>Enter a height(px) for image. Eg: 160</small></td>\
			</tr>\
			<tr>\
				<th><label for="ss_frame-align">Image Alignment</label></th>\
				<td><select name="align" id="ss_frame-align">\
					<option value="none">None</option>\
					<option value="left">Left Align</option>\
					<option value="right">Right Align</option>\
				</select><br /><br/>\
				<small>Select an alignment for the image.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ss_frame-style">Image Style</label></th>\
				<td><select name="style" id="ss_frame-style">\
					<option value="0">No Border</option>\
					<option value="1">Thick Border</option>\
					<option value="2">Thin Border</option>\
					<option value="foldify">Paper fold on hover</option>\
				</select><br /><br/>\
				<small>Select a style for image.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ss_frame-linkstyle">Image Link Style</label></th>\
				<td><select name="linkstyle" id="ss_frame-linkstyle">\
					<option value="normal">Normal</option>\
					<option value="pp">PrettyPhoto</option>\
				</select><br /><br/>\
				<small>Select a link style.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ss_frame-linksto">Image links to</label></th>\
				<td><input type="text" id="ss_frame-linksto" name="linksto" value="" /><br />\
				<small>If clicking on an image should link to some page, specify the URL here.</small></td>\
			</tr>\
			<tr>\
				<th><label for="ss_frame-title">Image Title</label></th>\
				<td><input type="text" id="ss_frame-title" name="title" value="" /><br />\
				<small>Enter a title for image.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="ss_frame-submit" class="button-primary" value="Insert image frame" name="submit" />\
		</p>\
		</div>');		
		var table = form.find('table');
		form.appendTo('body').hide();
		form.find('#ss_frame-submit').click(function(){
			var options = { 
				'src' : '',			
				'width' : '100',
				'height' : '100',
				'align' : 'none',
				'style' : '0',
				'linkstyle' : '',
				'linksto' : '',				
				'title' : ''
				};
			var shortcode = '[frame';
			
			for( var index in options) {
				var value = table.find('#ss_frame-' + index).val();
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}			
			shortcode += ']';

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
	});
 })();