<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://oberonlai.blog
 * @since      1.0.0
 *
 * @package    Media_With_Ftp
 * @subpackage Media_With_Ftp/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Media_With_Ftp
 * @subpackage Media_With_Ftp/admin
 * @author     Pontus Abrahamsson / Oberon Lai <m615926@gmail.com>
 */
class Media_With_Ftp_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	public $upload_dir;
	public $upload_url;
	public $upload_yrm;
	public $settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Media_With_Ftp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Media_With_Ftp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/media-with-ftp-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Media_With_Ftp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Media_With_Ftp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/media-with-ftp-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register Options Page Field
	 */
	public function media_with_ftp_cmb2_fields() {

		$cmb_options = new_cmb2_box(array(
			'id' => 'mwf_options',
			'title' => esc_html__('Media with FTP','media-with-ftp'),
			'object_types' => array('options-page'),
			'option_key' => 'mwf_options',
			'menu_title' => esc_html__('Media with FTP','media-with-ftp'),
			'parent_slug' => 'options-general.php'
		));
		$cmb_options->add_field(array(
			'name' => esc_html__(__('FTP Host Name', 'media-with-ftp')),
			'desc' => esc_html__(__('This is the FTP server hostname. It is usually used IP address or host URL.', 'media-with-ftp')),
			'id' => 'mwf_hostname',
			'type' => 'text',
			'attributes' => array(
				'placeholder' => esc_html__(__('ex: 123.123.123.123 or domain.com', 'media-with-ftp'))
			)
		));
		$cmb_options->add_field(array(
			'name' => esc_html__(__('FTP Port', 'media-with-ftp')),
			'desc' => esc_html__(__('This is the port number of connection the FTP server. The default is 21. DO NOT change it if you have no idea about protocol port.', 'media-with-ftp')),
			'id' => 'mwf_port',
			'type' => 'text',
			'default' => '21',
			'attributes' => array(
				'type' => 'number',
				'maxlenth' => '2',
				'pattern' => '\d*'
			)
		));
		$cmb_options->add_field(array(
			'name' => esc_html__(__('FTP Username', 'media-with-ftp')),
			'desc' => esc_html__(__('This is the username of connecting the FTP Server.', 'media-with-ftp')),
			'id' => 'mwf_username',
			'type' => 'text'
		));
		$cmb_options->add_field(array(
			'name' => esc_html__(__('FTP Password', 'media-with-ftp')),
			'desc' => esc_html__(__('This is the password of connecting the FTP Server.', 'media-with-ftp')),
			'id' => 'mwf_password',
			'type' => 'text',
			'attributes' => array(
				'type' => 'password'
			)
		));
		$cmb_options->add_field(array(
			'name' => esc_html__(__('FTP Image URL', 'media-with-ftp')),
			'desc' => esc_html__(__('This is the URL with folder structure of your FTP Server and also the path of your website\'s images.', 'media-with-ftp')),
			'id' => 'mwf_cdn',
			'type' => 'text',
			'attributes' => array(
				'placeholder' => 'ex: https://img.yourdomain.com/img'
			)
		));
		// $cmb_options->add_field(array(
		// 	'name' => esc_html__(__('FTP Folder Name', 'media-with-ftp')),
		// 	'desc' => esc_html__(__('This is the folder name of your FTP Server to place the images. It is usually used the "/" if your FTP Root Path ', 'media-with-ftp')),
		// 	'id' => 'mwf_path',
		// 	'default' => '/',
		// 	'type' => 'text'
		// ));
	}

	/**
	 * FTP connection info
	 */
	public function media_with_ftp_connection_info(){
		
		$this->upload_dir = wp_upload_dir();
		$this->upload_url = get_option('upload_url_path');
		$this->upload_yrm = get_option('uploads_use_yearmonth_folders');

		$this->settings = array(
			'host'	  =>	cmb2_get_option('mwf_options','mwf_hostname'),  			// * the ftp-server hostname
			'port'    =>  cmb2_get_option('mwf_options','mwf_port'),         // * the ftp-server port (of type int)
			'user'	  =>	cmb2_get_option('mwf_options','mwf_username'), 				// * ftp-user
			'pass'	  =>	cmb2_get_option('mwf_options','mwf_password'),	 				// * ftp-password
			'cdn'     =>  cmb2_get_option('mwf_options','mwf_cdn'),			// * This have to be a pointed domain or subdomain to the root of the uploads
			'path'	  =>	"/",	 					// - ftp-path, default is root (/). Change here and add the dir on the ftp-server,
			'base'	  =>  wp_upload_dir()['basedir']  	// Basedir on local 
		);

		/**
		 * Change the upload url to the ftp-server
		 */
		update_option( 'upload_url_path', esc_url( $this->settings['cdn'] ) );

	}

	/**
	 * Upload media file to FTP
	 */
	public function media_with_ftp_upload( $args ) {

		/**
		 * Host-connection
		 * Read about it here: http://php.net/manual/en/function.ftp-connect.php
		 */
		
		$connection = ftp_connect( $this->settings['host'], $this->settings['port'] );


		/**
		 * Login to ftp
		 * Read about it here: http://php.net/manual/en/function.ftp-login.php
		 */

		$login = ftp_login( $connection, $this->settings['user'], $this->settings['pass'] );

		// turn passive mode on
		ftp_pasv($connection, true);

		
		/**
		 * Check ftp-connection
		 */

		if ( !$connection || !$login ) {
				die('Connection attempt failed, Check your settings');
		}


		function ftp_putAll($conn_id, $src_dir, $dst_dir, $created) {
							$d = dir($src_dir);
				while($file = $d->read()) { // do this for each file in the directory
						if ($file != "." && $file != "..") { // to prevent an infinite loop
								if (is_dir($src_dir."/".$file)) { // do the following if it is a directory
										if (!@ftp_chdir($conn_id, $dst_dir."/".$file)) {
												ftp_mkdir($conn_id, $dst_dir."/".$file); // create directories that do not yet exist
										}
										$created  = ftp_putAll($conn_id, $src_dir."/".$file, $dst_dir."/".$file, $created); // recursive part
								} else {
										$upload = ftp_put($conn_id, $dst_dir."/".$file, $src_dir."/".$file, FTP_BINARY); // put the files
										if($upload)
											$created[] = $src_dir."/".$file;
								}
						}
				}
				$d->close();
				return $created;
		}

		/**
		 * If we ftp-upload successfully, mark it for deletion
		 * http://php.net/manual/en/function.ftp-put.php
		 */
		$delete = ftp_putAll($connection, $this->settings['base'], $this->settings['path'], array());
		


		// Delete all successfully-copied files
		foreach ( $delete as $file ) {
			unlink( $file );
		}
		
		return $args;
	}

	/**
	 * Delete image in FTP server
	 */
	public function media_with_ftp_delete( $args ){

		// FTP Connect
		$connection = ftp_connect( $this->settings['host'], $this->settings['port'] );
		$login = ftp_login( $connection, $this->settings['user'], $this->settings['pass'] );
		ftp_pasv($connection, true);
		if ( !$connection || !$login ) {
			die('Connection attempt failed, Check your settings');
		};

		// Get the file 
		if( !empty($this->upload_yrm) ) {
			$file_year = substr(wp_get_attachment_metadata($args)['file'],0,8);
			$file = array(
				'original' => str_replace($this->settings['cdn'].'/',"",wp_get_attachment_url($args)),
				'thumb' => $file_year.wp_get_attachment_metadata($args)['sizes']['thumbnail']['file'],
				'medium' => $file_year.wp_get_attachment_metadata($args)['sizes']['medium']['file'],
				'mdium_large' => $file_year.wp_get_attachment_metadata($args)['sizes']['medium_large']['file'],
				'large' => $file_year.wp_get_attachment_metadata($args)['sizes']['large']['file'],
				'post' => $file_year.wp_get_attachment_metadata($args)['sizes']['post-thumbnail']['file']
			);
		} else {
			$file = array(
				'original' => str_replace($this->settings['cdn'].'/',"",wp_get_attachment_url($args)),
				'thumb' => 	wp_get_attachment_metadata($args)['sizes']['thumbnail']['file'],
				'medium' => wp_get_attachment_metadata($args)['sizes']['medium']['file'],
				'mdium_large' => wp_get_attachment_metadata($args)['sizes']['medium_large']['file'],
				'large' => wp_get_attachment_metadata($args)['sizes']['large']['file'],
				'post' => wp_get_attachment_metadata($args)['sizes']['post-thumbnail']['file']
			);
		};

		foreach ($file as $path) {
			ftp_delete($connection, $path);
		}
		
		ftp_close($connection);
	}
}
