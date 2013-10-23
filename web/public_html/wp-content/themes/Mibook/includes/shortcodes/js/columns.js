// Layout Column Short Codes

(function() {  
     tinymce.create('tinymce.plugins.columns', {  
        init : function(ed, url) {  
             ed.addButton('columns', {  
                title : 'Insert layout columns',  
                image : url+'/images/layout.png',  
                onclick : function() {  
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Layout Column Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ss_columns-form' );					
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
	tinymce.PluginManager.add('columns', tinymce.plugins.columns);  
	jQuery(function(){
		var form = jQuery('<div id="ss_columns-form"><table id="ss_columns-table" class="form-table">\
			<tr>\
				<th><label for="ss_columns-sb_check">Are you using a sidebar?</label></th>\
				<td><select name="sb_check" id="ss_columns-sb_check">\
					<option value="yes">Yes</option>\
					<option value="no">No</option>\
					</select><br /><br/>\
				<small>Depending upon whether you are using a sidebar or not, choose from the options below.</small></td>\
			</tr>\
			<tr>\
				<td><h3>If using Sidebar</h3></td>\
			</tr>\
			<tr>\
				<th><label for="ss_columns-coltype_sb">Column set for page with sidebar</label></th>\
				<td><select name="coltype" id="ss_columns-coltype_sb">\
					<option value="scsb1">1 : 1</option>\
					<option value="scsb2">1/2 : 1/2</option>\
					<option value="scsb3">1/3 : 1/3 : 1/3</option>\
					<option value="scsb4">2/3 : 1/3</option>\
					<option value="scsb5">1/3 : 2/3</option>\
					</select><br /><br/>\
				<small>Select a column set to insert into a page with sidebar.</small></td>\
			</tr>\
			<tr>\
				<td><h3>If using Full width Page</h3></td>\
			</tr>\
			<tr>\
				<th><label for="ss_columns-coltype_full">Column set for full width page</label></th>\
				<td><select name="coltype" id="ss_columns-coltype_full">\
					<option value="scf1">1 : 1</option>\
					<option value="scf2">1/2 : 1/2</option>\
					<option value="scf3">1/2 : 1/4 : 1/4</option>\
					<option value="scf4">1/4 : 1/4 : 1/2</option>\
					<option value="scf5">1/4 : 1/4 : 1/4 : 1/4</option>\
					<option value="scf6">3/4 : 1/4</option>\
					<option value="scf7">1/4 : 3/4</option>\
					<option value="scf8">3/8 : 3/8 : 1/4</option>\
					<option value="scf9">1/4 : 3/8 : 3/8</option>\
					<option value="scf10">2/3 : 1/3</option>\
					<option value="scf11">1/3 : 2/3</option>\
					<option value="scf12">1/3 : 1/3 : 1/3</option>\
					<option value="scf13">2/9 : 2/9 : 2/9 : 1/3</option>\
					<option value="scf14">1/3 : 2/9 : 2/9 : 2/9</option>\
					<option value="scf15">4/9 : 2/9 : 1/3</option>\
					<option value="scf16">1/3 : 4/9 : 2/9</option>\
					<option value="scf17">2/9 : 4/9 : 1/3</option>\
					<option value="scf18">1/3 : 2/9 : 4/9</option>\
					</select><br /><br/>\
					<small>Select a column set to insert into a full width page.</small></td>\
			</tr>\
			</table>\
		<p class="submit">\
			<input type="button" id="ss_columns-submit" class="button-primary" value="Insert Columns" name="submit" />\
		</p>\
		</div>');		
		var table = form.find('table');
		form.appendTo('body').hide();
		form.find('#ss_columns-submit').click(function(){
			var shortcode_sb = '';
			var shortcode_full = '';			
			var coltype_sb = table.find('#ss_columns-coltype_sb').val();
			
			switch(coltype_sb) {
				case 'scsb1':
				shortcode_sb = '[two_third_last]<br/><br/>Full column content here<br/><br/>[/two_third_last]';
				break;
				
				case 'scsb2':
				shortcode_sb = '[one_third]<br/><br/>First column content<br/><br/>[/one_third]<br/><br/>[one_third_last]<br/><br/>Second column content<br/><br/>[/one_third_last]';
				break;
				
				case 'scsb3':
				shortcode_sb = '[two_nineth]<br/><br/>First column content<br/><br/>[/two_nineth]<br/><br/>[two_nineth]<br/><br/>Second column content<br/><br/>[/two_nineth]<br/><br/>[two_nineth_last]<br/><br/>Third column content<br/><br/>[/two_nineth_last]';
				break;
				
				case 'scsb4':
				shortcode_sb = '[four_nineth]<br/><br/>First column content<br/><br/>[/four_nineth]<br/><br/>[two_nineth_last]<br/><br/>Second column content<br/><br/>[/two_nineth_last]';
				break;
				
				case 'scsb5':
				shortcode_sb = '[two_nineth]<br/><br/>First column content<br/><br/>[/two_nineth]<br/><br/>[four_nineth_last]<br/><br/>Second column content<br/><br/>[/four_nineth_last]';
				break;					
			}
			
			var coltype_full = table.find('#ss_columns-coltype_full').val();
			
			switch(coltype_full) {
				case 'scf1':
				shortcode_full = '[full]<br/><br/>Full column content here<br/><br/>[/full]';
				break;
				
				case 'scf2':
				shortcode_full = '[half]<br/><br/>First column content<br/><br/>[/half]<br/><br/>[half_last]<br/><br/>Second column content<br/><br/>[/half_last]';
				break;
				
				case 'scf3':
				shortcode_full = '[half]<br/><br/>First column content<br/><br/>[/half]<br/><br/>[one_fourth]<br/><br/>Second column content<br/><br/>[/one_fourth]<br/><br/>[one_fourth_last]<br/><br/>Third column content<br/><br/>[/one_fourth_last]';
				break;
				
				case 'scf4':
				shortcode_full = '[one_fourth]<br/><br/>First column content<br/><br/>[/one_fourth]<br/><br/>[one_fourth]<br/><br/>Second column content<br/><br/>[/one_fourth]<br/><br/>[half_last]<br/><br/>Third column content<br/><br/>[/half_last]';
				break;
				
				case 'scf5':
				shortcode_full = '[one_fourth]<br/><br/>First column content<br/><br/>[/one_fourth]<br/><br/>[one_fourth]<br/><br/>Second column content<br/><br/>[/one_fourth]<br/><br/>[one_fourth]<br/><br/>Third column content<br/><br/>[/one_fourth]<br/><br/>[one_fourth_last]<br/><br/>Fourth column content<br/><br/>[/one_fourth_last]';
				break;
				
				case 'scf6':
				shortcode_full = '[three_fourth]<br/><br/>First column content<br/><br/>[/three_fourth]<br/><br/>[one_fourth_last]<br/><br/>Second column content<br/><br/>[/one_fourth_last]';
				break;
				
				case 'scf7':
				shortcode_full = '[one_fourth]<br/><br/>First column content<br/><br/>[/one_fourth]<br/><br/>[three_fourth_last]<br/><br/>Second column content<br/><br/>[/three_fourth_last]';
				break;
				
				case 'scf8':
				shortcode_full = '[three_eighth]<br/><br/>First column content<br/><br/>[/three_eighth]<br/><br/>[three_eighth]<br/><br/>Second column content<br/><br/>[/three_eighth]<br/><br/>[one_fourth_last]<br/><br/>Third column content<br/><br/>[/one_fourth_last]';
				break;
				
				case 'scf9':
				shortcode_full = '[one_fourth]<br/><br/>First column content<br/><br/>[/one_fourth]<br/><br/>[three_eighth]<br/><br/>Second column content<br/><br/>[/three_eighth]<br/><br/>[three_eighth_last]<br/><br/>Third column content<br/><br/>[/three_eighth_last]';
				break;
				
				case 'scf10':
				shortcode_full = '[two_third]<br/><br/>First column content<br/><br/>[/two_third]<br/><br/>[one_third_last]<br/><br/>Second column content<br/><br/>[/one_third_last]';
				break;	
				
				case 'scf11':
				shortcode_full = '[one_third]<br/><br/>First column content<br/><br/>[/one_third]<br/><br/>[two_third_last]<br/><br/>Second column content<br/><br/>[/two_third_last]';
				break;	
				
				case 'scf12':
				shortcode_full = '[one_third]<br/><br/>First column content<br/><br/>[/one_third]<br/><br/>[one_third]<br/><br/>Second column content<br/><br/>[/one_third]<br/><br/>[one_third_last]<br/><br/>Third column content<br/><br/>[/one_third_last]';
				break;
				
				case 'scf13':
				shortcode_full = '[two_nineth]<br/><br/>First column content<br/><br/>[/two_nineth]<br/><br/>[two_nineth]<br/><br/>Second column content<br/><br/>[/two_nineth]<br/><br/>[two_nineth]<br/><br/>Third column content<br/><br/>[/two_nineth]<br/><br/>[one_third_last]<br/><br/>Fourth column content<br/><br/>[/one_third_last]';
				break;
				
				case 'scf14':
				shortcode_full = '[one_third]<br/><br/>First column content<br/><br/>[/one_third]<br/><br/>[two_nineth]<br/><br/>Second column content<br/><br/>[/two_nineth]<br/><br/>[two_nineth]<br/><br/>Third column content<br/><br/>[/two_nineth]<br/><br/>[two_nineth_last]<br/><br/>Fourth column content<br/><br/>[/two_nineth_last]';
				break;	
				
				case 'scf15':
				shortcode_full = '[four_nineth]<br/><br/>First column content<br/><br/>[/four_nineth]<br/><br/>[two_nineth]<br/><br/>Second column content<br/><br/>[/two_nineth]<br/><br/>[one_third_last]<br/><br/>Third column content<br/><br/>[/one_third_last]';
				break;
				
				case 'scf16':
				shortcode_full = '[one_third]<br/><br/>First column content<br/><br/>[/one_third]<br/><br/>[four_nineth]<br/><br/>Second column content<br/><br/>[/four_nineth]<br/><br/>[two_nineth_last]<br/><br/>Third column content<br/><br/>[/two_nineth_last]';
				break;
				
				case 'scf17':
				shortcode_full = '[two_nineth]<br/><br/>First column content<br/><br/>[/two_nineth]<br/><br/>[four_nineth]<br/><br/>Second column content<br/><br/>[/four_nineth]<br/><br/>[one_third_last]<br/><br/>Third column content<br/><br/>[/one_third_last]';
				break;
				
				case 'scf18':
				shortcode_full = '[one_third]<br/><br/>First column content<br/><br/>[/one_third]<br/><br/>[two_nineth]<br/><br/>Second column content<br/><br/>[/two_nineth]<br/><br/>[four_nineth_last]<br/><br/>Third column content<br/><br/>[/four_nineth_last]';
				break;			
			}	
			
			var sb_check = table.find('#ss_columns-sb_check').val();
			var sc_output = '';
			
			if(sb_check == 'yes')
				sc_output = shortcode_sb;
			else
				sc_output = shortcode_full;

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sc_output);
			tb_remove();
		});
	});
 })();