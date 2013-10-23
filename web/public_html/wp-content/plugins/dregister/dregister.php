<?php

/*
Plugin Name: Dr. Register
Plugin URI: http://www.juzaam.com/dregister-wordpress-plugin/
Description: This plugins allows you a easy control of registration in your WP BLOG
Version: 1.3
Author: Ezio Lanza - Juzaam
Author URI: http://www.juzaam.com
*/

/*  Copyright 2008 Ezio Lanza - Juzaam(email : eziolanza@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*-------------------------------------------------------------------------------*/	
/* LOCALIZATION -------------------------*/
/*-------------------------------------------------------------------------------*/	
load_plugin_textdomain( 'dregister', '/wp-content/plugins/dregister/' );


/*-------------------------------------------------------------------------------*/	
/* VARIABILI E STRUMENTI-------------------------*/
/*-------------------------------------------------------------------------------*/	
$absolute = str_replace ('wp-content\plugins\dregister','',dirname(__FILE__));
$absolute = str_replace ('wp-content/plugins/dregister','',$absolute);
define( 'ABSPATH_ROOT',$absolute );
define( 'ABSPATH_PLUGINDIR',dirname(__FILE__));

require_once(ABSPATH_ROOT.'wp-includes/pluggable.php');
require_once(ABSPATH_ROOT.'wp-load.php');


// --- Recursive CHMOD (auto-update problem workaround) THX : http://snipplr.com/view/5350/recursive-chmod-in-php/ --//
# Scandir compatibility for PHP 4
if(!function_exists('scandir')) {
	function scandir($folder) {
	$handle = opendir($folder);
	while (false !== ($filename = readdir($handle))) {
		$files[] = $filename;
	}
	return $files;
	}
}

function recursiveChmod($path, $filePerm=0644, $dirPerm=0755){
	// Check if the path exists
	if(!file_exists($path)){
		return(FALSE);
	}

	// See whether this is a file
	if(is_file($path)){

	// Chmod the file with our given filepermissions
	@chmod($path, $filePerm);

	// If this is a directory...
	} elseif(is_dir($path)) {

		// Then get an array of the contents
		$foldersAndFiles = scandir($path);
		// Remove "." and ".." from the list
		$entries = array_slice($foldersAndFiles, 2);
		// Parse every result...
		foreach($entries as $entry){
			// And call this function again recursively, with the same permissions
			recursiveChmod($path."/".$entry, $filePerm, $dirPerm);
		}
		// When we are done with the contents of the directory, we chmod the directory itself
		@chmod($path, $dirPerm);

	}
	// Everything seemed to work out well, return TRUE
	return(TRUE);
}
/*-------------------------------------------------------------------------------*/	
/* INSTALLAZIONE -------------------------*/
/*-------------------------------------------------------------------------------*/	
get_currentuserinfo();

//-- Checks if the field content is allowed --//
function dr_check_field($field_data,$field_value){
		# Field is empty
		if ($field_data['required'] && empty($field_value)):
			return __('<strong>ERROR</strong>: You must fill in the required field "','dregister').$field_data['name'].'"';
		endif;
		# Field is numeric but content isn't
		if ($field_data['type']=='input_num' && !is_numeric($field_value) &&
				!(!$field_data['required'] && empty($field_value)) ):
			return __('<strong>ERROR</strong>: field "','dregister').$field_data['name'].__('" only allows numbers.','dregister');
		endif;	
		
		return TRUE;
}

// Aggiunge il foglio di stile
add_action( 'login_head', 'dr_add_css' );
add_action( 'admin_head', 'dr_add_css' );

// Aggiunge i campi personalizzati
add_action( 'register_form', 'dr_add_fields' );

// Controlla gli errori alla registrazione
add_filter( 'registration_errors', 'dr_reg_check' );	

// Inserisce nel DB i campi personalizzati
add_action('user_register', 'dr_reg_complete');

// Mostra i nuovi campi nel profilo 
add_action('show_user_profile', 'dr_profile');
add_action('edit_user_profile', 'dr_profile');

// Aggiorna i nuovi campi dal profilo
add_action('profile_update', 'dr_reg_complete');



/*-------------------------------------------------------------------------------*/	
/* CONTENUTO FRONTALE -------------------------*/
/*-------------------------------------------------------------------------------*/	

// -- Adds css to login page -- //
function dr_add_css(){	
	?><link rel="stylesheet" href="<?php echo get_option('siteurl');?>/wp-content/plugins/dregister/css/dregister.css" type="text/css" /><?php
}

// -- Adds fields in the form -- //
function dr_add_fields(){	

	# First and last name
	if (get_option('dr_force_first_name')):	
			echo '<p>
				<label>'; _e('First Name'); echo '<br />
				<input type="text" name="first_name" value="'.$_POST['first_name'].'" id="dr_custom_input" class="input" value="" size="25" tabindex="20" /></label>
			</p>';		
	endif;
	if (get_option('dr_force_last_name')):	
			echo '<p>
				<label>'; _e('Last Name'); echo '<br />
				<input type="text" name="last_name" value="'.$_POST['last_name'].'" id="dr_custom_input" class="input" value="" size="25" tabindex="20" /></label>
			</p>';		
	endif;
		
	# Custom fields
	if (get_option('dr_fields')):		
		
		foreach (get_option('dr_fields') as $k=>$v){			
			switch ( $v['type'] ){
			case 'input':
			case 'input_num':
				echo '<p>
					<label>'.$v['name'];
					if (!$v['required']) _e('<i style="font-size:80%"> not required</i>','dregister');
					echo ' <br />
					<input type="text" name="'.$v['field_name'].'" value="'.$_POST[$v['field_name']].'" id="dr_custom_input" class="input" value="" size="25" tabindex="20" />
					</label>
				</p>';
			break;
			case ( 'radio' ):
				echo '<p>
					<label>'.$v['name'];
					if (!$v['required']) _e('<i style="font-size:80%"> not required</i>','dregister');
					echo ' <br /></label><div class="dr_input_radio">';
					foreach ($v['subs'] as $sub_key=>$sub_name){					
					
						echo ' <input type="radio" name="'.$v['field_name'].'" value="'.$sub_name.'"> '.$sub_name;
					}					
				echo '</div></p>';			
			break;	
			}
		}
	echo '<br />';	
	endif;
}

// -- Checks for errors on form submitted --//
function dr_reg_check($errors) {	
	
	if (get_option('dr_force_first_name') && empty($_POST['first_name'])):	
		$errors->add('dr_first_name-empty',__('<strong>ERROR</strong>: You must fill in the  field "First Name".','dregister'));
	endif;
	
	if (get_option('dr_force_last_name') && empty($_POST['last_name'])):	
		$errors->add('dr_last_name-empty',__('<strong>ERROR</strong>: You must fill in the  field "Last Name".','dregister'));
	endif;
	
	foreach (get_option('dr_fields') as $k=>$v){
			
		if ( dr_check_field($v,$_POST[$v['field_name']]) !== TRUE)			
			$errors->add('dr_field_'.$k.'-error', dr_check_field($v,$_POST[$v['field_name']]) );			
		

	}		
	return $errors;
}	

/*-------------------------------------------------------------------------------*/	
/* PANNELLO AMMINISTRAZIONE -------------------------*/
/*-------------------------------------------------------------------------------*/	
add_action('admin_menu', 'my_plugin_menu');

function my_plugin_menu() {
  add_options_page('DRegister Options', 'DRegister', 8, __FILE__, 'DRegister_options');
}

function DRegister_options() {
	recursiveChmod(ABSPATH_PLUGINDIR, 0755, 0755);
	require_once ABSPATH_PLUGINDIR.'/options.php';
}


// -- Updates user's meta --//
function dr_reg_complete($user_id) {
	global $errors;

	if (get_option('dr_force_first_name')):	
		update_usermeta( $user_id, 'first_name', $_POST['first_name']);
	endif;
	
	if (get_option('dr_force_last_name')):	
		update_usermeta( $user_id, 'last_name', $_POST['last_name']);
	endif;

	foreach (get_option('dr_fields') as $k=>$v){
	
		if (dr_check_field($v,$_POST[$v['field_name']])=== TRUE)			
			update_usermeta( $user_id, $v['field_name'], $_POST[$v['field_name']]);
		
	}	
	
}	

// --- Shows custom fields in profile -- //
function dr_profile(){
	global $profileuser;?>
	
	<table class="form-table">
		<tbody><?php
		if (get_option('dr_fields')):
		foreach (get_option('dr_fields') as $k=>$v){
		
			switch ( $v['type'] ){
			case 'input':
			case 'input_num':
				?>		
				<tr>
					<th>
					<label><?php echo $v['name'];?></label>
					</th>
					<td>
					<input id="<?php echo $v['field_name'];?>" class="regular-text" type="text" value="<?php echo $profileuser->$v['field_name'];?>" name="<?php echo $v['field_name'];?>"/>
					<?php if($v['required']) echo _e('Required.','dregister'); ?>
					</td>
				</tr>
				<?php
			break;
			case ( 'radio' ):
				?>		
				<tr>
					<th>
					<label><?php echo $v['name'];?></label>
					</th>
					<td>
					<?php 
						foreach ($v['subs'] as $sub_key=>$sub_name){	
							$checked = ( $profileuser->$v['field_name'] == $sub_name ) ? 'checked' : '';
							echo ' <input id="'.$v['field_name'].'" '.$checked.' type="radio" name="'.$v['field_name'].'" value="'.$sub_name.'" /> '.$sub_name;
						}
					?>				
					<?php if($v['required']) echo _e('Required.','dregister'); ?>
					</td>
				</tr>
				<?php				
			break;	
			}		
		}
		endif;
		?>
		</tbody>
	</table>
<?php
}




?>