<h3>您可能还会对这些文章感兴趣！</h3>
<ul>
<?php
	$post_num = 10; // 设置调用数量
	$exclude_id = $post->ID; // 过滤当前文章
	$posttags = get_the_tags(); $i = 0;
	if ( $posttags ) { $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->name . ',';
	$args = array(
		'post_status' => 'publish',
		'tag_slug__in' => explode(',', $tags), // 调取tags文章
		'post__not_in' => explode(',', $exclude_id), // 排除已出现过的文章.
		'caller_get_posts' => 1, // 排除置顶文章.
		'orderby' => 'comment_date', 
		'posts_per_page' => $post_num
);
	query_posts($args); 
	while( have_posts() ) { the_post(); ?>
    <li><span style="float:right;padding-right:15px;"><?php the_time('m-d') ?></span><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo An_cut_str($post->post_title,40); ?></a> <small>(<?php if(function_exists(the_views)) { the_views(' 次', true);}?>)</small></li>
	<?php
		$exclude_id .= ',' . $post->ID; $i ++;
	 } wp_reset_query();
	}
	if ( $i < $post_num ) { // 当tags数量不足时，再取分类文章补足.
	$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
	$args = array(
		'category__in' => explode(',', $cats), // 只选分类的文章.
		'post__not_in' => explode(',', $exclude_id),
		'caller_get_posts' => 1,
		'orderby' => 'comment_date',
		'posts_per_page' => $post_num - $i
);
	 query_posts($args);
	 while( have_posts() ) { the_post(); ?>
    <li><span style="float:right;padding-right:15px;"><?php the_time('m-d') ?></span><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo An_cut_str($post->post_title,40); ?></a> <small>(<?php if(function_exists(the_views)) { the_views('次+', true);}?>)</small></li>
	<?php
		$i ++;
	 } wp_reset_query();
	}
if ( $i  == 0 )  echo '<li>暂无相关文章</li>';
?>
</ul>