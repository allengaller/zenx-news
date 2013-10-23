<table class="form-table">
<?php
$field_id=0;
$dr_fields = get_option('dr_fields');
if ($dr_fields):

foreach ($dr_fields as $k=>$v){

$field_id++;
?>
<tr valign="middle" id="tr_<?php echo $field_id;?>" class="dregister_options">
<th scope="row" class="input_field"><input type="text" name="fields[<?php echo $field_id;?>][name]" value="<?php echo $v['name'];?>"><br /><span class="small">meta_key: <i><?php echo $v['field_name'];?></i></span></th>
<td><?php type_select($field_id,$v['type']);?><input type="checkbox" <?php if ($v['required']) echo 'checked'; ?> name="fields[<?php echo $field_id;?>][required]"/> <?php _e('required','dregister');?> <a href="javascript:void(0)"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/dregister/img/delete.png" field_id="<?php echo $field_id;?>" class="field_delete"/></a>
<input type="hidden" name="fields[<?php echo $field_id;?>][update]" value="1" id="input_hidden_field_<?php echo $field_id;?>">
<div id="sub_placeholder_<?php echo $field_id;?>" class="small">
<?php include (ABSPATH_PLUGINDIR.'/inc/subfields_list.php'); ?>
</div>
</td>
</tr>
<?php
}
endif;

// Eventually blank field
if ($_POST['add_field']):
$field_id++;
?>
<tr valign="middle" id="tr_<?php echo $field_id;?>" class="dregister_options">
<th scope="row" class="input_field"><input type="text" name="fields[<?php echo $field_id;?>][name]" value=""><br /><span class="small">meta_key: <i></i></span></th>
<td><?php type_select($field_id);?><input type="checkbox" name="fields[<?php echo $field_id;?>][required]"/> <?php _e('required','dregister');?> <a href="javascript:void(0)"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/dregister/img/delete.png" field_id="<?php echo $field_id;?>" class="field_delete"/></a>
<input type="hidden" name="fields[<?php echo $field_id;?>][update]" value="1" id="input_hidden_field_<?php echo $field_id;?>">
<div id="sub_placeholder_<?php echo $field_id;?>" class="small">
</div>
</td>
</tr>
<?php
endif;
?>
<tr id="placeholder"></tr>
</table>