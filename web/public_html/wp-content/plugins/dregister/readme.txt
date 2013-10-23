=== DRegister ===
Contributors: juzaam
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=2591242
Tags: registration, register, fields, custom fields, first_name,first name, last name, last_name, registration, form, 2.7, AJAX, mootools
Requires at least: 2.0
Tested up to: 2.7.1
Stable tag: 1.3


Enhance your Registration Page. Require First Name, Last Name. Add custom fields. Require custom fields.

== Description ==


DRegister (which stands for Dr. Register) is a clean and easy plugin that allows you to :
<ul>
<li> Force your user to provide First and Last name upon registration</li>
<li> Create custom fields and specify if they have to be, alphanumeric, numeric only or multi-choice (radio) , plus if they are required to complete registration.</li>
<li> Clean use, no MySQL tables are created. User data is stored as WP User Meta and you can keep track of meta keys for further use.</li>
<li> Custom fields are available for editing on each user profile page.</li>
<li> Uses Mootools for smooth AJAX administration.</li>
<li> Working fine on WP 2.7.1.</li>
</ul>
<br />
Languages included: <b>English</b>, <b>Italian</b>, <b>Hungarian</b>,<b>Spanish</b></br>

<i>Want to translate this plugin? Contact me at webmaster [at] juzaam.com</i>

Translation credits: 
<ul>
<li>Hungarian: <b>János Csárdi-Braunstein</b> <a href="http://blogocska.org/" target="_blank">http://blogocska.org/</a></li>
<li>Spanish: <b>Alejandro Urrutia</b> <a href="http:/www.theindependentproject.com" target="_blank">http:/www.theindependentproject.com</a></li>
</ul>

== Installation ==


1. Upload the `dregister` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set the options in the Settings Panel

== Screenshots ==

1. Options page
2. Custom registration page
3. Enhanced user profile 

== LOCALIZATION ==
* Place your language file in the plugin folder directory and name it "dregister-{language}.mo" replacing {language} with your language value from wp-config.php 
	
== CHANGELOG ==

**v1.3** - 14 Feb, 2009

	*New feature: multi-choice field are now allowed
	*Enhancement: faster AJAX administration
	
**v1.2.5** - 1 Feb, 2009

	*Compatibility: fixed PHP 4 compatibility issue on installation


**v1.2.3** - 1 Feb, 2009

	*Enhancement: meta_key doesn't get updated when changing name of a existing field

**v1.2.2** - 24 Jan, 2009

	*Bug fixes on AJAX permissions


**v1.2.1** - 24 Jan, 2009

	*Bug fixes on error "You don't have administrator rights to modify registration options"


**v1.2** - 24 Jan, 2009

	*Various bug fixes
	*New feature: it's now possible to know meta_keys of newly created custom fields. (useful for developers)
	
**v1.1** - 23 Jan, 2009

	*Fixed administration bug where apparently everything went well but no changes were made
	
**v1.0** - 18 Jan, 2009

	*First release

