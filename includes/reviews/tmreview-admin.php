<?php
// Add column in admin list view to show featured image
// http://wp.tutsplus.com/tutorials/creative-coding/add-a-custom-column-in-posts-and-custom-post-types-admin-screen/
function tmprm_columns_head($defaults) {  
	//$defaults['comment'] = 'Описание';  
	//$defaults['icon'] = 'Символ';  
	//$defaults['category'] = 'Рубрика';  
	//$defaults['link'] = 'Ссылка';  
	return $defaults;  
}  
function tmprm_columns_content($column_name, $post_ID) {
	if ($column_name == 'comment') {  
        $curr_post = get_post($post_ID);
        echo $curr_post->post_excerpt;
	}
	if ($column_name == 'icon') {  
        $custom = get_post_custom($post_ID);
        $tmprm_icon = isset($custom['tmprm_icon']) ?  $custom['tmprm_icon'][0] : '';
        echo $tmprm_icon;
	}
}
add_filter('manage_tmprm_posts_columns', 'tmprm_columns_head');  
add_action('manage_tmprm_posts_custom_column', 'tmprm_columns_content', 10, 2);

// Extra admin field for image URL
function tmprm_icon(){
	global $post;
	$custom = get_post_custom($post->ID);
	$tmprm_icon = isset($custom['tmprm_icon']) ?  $custom['tmprm_icon'][0] : '';
	?>
    <p class="post-attributes-label-wrapper"><label class="post-attributes-label">Код символа:</label></p>
	<input name="tmprm_icon" value="<?php echo $tmprm_icon; ?>" type="text" />	
    <p>Список доступных символов можно найти на сайте <a href="http://fontawesome.io/" target="_blank">Font Awesome</a></p>
	<?php
}
function tmprm_admin_init_custpost(){
	add_meta_box("tmprm_icon", "Символ преимущества", "tmprm_icon", "tmprm", "side", "low");
}
add_action("add_meta_boxes", "tmprm_admin_init_custpost");
function tmprm_mb_save_details(){
	global $post;
	if (isset($_POST["tmprm_icon"])) {
		update_post_meta($post->ID, "tmprm_icon", $_POST["tmprm_icon"]);
	}
}
add_action('save_post', 'tmprm_mb_save_details');

?>