<?php

add_image_size( 'big-thumbnail', 400, 400, true );
add_filter( 'image_size_names_choose', 'tm_gallery_sizes');
function tm_gallery_sizes($sizes) {
    $addsizes = array(
        "big-thumbnail" => "Миниатюра большая"
    );

    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}

add_filter('post_gallery', 'my_gallery_output', 10, 2);
function my_gallery_output( $output, $attr ){
    if(isset($attr['columns'])):
        $columns = $attr['columns'];
        if($columns == 2):
            $columnMD = 6;
            $columnSM = 6;
        elseif($columns == 3):
            $columnMD = 4;
            $columnSM = 6;
        elseif($columns == 4):
            $columnMD = 3;
            $columnSM = 6;
        elseif($columns == 6):
            $columnMD = 2;
            $columnSM = 4;
        elseif($columns == 12):
            $columnMD = 1;
            $columnSM = 6;
        endif;
    else:
        $columns = 3;
        $columnMD = 4;
        $columnSM = 6;
    endif;

    if(isset($attr['size'])):
        $size = $attr['size'];
    elseif ( function_exists( 'add_image_size' ) ):
        $size = "big-thumbnail";
    else:
        $size = "thumbnail";
    endif;        
        
	$ids_arr = explode(',', $attr['ids']);
	$ids_arr = array_map('trim', $ids_arr );
    
    static $instance = 0;
    $instance++;

	$pictures = get_posts( array(
		'posts_per_page' => -1,
		'post__in'       => $ids_arr,
		'post_type'      => 'attachment',
		'orderby'        => 'post__in',
	) );

	if( ! $pictures ) return 'Запрос вернул пустой результат.';

	// Вывод
	$output = "<div class='post-gallery row'>\n";
    $current_row = 0;
    foreach($ids_arr as $id) {
        if($current_row % $columns == 0) {
            $output .="<div class='clearfix'></div>\n";
        }
        $thumbnail = wp_get_attachment_image_src($id, $size);
        $large = wp_get_attachment_image_src($id, 'large');
        $thumbnail_info = get_post( $id );
        $has_caption = $thumbnail_info->post_excerpt;

        $output .= "<div class='col-md-".$columnMD." col-sm-".$columnSM." col-xs-12'>\n";
            $output .= "<a href='".$large[0]."' title='".$thumbnail_info->post_excerpt."' data-fancybox='post-gallery-" . $instance . "'" . ( !empty($has_caption) ? " data-caption='" . $thumbnail_info->post_excerpt . "'" : '' ) . ">\n";
                $output .= "<img src='".$thumbnail[0]."' class='img-responsive' />\n";
            $output .= "</a>\n";
            if(!empty($has_caption)):
                $output .= "<p class='caption text-center'>\n";
                    $output .= $thumbnail_info->post_excerpt;
                $output .= "</p>";
            endif;
        $output .= "</div>\n";

        $current_row++;
    }
    
	$output .= '</div>';

	return $output;
}