<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
</head>

<body <?php body_class(); ?>>
    <header class="site-header">
        <?php wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'container' => 'nav',
            "menu_class" => "border border-gray-500 justify-center font-medium flex flex-col p-4  mt-4  rounded-lg  md:flex-row md:space-x-8 md:mt-0 bg-white"
        )); ?>
    </header>