<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php wp_head(); ?> 
    </head>

    <body <?php body_class(); ?>>

        <header class="site-header">
            <div class="header-elements">
                <?php 
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'main-menu-left', 
                            'container_class' => 'reset-list-style header-menu-wrapper menu-left desktop-menu'
                        )
                    );
                ?>

                <div class="header-logo">
                    <?php has_custom_logo() ? the_custom_logo() : ''; ?>
                </div><!-- .header-logo -->

                <?php 
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'main-menu-right', 
                            'container_class' => 'reset-list-style header-menu-wrapper menu-right desktop-menu'
                        )
                    );

                    wp_nav_menu(
                        array(
                            'theme_location'  => 'mobile-menu', 
                            'container_class' => 'reset-list-style header-menu-wrapper mobile-menu'
                        )
                    );
                ?>
                
                <div class="burger-menu">
                    <div class="bar-1"></div>
                    <div class="bar-2"></div>
                    <div class="bar-3"></div>
                </div><!-- .burger-menu -->
            </div><!-- .header-elements -->
        </header><!-- .site-header -->