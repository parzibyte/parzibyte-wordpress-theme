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
function remove_website_field($fields)
{
    if (isset($fields['url'])) {
        unset($fields['url']);
    }
    return $fields;
}
function agregar_script_captcha_comentarios()
{
    // Ruta del archivo JavaScript personalizado en tu tema
    wp_enqueue_script('captcha', get_template_directory_uri() . '/js/captcha.js', array(), null, true);
}
function agregar_contenedor_captcha($submit_button)
{
    $html_personalizado = '<div class="g-recaptcha" data-sitekey="6LcQh0UUAAAAAGxeWVi1VubbM2z1GmEZeWJXH0x0"></div>';
    return $html_personalizado . $submit_button;
}
function verificarToken($token, $claveSecreta)
{
    # La API en donde verificamos el token
    $url = "https://www.google.com/recaptcha/api/siteverify";
    # Los datos que enviamos a Google
    $datos = [
        "secret" => $claveSecreta,
        "response" => $token,
    ];
    // Crear opciones de la petición HTTP
    $opciones = array(
        "http" => array(
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($datos), # Agregar el contenido definido antes
        ),
    );
    # Preparar petición
    $contexto = stream_context_create($opciones);
    # Hacerla
    $resultado = file_get_contents($url, false, $contexto);
    # Si hay problemas con la petición (por ejemplo, que no hay internet o algo así)
    # entonces se regresa false. Este NO es un problema con el captcha, sino con la conexión
    # al servidor de Google
    if ($resultado === false) {
        # Error haciendo petición
        return false;
    }

    # En caso de que no haya regresado false, decodificamos con JSON
    # https://parzibyte.me/blog/2018/12/26/codificar-decodificar-json-php/

    $resultado = json_decode($resultado);
    # La variable que nos interesa para saber si el usuario pasó o no la prueba
    # está en success
    $pruebaPasada = $resultado->success;
    # Regresamos ese valor, y listo (sí, ya sé que se podría regresar $resultado->success)
    return $pruebaPasada;
}
function procesar_campo_oculto($comment_data)
{
    if (mb_strlen($comment_data["comment_content"]) > 255) {
        wp_die("Comment too long");
    }
    if (!isset($_POST["g-recaptcha-response"])) {
        wp_die("Incorrect captcha");
    }
    // Obtén el valor del campo oculto
    $recaptcha = sanitize_text_field($_POST['g-recaptcha-response']);
    if (!verificarToken($recaptcha, "")) {
        wp_die("Incorrect captcha");
    }
    $comment_data["comment_author_url"] = "";
    return $comment_data;
}

add_filter('preprocess_comment', 'procesar_campo_oculto');
add_action('wp_enqueue_scripts', 'agregar_script_captcha_comentarios');
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
add_filter('comment_form_default_fields', 'remove_website_field');
add_filter('comment_form_submit_button', 'agregar_contenedor_captcha');
