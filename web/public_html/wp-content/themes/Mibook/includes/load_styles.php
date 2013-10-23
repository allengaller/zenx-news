<?php
/* Load custom fonts and styles */

/* Fetch admin options. */
global $options;
foreach ($options as $value) {
if(isset($value['id']) && isset ($value['std']))
if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] );}
}
function font_family( $target ) {
$family = '';
if ( !( $target == 'Arial' || $target == 'Georgia') ) {
	switch ( $target ) {
		
		case "Droid Sans":
		$family = 'Droid+Sans:regular,bold';
		break;
		
		case "Allan":
		$family = 'Allan:bold';
		break;	
		
		case "Allerta":
		$family = 'Allerta:regular';
		break;
		
		case "Anton":
		$family = 'Anton:regular';
		break;
		
		case "Arimo":
		$family = 'Arimo:regular,italic,bold,bolditalic';
		break;
		
		case "Arvo":
		$family = 'regular,italic,bold,bolditalic';
		break;	
		
		case "Cabin":
		$family = 'Cabin:400,500,600,bold';
		break;
		
		case "Calligraffitti":
		$family = 'Calligraffitti:regular';
		break;		
		
		case "Cantarell":
		$family = 'Cantarell:regular,italic,bold,bolditalic';
		break;	
		
		case "Cardo":
		$family = 'Cardo:regular';
		break;
		
		case "Chewy":
		$family = 'Chewy:regular';
		break;
		
		case "Copse":
		$family = 'Copse:regular';
		break;	
		
		case "Crafty Girls":
		$family = 'Crafty+Girls:regular';
		break;
		
		case "Crimson Text":
		$family = 'Crimson+Text:regular,400italic,600,600italic,700,700italic';
		break;		
		
		case "Crushed":
		$family = 'Crushed:regular';
		break;	
		
		case "Cuprum":
		$family = 'Cuprum:regular';
		break;	
		
		case "Dancing Script":
		$family = 'Dancing+Script:regular';
		break;
		
		case "Droid Serif":
		$family = 'Droid+Serif:regular,italic,bold,bolditalic';
		break;	
		
		case "EB Garamond":
		$family = 'EB+Garamond:regular';
		break;			
		
		case "Expletus Sans":
		$family = 'Expletus+Sans:400,500,600,700';
		break;	
		
		case "Gruppo":
		$family = 'Gruppo:regular';
		break;
		
		case "Judson":
		$family = 'Judson:400,400italic,700';
		break;		
		
		case "Just Another Hand":
		$family = 'Just+Another+Hand:regular';
		break;
		
		case "Kreon":
		$family = 'Kreon:300,400,700';
		break;	
		
		case "Lobster":
		$family = 'Lobster:regular';
		break;
		
		case "Luckiest Guy":
		$family = 'Luckiest+Guy:regular';
		break;		
		
		case "Merriweather":
		$family = 'Merriweather:regular';
		break;
		
		case "Metrophobic":
		$family = 'Metrophobic:regular';
		break;		
		
		case "Molengo":
		$family = 'Molengo:regular';
		break;
		
		case "Neuton":
		$family = 'Neuton:regular,italic';
		break;
		
		case "Nobile":
		$family = 'Nobile:regular,italic,bold,bolditalic';
		break;
		
		case "Open Sans":
		$family = 'Open+Sans+Condensed:300,300italic';
		break;
		
		case "Open Sans Condensed":
		$family = 'Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic';
		break;										
		
		case "Orbitron":
		$family = 'Orbitron:400,500,700,900';
		break;
		
		case "Play":
		$family = 'Play:regular,bold';
		break;		
		
		case "PT Sans":
		$family = 'PT+Sans:regular,italic,bold,bolditalic';
		break;
		
		case "PT Serif":
		$family = 'PT+Serif:regular,italic,bold,bolditalic';
		break;	
		
		case "Philosopher":
		$family = 'Philosopher:regular';
		break;
		
		case "Rokkitt":
		$family = 'Rokkitt:regular';
		break;		
		
		case "Tangerine":
		$family = 'Tangerine:regular,bold';
		break;
		
		case "Ubuntu":
		$family = 'Ubuntu:regular,italic,bold,bolditalic';
		break;	
		
		case "Vollkorn":
		$family = 'Vollkorn:regular,italic,bold,bolditalic';
		break;
		
		case "Yanone Kaffeesatz":
		$family = 'Yanone+Kaffeesatz:200,300,400,700';
		break;																							
		
		} // Switch		
		return $family;
	} // If not default fonts
	else {
	$family = 'Open+Sans+Condensed:300,300italic|Droid+Serif:regular,italic,bold,bolditalic';
	return $family;
	}
} // Function font_family()

function font_weight( $target ) {
if ($target == 'bold' || $target == 'bold italic')
		$weight = 'bold';
		else
		$weight = 'normal';
		return $weight;
}

function font_style( $target ) {
if ($target == 'italic' || $target == 'bold italic')
		$style = 'italic';
		else
		$style = 'normal';
		return $style;
}

function pattern( $target ) {
$dir = get_template_directory_uri();
	if ($target == 'none')
		$out = 'none';
	else
		$out = 'url('.$dir.'/images/patterns/'.$target.'.png)';
		return $out;
}

$fam1 = font_family($mib_heading_font);
$fam2 = font_family($mib_ft_heading_font);
$fam3 = font_family($mib_bl_heading_font);
$famx = $fam1;
if( !($fam2 == $fam1) ) $famx = $fam1.'|'.$fam2;
if( !($fam3 == $fam1 || $fam3 == $fam2 ) ) $famx = $fam1.'|'.$fam2.'|'.$fam3;
?>
<link  href="http://fonts.googleapis.com/css?family=<?php echo $famx; ?>" rel="stylesheet" type="text/css" >

<style type="text/css">
<?php if( $mib_custom_headings == 'true' ) { ?>
h1, h2, h3, h4, h5 { 
font-family:'<?php echo $mib_heading_font; ?>', sans-serif; 
color:#<?php echo $mib_heading_color; ?>; 
font-weight:<?php echo font_weight($mib_heading_font_style);?>;
font-style:<?php echo font_style($mib_heading_font_style);?>
}
.page_titles h1 { 
font-family:'<?php echo $mib_ft_heading_font; ?>', sans-serif; 
color:#<?php echo $mib_ft_heading_color; ?>; 
font-weight:<?php echo font_weight($mib_ft_heading_font_style);?>;
font-style:<?php echo font_style($mib_ft_heading_font_style);?>
 }
.entry h2 { 
font-family:'<?php echo $mib_bl_heading_font; ?>', sans-serif; 
font-style:<?php echo font_style($mib_bl_heading_font_style);?>; 
font-weight:<?php echo font_weight($mib_bl_heading_font_style);?>
}
.entry h2, .entry h2 a {
color:#<?php echo $mib_bl_col; ?>;
 }
.entry h2 a:hover { 
color:#<?php echo $mib_bl_hvr_col; ?>;
text-decoration:none
 }
.sidebar h5 {
font-family:'<?php echo $mib_sb_heading_font; ?>', sans-serif; 
font-style:<?php echo font_style($mib_sb_heading_font_style);?>; 
font-weight:<?php echo font_weight($mib_sb_heading_font_style);?>;
color:#<?php echo $mib_sb_heading_color; ?>;
} 
.secondary h5 {
font-family:'<?php echo $mib_sc_heading_font; ?>', sans-serif; 
font-style:<?php echo font_style($mib_sc_heading_font_style);?>; 
font-weight:<?php echo font_weight($mib_sc_heading_font_style);?>;
color:#<?php echo $mib_sc_heading_color; ?>;
} 	
<?php
}

if( $mib_layout == 'stretched' ) {?>
.header_wrap, 
.utility_wrap, 
.featured_wrap, 
.slider_wrap, 
.primary_wrap,
.secondary_wrap,
.footer_wrap{
	background:none; 
	border:none;
	}
#header {
	background:#fff;
	}
.utility {
	background:#333 url(<?php echo get_template_directory_uri();?>/images/nav_main.png) 0px 1px repeat; 
	}
.footer, body {
	background:#272727;
	margin-bottom:0px;
	}
.featured {
	background:#f7f7f7;
	border-bottom:1px solid #ededed;
	}
.primary {
	background:#fff;
	}
.secondary {
	background:#f7f7f7;
	border-top:1px solid #ededed;
	}
#footer {
	border-top: 4px solid #9C0;
	background:#333 url(<?php echo get_template_directory_uri();?>/images/nav_main.png) 0px 1px repeat;
	}
<?php 
} // Stretched Layout

echo( '.brand { padding:'.$mib_logo_mrgtop.'px 0px '.$mib_logo_mrgbtm.'px 30px }');
echo( '.cycle_wrap, .cycle_slider, .cycle_slider li, .nivo_wrapper, #nivo_slider { height:'.$mib_sl_ht.'px }');
// Slider height should still work irrespective of style options. So we are not disabling it.
?>
</style>
<?php echo("\n"); ?>