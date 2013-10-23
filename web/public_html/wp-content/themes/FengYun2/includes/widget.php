<?php
// 最新文章
class news extends WP_Widget{
	function news(){
		$widget_options = array('classname'=>'set_contact','description'=>'主题自带的最新文章');
		$this->WP_Widget( false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;最新文章',$widget_options );
    }
	function widget($instance){
		include("widget/newarticles.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("news");'));

// 年度排行
class hot extends WP_Widget{
    function hot(){
		$widget_options = array('classname'=>'set_contact','description'=>'主题自带的年度排行');
		$this->WP_Widget(false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;年度排行',$widget_options);
    }
	function widget($instance){
		include("widget/hotarticles.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("hot");'));

// 随机文章
class random extends WP_Widget{
    function random(){
		$widget_options = array('classname'=>'set_contact','description'=>'主题自带的随机文章');
		$this->WP_Widget(false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;随机文章',$widget_options);
    }
	function widget($instance){
		include("widget/random.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("random");'));

// 最新评论
class comments extends WP_Widget{
    function comments(){
		$widget_options = array('classname'=>'set_contact','description'=>'主题自带的最新评论');
		$this->WP_Widget(false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;最新评论',$widget_options);
    }
	function widget($instance){
		include("widget/r_comments.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("comments");'));

// 推荐文章
class recommend extends WP_Widget{
    function recommend(){
		$widget_options = array('classname'=>'set_contact','description'=>'添加后需到主题设置中添加分类ID');
		$this->WP_Widget(false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;推荐文章',$widget_options);
    }
	function widget($instance){
		include("widget/s_cat.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("recommend");'));

// 全部分类
class categories_s extends WP_Widget{
    function categories_s(){
		$widget_options = array('classname'=>'set_contact','description'=>'主题自带的全部分类');
		$this->WP_Widget(false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;全部分类',$widget_options);
    }
	function widget($instance){
		include("widget/s_category.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("categories_s");'));

// 推荐栏目
class rcategory extends WP_Widget{
    function rcategory(){
		$widget_options = array('classname'=>'set_contact','description'=>'主题自带的推荐栏目，添加后需到主题设置中添加分类ID');
		$this->WP_Widget(false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;推荐栏目',$widget_options);
    }
	function widget($instance){
		include("widget/category_h.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("rcategory");'));

// 订阅本站
class rssblock extends WP_Widget{
    function rssblock(){
		$widget_options = array('classname'=>'set_contact','description'=>'主题自带的订阅本站，添加后需到主题设置中添加订阅代码');
		$this->WP_Widget(false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;订阅本站',$widget_options);
    }
	function widget($instance){
		include("widget/rssblock.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("rssblock");'));

// 侧边广告
class ads extends WP_Widget{
    function ads(){
		$widget_options = array('classname'=>'set_contact','description'=>'主题自带的侧边广告，添加后需到主题设置中添加广告代码');
		$this->WP_Widget(false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;侧边广告',$widget_options);
    }
	function widget($instance){
		include("widget/ads.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("ads");'));

// 热门标签
class tags extends WP_Widget{
    function tags(){
		$widget_options = array('classname'=>'set_contact','description'=>'主题自带的热门标签');
		$this->WP_Widget(false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;热门标签',$widget_options);
    }
	function widget($instance){
		include("widget/s_tag.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("tags");'));

// 侧边图片
class mimgs extends WP_Widget{
    function mimgs(){
		$widget_options = array('classname'=>'set_contact','description'=>'主题自带的最新图片,不支持添加自定义栏目图像');
		$this->WP_Widget(false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;最新图片',$widget_options);
    }
	function widget($instance){
		include("widget/mimgs.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("mimgs");'));

// tab菜单
class swt_tab1 extends WP_Widget{
	function swt_tab1(){
		$widget_options = array('classname'=>'set_contact','description'=>'主题自带的TAB菜单');
		$this->WP_Widget( false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;tab菜单',$widget_options );
    }
	function widget($instance){
		include("tab.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("swt_tab1");'));

// 侧边自定义广告1
class ad1 extends WP_Widget{
	function ad1(){
		$widget_options = array('classname'=>'set_contact','description'=>'侧边自定义广告1');
		$this->WP_Widget( false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;侧边自定义广告1',$widget_options );
    }
	function widget($instance){
		include("ad1.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("ad1");'));

// 搜索
class search_g extends WP_Widget{
    function search_g(){
		$widget_options = array('classname'=>'set_contact','description'=>'主题自带的搜索');
		$this->WP_Widget(false,'主题小工具&nbsp;&nbsp;&nbsp;&nbsp;搜索',$widget_options);
    }
	function widget($instance){
		include("widget/search_g.php");
?>
<?php
}
}
add_action('widgets_init',create_function('', 'return register_widget("search_g");'));
?>