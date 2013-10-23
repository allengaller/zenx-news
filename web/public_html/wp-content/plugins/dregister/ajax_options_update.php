<?php
// --- Paths definitions --- //
$absolute = str_replace ('wp-content\plugins\dregister','',dirname(__FILE__));
$absolute = str_replace ('wp-content/plugins/dregister','',$absolute);
define( 'ABSPATH_ROOT',$absolute );
define( 'ABSPATH_PLUGINDIR',dirname(__FILE__));

include_once(ABSPATH_ROOT.'wp-load.php');
include_once(ABSPATH_PLUGINDIR.'/config/globals.php');
include_once (ABSPATH_PLUGINDIR.'/functions/functions.php');		
include_once (ABSPATH_PLUGINDIR.'/functions/JSON.php');	


// !! Non loggato ---// 
if (!is_user_logged_in()):	
	$error = __('<b>ERROR</b>: You must log in first.','dregister');	
endif;
 
 // !! Non amministratore ---// 
if (!current_user_can('manage_options')):
	$error = __('<b>ERROR</b>: You don\'t have administrator rights to modify registration options.','dregister');		
endif;

// -- Cancella opzioni ---// 
if(empty($_POST['fields']) ):	
	delete_option('dr_fields');	
elseif (!$error):
	$old_fields = get_option('dr_fields');
	// -- Aggiorna opzioni ---// 
	foreach ($_POST['fields'] as $k=>$v){

		# Opzione monca
		if (empty($v['type'])):		
			unset ($_POST['fields'][$k]);
			continue;		
		endif;
		
		# Opzione vuota
		if (empty($v['name'])):		
			
			$error = __('<b>ERROR</b>: You cannot leave any blank field name.','dregister');
						
		endif;
		
		
		$field_name = 'dr_'.ereg_replace("[^a-z0-9_]", "", strtolower($v['name']));
		
		# Controlla se è presente il flag di update. Se sì, mantiene il meta_key
		if ($v['update']!=1 or empty($old_fields[$k]['field_name'])):
			$_POST['fields'][$k]['field_name'] = $field_name;
		else:
			$_POST['fields'][$k]['field_name'] = $old_fields[$k]['field_name'];
		endif;
		
		$field_names[$k] = $field_name;
		$field_nicenames[$field_name] = $v['name'];

		# Controlla la presenza di subs, rimuove quelli vuoti e li riordina numericamente
		if (is_array($_POST['fields'][$k]['subs'])):
			$s=0;
			foreach($_POST['fields'][$k]['subs'] as $k2=>$v2){
				$v2 = trim($v2);
				unset ($_POST['fields'][$k]['subs'][$k2]);
				if (!empty($v2)):
					$s++;			
					$_POST['fields'][$k]['subs'][$s]=ltrim($v2);
				endif;
			}
		endif;
			
		# Rimuove il flag di update
		unset ($_POST['fields'][$k]['update']);
	}
		
	foreach ( array_count_values($field_names) as $k=>$v){		
		# Opzione doppione
		if ($v>1):			
			$error = __('<b>ERROR</b>: Field "<b>', 'dregister');
			$error.=$field_nicenames[$k];
			$error.=__('</b>" is already present. Try changing the name.','dregister');
							
		endif;
		
	}
	update_option('dr_fields', $_POST['fields']);
	update_option('dr_force_first_name',$_POST['dr_force_first_name']);
	update_option('dr_force_last_name',$_POST['dr_force_last_name']);
endif;

$content = dr_compile(ABSPATH_PLUGINDIR.'/inc/options_list.php');
$json_output = json_encode( array('error'=>$error,'content'=>$content));

echo $json_output;
?>