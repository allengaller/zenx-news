<?php
// --- Paths definitions --- //
$absolute = str_replace ('wp-content\plugins\dregister','',dirname(__FILE__));
$absolute = str_replace ('wp-content/plugins/dregister','',$absolute);
define( 'ABSPATH_ROOT',$absolute );
define( 'ABSPATH_PLUGINDIR',dirname(__FILE__));

include_once(ABSPATH_ROOT.'wp-load.php');
include_once(ABSPATH_PLUGINDIR.'/config/globals.php');
include_once(ABSPATH_PLUGINDIR.'/functions/functions.php');

// !! Non loggato ---// 
if (!is_user_logged_in()):
	echo __('<p><strong>ERROR:</strong> You must log in first.</p>','dregister');
	die;
endif;
 
 // !! Non amministratore ---// 
if (!current_user_can('manage_options')):
	echo __('<p><strong>ERROR:</strong> You don\'t have administrator rights to modify registration options.</p>','dregister');
	die;
endif;

$field_id = intval($_POST['field_id']);
$dr_fields = get_option('dr_fields');

$dr_fields[$field_id]['type'] = $_POST['selected_type'];

include_once (ABSPATH_PLUGINDIR.'/inc/subfields_list.php'); 
?>