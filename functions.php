<?php
function register_my_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'footer' => __('Footer menu'),
        )
    );
}
function smartwp_remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
    wp_dequeue_style('global-styles'); // REMOVE THEME.JSON
}
function mywptheme_child_deregister_styles()
{
    wp_dequeue_style('classic-theme-styles');
}
function theme_widgets_init()
{
    // Área de widget izquierda
    register_sidebar(array(
        'name'          => 'Barra lateral izquierda',
        'id'            => 'left',
        'description'   => 'Esta es la barra lateral izquierda.',
        'before_widget' => '<div class="tarjeta">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Área de widget derecha
    register_sidebar(array(
        'name'          => 'Barra lateral derecha',
        'id'            => 'right',
        'description'   => 'Esta es la barra lateral derecha.',
        'before_widget' => '<div class="tarjeta">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}


function disable_embeds_code_init()
{

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    add_filter('embed_oembed_discover', '__return_false');

    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
    add_filter('tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin');

    // Remove all embeds rewrite rules.
    add_filter('rewrite_rules_array', 'disable_embeds_rewrites');

    // Remove filter of the oEmbed result before any HTTP requests are made.
    remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result', 10);
}

function disable_embeds_tiny_mce_plugin($plugins)
{
    return array_diff($plugins, array('wpembed'));
}

function disable_embeds_rewrites($rules)
{
    foreach ($rules as $rule => $rewrite) {
        if (false !== strpos($rewrite, 'embed=true')) {
            unset($rules[$rule]);
        }
    }
    return $rules;
}
function my_deregister_scripts()
{
    wp_dequeue_script('wp-embed');
}
add_action('wp_footer', 'my_deregister_scripts');
add_action('init', 'disable_embeds_code_init', 9999);
add_action('init', 'register_my_menus');
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);
add_action('wp_enqueue_scripts', 'mywptheme_child_deregister_styles', 20);
add_action('widgets_init', 'theme_widgets_init');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
