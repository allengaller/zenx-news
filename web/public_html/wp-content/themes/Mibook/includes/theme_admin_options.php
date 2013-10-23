<?php 
/* MiBook Theme Admin Options */

load_theme_textdomain( 'mibook', TEMPLATEPATH . '/languages' );
$themename = 'MiBook';
$shortname = 'mib';
$options = array (
				array(	"type" => "wrap_start" ),
				
				array(	"type" => "tabs_start" ),
						
				array(	"name" => __( 'General', 'mibook' ),
						"id" => $shortname."_general",
						"type" => "heading"),

				array(	"name" => __( 'Home Page', 'mibook' ),
						"id" => $shortname."_homepage",
						"type" => "heading"),
						
				array(	"name" => __( 'Slider', 'mibook' ),
						"id" => $shortname."_slider_area",
						"type" => "heading"),						
				
				array(	"name" => __( 'Single', 'mibook' ),
						"id" => $shortname."_single",
						"type" => "heading"),
						
				array(	"name" => __( 'Headings', 'mibook' ),
						"id" => $shortname."_headings",
						"type" => "heading"),
						
				array(	"type" => "tabs_end" ),


				
				//General Settings
				array(	"type" => "tabbed_start",
						"id" => $shortname."_general" ),
						
				array(	"name" => __( 'General Settings for the theme', 'mibook' ),
						"type" => "subheading" ),																	
					
				array(  "name" => __( 'Web Logo:', 'mibook' ),
						"desc" => __( 'Select logo format for your web.', 'mibook' ),
						"id" => $shortname."_logo_format",
						"type" => "select",
						"std" => "image",
						"options" => array("image", "text")),

				array(	"name" => __( 'Custom Logo URL:', 'mibook' ),
						"desc" => __( 'Enter full URL of your Logo image.', 'mibook' ),
						"id" => $shortname."_logo",
						"std" => "",
						"type" => "text"),																		
						
				array(	"name" => __( 'Logo MarginTop(px):', 'mibook' ),
						"desc" => __( 'Enter a top margin for Logo or Blog name', 'mibook' ),
						"id" => $shortname."_logo_mrgtop",
						"std" => "10",
						"type" => "text"),	
						
				array(	"name" => __( 'Logo MarginBottom(px):', 'mibook' ),
						"desc" => __( 'Enter a bottom margin for Logo or Blog name', 'mibook' ),
						"id" => $shortname."_logo_mrgbtm",
						"std" => "10",
						"type" => "text"),
				
				array(	"name" => __( 'Layout Style:', 'mibook' ),
						"desc" => __( 'Select a layout style for your theme', 'mibook' ),
						"id" => $shortname."_layout",
						"std" => "boxed",
						"type" => "select",
						"options" => array("boxed", "stretched")),

				array(	"name" => __( 'Global Sidebar Placement:', 'mibook' ),
						"desc" => __( 'Select a placement for sidebar', 'mibook' ),
						"id" => $shortname."_sidebar",
						"std" => "right",
						"type" => "select",
						"options" => array("right", "left")),

				array(	"name" => __( 'Meta Description for Website:', 'mibook' ),
						"desc" => __( 'Enter a brief and concise words to description your website. Seperate each keyword with comma. ', 'mibook' ),
						"id" => $shortname."_meta_description",
						"std" => "",
						"type" => "textarea"),
						
				array(	"name" => __( 'Meta Keywords for SEO:', 'mibook' ),
						"desc" => __( 'Enter a brief and concise list of some unique keywords that best describes the content of your page. Seperate each keyword with comma.', 'mibook' ),
						"id" => $shortname."_meta_keywords",
						"std" => "",
						"type" => "textarea"),					
						
				array(	"name" => __( 'Google Analytics Code:', 'mibook' ),
						"desc" => __( 'Enter your Google Analytics ID code. For ex: UA-XXXXXXXX-X', 'mibook' ),
						"id" => $shortname."_analytics",
						"std" => "UA-XXXXXXXX-X",
						"type" => "text"),						
						
				array(	"name" => __( 'Contact e-mail:', 'mibook' ),
						"desc" => __( 'Enter the e-mail address to which mail should be recieved from contact page.', 'mibook' ),
						"id" => $shortname."_email",
						"std" => "chzng@msn.com",
						"type" => "text"),
						
				array(	"name" => __( 'Mail Sent Message:', 'mibook' ),
						"desc" => __( 'Information after Contact e-mail Sent. You can use <code>HTML</code> here.', 'mibook' ),
						"id" => $shortname."_success_msg",
						"std" => __( '<h4>Thank You! Your message has been sent.</h4>', 'mibook' ),
						"type" => "textarea"),
						
				array(	"name" => __( 'Custom Footer Text (Left):', 'mibook' ),
						"desc" => __( 'Enter custom text for left side of the footer. You can use <code>HTML</code> here.', 'mibook' ),
						"id" => $shortname."_footer_left",
						"std" => "",
						"type" => "textarea"),
						
				array(	"name" => __( 'Custom Footer Text (Right):', 'mibook' ),
						"desc" => __( 'Enter custom text for right side of the footer. You can use <code>HTML</code> here.', 'mibook' ),
						"id" => $shortname."_footer_right",
						"std" => "",
						"type" => "textarea"),						
					
				array(	"type" => "tabbed_end" ),



				// Homepage Settings
				array(	"type" => "tabbed_start",
						"id" => $shortname."_homepage" ),
				
				array(	"name" => __( 'Home Category Setting', 'mibook' ),
						"type" => "subheading" ),
				
				array(	"name" => __( 'Home Category IDs to exclude:', 'mibook' ),
						"desc" => __( 'Insert the category IDs you want excluded from home page. Ex: 1,3,5', 'mibook' ),
						"id" => $shortname."_exclude_cats",
						"std" => "",
						"type" => "text"),
				
				array(	"name" => __( 'Orderby of Home Category:', 'mibook' ),
						"desc" => __( 'Select an orderby,ID:Category id,Name:Category name,Count:Category post count,Slug:Category slug', 'mibook' ),
						"id" => $shortname."_cats_orderby",
						"std" => "ID",
						"type" => "select",
						"options" => array("ID", "Name", "Count", "Slug")),
								
				array(	"name" => __( 'Order of Home Category:', 'mibook' ),
						"desc" => __( 'Select an order - Ascending or Descending', 'mibook' ),
						"id" => $shortname."_cats_order",
						"std" => "ASC",
						"type" => "select",
						"options" => array("ASC", "DESC")),
				
				array(	"name" => __( 'Block Slider Settings', 'mibook' ),
						"type" => "subheading" ),

				array(	"name" => __( 'Block Slider Name:', 'mibook' ),
						"desc" => __( 'Custom your block slider name.', 'mibook' ),
						"id" => $shortname."_block_slider_name",
						"std" => "Block Slider",
						"type" => "text"),
				
				array(	"name" => __( 'Block Slider Category ID to fetch images from:', 'mibook' ),
						"desc" => __( 'Enter your block slider category ID (or IDs separated by comma) from which images will be shown on slider.', 'mibook' ),
						"id" => $shortname."_block_slider_id",
						"std" => "",
						"type" => "text"),
				
				array(	"name" => __( 'Order of block slider:', 'mibook' ),
						"desc" => __( 'Select an order - Ascending or descending', 'mibook' ),
						"id" => $shortname."_block_slider_order",
						"std" => "ASC",
						"type" => "select",
						"options" => array("DESC", "ASC")),
						
				array(	"type" => "tabbed_end" ),	


				
				// Slider Settings
				array(	"type" => "tabbed_start",
						"id" => $shortname."_slider_area" ),
						
				array(	"name" => __( 'Slider Settings', 'mibook' ),
						"type" => "subheading" ),																														
						
				array(  "name" => __( 'Show Slider:', 'mibook' ),
						"desc" => __( 'Select the slider enable or not.', 'mibook' ),
						"id" => $shortname."_slider",
						"type" => "checkbox",
						"std" => "Enable",
						"type" => "select",
						"options" => array("Enable", "Disable")),
				
						
				array(	"name" => __( 'Slider Type:', 'mibook' ),
						"desc" => __( 'Select a slider - Cycle Slider or Nivo Slider', 'mibook' ),
						"id" => $shortname."_slider_type",
						"std" => "cycle",
						"type" => "select",
						"options" => array("cycle", "nivo")),											
						
				array(	"name" => __( 'Category ID to fetch images from:', 'mibook' ),
						"desc" => __( 'Enter your featured category ID (or IDs separated by comma) from which images will be shown on slider.', 'mibook' ),
						"id" => $shortname."_feat_cat_id",
						"std" => "1",
						"type" => "text"),
						
				array(	"name" => __( 'Number of slides to show:', 'mibook' ),
						"desc" => __( 'Enter number of slides to show.', 'mibook' ),
						"id" => $shortname."_num_of_slides",
						"std" => "3",
						"type" => "text"),
						
				array(	"name" => __( 'Slider Height (px):', 'mibook' ),
						"desc" => __( 'Enter a height for slider', 'mibook' ),
						"id" => $shortname."_sl_ht",
						"std" => "350",
						"type" => "text"),
						
				array(	"name" => __( 'Order of slider:', 'mibook' ),
						"desc" => __( 'Select an order - Ascending or descending', 'mibook' ),
						"id" => $shortname."_feat_order",
						"std" => "desc",
						"type" => "select",
						"options" => array("desc", "asc")),
						
				array(	"type" => "tabbed_end" ),			
				


				// Single Setting
				array(	"type" => "tabbed_start",
						"id" => $shortname."_single" ),
						
				array(	"name" => __( 'Single Post Settings', 'mibook' ),
						"type" => "subheading" ),						
						
				array(  "name" => __( 'Whether to show Author Bio:', 'mibook' ),
						"desc" => __( 'Select display Author Bio on single posts.', 'mibook' ),
						"id" => $shortname."_author",
						"type" => "select",
						"std" => "Enable",
						"options" => array("Enable", "Disable")),
						
				array(  "name" => __( 'Whether to show related posts:', 'mibook' ),
						"desc" => __( 'Select display Related Posts on single posts.', 'mibook' ),
						"id" => $shortname."_rp",
						"type" => "select",
						"std" => "Enable",
						"options" => array("Enable", "Disable")),
						
				array(	"name" => __( 'Related posts taxonomy:', 'mibook' ),
						"desc" => __( 'Select a taxonomy for related posts.', 'mibook' ),
						"id" => $shortname."_rp_taxonomy",
						"std" => "category",
						"type" => "select",
						"options" => array("tags", "category")),
						
				array(	"name" => __( 'Related posts display style:', 'mibook' ),
						"desc" => __( 'Select a display style for related posts.', 'mibook' ),
						"id" => $shortname."_rp_style",
						"std" => "thumbnail",
						"type" => "select",
						"options" => array("thumbnail", "list")),
						
				array(	"name" => __( 'Number of related posts to show:', 'mibook' ),
						"desc" => __( 'Enter a number for posts to show.', 'mibook' ),
						"id" => $shortname."_rp_num",
						"std" => "4",
						"type" => "text"),
																
				array(	"type" => "tabbed_end" ),



				// Global Heading Setting
				array(	"type" => "tabbed_start",
						"id" => $shortname."_headings" ),
						
				array(	"name" => __( 'Global Heading Settings', 'mibook' ),
						"type" => "subheading" ),	
						
				array(  "name" => __( 'Use custom heading settings:', 'mibook' ),
						"desc" => __( 'Check to use your custom heading settings. Your custom settings will only take effect if you enable this option.', 'mibook' ),
						"id" => $shortname."_custom_headings",
						"type" => "checkbox",
						"std" => "false"),												
						
				array(	"name" => __( 'Heading Font:', 'mibook' ),
						"desc" => __( 'Select a font for headings', 'mibook' ),
						"id" => $shortname."_heading_font",
						"std" => "Open Sans",
						"type" => "select",
						"options" => array("Open Sans", "Arial", "Georgia", "Allan", "Allerta", "Anton", "Arimo", "Arvo", "Cabin", "Calligraffitti", "Cantarell", "Cardo", "Chewy", "Copse", "Crafty Girls", "Crimson Text", "Crushed", "Cuprum", "Dancing Script", "Droid Sans", "Droid Serif", "EB Garamond", "Expletus Sans", "Gruppo", "Judson", "Just Another Hand", "Kreon", "Lobster", "Luckiest Guy", "Merriweather", "Metrophobic", "Molengo", "Neuton", "Nobile", "Open Sans Condensed", "Orbitron", "Play", "PT Sans", "PT Serif", "Philosopher", "Rokkitt", "Tangerine", "Ubuntu", "Vollkorn", "Yanone Kaffeesatz")),
						
				array(	"name" => __( 'Font Style:', 'mibook' ),
						"desc" => __( 'Select a font style for headings. This style will be loaded only if available within the font.', 'mibook' ),
						"id" => $shortname."_heading_font_style",
						"std" => "regular",
						"type" => "select",
						"options" => array("regular", "italic", "bold", "bold italic")),											
						
				array(	"name" => __( 'Heading Color:', 'mibook' ),
						"desc" => __( 'Choose a color for headings', 'mibook' ),
						"id" => $shortname."_heading_color",
						"std" => "333333",
						"type" => "color_text"),						
						
						
				array(	"name" => __( 'Featured Area Heading Settings', 'mibook' ),
						"type" => "subheading" ),						
						
				array(	"name" => __( 'Featured area Heading Font:', 'mibook' ),
						"desc" => __( 'Select a font for featured area headings', 'mibook' ),
						"id" => $shortname."_ft_heading_font",
						"std" => "Open Sans",
						"type" => "select",
						"options" => array("Open Sans", "Arial", "Georgia", "Allan", "Allerta", "Anton", "Arimo", "Arvo", "Cabin", "Calligraffitti", "Cantarell", "Cardo", "Chewy", "Copse", "Crafty Girls", "Crimson Text", "Crushed", "Cuprum", "Dancing Script", "Droid Sans", "Droid Serif", "EB Garamond", "Expletus Sans", "Gruppo", "Judson", "Just Another Hand", "Kreon", "Lobster", "Luckiest Guy", "Merriweather", "Metrophobic", "Molengo", "Neuton", "Nobile", "Open Sans Condensed", "Orbitron", "Play", "PT Sans", "PT Serif", "Philosopher", "Rokkitt", "Tangerine", "Ubuntu", "Vollkorn", "Yanone Kaffeesatz")),
						
				array(	"name" => __( 'Featured area Heading Font Style:', 'mibook' ),
						"desc" => __( 'Select a font style for featured area headings. This style will be loaded only if available within the font.', 'mibook' ),
						"id" => $shortname."_ft_heading_font_style",
						"std" => "regular",
						"type" => "select",
						"options" => array("regular", "italic", "bold", "bold italic")),											
						
				array(	"name" => __( 'Featured area Heading Color:', 'mibook' ),
						"desc" => __( 'Choose a color for headings', 'mibook' ),
						"id" => $shortname."_ft_heading_color",
						"std" => "555555",
						"type" => "color_text"),	
						
				array(	"name" => __( 'Blog post titles Settings', 'mibook' ),
						"type" => "subheading" ),
						
				array(	"name" => __( 'Post titles heading Font:', 'mibook' ),
						"desc" => __( 'Select a font for blog post titles', 'mibook' ),
						"id" => $shortname."_bl_heading_font",
						"std" => "Open Sans",
						"type" => "select",
						"options" => array("Open Sans", "Arial", "Georgia", "Allan", "Allerta", "Anton", "Arimo", "Arvo", "Cabin", "Calligraffitti", "Cantarell", "Cardo", "Chewy", "Copse", "Crafty Girls", "Crimson Text", "Crushed", "Cuprum", "Dancing Script", "Droid Sans", "Droid Serif", "EB Garamond", "Expletus Sans", "Gruppo", "Judson", "Just Another Hand", "Kreon", "Lobster", "Luckiest Guy", "Merriweather", "Metrophobic", "Molengo", "Neuton", "Nobile", "Open Sans Condensed", "Orbitron", "Play", "PT Sans", "PT Serif", "Philosopher", "Rokkitt", "Tangerine", "Ubuntu", "Vollkorn", "Yanone Kaffeesatz")),
						
				array(	"name" => __( 'Post titles font style:', 'mibook' ),
						"desc" => __( 'Select a font style for post titles. This style will be loaded only if available within the font.', 'mibook' ),
						"id" => $shortname."_bl_heading_font_style",
						"std" => "regular",
						"type" => "select",
						"options" => array( "regular", "italic", "bold", "bold italic")),																	
						
						
				array(	"name" => __( 'Post Title Color:', 'mibook' ),
						"desc" => __( 'Choose a color for post titles', 'mibook' ),
						"id" => $shortname."_bl_col",
						"std" => "333333",
						"type" => "color_text"),
						
				array(	"name" => __( 'Post Title Hover Color:', 'mibook' ),
						"desc" => __( 'Choose a hover color for post titles', 'mibook' ),
						"id" => $shortname."_bl_hvr_col",
						"std" => "000000",
						"type" => "color_text"),
						
				array(	"name" => __( 'Sidebar Heading Settings', 'mibook' ),
						"type" => "subheading" ),						
						
				array(	"name" => __( 'Sidebar Heading Font:', 'mibook' ),
						"desc" => __( 'Select a font for sidebar widget headings', 'mibook' ),
						"id" => $shortname."_sb_heading_font",
						"std" => "Open Sans",
						"type" => "select",
						"options" => array("Open Sans", "Arial", "Georgia", "Allan", "Allerta", "Anton", "Arimo", "Arvo", "Cabin", "Calligraffitti", "Cantarell", "Cardo", "Chewy", "Copse", "Crafty Girls", "Crimson Text", "Crushed", "Cuprum", "Dancing Script", "Droid Sans", "Droid Serif", "EB Garamond", "Expletus Sans", "Gruppo", "Judson", "Just Another Hand", "Kreon", "Lobster", "Luckiest Guy", "Merriweather", "Metrophobic", "Molengo", "Neuton", "Nobile", "Open Sans Condensed", "Orbitron", "Play", "PT Sans", "PT Serif", "Philosopher", "Rokkitt", "Tangerine", "Ubuntu", "Vollkorn", "Yanone Kaffeesatz")),
						
				array(	"name" => __( 'Sidebar Heading Font Style:', 'mibook' ),
						"desc" => __( 'Select a font style for sidebar widget headings. This style will be loaded only if available within the font.', 'mibook' ),
						"id" => $shortname."_sb_heading_font_style",
						"std" => "regular",
						"type" => "select",
						"options" => array("regular", "italic", "bold", "bold italic")),
						
				array(	"name" => __( 'Sidebar Heading Color:', 'mibook' ),
						"desc" => __( 'Choose a color for headings', 'mibook' ),
						"id" => $shortname."_sb_heading_color",
						"std" => "555555",
						"type" => "color_text"),
						
				array(	"name" => __( 'Secondary Area Heading Settings', 'mibook' ),
						"type" => "subheading" ),						
						
				array(	"name" => __( 'Secondary area Heading Font:', 'mibook' ),
						"desc" => __( 'Select a font for secondary area widget headings', 'mibook' ),
						"id" => $shortname."_sc_heading_font",
						"std" => "Open Sans",
						"type" => "select",
						"options" => array("Open Sans", "Arial", "Georgia", "Allan", "Allerta", "Anton", "Arimo", "Arvo", "Cabin", "Calligraffitti", "Cantarell", "Cardo", "Chewy", "Copse", "Crafty Girls", "Crimson Text", "Crushed", "Cuprum", "Dancing Script", "Droid Sans", "Droid Serif", "EB Garamond", "Expletus Sans", "Gruppo", "Judson", "Just Another Hand", "Kreon", "Lobster", "Luckiest Guy", "Merriweather", "Metrophobic", "Molengo", "Neuton", "Nobile", "Open Sans Condensed", "Orbitron", "Play", "PT Sans", "PT Serif", "Philosopher", "Rokkitt", "Tangerine", "Ubuntu", "Vollkorn", "Yanone Kaffeesatz")),
						
				array(	"name" => __( 'Secondary area Heading Font Style:', 'mibook' ),
						"desc" => __( 'Select a font style for secondary area widget headings. This style will be loaded only if available within the font.', 'mibook' ),
						"id" => $shortname."_sc_heading_font_style",
						"std" => "regular",
						"type" => "select",
						"options" => array("regular", "italic", "bold", "bold italic")),
						
				array(	"name" => __( 'Secondary area Heading Color:', 'mibook' ),
						"desc" => __( 'Choose a color for secondary area widget headings', 'mibook' ),
						"id" => $shortname."_sc_heading_color",
						"std" => "777777",
						"type" => "color_text"),
						
				array(	"type" => "tabbed_end" ),
				array(	"type" => "wrap_end" )
);

function mytheme_add_admin() {
    global $themename, $shortname, $options;
	
	// Load admin styling files.
	$file_dir = get_template_directory_uri();
	wp_enqueue_style("admin_css", $file_dir."/admin/admin.css", false, "1.0", "all");
	wp_enqueue_style("colorpicker_css", $file_dir."/admin/css/colorpicker.css", false, "1.0", "all");
	wp_enqueue_script("colorpicker_js", $file_dir."/admin/colorpicker.js", false, "1.0");
	wp_enqueue_script("admin_js", $file_dir."/admin/admin.js", false, "1.0");	
	    if ( isset($_GET['page']) && ($_GET['page'] == basename(__FILE__)) ) {
		 if ( isset($_REQUEST['action']) && ('save' == $_REQUEST['action']) ) {
                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
                header("Location: themes.php?page=theme_admin_options.php&saved=true");
                die;
        } else if( isset($_REQUEST['action']) && ('reset' == $_REQUEST['action'] )) {
            foreach ($options as $value) {
                delete_option( $value['id'] ); }
            header("Location: themes.php?page=theme_admin_options.php&reset=true");
            die;
        }
    }
    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p>'.$themename.' '.__( 'Settings Saved. ', 'mibook' ).'</p></div>';
    if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p>'.$themename.' '.__( 'settings reset.', 'mibook' ).'</p></div>';
    
?>
<div class="wrap">
	<div class="settings-icon"></div>
    <h2><?php echo $themename; ?><?php _e('Theme Settings','mibook') ?></h2>
    <form method="post">
		<?php foreach ($options as $value) {     
            switch ( $value['type'] ) {
			
                case "wrap_start":
                ?>
                <div class="ss_wrap">
                <?php break;
				
                case "wrap_end":
                ?>
                </div>
                <?php break;							
                    
                case "tabs_start":
                ?>
                <ul class="tabs">
                <?php break;
				
                case "tabs_end":
                ?>
                </ul>
                <?php break;
				
                case "tabbed_start":
                ?>
                <div class="tabbed" id="<?php echo $value['id']; ?>">
                <?php break;
				
                case "tabbed_end":
                ?>
                </div>
                <?php break;											
                    
                case "heading":
                ?>
                <li><a href="#<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></li>
                <?php break;
				
                case "subheading":
                ?>
                <div class="subheading"><?php echo $value['name']; ?></div>
                <?php break;				
                
                case 'select':
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                            <?php foreach ($value['options'] as $option) { ?>
                            <option <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
                            <?php } ?>
                        </select>
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
                <?php break;
        
                case 'text':
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
                <?php break;
				
				case 'color_text':
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <input class="mycolor" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
                    <div id="pick_ico_<?php echo $value['id']; ?>" class="picker_ico">
                      <div></div>            
                    </div>                         
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
              
                <?php break;
                case 'textarea':
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <textarea class="code" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="30" rows="4"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std'];} ?></textarea>
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
                <?php break;		
                
                    
                case "checkbox":
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
                <?php break;
                } 
            }
            ?>
            <p class="submit">
            <input name="save" type="submit" value="<?php _e('Save changes', 'mibook' ) ?>" />    
            <input type="hidden" name="action" value="save" />
            </p>
    </form>
    <form method="post">
        <p class="submit">
        <input name="reset" type="submit" value="<?php _e('Reset all settings', 'mibook' ) ?>" class="reset" style="color:#f56c6c; border:1px solid #f56c6c; margin-left:510px;"/>
        <input type="hidden" name="action" value="reset" />
        </p>
    </form>
    
<!--Show All Categorie'ID-->
<?php function wp_cats_id() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { 
		$output = '<li><div class="cat_name">'.$category->name.":</div><span>".$category->term_id.'</span> </li>';
		echo $output;
		}
	}
?>
 	<ul class="wp_cats_id">
        <h3><span class="cat_name" style="margin-right:6px; font-weight:600;"><?php _e('Cat Name','mibook');?></span><?php _e('Cat ID','mibook');?></h3>
		<?php wp_cats_id();?>
	</ul>     
    
</div>
<?php
}
add_action('admin_menu', 'mytheme_add_admin');?>