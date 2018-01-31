<?php
// Set up settings defaults
register_activation_hook(__FILE__, 'tmtheme_set_options');
function tmtheme_set_options (){
	$defaults = array(
		'portfolio_page' => '-1',
	);
	add_option('tmtheme_settings', $defaults);
}
// Clean up on uninstall
register_activation_hook(__FILE__, 'tmtheme_deactivate');
function tmtheme_deactivate(){
	delete_option('tmtheme_settings');
}


// Render the settings page
class tmtheme_settings_page {
	// Holds the values to be used in the fields callbacks
	private $options;
			
	// Start up
	public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
	}
			
	// Add settings page
	public function add_plugin_page() {
		add_menu_page('ТМ Базовый сайт', 'ТМ Базовый сайт', 'manage_options', 'tmtheme');
		add_submenu_page('tmtheme', 'Свойства', 'Свойства', 'manage_options', 'tmtheme-properties', array($this,'create_admin_page'));
	}
			
	// Options page callback
	public function create_admin_page() {
		// Set class property
		$this->options = get_option( 'tmtheme_settings' );
		if(!$this->options){
			tmtheme_set_options ();
			$this->options = get_option( 'tmtheme_settings' );
		}
		?>
		<div class="wrap">
		<h2>ТМ Базовый сайт - Настройки темы</h2>        				 
        <form method="post" action="options.php">
        <?php
                settings_fields( 'tmtheme_settings' );   
                do_settings_sections( 'tmtheme-properties' );
                submit_button(); 
        ?>
        </form>        
		</div>
		<?php
	}
			
	// Register and add settings
	public function page_init() {		
		register_setting(
            'tmtheme_settings', // Option group
            'tmtheme_settings', // Option name
            array( $this, 'sanitize' ) // Sanitize
		);
		
        // Sections
		add_settings_section(
            'tmtheme_settings_portfolio', // ID
            'Портфолио (главная страница)', // Title
            array( $this, 'tmtheme_settings_portfolio_header' ), // Callback
            'tmtheme-properties' // Page
		);
        
		// Behaviour Fields
		add_settings_field(
            'portfolio_page', // ID
            'Запись преимуществ', // Title 
            array( $this, 'portfolio_page_callback' ), // Callback
            'tmtheme-properties', // Page
            'tmtheme_settings_portfolio' // Section		   
		);			 
	}
			
	// Sanitize each setting field as needed -  @param array $input Contains all settings fields as array keys
	public function sanitize( $input ) {
		$new_input = array();
		foreach($input as $key => $var){
			if($key == 'twbs' || $key == 'columns' || $key == 'background_images_height'){
				$new_input[$key] = absint( $input[$key] );
			} else if ($key == 'link_button_before' || $key == 'link_button_after' || $key == 'before_title' || $key == 'after_title' || $key == 'before_caption' || $key == 'after_caption'){
				$new_input[$key] = $input[$key]; // Don't sanitise these, meant to be html!
			} else { 
				$new_input[$key] = sanitize_text_field( $input[$key] );
			}
		}
		return $new_input;
	}
			
	// Print the Section text
	public function tmtheme_settings_portfolio_header() {
        //echo '<p>'.__('Basic setup of how each Carousel will function, what controls will show and which images will be displayed.', 'tmtheme-properties').'</p>';
	}
			
	// Callback functions - print the form inputs
    // Carousel behaviour	
	public function portfolio_page_callback() {
        $args = array(
            'post_type' => 'page'
        );

        $loop = new WP_Query( $args );
        $portfolio_page_list = array();
        while ( $loop->have_posts() ) {
            $loop->the_post();            
            $post_id = get_the_ID();
            $title = get_the_title();            
            //array_push($portfolio_page_list, $post_id, $title);
            
            $portfolio_page_list += [$post_id => $title];
        }        
        wp_reset_postdata();
        
		print '<select id="portfolio_page" name="tmtheme_settings[portfolio_page]">';
        if(isset( $this->options['portfolio_page'] ) && $this->options['portfolio_page'] == '-1')
            print '<option value="-1" selected="selected">нет</option>';
        else 
            print '<option value="-1">нет</option>';
        
		foreach($portfolio_page_list as $val => $option){
			print '<option value="'.$val.'"';
			if(isset( $this->options['portfolio_page'] ) && $this->options['portfolio_page'] == $val){
				print ' selected="selected"';
			}
			print ">$option</option>";
		}
		print '</select>';
	}
}

if( is_admin() ){
    $tmtheme_settings_page = new tmtheme_settings_page();
}

// Add settings link on plugin page
function tmtheme_settings_link ($links) { 
	$settings_link = '<a href="edit.php?post_type=tmtheme&page=tmtheme-properties">'.__('Settings', 'tmtheme-properties').'</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
}
$tmtheme_plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$tmtheme_plugin", 'tmtheme_settings_link' );
