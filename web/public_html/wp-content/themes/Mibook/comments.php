<?php
/* Comments Template */

/* Fetch Theme Admin Options */
global $options;
foreach ($options as $value) {
	if(isset($value['id']) && isset ($value['std']))
		if (get_option( $value['id'] ) === FALSE) {
			$$value['id'] = $value['std']; 
		} else {
		$$value['id'] = get_option( $value['id'] );
	}
}
?>
	<div id="comments" class="clearfix">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'mibook' ); ?></p>
	</div><!-- #comments -->
	<?php
			return;
		endif;
	?>

	<?php if ( have_comments() ) : ?>
		<h3 id="comments-title" class="single-headings">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'mibook' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>

	<?php //Nav Comment start
		if(get_option('page_comments')) {
			$comment_pages = paginate_comments_links('echo=0');
			if($comment_pages) {
	?>
		<div class="nav-comment">
			<?php echo $comment_pages; ?>
		</div>
	<?php
			}
		}
	?><!--Nav Comment-->

	<ol class="commentlist">
		<?php wp_list_comments( array( 'callback' => 'mibook_comment' ) );?>
	</ol>

	<?php //Nav Comment start
		if(get_option('page_comments')) {
			$comment_pages = paginate_comments_links('echo=0');
			if($comment_pages) {
	?>
		<div class="nav-comment">
			<?php echo $comment_pages; ?>
		</div>
	<?php
			}
		}
	?><!--Nav Comment-->

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'mibook' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->