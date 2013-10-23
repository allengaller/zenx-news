<?php
/* Custom Post options that allows us to customize the Portfolio gallery content and images*/ 
$post_opts_key = "post_options";
$meta_boxes = array(
				//Sidebar Placement
				"info1" => array( "type" => "heading",
								"description" => __( 'Sidebar', 'mibook' ) ),
								
				"sidebar_opts" => array(
								"id" => "sidebar_opts",
								"title" => __( 'Sidebar Placement', 'mibook' ),
								"std" => "right",
								"type" => "select",
								"options" => array("right", "left", "none"),	
								"description" => __( 'Choose right, left or none.', 'mibook' ) ),
			
				"hr1" => array(	"type" => "hr"),

				//Slider options for this post
				"info2" => array( "type" => "heading",
								"description" => __( 'Slider options for this post', 'mibook' ) ),

				"hide_caption" => array(
								"id" => "hide_caption",
								"title" => __( 'Check to hide caption for this post on Slider', 'mibook' ),
								"type" => "checkbox",
								"description" => __( 'If unchecked, post title will be used as caption.', 'mibook' ) ),
				
				"caption" => array(
								"id" => "caption",
								"title" => __( 'Custom HTML Caption for this post', 'mibook' ),
								"type" => "text",
								"description" => __( 'Write a custom caption for this post. This caption will be shown on slider.', 'mibook' ) ),

				"img_link" => array(
								"id" => "img_link",
								"title" => __( 'Slider image links to', 'mibook' ),
								"type" => "text",
								"description" => __( 'Enter a URL to which the slider image should link to. Example: http://somesite.com. If left empty, the image will link to the permanent post.', 'mibook' ) ),
				
				"no_link" => array(
								"id" => "no_link",
								"title" => __( 'Do not link slide images', 'mibook' ),
								"type" => "checkbox",
								"description" => __( 'Check to de-activate links for slide images.', 'mibook' ) ),																													
								);

function create_meta_box() {
	global $post_opts_key;
	
	if( function_exists( 'add_meta_box' ) ) {
		add_meta_box( 'new-meta-boxes', __('Post Options','mibook'), 'display_meta_box', 'post', 'normal', 'high' );
	}
}

function display_meta_box() {
	global $post, $meta_boxes, $post_opts_key;
	?>
	<div class="form-wrap">
		<?php wp_nonce_field( plugin_basename( __FILE__ ), $post_opts_key . '_wpnonce', false, true );        
        foreach($meta_boxes as $meta_box) {
			$data = get_post_meta($post->ID, $post_opts_key, true);			
			if( $meta_box[ 'type' ] == "heading" ) {
				echo ('<h4>'.$meta_box[ 'description' ].'</h4>'); 
			}
			
			elseif ( $meta_box[ 'type' ] == "text" ) {?>
                <div class="form-field form-required">
                    <label for="<?php echo $meta_box[ 'id' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
                    <input style="width:100%" type="text" name="<?php if (isset($meta_box['id'])) echo $meta_box['id']; ?>" id="<?php if (isset($meta_box['id'])) echo $meta_box[ 'id' ]; ?>" value="<?php if (isset($data[ $meta_box[ 'id' ] ])) echo htmlspecialchars( $data[ $meta_box[ 'id' ] ] ); ?>" />
                    <p><?php echo $meta_box[ 'description' ]; ?></p>
                </div>        
			<?php
			 }
			 
				elseif ( $meta_box[ 'type' ] == "select" ) {?>
                <div>
                <label for="<?php echo $meta_box[ 'id' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
                <select style="width:100%" name="<?php echo $meta_box['id']; ?>" id="<?php echo $meta_box['id']; ?>">
                            <?php foreach ($meta_box['options'] as $option) { ?>
                            <option <?php if ( isset($data[ $meta_box[ 'id' ] ]) && ( $data[ $meta_box[ 'id' ] ] == $option ) ) { echo ' selected="selected"'; } elseif ($option == $meta_box['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
                            <?php } ?>
                        </select>
              <p style="clear:both;"><?php echo $meta_box[ 'description' ]; ?></p>
              </div>
			<?php }
			 
				elseif ($meta_box[ 'type' ] == "checkbox" ) {?>
                 <div class="hide-caption style" style="padding:6px;">                   
<?php if(isset($data[$meta_box['id']]) && $data[$meta_box['id']]){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input style="float:left; width:20px; margin-top:2px;" type="checkbox" name="<?php echo $meta_box['id']; ?>" id="<?php echo $meta_box['id']; ?>" value="true" <?php echo $checked; ?>  />
                        <label for="<?php echo $meta_box[ 'id' ]; ?>" ><?php echo $meta_box[ 'title' ]; ?></label>
                        <p style=" text-indent:20px;"><?php echo $meta_box[ 'description' ]; ?></p>
                </div>
       <?php }
			elseif( $meta_box[ 'type' ] == "hr" ) {
				echo ('<div style="border-bottom:1px solid #E3E3E3; margin:12px 0px 0px"></div>
					  <div style="border-top:1px solid #FFF; margin:0px 0px 12px"></div>'); 
			}	   			 
		 } ?>	
	</div>
<?php
}

function save_meta_box( $post_id ) {
	global $post, $meta_boxes, $post_opts_key;
	
	foreach( $meta_boxes as $meta_box ) {
	if(isset ($meta_box['id']) && isset($_POST[ $meta_box['id'] ]))
		$data[ $meta_box['id'] ] = $_POST[ $meta_box['id'] ];
	}
	
	if (isset($_POST[ $post_opts_key . '_wpnonce' ]))
		if ( !wp_verify_nonce( $_POST[ $post_opts_key . '_wpnonce' ], plugin_basename(__FILE__) ) )
			return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	
	if(isset($data))
		update_post_meta( $post_id, $post_opts_key, $data );
}

add_action( 'admin_menu', 'create_meta_box' );
add_action( 'save_post', 'save_meta_box' );
?>