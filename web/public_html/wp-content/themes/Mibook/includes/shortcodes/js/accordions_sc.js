// Accordion Short Code

(function() {  
     tinymce.create('tinymce.plugins.accordions', {  
        init : function(ed, url) {  
             ed.addButton('accordions', {  
                title : 'Insert an accordion',  
                image : url+'/images/accordion.png',  
                onclick : function() {  
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Accordion Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ss_accordions-form' );					
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
	tinymce.PluginManager.add('accordions', tinymce.plugins.accordions);  

	jQuery(function(){
		var form = jQuery('<div id="ss_accordions-form"><table id="ss_accordions-table" class="form-table">\
						  <tr>\
						  <td><h3>Options for inserting an Accordion</h3></td>\
						  </tr>\
						  <tr>\
						  <th><label for="ss_accordions-num">Number of Accordion items</label></th>\
						  <td><input type="text" id="ss_accordions-num" name="num" value="3" /><br />\
						  <small>Enter the number of accordion items to insert.</small></td>\
						  </tr>\
						  </table>\
						  <p class="submit">\
						  <input type="button" id="ss_accordions-submit" class="button-primary" value="Insert Accordions" name="submit" />\
						  </p>\
						  </div>');		
		var table = form.find('table');
		form.appendTo('body').hide();
		form.find('#ss_accordions-submit').click(function(){
			var shortcode = '';
			var num_of_acc = table.find('#ss_accordions-num').val();			
			for( var i=1; i<= num_of_acc; i++) {
				shortcode += '[accordion title="Accordion item' + i + '"]<br/>Accordion' + i + ' content here.<br/>[/accordion]<br/>';
				}
			
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
	});
 })();