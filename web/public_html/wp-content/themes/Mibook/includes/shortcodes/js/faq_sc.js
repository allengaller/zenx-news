// FAQ Short Code

(function() {  
     tinymce.create('tinymce.plugins.faq', {  
        init : function(ed, url) {  
             ed.addButton('faq', {  
                title : 'Insert an FAQ set',  
                image : url+'/images/faq.png',  
                onclick : function() {  
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'FAQ Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ss_faq-form' );					
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
	tinymce.PluginManager.add('faq', tinymce.plugins.faq);  
	jQuery(function(){
		var form = jQuery('<div id="ss_faq-form"><table id="ss_faq-table" class="form-table">\
						  <tr>\
						  <td><h3>Options for inserting an FAQ Set</h3></td>\
						  </tr>\
						  <tr>\
						  <th><label for="ss_faq-num">Number of FAQ items</label></th>\
						  <td><input type="text" id="ss_faq-num" name="num" value="3" /><br />\
						  <small>Enter the number of FAQs to insert.</small></td>\
						  </tr>\
						  </table>\
						  <p class="submit">\
						  <input type="button" id="ss_faq-submit" class="button-primary" value="Insert FAQ Set" name="submit" />\
						  </p>\
						  </div>');		
		var table = form.find('table');
		form.appendTo('body').hide();
		form.find('#ss_faq-submit').click(function(){
			var shortcode = '';
			var num_of_faq = table.find('#ss_faq-num').val();
			
			for( var i=1; i<= num_of_faq; i++) {
				shortcode += '[faq question="<strong>' + i + '.</strong> Question' + i + ' goes here. Edit this into your own question."]<br/><br/>Answer' + i + ' should be placed here. You can use rich editing or columns to format your answers.<br/><br/>[/faq]<br/><br/>';
			}

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
	});
 })();