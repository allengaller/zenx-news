// Toggle Short Code

(function() {  
     tinymce.create('tinymce.plugins.toggle', {  
        init : function(ed, url) {  
             ed.addButton('toggle', {  
                title : 'Insert a Toggle',  
                image : url+'/images/toggle.png',  
                onclick : function() {  
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Toggle Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ss_toggle-form' );					
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
	tinymce.PluginManager.add('toggle', tinymce.plugins.toggle);  
	jQuery(function(){
		var form = jQuery('<div id="ss_toggle-form"><table id="ss_toggle-table" class="form-table">\
						  <tr>\
						  <td><h3>Options for inserting a Toggle</h3></td>\
						  </tr>\
						  <tr>\
						  <th><label for="ss_toggle-title">Title of Toggle</label></th>\
						  <td><input type="text" id="ss_toggle-title" name="title" value="My Toggle" /><br />\
						  <small>Enter a title for your toggle.</small></td>\
						  </tr>\
						  </table>\
						  <p class="submit">\
						  <input type="button" id="ss_toggle-submit" class="button-primary" value="Insert Toggle" name="submit" />\
						  </p>\
						  </div>');		
		var table = form.find('table');
		form.appendTo('body').hide();
		form.find('#ss_toggle-submit').click(function(){
			var shortcode = '';
			var tog_title = table.find('#ss_toggle-title').val();
			shortcode = '[toggle title="' + tog_title + '"]<br/>Toggle content can be inserted here. You can use images or rich html content here too.<br/>[/toggle]<br/>';

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
	});
 })();