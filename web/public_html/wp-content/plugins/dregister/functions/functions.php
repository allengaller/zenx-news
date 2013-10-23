<?php

// --- Creates cascading select for custom field types --//
function type_select($id,$type_selected=NULL){
?><select field_id="<?php echo $id;?>" name="fields[<?php echo $id;?>][type]" id="select_<?php echo $id;?>" class="select_field_type"><?php
	foreach ($GLOBALS['dr_types'] as $type=>$value){
		$selected = ($type==$type_selected) ? 'selected="selected"' : '';
		?><option value="<?php echo $type;?>" <?php echo $selected;?>><?php echo $value;?></option><?php
	}?>
</select><?php
}


function dr_compile($file) {	
	global $wpdb,$current_user;	
    ob_start();
    require $file;
    return ob_get_clean();
	
}
?>