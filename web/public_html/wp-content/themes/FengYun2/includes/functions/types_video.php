<?php
// 公告
function post_type_video() {
register_post_type(
					'video', 
					array( 'public' => true,
					'publicly_queryable' => true,
					'hierarchical' => false,
					'labels'=>array(
									'name' => _x('视频', 'post type general name'),
									'singular_name' => _x('视频', 'post type singular name'),
									'add_new' => _x('添加视频', '视频'),
									'add_new_item' => __('添加视频'),
									'edit_item' => __('编辑视频'),
									'new_item' => __('新的视频'),
									'view_item' => __('预览视频'),
									'search_items' => __('搜索视频'),
									'not_found' =>  __('您还没有发布视频'),
									'not_found_in_trash' => __('回收站中没有视频'), 
									'parent_item_colon' => ''
									),
                             'show_ui' => true,
							 'menu_position'=>5,
									'supports' => array(
														'title',
														'author', 
														'excerpt',
														'thumbnail',
														'trackbacks',
														'editor', 
														'comments',
														'custom-fields',
														'revisions'	) ,
					)
);

}

add_action('init', 'post_type_video');

function create_videos_taxonomy() 
{
	$labels = array(
					'name' => _x( '视频分类', 'taxonomy general name' ),
					'singular_name' => _x( 'videos', 'taxonomy singular name' ),
					'search_items' =>  __( '搜索分类' ),
					'all_items' => __( '全部分类' ),
					'parent_item' => __( '父级分类目录' ),
					'parent_item_colon' => __( '父级分类目录:' ),
					'edit_item' => __( '编辑视频分类' ), 
					'update_item' => __( '更新' ),
					'add_new_item' => __( '添加新视频分类' ),
					'new_item_name' => __( 'New Genre Name' ),
					); 
  
// Tags
	register_taxonomy(
		'video_tags',
		'video',
		array(
			'hierarchical' => false,
			'label' => '视频标签',
			'query_var' => true,
			'rewrite' => true
		)
	);

	register_taxonomy('videos',array('video'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'videos' ),
  ));
}
add_action( 'init', 'create_videos_taxonomy', 0 );
?>