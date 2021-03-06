<?php
// Set up settings defaults
register_activation_hook(__FILE__, 'tmprm_set_options');
function tmprm_set_options (){
	$defaults = array(
		'columns' => '4',
		'custom_post' => '-1',
	);
	add_option('tmprm_settings', $defaults);
}
// Clean up on uninstall
register_activation_hook(__FILE__, 'tmprm_deactivate');
function tmprm_deactivate(){
	delete_option('tmprm_settings');
}


// Render the settings page
class tmprm_settings_page {
	// Holds the values to be used in the fields callbacks
	private $options;
			
	// Start up
	public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
	}
			
	// Add settings page
	public function add_plugin_page() {
		add_submenu_page('edit.php?post_type=tmprm', 'Свойства', 'Свойства', 'manage_options', 'tmprm-pteims', array($this,'create_admin_page'));
	}
			
	// Options page callback
	public function create_admin_page() {
		// Set class property
		$this->options = get_option( 'tmprm_settings' );
		if(!$this->options){
			tmprm_set_options ();
			$this->options = get_option( 'tmprm_settings' );
		}
		?>
		<div class="wrap">
		<h2>Свойства преимуществ</h2>        				 
        <form method="post" action="options.php">
        <?php
                settings_fields( 'tmprm_settings' );   
                do_settings_sections( 'tmprm-pteims' );
                submit_button(); 
        ?>
        </form>        
		</div>
		<?php
	}
			
	// Register and add settings
	public function page_init() {		
		register_setting(
            'tmprm_settings', // Option group
            'tmprm_settings', // Option name
            array( $this, 'sanitize' ) // Sanitize
		);
		
        // Sections
		add_settings_section(
            'tmprm_settings_behaviour', // ID
            'Настройки', // Title
            array( $this, 'tmprm_settings_behaviour_header' ), // Callback
            'tmprm-pteims' // Page
		);
        
		// Behaviour Fields
		add_settings_field(
            'columns', // ID
            'Количество столбцов', // Title
            array( $this, 'columns_callback' ), // Callback
            'tmprm-pteims', // Page
            'tmprm_settings_behaviour' // Section
		);
		add_settings_field(
            'custom_post', // ID
            'Запись преимуществ', // Title 
            array( $this, 'custom_post_callback' ), // Callback
            'tmprm-pteims', // Page
            'tmprm_settings_behaviour' // Section		   
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
	public function tmprm_settings_behaviour_header() {
        //echo '<p>'.__('Basic setup of how each Carousel will function, what controls will show and which images will be displayed.', 'tmprm-pteims').'</p>';
	}
			
	// Callback functions - print the form inputs
    // Carousel behaviour	
	public function columns_callback() {
        $col_options = array (
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'6' => '6'
		);
		print '<select id="col_options" name="tmprm_settings[columns]">';
		foreach($col_options as $val => $option){
			print '<option value="'.$val.'"';
			if(isset( $this->options['columns'] ) && $this->options['columns'] == $val){
				print ' selected="selected"';
			}
			print ">$option</option>";
		}
		print '</select>';
	}
    
	public function custom_post_callback() {
        $args = array(
            'post_type' => 'post'
        );

        $loop = new WP_Query( $args );
        $custom_post_list = array();
        while ( $loop->have_posts() ) {
            $loop->the_post();            
            $post_id = get_the_ID();
            $title = get_the_title();            
            //array_push($custom_post_list, $post_id, $title);
            
            $custom_post_list += [$post_id => $title];
        }        
        wp_reset_postdata();
        
		print '<select id="custom_post" name="tmprm_settings[custom_post]">';
        if(isset( $this->options['custom_post'] ) && $this->options['custom_post'] == '-1')
            print '<option value="-1" selected="selected"></option>';
        else 
            print '<option value="-1"></option>';
        
		foreach($custom_post_list as $val => $option){
			print '<option value="'.$val.'"';
			if(isset( $this->options['custom_post'] ) && $this->options['custom_post'] == $val){
				print ' selected="selected"';
			}
			print ">$option</option>";
		}
		print '</select>';
	}
}

if( is_admin() ){
    $tmprm_settings_page = new tmprm_settings_page();
}

// Add settings link on plugin page
function tmprm_settings_link ($links) { 
	$settings_link = '<a href="edit.php?post_type=tmprm&page=tmprm-pteims">'.__('Settings', 'tmprm-pteims').'</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
}
$tmprm_plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$tmprm_plugin", 'tmprm_settings_link' );
