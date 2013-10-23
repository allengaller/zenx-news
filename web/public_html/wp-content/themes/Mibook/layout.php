<div class="mod">
<?php 	
	$cat_args=array(
	'type'		=> 'post',   // type（字符）需检索的分类类型,默认为post，也可以填link。
	'orderby'	=> get_option('mib_cats_orderby'),    // orderby（字符）排序规则:默认为按分类 编号排序。有效的值包括：id（默认）；name(分类名)；slug（分类别名）；count（文章数）；term_group（）。
	'order'		=> get_option('mib_cats_order'),    // order（字符）为类别排序（升序或降序）。默认升序。可能的值包括：Asc（默认）；desc。
	'exclude'	=> get_option('mib_exclude_cats'),    // exclude（字符）排除列表中以升序排列的用逗号分开的一个或多个分类。
	 );
	$categories=get_categories($cat_args);
	foreach($categories as $category) {
	echo '<div class="mod-item">'; 
	?>
	<?php $args=array(
		'showposts'				=> 1, 
		'category__in'			=> array($category->term_id),
		'ignore_sticky_posts'	=>1, // number of sticky posts to ignore in the listing		
		);
	$posts=get_posts($args);
	if ($posts) {		
		echo '<div class="item-caption">
					<h5><a class="item-parent-cat" href="' . get_category_link( $category->term_id ) .'"  title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . ' target="_blank" >' . $category->name.'</a>'.get_cats_children($category->term_id).'</h5>
				<div class="layout-meta">
					<em>'. __( 'Post Counts:', 'mibook' ).''.get_category($category->term_id)->count.'</em>
					<a href="' . get_category_link( $category->term_id ) . '/feed" title="' . sprintf( __( "RSS in %s" ), $category->name ) . '" ' . ' target="_blank" >' . __( 'RSS', 'mibook' ).'</a>
					<a href="' . get_category_link( $category->term_id ) .'"  title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . ' target="_blank" > '. __( 'More Post', 'mibook' ).'</a>
				</div>					
			</div>
		<div class="preview-post">';		
	foreach($posts as $post) {
		setup_postdata($post); 		
		$post_opts = get_post_meta( $post->ID, 'post_options', true ); ?>
		<?php  { ?>
			<div class="preview-post-thumbnail foldify">
            	<?php include('includes/post_thumbnail.php'); ?>
            </div>
		<?php } ?>
        <div class="preview-post-content"> 
			<h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" target="_blank"><?php the_title(); ?></a></h5>
			<div class="entry-meta"><?php mibook_header_meta(); ?></div>
			<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 73,"..."); ?>
			<a href="<?php the_permalink(); ?>" class="read-more" rel="bookmark" title="<?php the_title_attribute(); ?>" target="_blank"><?php _e( 'Read More', 'mibook' ); ?></a>
            </div>
		<?php 
		  } echo '</div>';
		  } ?><!-- .preview-post -->

<?php $args=array(
		'showposts' => 1, // number of posts to display
		'category__in' => array($category->term_id),
		'orderby' => rand,
		);
	$posts=get_posts($args);
	if ($posts) {		
		echo '<div class="random-post">';		
	foreach($posts as $post) {
		setup_postdata($post); 		
		$post_opts = get_post_meta( $post->ID, 'post_options', true );?>
		<?php { ?>
            <?php include('includes/post_thumbnail.php'); ?>
		<?php } ?> 
			<h5 class="boxCaption"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title_attribute(); ?></a></h5>
		<?php 
		  } echo '</div>';
	} ?><!-- .random-post -->
 
	<div class="list-post">    
		<?php $args=array(
			'showposts' => 3, // number of posts to display
			'category__in' => array($category->term_id),
			'offset'=>1
			);
		$posts=get_posts($args);
		if ($posts) {
			echo '<ul class="list-post-left">';
		foreach($posts as $post) {
			setup_postdata($post); ?>							
        	<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" target="_blank"><?php the_title(); ?></a> <?php edit_post_link() ?>	<!--<span class="date"><?php //the_time('Y-m-d') ?></span>--></li>
			<?php 
		  	} echo '</ul>';
		  	} ?><!-- .list-post-left -->
          
 		<?php $args=array(
			'showposts' => 3, // number of posts to display
			'category__in' => array($category->term_id),
			'offset'=>4
			);
		$posts=get_posts($args);
		if ($posts) {
			echo '<ul class="list-post-right">';
		foreach($posts as $post) {
			setup_postdata($post); ?>							
        	<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" target="_blank"><?php the_title(); ?></a> <?php edit_post_link() ?>	<!--<span class="date"><?php //the_time('Y-m-d') ?></span>--></li>
		  	<?php 
} echo '</ul>';
		  	} ?><!-- .list-post-right -->         
	</div><!-- .list-post -->
          				
	<?php	
	echo '</div>';// .mod-item		
	} 
?>

</div><!--  .mod  -->