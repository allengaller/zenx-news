<?php
include_once(ABSPATH_PLUGINDIR.'/config/globals.php');
include_once (ABSPATH_PLUGINDIR.'/functions/functions.php');						
?>				 
<div class="wrap">
<h2>DRegister</h2>
<script type="text/javascript" src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/dregister/mootools/mootools-1.2-core.js"></script>	
<script type="text/javascript" src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/dregister/js/options.js"></script>
<select id="field_select_dummy" class="hidden">
<?php
foreach ($GLOBALS['dr_types'] as $type=>$value){
	?><option value="<?php echo $type;?>"><?php echo $value;?></option><?php
}?>
</select>
<h3 id="dr_h3"><?php _e('Existing fields','dregister');?></h3>
<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/dregister/img/wait30trans.gif" class="hidden" id="wait"/>
<div id="message" class="hidden updated below-h2"><p><?php _e('Changes saved.','dregister');?></p></div>
<div id="message_error" class="hidden error updated"><p></p></div>
<form method="post" action="<?php bloginfo('wpurl'); ?>/wp-content/plugins/dregister/ajax_options_update.php" id="dr_form_update">

<table class="form-table">

<tr valign="bottom">
	<th scope="row"><?php _e('Require first name','dregister');?><br /><span class="small">meta_key: <i>first_name</i></span></th>
	<td><input type="checkbox" name="dr_force_first_name"<?php if (get_option('dr_force_first_name')) echo ' checked';?>></td>
</tr>
<tr valign="bottom">
	<th scope="row"><?php _e('Require last name','dregister');?><br /><span class="small">meta_key: <i>last_name</i></span></th>
	<td><input type="checkbox" name="dr_force_last_name"<?php if (get_option('dr_force_last_name')) echo ' checked';?>></td>
</tr>

</table>

<h3><?php _e('Custom fields','dregister');?></h3>
<?php
if ( function_exists('wp_nonce_field') )
	wp_nonce_field('dregister-update_options');
?>

<a href="javascript:void(0)" id="dr_link_add_custom_field"><?php _e('+ Add custom field','dregister');?></a>
<div id="div_options_wrapper">
<?php
	include (ABSPATH_PLUGINDIR.'/inc/options_list.php');
?>
</div>


<p class="submit">
<input type="hidden" name="counter" id="counter" value="<?php echo $field_id;?>" />
<input type="hidden" id="loc_required" value="<?php echo _e('required','dregister');?>" />
<input type="hidden" name="plugin_url" id="plugin_url" value="<?php bloginfo('wpurl'); ?>/wp-content/plugins/dregister/" />
<input type="submit" name="Submit" value="<?php _e('Save Changes','dregister') ?>" />
</p>

</form>
</div>