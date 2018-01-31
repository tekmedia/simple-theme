<!DOCTYPE html PUBLIC>
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />	
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php wp_title(""); if(!is_front_page()) echo " - "; bloginfo('name'); ?></title>
	<meta name='description' content='<?php wp_title(""); ?>' />
	<meta name='keywords' content='<?php wp_title(""); ?>' />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/jquery.fancybox.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fonts/fonts.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/animate.min.css" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
	<?php wp_head(); ?>
</head>
<body data-spy="scroll" data-target="#header">
<header id="header">
    <div class="top_header">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="header-address">
                        <i class="fa fa-home"></i>
                        <p><?php if (get_theme_mod( 'header_address' )) echo get_theme_mod( 'header_address' ); ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="header-phone">
                        <i class="fa fa-phone"></i>
                        <?php if (get_theme_mod( 'header_phone' )) echo '<a href="tel:' . get_theme_mod( 'header_phone' ) . '">' . get_theme_mod( 'header_phone' ) . '</a>'; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="header-social_icon text-right">
                        <?php
                            wp_nav_menu( array( 'theme_location' => 'social-menu' ) );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header_menu text-center affix" data-spy="affix" data-offset-top="50" id="nav">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php if (has_custom_logo()) { ?>
                        <?php echo get_custom_logo(); ?>
                    <?php } else { ?>
                        <a href=""><img src="<? echo get_template_directory_uri(); ?>/img/logo.png" alt=""></a>
                    <?php } ?>
                </div>
                <div class="collapse navbar-collapse zero_mp" id="main-navbar">
                    <?php
                        wp_nav_menu( array(
                          'theme_location' => 'main-menu',
                          'depth' => 2,
                          'container' => false,
                          'menu_class' => 'nav navbar-nav navbar-right',
                          'walker' => new wp_bootstrap_navwalker())
                        );
                    ?>
                </div>
            </nav>
        </div>
    </div>
</header>