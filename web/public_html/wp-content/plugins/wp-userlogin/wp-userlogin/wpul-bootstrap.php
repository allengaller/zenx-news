<?php 
#// BEGIN set display based on selected fields & user permission
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
        global $current_user, $user_ID, $wp_admin_bar,$wpdb,$post;
        get_currentuserinfo();
	

        $comments_waiting = $wpdb->get_var("SELECT count(comment_ID) FROM $wpdb->comments WHERE comment_approved = '0'");
	$core = get_option('_site_transient_update_core');
	$plugins = get_option('_site_transient_update_plugins');
	$updates['plugins'] = $plugins->response;
	$updates['core'] = $core->updates['0']->response;
	$plugin_update = count($updates['plugins']);
	$link[] = ($check['dashboard'] == 'CHECKED' ? '<li><a class="btn btn-link btn-block" href="'.admin_url().'">'.__('Dashboard').'</a></li>':'');
	$link[] = ($comments_waiting > 0) ? '<li><a class="btn btn-info btn-block" href="'.admin_url('edit-comments.php?comment_status=moderated').'"/">'.pluralize($comments_waiting,__('Comments'),__('Comment')).(' Pending').' <span class="badge badge-important">'.$comments_waiting.'</span></a></li>':'';
        $link[]= current_user_can('edit_posts') && (is_single() || is_page())?'<li><a class="btn btn-danger btn-block" href="'.get_edit_post_link($post->ID).'">Edit This '.ucwords($post->post_type).'</a></li>':'';
        
        $postlabel = '<li><a class="btn btn-link btn-block" data-toggle="collapse" data-target="#posts">'.__('Posts').' <b class="caret"></b></a>
        <div id="posts" class="collapse">';
	$new = $check['newpost'] == 'CHECKED' && current_user_can('publish_posts') ? '<a href="'.admin_url('post-new.php').'" class="btn btn-info btn-block ">'.__('New Post').'</a>':'';
        $edit = $check['editpost'] == 'CHECKED' && current_user_can('edit_posts') ? '<a href="'.admin_url('edit.php').'" class="btn btn-info btn-block ">'.__('Edit Posts').'</a>':'';
        $endcollapse = '</div></li>';
        $link[] = $postlabel.$new.$edit.$ethis.$endcollapse ;

	$themes = '<li><a class="btn btn-default btn-block btn-link" data-toggle="collapse" data-target="#themes">'.__('Appearance').' <b class="caret"></b></a><div id="themes" class="collapse">';
        $manage =$check['managetheme'] == "CHECKED" && current_user_can('update_themes')? '<a href="'.admin_url('themes.php').'" class="btn btn-info btn-block ">'.__('Manage Themes').'</a>':'';
	$installt = $check['installtheme'] == "CHECKED" && current_user_can('install_themes')? '<a href="'.admin_url('theme-install.php').'" class="btn btn-info btn-block ">'.__('Install Themes').'</a>':'';
	$editt = $check['edittheme'] == "CHECKED" && current_user_can('editthemes')? '<li><a href="'.admin_url('theme-install.php').'" class="btn btn-info btn-block ">'.__('Editor').'</a>':'';
        $link[] = $themes.$manage.$installt.$editt.'</div></li>';
        
	$plugins = '<li><a class="btn btn-link btn-block" data-toggle="collapse" data-target="#plugins">'.__('Plugins').' <b class="caret"></b></a><div id="plugins" class="collapse">';
        $update = $check['update_plugins'] == "CHECKED" && current_user_can('update_plugins') ? '<a href="'.admin_url('plugins.php').'" class="btn btn-info btn-block ">'.__('Manage Plugins').'</a>':'';
	$installp = $check['install_plugins'] == "CHECKED" && current_user_can('install_plugins') ? '<a href="'.admin_url('plugins.php').'" class="btn btn-info btn-block ">'.__('Install Plugins').'</a>':'';
        $link[] = $plugins.$update.$installp.'</div></li>';
                
	$users = '<li><a class="btn btn-link btn-block" data-toggle="collapse" data-target="#users">'.__('Users').' <b class="caret"></b></a><div id="users" class="collapse">';
	$editu = $check['users'] == "CHECKED" &&  current_user_can('edit_users')?'<a href="'.admin_url('users.php').'" class="btn btn-info btn-block ">'.__('All Users').'</a>':'';
	$eprofile = $check['profile'] == "CHECKED" &&  is_user_logged_in()?'<a href="'.admin_url('profile.php').'" class="btn btn-info btn-block ">'.__('Edit Your Profile').'</a>':'';
	$vprofile = '<a href="'.home_url('?author='.$user_ID).'" class="btn btn-success btn-block">'.__('View Your Profile','wp-userlogin').'</a>';
        $link[] = $users.$editu.$eprofile.$vprofile.'</div></li>';
        
        $link[] = $plugin_update > 0 && current_user_can('update_core') ? '<li><a href="'.admin_url('update-core.php').'"/><button type="button" class="btn btn-danger btn-block">'.$plugin_update.__(' Plugin ').pluralize($plugin_update,__('Updates'),__('Update')).__(' Available').'</a>':''; 
	$link[] = $updates['core'] == 'upgrade' && current_user_can('update_core')?'<li><a href="'.admin_url('update-core.php').'"/><button type="button" class="btn btn-danger btn-block">'.__('Core Update Available').'</a>':''; 
	$link[] = $check['options'] == "CHECKED" &&  current_user_can('manage_options')?'<li><a class="btn btn-link btn-block" href="'.admin_url('options-general.php').'">'.__('Settings').'</a></li>':'';
        $link[] = '<li><a class="btn btn-link btn-block" href="'.admin_url('tools.php').'">'.__('Your Available Tools').'</a></li>';
	$link[] = $check['logout'] == "CHECKED" && is_user_logged_in()?
            $check['redirect_out'] !== ''?'<li><a class="btn btn-danger btn-block" href="'.wp_logout_url(get_bloginfo('url').'/'.$check['redirect_out']).'">'.__('Logout').'</a></li>':'<li><a class="btn btn-link btn-block" href="'.wp_logout_url($_SERVER['REQUEST_URI']).'">'.__('Logout').'</a></li>'
        :'';    
    if($check['welcomecheck'] == "CHECKED"){
        $firstname = !empty($current_user->user_firstname)?$current_user->user_firstname:$current_user->display_name;
        $lastname = !empty($current_user->user_lastname)? $current_user->user_lastname:$current_user->display_name;
        $fullname = !empty($current_user->user_firstname) && !empty($current_user->user_lastname)?$current_user->user_firstname.' '.$current_user->user_lastname:$current_user->display_name;

        $look = array(
            'user'=>$current_user->user_nicename,
            'login'=>$current_user->user_login,
            'email'=>$current_user->user_email,
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'fullname'=>$fullname,
            'id'=>$current_user->ID
        );
        $key = '';
        $val = '';
        list($key,$val) = explode('%',$welcome);
            $head = $welcome ? $key. $look[$val]:'';
        }
        $head = '<span id="welcome">'.$head.'</span>';
    $avatar = $check['avatar'] == "CHECKED"?get_avatar( $current_user->ID, '96', '', $look[$val] ):'';
        $head = '<ul class="wpul_menu accordion" id="accordion2"><li>'.$head.'<div class="clearfix"></div>'.$avatar . '</li>';
        
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
			$options[] =$i;
		}
            }
	    if(current_user_can('edit_posts')){
		$options[] = 2;
		$options[] = 0;
	    }
            if(current_user_can('publish_posts')){
		for($i=3;$i<8;$i++){
			$options[] = $i;
		}
		$options[] .= 0;
	    }
            if(current_user_can('read') ){
                    $options[] = 0;
                    $options[] = 6;
                    $options[] = 7;
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