<?php
// Shortcode
function tmreview_shortcode($atts, $content = null) {
	/*$options = get_option( 'tmreview_settings' );
	if(!$options){
		tmreview_set_options();
		$options = get_option( 'tmreview_settings' );
	}

	$atts = shortcode_atts($options, $atts);*/
	return tmreview_frontend($atts);
}
add_shortcode('tm-reivews', 'tmreview_shortcode');

// Display carousel
function tmreview_frontend($atts){ ?>
    <div class="section-title">
        <h2>Отзывы</h2>
    </div>
    <?php
    $args = array(
        'post_type' => 'tmreview',
        'posts_per_page' => '-1',
    );

    // Collect the carousel content. Needs printing in two loops later (bullets and content)
    $loop = new WP_Query( $args );
    if ($loop) { ?>
        <div class="carousel slide" id="review-carousel" data-ride="carousel" data-interval="3000">
            <?php 
            $count = count( $loop->posts ) % 2 > 0 ? (count( $loop->posts ) % 2) + 1 : count( $loop->posts ) % 2;  ?>
            <ol class="carousel-indicators">
                <?php for ($i = 0; $i < $count; $i++) { ?>
                    <li data-target="#review-carousel" data-slide-to="<?php echo $i; ?>" <?php echo $i == 0 ? 'class="active"' : ''; ?>></li>
                <?php } ?>
            </ol>
            <div class="carousel-inner">
            <?php for ($i = 0; $i < count( $loop->posts ); $i+=2) { ?>
                <div class="item <?php echo $i == 0 ? 'active' : ''; ?>" id="review-item-<?php echo $i ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-circle">
                                <?php echo get_the_post_thumbnail( $loop->posts[$i]->ID, 'thumbnail' ); ?>
                            </div>
                            <div class="review_content">
                                <i class="fa fa-quote-left"></i>
                                <p><?php echo $loop->posts[$i]->post_content; ?></p>
                            </div>
                            <div class="review_author">
                                <h5><?php echo $loop->posts[$i]->post_title; ?></h5>
                                <!--<p>CEO, Fourder</p>-->
                            </div>
                        </div>
                        <?php if ($loop->posts[$i+1]) { ?>
                        <div class="col-md-6">
                            <div class="profile-circle">
                                <?php echo get_the_post_thumbnail( $loop->posts[$i+1]->ID, 'thumbnail' ); ?>
                            </div>
                            <div class="review_content">
                                <i class="fa fa-quote-left"></i>
                                <p><?php echo $loop->posts[$i+1]->post_content; ?></p>
                            </div>
                            <div class="review_author">
                                <h5><?php echo $loop->posts[$i+1]->post_title; ?></h5>
                                <!--<p>CEO, Fourder</p>-->
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            </div>        
        </div>        
    <?php }
    
    wp_reset_postdata();
	
	return $output;
}

