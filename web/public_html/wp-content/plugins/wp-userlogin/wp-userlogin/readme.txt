=== WP-UserLogin ===
Contributors: Jerry Stephens
Tags: userlogin, userslogin, wp-userlogin, login, users, user, dashboard, controlpanel, control-panel, panel, control, widget, sidebar, register, password,stylesheet, css, openid
Requires at least: 3.0
Tested up to: 3.*
Stable tag: 13.08
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Front page login/logout and control panel.

== Installation ==

Unzip and upload to /wp-content/plugins/ directory
Activate the plugin
Add the User Login widget to your sidebar
If your site doesn't support widgets simply add `<?php the_widget('wpul_widget');?>` to your sidebar

== Frequently Asked Questions ==

= What does this plugin do, exactly? =

It builds a login form and control panel in the sidebar of your page.

= Can I edit the CSS for the form and control panel? =

Yes, as of v5.0 a stylesheet editor has been included. If you don't like that stylesheet, or you have your own already, you also have the option to use your own stylesheet.

= The last version didn't support OpenID. What happened? =

Most were telling me they weren't using it or that it was dead. And from what I had seen, it seemed to be true. However, one user requested it again as that was the reason she chose my plugin. So I obliged.

= Does this work with EVERY OpenID plugin? =

No, this plugin only works with the plugin named [OpenID](http://wordpress.org/extend/plugins/openid/ "Go Figure")

== Screenshots ==

No screenshots available

== Changelog ==

= 13.08 =
* Updated readme file
* Added help section
* Replace Bootstrap files with CDN

= 13.06 =
* Build ability to turn Bootstrap use on/off

= 13.05 =
* Add [Bootstrap](http://twitter.github.io/bootstrap/) incorporation 

= 12.12.26 =
* Use get_option() function to get information for update notification
* Set version convention to year.month.day

= 12.12.12 =
* Correct broken function in wpul_widget class

= 12.12 =
* Change version naming convention to date-oriented
* Utilize the ability to extend WP_Widget class
* Search $wpdb for notifications for updates, plugin updates, and comments awaiting moderation
* Allow widget to be placed in more than one sidebar
* Utilize native WordPress login form, rather than writing my own
* Reduce redundancy in submenu pages
* Add CSS insertion to enhance update/moderation notification
* Removed OpenID integration in favor of using wp_login_form

= 5.5 =
* Switched from numeric user abilities to native user permissions
* Added plugin links
* Set login/logout redirects if none are specified

= 5.3 =
* Corrected empty list item display bug
* Added one-line call for non-widgetized sites

= 5.2 =
* Correct array_diff/implode error message

= 5.1 =
* Added optional additional links function

= 5.0 =
* Added default stylesheet
* Added stylesheet editor
* Rebuilt look and feel of options page
* Gave plugin its own sidebar panel
* Integrated native Wordpress gravatar function
* Streamlined options saving
* Created uninstall function
* Cleaned up old database entries
* Changed function names to avoid conflicting with other plugins
* Changed element id and class names to avoid conflict with other plugins
* Configured redirect in/out URLs to relative URL instead of absolute

= 4.0 =
* Added logout redirection
* Streamlined needless processes

= 3.1.1 =
* Minor functionality correction

= 3.1 =
* Added I18n localization

= 3.0 =
* Added welcome message and parameters
* Added database propagation on plugin activation

= 2.3.2 =
* Minor functionality correction

= 2.3.1 =
* Minor functionality correction

= 2.3 =
* Added login redirection

= 2.2 =
* Tested for WordPress 2.5.1

= 2.1 =
* Minor functionality correction

= 2.0 =
* Improved user-role handling 
* Added Control Panel

= 1.2 =
* Minor functionality correction

= 1.1 =
* Improved Wordpress integration

= 1.0 =
* First stable release
* Added OpenID plugin integration

== Upgrade Notice ==
This upgrade removes the donate and links for further documentation, which are no longer kept or working.