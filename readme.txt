=== WP Easy Sharing ===
Contributors: fahadmahmood
Author URI: http://shop.androidbubbles.com
Plugin URI: http://androidbubble.com/blog/wp-easy-sharing
Tags: social buttons, social sharing buttons, easy sharing button, social clicks, social sharing links, sharing links, twitter, googleplus, facebook, linkedin, pinterest, add to custom post type
Requires at least: 3.5
Tested up to: 5.4
Stable tag: 1.1.5
License: GPL2 
Social sharing buttons for Facebook, Twitter, Linkedin, Pinterest, Google+ and Tutorsloop with shortcodes.

== Description ==

Especially developed for those advanced users who want to use their own CSS and custom icons instead of default. Simply use the shortcodes and customize the styles.



**Plugin Features**


- Social sharing support for Facebook, Google+, Linkedin, Twitter, Pinterest and Tutorsloop.

- Auto display to Post, Page, Media and Custom Post type.

- Custom Social Button text. 

- 100% responsive. 

- Reorder Social icon order easily.

- No Image, button created using CSS3. For device width less than 480px, this plugin used one single image to display social icons.

- Provide Shortcode, can integrated with any theme easily.

- Add text before share buttons



**Plugin Shortcode**

You can also use following shortcode



` 

[wpe_sharing social_options='facebook,twitter,googleplus,linkedin,pinterest,tutorsloop' twitter_username='wpmechanic' facebook_text='' twitter_text='' googleplus_text='' linkedin_text='' pinterest_text='' tutorsloop_text='' icon_order='f,t,l,g,p,tl' show_icons='0' before_button_text='' social_image='']

`



== Support ==

* https://wordpress.org/support/plugin/wp-easy-sharing/

* http://androidbubble.com/blog/contact/



== Screenshots ==



1. Settings Page

2. Shortcode implementation in content editor for pages

3. Shortcodes

4. Shortcode output with show_icons=1

5. Default settings output for pages with show_icons=0

6. Default settings output for pages with show_icons=0 & text fields are not empty

7. Allow Sharing Settings Page (Pro Feature)

  

== Installation ==



How to install the plugin and get it working:





Method-A:



1. Go to your wordpress admin "yoursite.com/wp-admin"



2. Login and then access "yoursite.com/wp-admin/plugin-install.php?tab=upload



3. Upload and activate this plugin



4. Use shortcode anywhere



Method-B:



1.	Download the Plugin installation package and extract the files on



	your computer. 

2.	Create a new directory named `WP Easy Sharing` in the `wp-content/plugins`



	directory of your WordPress installation. Use an FTP or SFTP client to



	upload the contents of your WP Easy Sharing archive to the new directory



	that you just created on your web host.

3.	Log in to the WordPress Dashboard and activate the plugin.

4.	Once the plugin is activated, use shortcode.



= Installing the plugin =



1. In your WordPress admin panel, go to *Plugins > New Plugin*, search for *WP Easy Sharing* and click "Install now"

2. Alternatively, download the plugin and upload the contents of `wp-easy-sharing.zip` to your plugins directory, which usually is `/wp-content/plugins/`. Activate the plugin.



== Changelog ==
= 1.1.5 =
* Languages added. [Thanks to Abu Usman]
= 1.1.3 =
* Sanitized input and fixed direct file access issues.
= 1.1.2 =
* Features improved.

= 1.1.0 =

* Features improved.

* Tutorsloop.net added as a new social/education sharing portal. [Thanks Shadab]

= 1.0 =

Initial Commit



== Upgrade Notice =
= 1.1.5 =
Languages added.
= 1.1.3 =
Sanitized input and fixed direct file access issues.
= 1.1.2 =
Features improved.

= 1.1.0 =

Features improved.

Tutorsloop.net added as a new social/education sharing portal.

= 1.0 =





== Arbitrary section ==



I would appreciate the suggestions related to new features. Please don't forget to support this free plugin by giving your awesome reviews.


a.wpes-button-facebook,
a.wpes-button-facebook:hover{
	background:url("/wp-content/uploads/2016/11/facebook.png");

}
a.wpes-button-twitter,
a.wpes-button-twitter:hover{
	background:url("/wp-content/uploads/2016/11/twitter-icon.png");

	
}	
a.wpes-button-googleplus,
a.wpes-button-googleplus:hover{
	background:url("/wp-content/uploads/2016/11/google-plus.png");
}			
a.wpes-button-linkedin,
a.wpes-button-linkedin:hover{
	background:url("/wp-content/uploads/2016/12/linkedin-1.png");

}	
a.wpes-button-pinterest,
a.wpes-button-pinterest:hover{
	background:url("/wp-content/uploads/2016/12/pintrestA-1.png");
}
a.wpes-button-youtube,
a.wpes-button-youtube:hover{
	background:url("/wp-content/uploads/2016/12/youtube-1.png");

}
a.wpes-button-tutorsloop{
	
}

a.wpes-button-facebook,
a.wpes-button-twitter,
a.wpes-button-googleplus,
a.wpes-button-linkedin,
a.wpes-button-pinterest,
a.wpes-button-youtube,
a.wpes-button-tutorsloop,
a.wpes-button-facebook:hover,
a.wpes-button-twitter:hover,
a.wpes-button-googleplus:hover,
a.wpes-button-linkedin:hover,
a.wpes-button-pinterest:hover,
a.wpes-button-youtube:hover,
a.wpes-button-tutorsloop:hover	{
	background-repeat:no-repeat;		
	background-size: auto 100%;
	background-position:top left;
	height:80px;		
	width:40px;
}
		
div.easy-sharing{
	width:100%;
	padding:0;
}





== License ==
This WordPress Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
This free software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with this software. If not, see http://www.gnu.org/licenses/gpl-2.0.html.