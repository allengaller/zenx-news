<?php
 if (in_array ($dr_fields[$field_id]['type'],$GLOBALS['dr_types_with_subs'])): ?>

<a href="javascript:void(0)" class="link_add_sub" field_id="<?php echo $field_id;?>"><?php _e('+ add option','dregister');?></a><br/><?php
	if (is_array($dr_fields[$field_id]['subs']) && !empty($dr_fields[$field_id]['subs']) ):
	// Shows subs if any	
	foreach ($dr_fields[$field_id]['subs'] as $subfield_id=>$v2){

	 ?><p id="p_sub_<?php echo $subfield_id;?>">#<?php echo $subfield_id;?> <input type="text" name="fields[<?php echo $k;?>][subs][<?php echo $subfield_id;?>]" value="<?php echo $v2;?>" /><a href="javascript:void(0)"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/dregister/img/delete.png" field_id="<?php echo $field_id;?>" sub_id="<?php echo $subfield_id;?>" class="sub_delete"/></a></p>
	<?php
	}
	else:
		for ($subfield_id=1;$subfield_id<=2;$subfield_id++){
		?><p id="p_sub_<?php echo $field_id.'_'.$subfield_id;?>">#<?php echo $subfield_id;?> <input type="text" name="fields[<?php echo $field_id;?>][subs][<?php echo $subfield_id;?>]" /><a href="javascript:void(0)"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/dregister/img/delete.png" field_id="<?php echo $field_id;?>" sub_id="<?php echo $subfield_id;?>" class="sub_delete"/></a></p><?php
		}
		$subfield_id--;
	endif;
?>
<div id="sub_add_placeholder_<?php echo $field_id;?>" last_sub_id="<?php echo $subfield_id;?>"></div>

<?php endif; ?>