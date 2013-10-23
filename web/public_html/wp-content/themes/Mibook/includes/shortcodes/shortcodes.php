<?php
// Cruz custom shortcodes
add_action( 'init', 'cruz_add_shortcodes' );

function cruz_add_shortcodes() {
	add_shortcode('full', 'full');
	add_shortcode('three_fourth', 'three_fourth');
	add_shortcode('three_fourth_last', 'three_fourth_last');
	add_shortcode('half', 'half');
	add_shortcode('half_last', 'half_last');
	add_shortcode('three_eighth', 'three_eighth');
	add_shortcode('three_eighth_last', 'three_eighth_last');	
	add_shortcode('one_third', 'one_third');
	add_shortcode('one_third_last', 'one_third_last');
	add_shortcode('one_fourth', 'one_fourth');
	add_shortcode('one_fourth_last', 'one_fourth_last');	
	add_shortcode('two_third', 'two_third');
	add_shortcode('two_third_last', 'two_third_last');
	add_shortcode('two_nineth', 'two_nineth');
	add_shortcode('two_nineth_last', 'two_nineth_last');
	add_shortcode('four_nineth', 'four_nineth');
	add_shortcode('four_nineth_last', 'four_nineth_last');		
	add_shortcode('frame', 'frame');
	add_shortcode('tabs', 'tabs');
	add_shortcode('tab', 'tab');
	add_shortcode('tour', 'tour');
	add_shortcode('step', 'step');	
	add_shortcode('pricing', 'pricing');
	add_shortcode('col3', 'col3');
	add_shortcode('col4', 'col4');
	add_shortcode('col5', 'col5');		
	add_shortcode('toggle', 'toggle');
	add_shortcode('accordion', 'accordion');
	add_shortcode('faq', 'faq');
	add_shortcode('pullquote_left', 'pullquote_left');
	add_shortcode('pullquote_right', 'pullquote_right');
	add_shortcode('dropcap', 'dropcap');
	add_shortcode('box', 'box');
	add_shortcode('hr', 'hr');
	add_shortcode('dhr', 'dhr');
	add_shortcode('hr_3d', 'hr_3d');
	add_shortcode('hr_strip', 'hr_strip');
	add_shortcode('hr_dotted', 'hr_dotted');	
	add_shortcode('btn', 'btn');
	add_shortcode('quote', 'quote');		
}

function full( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="full">'.do_shortcode($content).'</div>';
}

function three_fourth( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="three_fourth">'.do_shortcode($content).'</div>';
}

function three_fourth_last( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="three_fourth last">'.do_shortcode($content).'</div><div class="clearf"></div>';
}

function half( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="half">'.do_shortcode($content).'</div>';
}

function half_last( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="half last">'.do_shortcode($content).'</div><div class="clearf"></div>';
}

function three_eighth( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="three_eighth">'.do_shortcode($content).'</div>';
}

function three_eighth_last( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="three_eighth last">'.do_shortcode($content).'</div><div class="clearf"></div>';
}

function one_third( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="one_third">'.do_shortcode($content).'</div>';
}

function one_third_last( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="one_third last">'.do_shortcode($content).'</div><div class="clearf"></div>';
}

function one_fourth( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="one_fourth">'.do_shortcode($content).'</div>';
}

function one_fourth_last( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="one_fourth last">'.do_shortcode($content).'</div><div class="clearf"></div>';
}

function two_third( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="two_third">'.do_shortcode($content).'</div>';
}

function two_third_last( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="two_third last">'.do_shortcode($content).'</div><div class="clearf"></div>';
}

function two_nineth( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="two_nineth">'.do_shortcode($content).'</div>';
}

function two_nineth_last( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="two_nineth last">'.do_shortcode($content).'</div><div class="clearf"></div>';
}

function four_nineth( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="four_nineth">'.do_shortcode($content).'</div>';
}

function four_nineth_last( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="four_nineth last">'.do_shortcode($content).'</div><div class="clearf"></div>';
}

function tour( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'heading' => ''
      ), $atts ) );
	return '<div class="tour clearfix"><h5 class="tour_head">'.$heading.'</h5>'.do_shortcode($content).'</div>';
}

function step( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'title' => 'Step'
      ), $atts ) );
	$tour_id = 'tour-'.rand(3,50000);
	return '<div class="toured" id="'.$tour_id.'"><h4 class="tour_title">'.$title.'</h4>'.do_shortcode($content).'</div>';
}

function pricing( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="pricing clearfix">'.do_shortcode($content).'</div>';
}

function col3( $atts, $content = null ) {
   extract( shortcode_atts( array(
   	  'title' => 'No title',
      'premium' => 'false'
      ), $atts ) );
	  $grid_class = 'col3';
	$grid_class = ( $premium == "true" ) ? $grid_class.' premium' : $grid_class;
	return '<div class="'.$grid_class.'"><div class="pricing_title">'.$title.'</div><div class="pricing_content">'.do_shortcode($content).'</div></div>';
}

function col4( $atts, $content = null ) {
   extract( shortcode_atts( array(
   	  'title' => 'No title',
      'premium' => 'false'
      ), $atts ) );
	  $grid_class = 'col4';
	$grid_class = ( $premium == "true" ) ? $grid_class.' premium' : $grid_class;
	return '<div class="'.$grid_class.'"><div class="pricing_title">'.$title.'</div><div class="pricing_content">'.do_shortcode($content).'</div></div>';
}

function col5( $atts, $content = null ) {
   extract( shortcode_atts( array(
   	  'title' => 'No title',
      'premium' => 'false'
      ), $atts ) );
	  $grid_class = 'col5';
	$grid_class = ( $premium == "true" ) ? $grid_class.' premium' : $grid_class;
	return '<div class="'.$grid_class.'"><div class="pricing_title">'.$title.'</div><div class="pricing_content">'.do_shortcode($content).'</div></div>';
}

function tabs( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="tabber">'.do_shortcode($content).'</div>';
}

function tab( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'title' => 'mytab'
      ), $atts ) );
	$tab_id = 'tab-'.rand(2,20000);
	return '<div class="tabbed" id="'.$tab_id.'"><h4 class="tab_title">'.$title.'</h4>'.do_shortcode($content).'</div>';
}

function toggle( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'title' => 'mytoggle'
      ), $atts ) );
	return '<h5 class="toggle"><span></span>'.$title.'</h5><div class="toggle_content">'.do_shortcode($content).'</div>';
}

function accordion( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'title' => 'myaccordion'
      ), $atts ) );
	return '<h5 class="handle">'.$title.'<span></span></h5><div class="acc_content"><div class="acc_inner">'.do_shortcode($content).'</div></div>';
}

function faq( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'question' => 'Your question here'
      ), $atts ) );
	return '<h5 class="question">'.$question.'</h5><div class="faq_content"><div class="faq_inner">'.do_shortcode($content).'</div></div>';
}

function quote( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<div class="quote">'.do_shortcode($content).'</div>';
}

function pullquote_left( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<span class="pqleft">'.do_shortcode($content).'</span>';
}

function pullquote_right( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<span class="pqright">'.do_shortcode($content).'</span>';
}

function dropcap( $atts, $content = null ) {
   extract( shortcode_atts( array(), $atts ) );
	return '<span class="dropcap">'.do_shortcode($content).'</span>';
}

function box( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'style' => '0',
	  'text_align' => 'left',
      ), $atts ) );
	if( $style == '0' ) $class = 'box0';
	if( $style == '1' ) $class = 'box1';
	if( $style == '2' ) $class = 'box2';
	if( $style == '3' ) $class = 'box3';
	if( $style == '4' ) $class = 'box4';
	return '<div class="box '.$class.' '.$text_align.'">'.do_shortcode($content).'</div>';
}

function btn( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'link' => '',
	  'color' => '',
	  'size' => ''
      ), $atts ) );
	$color_class = ( $color == '' ) ? '' : $color;
	$btn_class = ( $color == '' ) ? 'btn' : 'btn2';
	$size_class = ( ( $color != '' ) && ( $size != '' ) ) ? $size : '';  
	return '<a href="'.$link.'" class="'.$btn_class.' '.$color_class.' '.$size_class.'" target="_blank">'.do_shortcode($content).'</a>';
}

function frame( $atts ) {
   extract( shortcode_atts( array(
		'style' => '0',
		'src' => '',
		'linkstyle' => '',
		'linksto' => '',
		'width' => '100',
		'height' => '100',
		'align' => 'none',
		'title' => 'image'
      ), $atts ) );
	  $imgclass = '';
	  if ( $style == '0' ) $imgclass = 'nostyle';
	  if ( $style == '1' ) { $imgclass = 'border-1'; $width = $width - 6; $height = $height - 6; }
	  if ( $style == '2' ) { $imgclass = 'border-2'; $width = $width - 6; $height = $height - 6; }
	  if ( $align == 'left' ) $imgclass .= ' imgleft';
	  elseif ( $align == 'right' ) $imgclass .= ' imgright';	  
	  $bloginfo = get_template_directory_uri();
	  $imgcontent = '<img class="'.$imgclass.'" title="'.$title.'" alt="'.$title.'" src="'.$bloginfo.'/scripts/timthumb.php?src='.$src.'&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1&amp;q=100" />';
	  $linksto = ( $linksto == '' ) ? $src : $linksto;
	  if ( $linkstyle == 'pp' )
	  	$output = '<a rel="prettyPhoto[group2]" href="'.$linksto.'">'.$imgcontent.'</a>';
	  elseif ( $linkstyle == 'normal' )
	  	$output = '<a href="'.$linksto.'">'.$imgcontent.'</a>';
	  else
	  	$output = $imgcontent;
	  if ( $style == 'foldify' )
		$output = '<div style="width:'.$width.'px; height:'.$height.'px; position:relative; overflow:hidden" class="foldify">'.$output.'</div>';
	  return $output;
}

function hr() {
	return '<div class="hr"></div>';
}

function dhr() {
	return '<div class="double_hr"></div>';
}

function hr_3d() {
	return '<div class="hr_3d"></div>';
}

function hr_strip() {
	return '<div class="hr_strip"></div>';
}

function hr_dotted() {
	return '<div class="hr_dotted"></div>';
} ?>