<?php
// Shortcode
function tmtheme_portfolio_shortcode($atts, $content = null) {
	$options = get_option( 'tmtheme_settings' );
	if(!$options){
		tmtheme_set_options();
		$options = get_option( 'tmtheme_settings' );
	}

	$atts = shortcode_atts($options, $atts);
	return tmtheme_portfolio_frontend($atts);
}
add_shortcode('tm-theme-portfolio', 'tmtheme_portfolio_shortcode');

// Display carousel
function tmtheme_portfolio_frontend($atts){
    $loop = new WP_Query( 'page_id=' . $atts['portfolio_page'] );
    while ( $loop->have_posts() ) {
        $loop->the_post();
        $post_id = get_the_ID();
        $title = get_the_title();
        $content = get_the_excerpt();
        $link = get_permalink(); ?>
        <div class="section-title">
            <h2><?php echo $title; ?></h2>
            <p><?php echo $content; ?></p>
        </div>
    <?php } 
    
    wp_reset_postdata();    
    
    $gal = get_post_galleries($post_id, false);
    $gal_imgs = array();
    foreach($gal as $currGal) {        
        foreach($currGal['src'] as $img) {        
            array_push($gal_imgs, $img);
        }
    }
    
    if ($gal_imgs) {
        $output = '<div class="fp-portfolio-list row">';
        $i = 0;
        foreach($gal_imgs as $img) {        
            $output .= '<div class="col-md-3 col-sm-6">';
            //$output .= '<a href="' . $img . '" data-fancybox="portfolio">';
            $output .= '<img src="' . $img . '" class="img-responsive" />';
            //$output .= '</a>';
            $output .= '</div>';
        }
    }
    
    $output .= '</div>';
    $output .= '<p class="section-more text-center"><a href="' . $link . '">Смотреть больше</a></p>';
	
	return $output;
}

