=== Plugin Name ===
Donate link: https://oberonlai.blog
Tags: image, hosting, ftp, remote, media
Requires at least: 3.6.0
Tested up to: 5.2.2
Requires PHP: 5.4
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Let's you upload images to ftp-server and remove the uploads in the WordPress Media Library.

== Description ==

Media with FTP can manage the media files of remote image hosting throught FTP connection. Uploading and deleteing remote files in the WordPress Media Library directly.

Configuring the FTP connection in admin option page, also you can assign the images path in the panel.

A few notes about the option fields:

*   "FTP Host Name" is the URL or IP address of FTP connection for you image hosting.
*   "FTP Port" is the FTP port number and it's usually 21. Keep the default value if you don't know what it is.
*   "FTP Username" is the username of FTP connection.
*   "FTP Password" is the password of FTP connection.
*   "FTP Root Path" is the images' folder path in your image hosting, and it also replaces the image url which upload from media library on your web site.
*   "FTP Folder Path" is the folder saving files in image hosting. Keeping the default value "/" if your "FTP Root Path" is pointed to the image folder. You can change it after adding the folder on the image hosting.

The source code was made by Pontus Abrahamsson from [https://github.com/pontusab/wp-ftp-media-library](https://github.com/pontusab/wp-ftp-media-library). This plugin integrates the function of deleting remote server files and the visual options page for non-developer user, also making the plugin structure with WordPress plugin boilerplate with OOP.

Let me know if any questions, enjoy!

== Installation ==

1. Upload `media-with-ftp.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set the FTP connection info througt the 'Settings > Media with FTP'

== Frequently Asked Questions ==

= What's the plugin for? =

Manage the files of remote server in WordPress media library directly.

= How do I set my FTP conncection =

Go to 'Settings > Media with FTP' menu and submit.

== Screenshots ==

1.The Admin Options for user.

== Changelog ==

= 1.0.1 =
* Correct the description wording
* Include cmb2 with composer autoload
* Remove the field of FTP Folder Path

= 1.0 =
* Function of deleting remote server images
* Admin option page with CMB2