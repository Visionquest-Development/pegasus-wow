<?php
/*
Plugin Name: Pegasus Wow Plugin
Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
Description: This allows you to create onScroll animations on your website with just a shortcode.
Version:     1.0
Author:      Jim O'Brien
Author URI:  https://visionquestdevelopment.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wporg
Domain Path: /languages
*/

	/**
	 * Silence is golden; exit if accessed directly
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	function pegasus_wow_menu_item() {
		//add_menu_page("wow", "wow", "manage_options", "pegasus_wow_plugin_options", "pegasus_wow_plugin_settings_page", null, 99);
		
	}
	add_action("admin_menu", "pegasus_wow_menu_item");

	function pegasus_wow_plugin_settings_page() { ?>
	    <div class="wrap pegasus-wrap">
	    <h1>wow</h1>			
			<!--<p>Shortcode Usage: <pre>[counter_up number="83"] </pre></p>-->
			
		</div>
	<?php
	}

	
	function pegasus_wow_plugin_styles() {
		wp_enqueue_style( 'animate-css', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'css/animate.css', array(), null, 'all' );
		
	}
	add_action( 'wp_enqueue_scripts', 'pegasus_wow_plugin_styles' );
	
	/**
	* Proper way to enqueue JS 
	*/
	function pegasus_wow_plugin_js() {
		
		
		//wp_enqueue_script( 'waypoints-js', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'js/waypoints.js', array( 'jquery' ), null, true );
		
		//wp_enqueue_script( 'images-loaded-js', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'js/imagesLoaded.js', array( 'jquery' ), null, true );
		
		wp_enqueue_script( 'wow-js', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'js/wow.js', array( 'jquery' ), null, true );
		//wp_enqueue_script( 'pegasus-wow-plugin-js', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'js/plugin.js', array( 'jquery' ), null, true );
		
	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_wow_plugin_js' );
	
	


		
	/* ========================================================================
	=================Enqueue Animate.CSS and WOW.js ==============================
	========================================================================*/
	

	// Enqueue script to activate WOW.js 
	
	add_action('wp_enqueue_scripts', 'pegasus_wow_init_in_footer');
	function pegasus_wow_init_in_footer() {
		add_action( 'print_footer_scripts', 'wow_init' );
	}
	 

	// Add JavaScript before </body>
	function wow_init() { ?>
		<script type="text/javascript">
			//new WOW().init();
			var wow = new WOW(
				{
					boxClass:     'wow',      // animated element css class (default is wow)
					animateClass: 'animated', // animation css class (default is animated)
					offset:       10,          // distance to the element when triggering the animation (default is 0)
					mobile:       true,      // trigger animations on mobile devices (true is default)
					live:         true 
				}
			);
			wow.init();
		</script>
	<?php }
	
	
	/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		END CODE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/




	/*~~~~~~~~~~~~~~~~~~~~
	WOW
	~~~~~~~~~~~~~~~~~~~~~*/

	// [wow id="bounce"] text [/wow]
	function pegasus_wow_func( $atts, $content = null ) {
		$a = shortcode_atts( array(
			'id' => '',
		), $atts );

		$output = '';

		$output .= '<div class="wow ' . $a['id'] . '">';
		$output .= do_shortcode( $content );
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'wow', 'pegasus_wow_func' );