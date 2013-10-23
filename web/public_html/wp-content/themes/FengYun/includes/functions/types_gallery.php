<?php
// 公告
function post_type_picture() {
register_post_type(
                     'picture', 
                     array( 'public' => true,
					 		'publicly_queryable' => true,
							'hierarchical' => false,
                    		'labels'=>array(
    									'name' => _x('相册', 'post type general name'),
    									'singular_name' => _x('图片', 'post type singular name'),
    									'add_new' => _x('添加图片', '图片'),
    									'add_new_item' => __('添加图片'),
    									'edit_item' => __('编辑图片'),
    									'new_item' => __('新的图片'),
    									'view_item' => __('预览图片'),
    									'search_items' => __('搜索图片'),
    									'not_found' =>  __('您还没有发布图片'),
    									'not_found_in_trash' => __('回收站中没有图片'), 
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
add_action('init', 'post_type_picture');

function create_gallery_taxonomy() 
{
  $labels = array(
	  						  'name' => _x( '相册分类', 'taxonomy general name' ),
    						  'singular_name' => _x( 'gallery', 'taxonomy singular name' ),
    						  'search_items' =>  __( '搜索分类' ),
   							  'all_items' => __( '全部分类' ),
    						  'parent_item' => __( '父级分类目录' ),
   					   		  'parent_item_colon' => __( '父级分类目录:' ),
   							  'edit_item' => __( '编辑相册分类' ), 
  							  'update_item' => __( '更新' ),
  							  'add_new_item' => __( '添加新相册分类' ),
  							  'new_item_name' => __( 'New Genre Name' ),
  ); 
  
// Tags
	register_taxonomy(
		'picture_tags',
		'picture',
		array(
			'hierarchical' => false,
			'label' => '图片标签',
			'query_var' => true,
			'rewrite' => true
		)
	);

  register_taxonomy('gallery',array('picture'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'gallery' ),
  ));
}
add_action( 'init', 'create_gallery_taxonomy', 0 );
?>