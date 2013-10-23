// Tabs Short Code

(function() {  
     tinymce.create('tinymce.plugins.tabs', {  
        init : function(ed, url) {  
             ed.addButton('tabs', {  
                title : 'Insert a tabbed content',  
                image : url+'/images/tabs.png',  
                onclick : function() {  
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Tabbed Content Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ss_tabs-form' );					
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
	tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);  
	jQuery(function(){
		var form = jQuery('<div id="ss_tabs-form"><table id="ss_tabs-table" class="form-table">\
						  <tr>\
						  <td><h3>Options for inserting a Tabbed Content</h3></td>\
						  </tr>\
						  <tr>\
						  <th><label for="ss_tabs-num">Number of Tabs</label></th>\
						  <td><input type="text" id="ss_tabs-num" name="num" value="3" /><br />\
						  <small>Enter the number of tabs to insert.</small></td>\
						  </tr>\
						  </table>\
						  <p class="submit">\
						  <input type="button" id="ss_tabs-submit" class="button-primary" value="Insert Tabs" name="submit" />\
						  </p>\
						  </div>');		
		var table = form.find('table');
		form.appendTo('body').hide();
		form.find('#ss_tabs-submit').click(function(){
			var shortcode = '';
			var inner = '';
			var num_of_tabs = table.find('#ss_tabs-num').val();
			
			for( var i=1; i<= num_of_tabs; i++) {
				inner += '[tab title="Tab' + i + '"]<br/>Tab' + i + ' content here.<br/>[/tab]<br/>';
			}			
			shortcode = '[tabs]<br/>' + inner + '[/tabs]';

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
	});
 })();