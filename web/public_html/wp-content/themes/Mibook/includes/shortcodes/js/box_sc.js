// Box Short Code

(function() {  
     tinymce.create('tinymce.plugins.box', {  
        init : function(ed, url) {  
             ed.addButton('box', {  
                title : 'Insert Content Box',  
                image : url+'/images/box.png',  
                onclick : function() {  
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Content Box Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ss_box-form' );					
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
	tinymce.PluginManager.add('box', tinymce.plugins.box);  
	jQuery(function(){
		var form = jQuery('<div id="ss_box-form"><table id="ss_box-table" class="form-table">\
						  <tr>\
						  <td><h3>Options for Content Box</h3>\
						  </td>\
						  </tr>\
						  <tr>\
						  <th><label for="ss_box-boxstyle">Type of Box</label></th>\
						  <td><select name="align" id="ss_box-boxstyle">\
						  <option value="0">Normal Box</option>\
						  <option value="1">Information or Warning</option>\
						  <option value="2">Success Notification</option>\
						  <option value="3">Error or restriction</option>\
						  <option value="4">Event Notification</option>\
						  </select><br /><br/>\
						  <small>Select the type of Content Box</small></td>\
						  </tr>\
						  </table>\
						  <p class="submit">\
						  <input type="button" id="ss_box-submit" class="button-primary" value="Insert Content Box" name="submit" />\
						  </p>\
						  </div>');		
		var table = form.find('table');
		form.appendTo('body').hide();
		form.find('#ss_box-submit').click(function(){
			var shortcode = '';
			var boxstyle = table.find('#ss_box-boxstyle').val();
			shortcode = '[box style="' + boxstyle + '"]<br/><h5>Your box title here</h5>Box content can be inserted here.<br/>[/box]';
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
	});
 })();