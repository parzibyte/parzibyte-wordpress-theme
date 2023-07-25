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
    <h1 class="font-bold text-center">
        <a href="<?php echo get_site_url() ?>">
            <?php bloginfo("name") ?>
    </h1>
    </a>
    <p class="text-center"><?php bloginfo("description") ?></p>
    <header class="site-header">
        <?php wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'container' => 'nav',
            "menu_class" => "justify-end border font-medium flex flex-col p-4  mt-4  md:flex-row md:space-x-8 md:mt-0 bg-white"
        )); ?>
    </header>