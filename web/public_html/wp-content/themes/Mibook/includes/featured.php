<?php if( !( $mib_slider == 'Disable' ) ):
		if( is_home() || is_front_page() ):?>   
            <div class="featured">
                <div class="slider_wrap clearfix">
					<?php if ( $mib_slider_type == 'cycle' ) { // Begin Cycle Slider ?>
                    <div class="cycle_wrap">
						<?php
                        $mib_feat_cat_id = empty($mib_feat_cat_id) ? '1' : $mib_feat_cat_id ;
                        $slide_args = array( 'showposts' => $mib_num_of_slides, 'cat'=> $mib_feat_cat_id, 'order' => $mib_feat_order );
                        $temp = $post;
                        $bloginfo = get_template_directory_uri();
                        global $post;
                        $slideshow_query = new WP_Query($slide_args); ?> 
                        <ul class="cycle_slider"><?php 
                            if( $slideshow_query->have_posts() ):
								while ($slideshow_query->have_posts()): $slideshow_query->the_post();
									$post_opts = get_post_meta( $post->ID, 'post_options', true);
									$caption = (isset($post_opts['caption'])) ? $post_opts['caption'] : '';
									$hide_caption = (isset($post_opts['hide_caption'])) ? $post_opts['hide_caption'] : '';
									$img_link = (isset($post_opts['img_link'])) ? $post_opts['img_link'] : '';
									$no_link = (isset($post_opts['no_link'])) ? $post_opts['no_link'] : ''; ?>
                                   <li>
								   <?php if(has_post_thumbnail()){ // If have thumbnail
										$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
										
										if( $no_link != 'true' ) { // If image links enabled ?>									
                                        	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
                                        		<img class="slide_img" src="<?php echo $image_src[0]; ?>" width="920px" height="<?php echo $mib_sl_ht; ?>px" alt="<?php the_title(); ?>"/>	
											</a><?php }
										else { // If image links disabled ?>									
                                        	<img class="slide_img" src="<?php echo $image_src[0]; ?>" width="920px" height="<?php echo $mib_sl_ht; ?>px" alt="<?php the_title(); ?>"/>									
										<?php }
										
										if( $hide_caption != 'true' ) { ?>
											<div class="show_desc">
												<?php if( $caption != '') echo $caption; else the_title(); ?>
											</div>                                
										<?php }	?>
									
								   <?php }else { // Have not thumbnail ?>
                                   
										<?php if( $no_link != 'true' ){ // If image links enabled ?>
											<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo catch_post_image(); ?>" width="920px" height="<?php echo $mib_sl_ht; ?>px" alt="<?php the_title(); ?>" /></a>
										<?php } else{ // If image links disabled ?>
											<img src="<?php echo catch_post_image(); ?>" width="920px" height="<?php echo $mib_sl_ht; ?>px" alt="<?php the_title(); ?>" />
										<?php }?>

									<?php  } // End thumbnail ?>
									</li>
								<?php endwhile; 
                            endif;
                            $post = $temp;
                            wp_reset_query();
                            ?>                    
                        </ul><!-- .cycle_slider -->
                        <ul class="cycle_nav"></ul>
                        <div class="controls">
                            <a class="prev_piece" href="#" title="Previous"></a>
                            <a class="next_piece" href="#" title="Next"></a>
                        </div><!-- .controls -->
                    </div><!-- .cycle_wrap -->
                    <?php } // End Cycle Slider
					
                    else { // Begin Nivo Slider ?>
                    <div class="nivo_wrap">
						<?php
                        $mib_feat_cat_id = empty($mib_feat_cat_id) ? '1' : $mib_feat_cat_id ;
                        $slide_args = array( 'showposts' => $mib_num_of_slides, 'cat'=> $mib_feat_cat_id, 'order' => $mib_feat_order );
                        $temp = $post;
                        $bloginfo = get_template_directory_uri();
                        global $post;
                        $slideshow_query = new WP_Query($slide_args); ?> 
                        <div id="nivo_slider">
						<?php
							$slides = 1;
							$format = '';
							if( $slideshow_query->have_posts() ):
								while ($slideshow_query->have_posts()): $slideshow_query->the_post();
									$post_opts = get_post_meta( $post->ID, 'post_options', true);
									$caption = (isset($post_opts['caption'])) ? $post_opts['caption'] : '';
									$hide_caption = (isset($post_opts['hide_caption'])) ? $post_opts['hide_caption'] : '';
									$img_link = (isset($post_opts['img_link'])) ? $post_opts['img_link'] : '';
									$no_link = (isset($post_opts['no_link'])) ? $post_opts['no_link'] : '';	?>
                                    
									<?php if(has_post_thumbnail()){ //If have thumbnail
										$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
                                    	if( $no_link != 'true' ) { // If image links enabled ?>                                    
                                    		<a class="nivo-imageLink" href="<?php if($img_link) echo $img_link; else the_permalink(); ?>"><img class="slide_img" src="<?php echo $dir; ?>/scripts/timthumb.php?src=<?php echo $image_src[0]; ?>&amp;w=960&amp;h=<?php echo $mib_sl_ht; ?>&amp;zc=1&amp;q=100" width="920px" height="<?php echo $mib_sl_ht; ?>px" alt="<?php the_title(); ?>" <?php if( $hide_caption != 'true' ) { ?> title="<?php if( $caption != '') { echo( '#caption'.$slides ); $format .= '<div id="caption'.$slides.'" class="nivo-html-caption">'.$caption.'</div>'; } else the_title(); ?>"<?php } //hide caption ?>/></a><?php }
										else { // If image links disabled ?>									
											<img class="slide_img" src="<?php echo $dir; ?>/scripts/timthumb.php?src=<?php echo $image_src[0]; ?>&amp;w=960&amp;h=<?php echo $mib_sl_ht; ?>&amp;zc=1&amp;q=100" width="920px" height="<?php echo $mib_sl_ht; ?>px" alt="<?php the_title(); ?>" <?php if( $hide_caption != 'true' ) { ?> title="<?php if( $caption != '') { echo( '#caption'.$slides ); $format .= '<div id="caption'.$slides.'" class="nivo-html-caption">'.$caption.'</div>'; } else the_title(); ?>"<?php } //hide caption ?> />
										<?php }	

									}else {  // Have not thumbnail ?>
                                    
                                    	<?php if( $no_link != 'true' ){ // If image links enabled ?>
                                    		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img class="slide_img" src="<?php echo $dir; ?>/scripts/timthumb.php?src=<?php echo catch_post_image(); ?>&amp;w=960&amp;h=<?php echo $mib_sl_ht; ?>&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" <?php if( $hide_caption != 'true' ) { ?> title="<?php if( $caption != '') { echo( '#caption'.$slides ); $format .= '<div id="caption'.$slides.'" class="nivo-html-caption">'.$caption.'</div>'; } else the_title(); ?>"<?php } //hide caption ?> /></a>
    									<?php }else{ // If image links disabled ?>
											<img class="slide_img" src="<?php echo $dir; ?>/scripts/timthumb.php?src=<?php echo catch_post_image(); ?>&amp;w=960&amp;h=<?php echo $mib_sl_ht; ?>&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" <?php if( $hide_caption != 'true' ) { ?> title="<?php if( $caption != '') { echo( '#caption'.$slides ); $format .= '<div id="caption'.$slides.'" class="nivo-html-caption">'.$caption.'</div>'; } else the_title(); ?>"<?php } //hide caption ?> />
										<?php } ?>
                                     
                                    <?php } // End thumbnail ?>
									<?php $slides += 1;                                
								endwhile; 
                            endif;
                            $post = $temp;
                            wp_reset_query();
                            ?> 
                        </div><!-- #nivo_slider -->
                        <?php echo $format; ?>
                    </div><!-- .nivo_wrapper -->
                    <?php } // Nivo Slider ?>                                
                </div><!-- .slider_wrap -->                
            </div><!-- .featured -->
            <?php 
		endif; // If on Home
    endif; // If not Hide Slider ?>    
    <?php if( is_page() && (!is_home() && !is_front_page()) ){
		$page_opts = get_post_meta( $posts[0]->ID, 'page_options', true );
		$custom_caption = (isset($page_opts['custom_caption'])) ? $page_opts['custom_caption'] : '';
		$cust_embed = (isset($page_opts['cust_embed'])) ? $page_opts['cust_embed'] : '';
		$hide_feat = (isset($page_opts['hide_feat'])) ? $page_opts['hide_feat'] : '';
		if( !$hide_feat ) {	
	?>
     
    <div class="featured">
        <div class="featured_wrap clearfix <?php if ( $cust_embed ) echo ( 'custom_embed' ); ?>">
		<?php
        if( $cust_embed ) { // Custom Page Header or Flash Embed
		echo stripslashes( $cust_embed );
		}
		else {		
		?>
            <div class="page-title">
                <h3><?php if( $custom_caption ) echo( $custom_caption ); else mibook_page_title(); ?></h3>
            </div>
            <div class="feat_widget_area">
				<?php 
                $unique_feat_bar = (isset($page_opts['unique_feat_bar'])) ? $page_opts['unique_feat_bar'] : '';
                if ( $unique_feat_bar )
                {
                    if ( is_active_sidebar( $posts[0]->ID.'-feat-bar') ) :
                        dynamic_sidebar( $posts[0]->ID.'-feat-bar' );
                    endif;
                }
                else
                {			
                    if ( is_active_sidebar( 'default-feat-bar' ) ) :
                        dynamic_sidebar( 'default-feat-bar' ); 
                    endif; 
                }?> 
            </div><!-- .feat_widget_area -->
            <?php } // Not Custom embed ?>
            </div><!-- .featured_wrap -->
    </div><!-- .featured -->
    <?php } // Hide Featured
	} // Featured Area
	
	elseif(!is_home() && !is_front_page()) { // Normal Pages like single, search, archives ?>
        <div class="featured">
            <div class="featured_wrap clearfix">
                <div class="breadcrumbs">
                    <h3><?php if(!is_attachment()){
							mibook_breadcrumbs();}
							else{ mibook_page_title(); }
						?>
					</h3>
                </div>
                <div class="feat_widget_area">
					<?php
                    if ( is_active_sidebar( 'default-feat-bar' ) ) :
                    dynamic_sidebar( 'default-feat-bar' ); 
                    endif; 
                    ?> 
                </div><!-- .feat_widget_area -->
            </div><!-- .featured_wrap -->
        </div><!-- .featured -->
	<?php } ?>