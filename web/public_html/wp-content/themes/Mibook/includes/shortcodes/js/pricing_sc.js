// Pricing Grids Short Code

(function() {  
     tinymce.create('tinymce.plugins.pricing', {  
        init : function(ed, url) {  
             ed.addButton('pricing', {  
                title : 'Insert Pricing Grid',  
                image : url+'/images/pricing.png',  
                onclick : function() {  
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Pricing Grid Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ss_pricing-form' );					                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
	tinymce.PluginManager.add('pricing', tinymce.plugins.pricing);  
	jQuery(function(){
		var form = jQuery('<div id="ss_pricing-form"><table id="ss_pricing-table" class="form-table">\
						  <tr>\
						  <td><h3>Options for Pricing Grid</h3>\
						  </td>\
						  </tr>\
						  <tr>\
						  <th><label for="ss_pricing-gridtype">Type of Grid</label></th>\
						  <td><select name="align" id="ss_pricing-gridtype">\
						  <option value="col3">3 Columnar</option>\
						  <option value="col4">4 Columnar</option>\
						  <option value="col5">5 Columnar</option>\
						  </select><br /><br/>\
						  <small>Select the type of Pricing Grid</small></td>\
						  </tr>\
						  </table>\
						  <p class="submit">\
						  <input type="button" id="ss_pricing-submit" class="button-primary" value="Insert Pricing Grid" name="submit" />\
						  </p>\
						  </div>');		
		var table = form.find('table');
		form.appendTo('body').hide();
		form.find('#ss_pricing-submit').click(function(){

			var shortcode = '';
			var out_3col = '';
			var out_4col = '';
			var out_5col = '';
			
			for (var i=1; i<=3; i++) {
				if(i!=2) {
				out_3col += '[col3 title="Offer Name' + i + '"]<br/><br/>Your pricing grid content here. You can edit it after insertion.<br/><br/><ul class="list list1"><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li></ul><br/><br/>[btn link="#"]Button &rarr;[/btn]<br/>[/col3]<br/><br/>';
				}
				if(i==2) {
				out_3col += '[col3 title="Premium Offer" premium="true"]<br/><br/>Your pricing grid content here. You can edit it after insertion.<br/><br/><ul class="list list1"><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li></ul><br/><br/>[btn link="#"]Button &rarr;[/btn]<br/>[/col3]<br/><br/>';	
				}
			}
			
			for (var j=1; j<=4; j++) {
				if(j!=2) {
				out_4col += '[col4 title="Offer Name' + j + '"]<br/><br/>Your pricing grid content here. You can edit it after insertion.<br/><br/><ul class="list list1"><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li></ul><br/><br/>[btn link="#"]Button &rarr;[/btn]<br/>[/col4]<br/><br/>';
				}
				if(j==2) {
				out_4col += '[col4 title="Premium Offer" premium="true"]<br/><br/>Your pricing grid content here. You can edit it after insertion.<br/><br/><ul class="list list1"><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li></ul><br/><br/>[btn link="#"]Button &rarr;[/btn]<br/>[/col4]<br/><br/>';	
				}
			}
			
			for (var k=1; k<=5; k++) {
				if(k!=2) {
				out_5col += '[col5 title="Offer Name' + k + '"]<br/><br/>Your pricing grid content here. You can edit it after insertion.<br/><br/><ul class="list list1"><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li></ul><br/><br/>[btn link="#"]Button &rarr;[/btn]<br/>[/col5]<br/><br/>';
				}
				if(k==2) {
				out_5col += '[col5 title="Premium Offer" premium="true"]<br/><br/>Your pricing grid content here. You can edit it after insertion.<br/><br/><ul class="list list1"><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li><li>Offer list</li></ul><br/><br/>[btn link="#"]Button &rarr;[/btn]<br/>[/col5]<br/><br/>';	
				}
			}
			
			var gridtype = table.find('#ss_pricing-gridtype').val();
			switch(gridtype) {
				case 'col3':
				shortcode = '[pricing]<br/><br/>' + out_3col + '[/pricing]';
				break;
				
				case 'col4':
				shortcode = '[pricing]<br/><br/>' + out_4col + '[/pricing]';
				break;
				
				case 'col5':
				shortcode = '[pricing]<br/><br/>' + out_5col + '[/pricing]';
				break;				
			}

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
	});
 })();