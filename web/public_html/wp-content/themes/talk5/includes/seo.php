<?php if ( is_home() ) { ?><title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(' | 第 %s 页 ',$paged); ?></title><?php } ?>
<?php if ( is_search() ) { ?><title>搜索结果 | <?php bloginfo('name'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(' | 第 %s 页 ',$paged); ?></title><?php } ?>
<?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?> | <?php bloginfo('name'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(' | 第 %s 页 ',$paged); ?></title><?php } ?>
<?php if ( is_category() ) { ?><title><?php single_cat_title(); ?> | <?php bloginfo('name'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(' | 第 %s 页 ',$paged); ?></title><?php } ?>
<?php if ( is_page() ) { ?><title><?php echo trim(wp_title('',0)); ?> | <?php bloginfo('name'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(' | 第 %s 页 ',$paged); ?></title><?php } ?>
<?php if ( is_day() ) { ?><title><?php the_time('Y年m月d日'); ?> | <?php bloginfo('name'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(' | 第 %s 页 ',$paged); ?></title><?php } ?>
<?php if ( is_month() ) { ?><title><?php the_time('Y年m月'); ?> | <?php bloginfo('name'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(' | 第 %s 页 ',$paged); ?></title><?php } ?>
<?php if ( is_year() ) { ?><title><?php the_time('Y年'); ?> | <?php bloginfo('name'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(' | 第 %s 页 ',$paged); ?></title><?php } ?>
<?php if ( is_404() ) { ?><title><?php echo"未找到指定的页面( ERROR 404 )-" ?> | <?php bloginfo('name'); ?></title><?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><title><?php  single_tag_title("", true); ?> | <?php bloginfo('name'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(' | 第 %s 页 ',$paged); ?></title>
<?php } ?> <?php } ?>
<?php if ( is_author() ) {?><title><?php wp_title('');?>发表的所有文章 | <?php bloginfo('name'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(' | 第 %s 页 ',$paged); ?></title><?php }?>
<?php
if (!function_exists('utf8Substr')) {
 function utf8Substr($str, $from, $len)
 {
     return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
          '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
          '$1',$str);
 }
}
if ( is_single() ){
    if ($post->post_excerpt) {
        $description  = $post->post_excerpt;
    } else {
   if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
    $post_content = $result['1'];
   } else {
    $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
    $post_content = $post_content_r['0'];
   }
         $description = utf8Substr($post_content,0,160);  
  } 
    $keywords = "";
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ",";
    }
}
?>
<?php echo "\n"; ?>
<?php if ( is_single() ) { ?>
<meta name="description" content="<?php echo trim($description); ?>" />
<meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
<?php } ?>
<?php if ( is_home() || is_day() || is_author() || is_month() || is_year() || is_404()|| is_page()) { ?>
<meta name="description" content="<?php echo get_qintag_option('indexdescription'); ?>" />
<meta name="keywords" content="<?php echo get_qintag_option('indexkeyword'); ?>" />
<?php } ?>
<?php if ( is_category() ) {
function deletehtml($description) {  
$description = trim($description);  
$description = strip_tags($description,"");  
return ($description); 
} 
add_filter('category_description', 'deletehtml');
?>
<meta name="description" content="<?php echo category_description($cat_ID); ?>" /> 
<meta name="keywords" content="<?php echo get_qintag_option('indexkeyword'); ?>" />
<?php } ?>