<?php #// BEGIN set display based on selected fields & user permission
class wpul_widget extends WP_Widget {

	function wpul_widget() {
		// Instantiate the parent object
			show_admin_bar(false); // Disable admin bar

		parent::__construct( false, 'WP UserLogin');
	}
function wpul_user_permissions($args){
	$wp_url = get_settings('siteurl');
        $check = get_option('wpul_settings');
        $welcome = $check['welcome'];
	$vals = explode(',',$args);
        global $current_user, $user_ID, $wp_admin_bar,$wpdb;
        get_currentuserinfo();
	

        $comments_waiting = $wpdb->get_var("SELECT count(comment_ID) FROM $wpdb->comments WHERE comment_approved = '0'");
	$core = get_option('_site_transient_update_core');
	$plugins = get_option('_site_transient_update_plugins');
	$updates['plugins'] = $plugins->response;
	$updates['core'] = $core->updates['0']->response;
	$plugin_update = count($updates['plugins']);
	if($check['dashboard'] == 'CHECKED'){
		$link[] .= '<li><a href="'.admin_url().'">'.__('Dashboard').'</a></li>';
	}
	if($check['newpost'] == 'CHECKED' && current_user_can('publish_posts')){
		$link[] .= '<li><a href="'.admin_url('post-new.php').'">'.__('New Post').'</a></li>';
		$link[] = '<li><a href="'.admin_url('edit.php').'">'.__('Edit Posts').'</a></li>';
	}
	if($comments_waiting > 0){
		$link[] = '<li class="notify"><a href="'.admin_url('edit-comments.php?comment_status=moderated').'"/>'.$comments_waiting.' '.pluralize($comments_waiting,__('Comments'),__('Comment')).(' Pending').'</a></li>'; 
	}

	if($check['managetheme'] == "CHECKED" && current_user_can('update_themes')){
		$link[] .= '<li><a href="'.admin_url('themes.php').'">'.__('Manage Theme').'</a></li>';
	}
	if($check['install_plugins'] == "CHECKED" && current_user_can('install_plugins')){
		$link[] .= '<li><a href="'.admin_url('plugins.php').'">'.__('Manage Plugins').'</a></li>';
		$link[] .= '<li><a href="'.admin_url('plugin-install.php').'">'.__('Install Plugins').'</a></li>';
	}
	if($plugin_update > 0 && current_user_can('update_core')){
		$link[] = '<li class="notify"><a href="'.admin_url('update-core.php').'"/>'.$plugin_update.__(' Plugin ').pluralize($plugin_update,__('Updates'),__('Update')).__(' Available').'</a></li>'; 
	}
	if($updates['core'] == 'upgrade' && current_user_can('update_core')){
		$link[] = '<li class="notify"><a href="'.admin_url('update-core.php').'"/>'.__('Core Update Available').'</a></li>'; 
	}
	if($check['options'] == "CHECKED" &&  current_user_can('manage_options')){
		$link[] .= '<li><a href="'.admin_url('options-general.php').'">'.__('Options').'</a></li>';
	}
	if($check['users'] == "CHECKED" &&  current_user_can('edit_users')){
		$link[] .= '<li><a href="'.admin_url('users.php').'">'.__('Users').'</a></li>';
	}
	if($check['profile'] == "CHECKED" &&  is_user_logged_in()){
		$link[] .= '<li><a href="'.admin_url('profile.php').'">'.__('Edit Your Profile').'</a></li>'.PHP_EOL.
		'<li><a href="'.home_url('?author='.$user_ID).'">'.__('View Your Profile','wp-userlogin').'</a></li>';
		$link[] .= '<li><a href="'.admin_url('tools.php').'">'.__('Your Available Tools').'</a></li>';
	}
	if($check['logout'] == "CHECKED" && is_user_logged_in()){
		if($check['redirect_out'] !== ''){
			$link[] .= '<li><a href="'.wp_logout_url(get_bloginfo('url').'/'.$check['redirect_out']).'">'.__('Logout').'</a></li>';	
		}else{
			$link[] .= '<li><a href="'.wp_logout_url($_SERVER['REQUEST_URI']).'">'.__('Logout').'</a></li>';
		}
	}        
    if($check['welcomecheck'] == "CHECKED"){
        if($current_user->user_firstname != "") :
            $firstname = $current_user->user_firstname;
        else: 
            $firstname = $current_user->display_name;
        endif;

        if($current_user->user_lastname != ""):
            $lastname = $current_user->user_lastname;
        else: 
            $lastname = $current_user->display_name;
        endif;
        
        if($current_user->user_firstname != "" && $current_user->user_lastname != ""):
            $fullname = $current_user->user_firstname.' '.$current_user->user_lastname;
        else :
            $fullname = $current_user->display_name;
        endif;
        
        $head = preg_replace('/\%user/',$current_user->display_name,
        preg_replace('/\%login/',$current_user->user_login,
        preg_replace('/\%id/',$current_user->ID,
        preg_replace('/\%email/',$current_user->user_email,
        preg_replace('/\%firstname/',$firstname,
        preg_replace('/\%lastname/',$lastname,
        preg_replace('/\%fullname/',$fullname,$welcome)))))));
        $head = '<span id="welcome">'.$head.'</span>';
    }
    else{ 
        $head = '';
    }	
    if($check['avatar'] == "CHECKED"):
        $avatar = get_avatar( $current_user->ID, $size, $default, $alt ); 
    else:
        $avatar = "";
    endif;
        echo $avatar;
        $head = $head . '<ul class="wpul_menu">';
        
 	$foot = wpul_optional_links()."</ul>";
$links = implode('',$link);
	return $head.$links.$foot;
}

	function widget( $args, $instance ) {
		// Widget output
		$check = get_option('wpul_settings');
		//~ print_r($check);	
		if(is_user_logged_in()){
			global $current_user;
			get_currentuserinfo();
		$title =$option['set_log'];	
		
            if ( current_user_can('activate_plugins')){
		for($i=0;$i<10;$i++){
			$options[] .=$i;
		}
            }
	    if(current_user_can('edit_posts')){
		$options[] .= 2;
		$options[] .= 0;
	    }
            if(current_user_can('publish_posts')){
		for($i=3;$i<8;$i++){
			$options[] .= $i;
		}
		$options[] .= 0;
	    }
            if(current_user_can('read') ){
                    $options[] .= 0;
                    $options[] .= 6;
                    $options[] .= 7;
            }
	    $options = array_unique($options);
	    $options = implode(',',$options);
	    $options = $this->wpul_user_permissions($options);

		}else{
		$title = $option['set_nonlog'];
		if($option['redirect'] !== ''){
			$redir = get_bloginfo('url').'/'.$option['redirect'];
		}else{
			$redir = $_SERVER['REQUEST_URI'];
		}
                
			$outargs = array(
        'echo' => true,
        'redirect' => $redir, 
        'form_id' => 'loginform',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => __( 'Log In' ),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'value_username' => NULL,
        'value_remember' => false );
			wp_login_form($outargs);
		}
		echo $before_title
		. $title
		. $after_title
		. $options
		.$after_widget;
		
	}



	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {
		// Output admin widget options form
	}
}
?>