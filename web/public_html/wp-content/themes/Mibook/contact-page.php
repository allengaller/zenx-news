<?php /*
Template Name: Contact Page
*/

/* Fetch admin options. */
global $options;
foreach ($options as $value) {
	if(isset($value['id']) && isset ($value['std']))
		if (get_option( $value['id'] ) === FALSE) {
			$$value['id'] = $value['std']; 
		} else {
		$$value['id'] = get_option( $value['id'] );
	}
}
if(isset($_POST['submit'])) {
	
	//Validate Name Field
	if(trim($_POST['username']) === '') {
		$name_err = 'Enter Your Name';
		$errorFlag = true;
	} 
	else {
		$name = trim($_POST['username']);
	}

	//Validate E-mail Address
	if(trim($_POST['email']) === '')  {
		$email_err = 'An Email is required';
		$errorFlag = true;
	} else if (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/i", trim($_POST['email']))) {
		$email_err = 'Enter a valid Email';
		$errorFlag = true;
	} else {
		$email = trim($_POST['email']);
	}

	//If URL is left blank. Allow form sending
	if(trim($_POST['url']) == '')  {
		$url = 'No URL provided';
	}
	elseif(trim($_POST['url']) != '')  {
		if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", trim($_POST['url']))){
			$url_err = 'Please enter a valid url';
			$errorFlag = true;
		}
		else
			$url = trim($_POST['url']);
	}

	//Validate Message	
	if(trim($_POST['comment']) === '') {
		$comment_err = 'A comment is required';
		$errorFlag = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comment']));
		} else {
			$comments = trim($_POST['comment']);
		}
	}

	//If there were no errors, send the mail.
	if(!isset($errorFlag)) {	
		$to 		= $mib_email; //Replace this email address with yours
		$subject 	= 'Message sent from your website by: '.$name;
		$body 		= "Name: $name \nEmail: $email \nURL: $url \nComments: $comments";
		$headers 	= 'From: My WebSite <'.$to.'>' . "\r\n" . 'Reply-To: ' . $email;
		
		if(mail($to, $subject, $body, $headers))
			$sent = true;

		else	//the mail was not sent
			$sent = false;
	}
}
get_header();
				if (have_posts()) :
				while (have_posts()) : the_post(); 
						the_content();        
						if(isset($sent)) { ?>
							<div id="mail_success_no_JS" class="box box2">
								<?php echo stripslashes($mib_success_msg); ?>
							</div><!--end mail_success-->
						<?php }?>                        
						<form <?php if(isset($sent)) { ?>style="display:none"<?php }?> action="<?php the_permalink();?>" method="post" id="contactform" class="commentform"> 
						<p><input class="<?php if(isset($name_err) && $name_err != '') { ?>error<?php } ?>" id="name" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>" /><label for="name"><?php _e( 'Name*', 'mibook' ); ?></label></p>
						<p><input id="email" name="email" class="<?php if(isset($email_err) && $email_err != '') { ?>error<?php } ?>" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" /><label for="email"><?php _e( 'E-mail*', 'mibook' ); ?></label></p>
						<p><input id="url" name="url" class="<?php if(isset($url_err) && $url_err != '') { ?>error<?php } ?>" value="<?php if(isset($_POST['url']))  echo $_POST['url'];?>" /><label for="url"><?php _e( 'URL', 'mibook' ); ?></label></p>                       
						<p><textarea name="comment" rows="10" cols="8" class="<?php if(isset($comment_err) && $comment_err != '') { ?>error<?php } ?>" id="comment" ><?php if(isset($_POST['comment'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comment']); } else { echo $_POST['comment']; } } ?></textarea><label for="comment"><?php _e( 'Message*', 'mibook' ); ?></label></p>
						<p class="submit"><input name="submit" type="submit" class="submit" tabindex="5" value="<?php _e( 'Send Message', 'mibook' ); ?>" /></p>
						</form>
						<div id="mail_success" class="box box2">
						<?php echo stripslashes($mib_success_msg); ?>
						</div> 
					<?php endwhile;
					else : ?>
					<h2><?php _e( 'Not Found', 'mibook' ); ?></h2>
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mibook' ); ?></p>
				<?php endif;?>
	</div><!-- .content -->            
	<?php
	$sidebar_opts = '';
	if ( is_page() ) {
			$page_opts = get_post_meta( $post->ID, 'page_options', true );
            $sidebar_opts = $page_opts['sidebar_opts'];
	}
	if ( ( $sidebar_opts == 'right' ) && ( !( $sidebar_opts == 'left' || $sidebar_opts == 'none' ) ) ){
		get_sidebar();
	}
	elseif ( ( $mib_sidebar == 'right' ) && ( !( $sidebar_opts == 'left' || $sidebar_opts == 'none' ) ) ) {
		get_sidebar();
	}
	?>
    </div><!-- .primary_wrap --> 
</div><!-- .primary -->     
<?php get_footer(); ?>