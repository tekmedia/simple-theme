<?php

function register_menus() {
    register_nav_menus (
        array(
            'main-menu' => 'Главное меню',
            'social-menu' => 'Социальные кнопки'
        )
    );
}
add_action('init', 'register_menus');

/*function my_register_sidebars() {
	register_sidebar(
		array(
			'id' => 'header-title',
			'name' => 'Шапка. Заголовок',
		)
	); 
} 
add_action( 'widgets_init', 'my_register_sidebars' );*/



function customizer_init( $wp_customize ) {
 
	$transport = 'postMessage'; // описание этой переменной чуть ниже
 
	// Цвет меню
	$wp_customize->add_setting(
		'menu_color',
		array(
			'default'     => '#000000',
			'transport'   => $transport // как обновлять превью сайта: $transport - асинхронным запросом, 'refresh' - перезагрузкой фрейма, указав значение 'refresh', вы можете полностью отказаться от JavaScript
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_color',
			array(
			    'label'      => 'Цвет меню',
			    'section'    => 'colors',
			    'settings'   => 'menu_color'
			)
		)
	);
 
	// Цвет пункта меню при наведении
	$wp_customize->add_setting(
		'menu_color_hover',
		array(
			'default'     => '#444',
			'transport'   => $transport
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_color_hover',
			array(
			    'label'      => 'Цвет пункта меню при наведении',
			    'section'    => 'colors',
			    'settings'   => 'menu_color_hover'
			)
		)
	);
 
	// Цвет активного пункта меню
	$wp_customize->add_setting(
		'menu_color_active',
		array(
			'default'     => '#E7E7E7',
			'transport'   => $transport
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_color_active',
			array(
			    'label'      => 'Цвет активного пункта меню',
			    'section'    => 'colors',
			    'settings'   => 'menu_color_active'
			)
		)
	);
    
    // Телефоны и адрес в шапке
	$wp_customize->add_setting(
		'header_address', // id
		array(
			'default'            => '',
			'sanitize_callback'  => 'sanitize_copyright',
			'transport'          => $transport
		)
	);
	$wp_customize->add_control(
		'header_address',
		array(
			'section'  => 'title_tagline', // id секции
			'label'    => 'Адрес',
			'type'     => 'text' // текстовое поле
		)
	);
    $wp_customize->add_setting(
		'header_phone', // id
		array(
			'default'            => '',
			'sanitize_callback'  => 'sanitize_copyright',
			'transport'          => $transport
		)
	);
	$wp_customize->add_control(
		'header_phone',
		array(
			'section'  => 'title_tagline', // id секции
			'label'    => 'Телефон',
			'type'     => 'text' // текстовое поле
		)
	);
    $wp_customize->add_setting(
		'header_email', // id
		array(
			'default'            => '',
			'sanitize_callback'  => 'sanitize_copyright',
			'transport'          => $transport
		)
	);
	$wp_customize->add_control(
		'header_email',
		array(
			'section'  => 'title_tagline', // id секции
			'label'    => 'Электронная почта',
			'type'     => 'text' // текстовое поле
		)
	);
} 
add_action( 'customize_register', 'customizer_init' );
 
/*
 * Функция обработки текстовых значений, перед их сохранением в базу
 */
function sanitize_copyright( $value ) {
	return strip_tags( stripslashes( $value ) ); // обрезаем слеши и HTML-теги
}
 

/*function customizer_css() { 
	echo '<style>';
	
    //Jumbotron
    if ( 0 < count( strlen( ( $background_image_url = get_theme_mod( 'jumbotron_image' ) ) ) ) ) {
    		echo '.jumbotron { background-image: url( \'' . $background_image_url . '\' ); }';
	}
    
    //Menu Color
    echo '.navbar-default { background-color: ' . get_theme_mod( 'menu_color' ) . '; }';
    echo '.navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li > a:hover { background-color: ' . get_theme_mod( 'menu_color_hover' ) . '; }';
    echo '.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .active > a:hover { background-color: ' . get_theme_mod( 'menu_color_active' ) . '; }';
    
	echo '</style>';
}
add_action( 'wp_head', 'customizer_css' ); // вешаем на wp_head*/