<?php
// Shortcode
function tmprm_shortcode($atts, $content = null) {
	$options = get_option( 'tmprm_settings' );
	if(!$options){
		tmprm_set_options();
		$options = get_option( 'tmprm_settings' );
	}

	$atts = shortcode_atts($options, $atts);
	return tmprm_frontend($atts);
}
add_shortcode('tm-preims', 'tmprm_shortcode');

// Display carousel
function tmprm_frontend($atts){
    $loop = new WP_Query( 'p=' . $atts['custom_post'] );
    while ( $loop->have_posts() ) {
        $loop->the_post();
        $post_id = get_the_ID();
        $title = get_the_title();
        $content = get_the_excerpt(); ?>
        <div class="section-title">
            <h2><?php echo $title; ?></h2>
            <p><?php echo $content; ?></p>
        </div>
    <?php } 
    
    wp_reset_postdata();    
    
	$args = array(
		'post_type' => 'tmprm',
		'posts_per_page' => '-1',
	);

	// Collect the carousel content. Needs printing in two loops later (bullets and content)
	$loop = new WP_Query( $args );
    if ($loop) { 
        switch ($atts['columns']) {
            case 2:
                $cols = 'col-sm-6';
                break;
            case 3:
                $cols = 'col-md-4 col-sm-6';
                break;
            case 4:
                $cols = 'col-md-3 col-sm-6';;
                break;
            case 6:
                $cols = 'col-md-2 col-sm-4';
                break;
        } 
        $i = 0;
        ?>
        <div class="row">
        <?php while ( $loop->have_posts() ) {
            $loop->the_post();                
            $post_id = get_the_ID();
            $title = get_the_title();
            $content = get_the_excerpt();
            $icon = get_post_meta(get_the_ID(), 'tmprm_icon', true); ?>
            
            <div class="<?php echo $cols; ?>">
                <div class="item">
                    <div class="single_item">
                        <div class="item_list">
                            <div class="welcome_icon">
                                <i class="fa <?php echo $icon; ?>"></i>
                            </div>
                            <h4><?php echo $title; ?></h4>
                            <p><?php echo $content; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $i % $atts['columns'] == $atts['columns'] - 1 ? '<div class="clearfix"></div>' : ''; $i++; ?>
        <?php } ?>
        </div>        
    <?php }
	
	wp_reset_postdata();  
	
	return $output;
}

