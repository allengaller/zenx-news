// Tour Short Code

(function() {  
     tinymce.create('tinymce.plugins.tour', {  
        init : function(ed, url) {  
             ed.addButton('tour', {  
                title : 'Insert a Tour Content',  
                image : url+'/images/tour.png',  
                onclick : function() {  
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Tour Content Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ss_tour-form' );					
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
	tinymce.PluginManager.add('tour', tinymce.plugins.tour);  
	jQuery(function(){
		var form = jQuery('<div id="ss_tour-form"><table id="ss_tour-table" class="form-table">\
						  <tr>\
						  <td><h3>Options for inserting a Tour Content</h3>\
						  </td>\
						  </tr>\
						  <tr>\
						  <th><label for="ss_tour-head">Tour Heading</label></th>\
						  <td><input type="text" id="ss_tour-head" name="head" value="" /><br />\
						  <small>Enter a heading for tour. Leave blank for no title.</small></td>\
						  </tr>\
						  <tr>\
						  <th><label for="ss_tour-num">Number of Tour steps</label></th>\
						  <td><input type="text" id="ss_tour-num" name="num" value="4" /><br />\
						  <small>Enter the number of tour steps to insert.</small></td>\
						  </tr>\
						  </table>\
						  <p class="submit">\
						  <input type="button" id="ss_tour-submit" class="button-primary" value="Insert Tour" name="submit" />\
						  </p>\
						  </div>');		
		var table = form.find('table');
		form.appendTo('body').hide();
		form.find('#ss_tour-submit').click(function(){
			var shortcode = '';
			var inner = '';
			var num_of_steps = table.find('#ss_tour-num').val();
			var tour_head = table.find('#ss_tour-head').val();
			
			for( var i=1; i<= num_of_steps; i++) {
				inner += '[step title="Tour Step' + i + '"]<br/>Tour Step' + i + ' content here.<br/>[/step]<br/>';
			}
			
			shortcode = '[tour heading="' + tour_head + '"]<br/>' + inner + '[/tour]';

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
	});
 })();