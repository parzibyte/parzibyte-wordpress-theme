<?php
//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
    wp_dequeue_style('global-styles'); // REMOVE THEME.JSON
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);
add_action('wp_enqueue_scripts', 'mywptheme_child_deregister_styles', 20);
function mywptheme_child_deregister_styles()
{
    wp_dequeue_style('classic-theme-styles');
}
function theme_widgets_init()
{
    // Área de widget izquierda
    register_sidebar(array(
        'name'          => 'Barra lateral izquierdaa',
        'id'            => 'left',
        'description'   => 'Esta es la barra lateral izquierda.',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Área de widget derecha
    register_sidebar(array(
        'name'          => 'Barra lateral derecha',
        'id'            => 'right',
        'description'   => 'Esta es la barra lateral derecha.',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'theme_widgets_init');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
