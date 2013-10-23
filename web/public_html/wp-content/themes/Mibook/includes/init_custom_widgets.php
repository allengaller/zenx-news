<?php 
/*Initialize Custom Widgets*/
function custom_widget_init() {
	register_widget('Mibook_Cat_Widget');
	register_widget('Mibook_Tagcloud_Widget');
	register_widget('Mibook_Recent_Posts');
	register_widget('Mibook_Mini_Folio');
	register_widget('Mibook_Popular_Posts');
	register_widget('Mibook_Recent_Comments');	
	register_widget('Mibook_Mini_Slider');
	register_widget('Mibook_Content_Slider');
	register_widget('Mibook_Flickr_Widget');
	register_widget('Mibook_Social_Widget');
	register_widget('Mibook_Twitter_Widget');
}
add_action('widgets_init', 'custom_widget_init');?>