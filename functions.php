<?php
/**
 * ericadventures functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ericadventures
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ericadventures_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on ericadventures, use a find and replace
		* to change 'ericadventures' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'ericadventures', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );
	add_image_size('img-city', 400, 310, true);
	add_image_size('img-blog', 600, 450, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'ericadventures' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'ericadventures_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'ericadventures_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ericadventures_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ericadventures_content_width', 640 );
}
add_action( 'after_setup_theme', 'ericadventures_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ericadventures_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ericadventures' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ericadventures' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title asidetours">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ericadventures_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

function get_google_maps_api_key() {
    // Lee la clave de API desde wp-config.php
    // Define GOOGLE_MAPS_API_KEY en wp-config.php como: define('GOOGLE_MAPS_API_KEY', 'tu-clave-aqui');
    return defined('GOOGLE_MAPS_API_KEY') ? GOOGLE_MAPS_API_KEY : '';
}

function my_acf_google_map_api( $api ){
    $api['key'] = get_google_maps_api_key();
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function ericadventures_scripts() {
    // Versión dinámica basada en el timestamp del archivo CSS
    $css_file = get_template_directory() . '/src/output.css';
    $css_version = file_exists($css_file) ? filemtime($css_file) : _S_VERSION;
    
    wp_enqueue_style( 'ericadventures-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'css-eric', get_stylesheet_directory_uri().'/src/output.css', array(), $css_version );
    
    // Enlaza el CSS de FancyBox
    wp_enqueue_style('fancybox-css', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css');
    
    // Enlaza el JS de FancyBox
    wp_enqueue_script('fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array(), '5.0', true);
    
    // Inicializa FancyBox
    wp_add_inline_script('fancybox-js', 'document.addEventListener("DOMContentLoaded", function() {
        Fancybox.bind("[data-fancybox=\'gallery\']", {});
    });');
    
    // Google Maps API
    wp_enqueue_script(
        'google-maps',
        'https://maps.googleapis.com/maps/api/js?key=' . get_google_maps_api_key(),
        array(),
        null,
        true
    );
    
    // Script del modal de mapa
    wp_add_inline_script('google-maps', '
        let mapInstance = null;
        let mapInitialized = false;

        function openMapModal() {
            const modal = document.getElementById("mapModal");
            modal.style.display = "flex";
            modal.classList.remove("hidden");
            modal.classList.add("show");
            document.body.style.overflow = "hidden";
            
            // Esperar a que el modal sea visible antes de inicializar el mapa
            setTimeout(() => {
                if (!mapInitialized) {
                    initMap(document.querySelector(".acf-map"));
                    mapInitialized = true;
                } else if (mapInstance) {
                    // Re-centrar el mapa si ya existe
                    google.maps.event.trigger(mapInstance, "resize");
                }
            }, 300);
        }

        function closeMapModal(event) {
            if (!event || event.target.id === "mapModal" || event.currentTarget.tagName === "BUTTON") {
                const modal = document.getElementById("mapModal");
                modal.style.display = "none";
                modal.classList.add("hidden");
                modal.classList.remove("flex", "show");
                document.body.style.overflow = "auto";
            }
        }

        document.addEventListener("keydown", function(event) {
            if (event.key === "Escape") {
                closeMapModal();
            }
        });

        function initMap(mapElement) {
            if (!mapElement) {
                console.error("No se encontró el elemento del mapa");
                return;
            }
            
            const marker = mapElement.querySelector(".marker");
            if (!marker) {
                console.error("No se encontró el marcador");
                return;
            }
            
            const lat = parseFloat(marker.dataset.lat);
            const lng = parseFloat(marker.dataset.lng);
            const zoom = parseInt(mapElement.dataset.zoom) || 16;
            
            if (isNaN(lat) || isNaN(lng)) {
                console.error("Coordenadas inválidas");
                return;
            }
            
            mapInstance = new google.maps.Map(mapElement, {
                center: { lat: lat, lng: lng },
                zoom: zoom,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            
            const markerObj = new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map: mapInstance,
                animation: google.maps.Animation.DROP
            });
            
            const infowindow = new google.maps.InfoWindow({
                content: marker.innerHTML
            });
            
            markerObj.addListener("click", function() {
                infowindow.open(mapInstance, markerObj);
            });
            
            console.log("Mapa inicializado correctamente");
        }
    ');
}
add_action( 'wp_enqueue_scripts', 'ericadventures_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* Quitar <p> y <br/> de Contact Form 7 */
add_filter('wpcf7_autop_or_not', '__return_false');


function register_acf_block_types()
{
	// register block gallery
	acf_register_block_type(array(
		'name'              => 'Prices Moto',
		'title'             => __('Prices Moto'),
		'description'       => __('Prices Moto.'),
		'render_template'   => 'template-parts/block/moto.php',
		'category'          => 'formatting',
		'icon'              => 'format-gallery',
		'keywords'          => array('moto', 'motos'),
	));

	// register block gallery
	acf_register_block_type(array(
		'name'              => 'Prices car',
		'title'             => __('Prices car'),
		'description'       => __('Prices car.'),
		'render_template'   => 'template-parts/block/car.php',
		'category'          => 'formatting',
		'icon'              => 'format-gallery',
		'keywords'          => array('car', 'cars'),
	));

}
// Check if function exists and hook into setup.
if (function_exists('acf_register_block_type')) {
	add_action('acf/init', 'register_acf_block_types');
}

function wpdocs_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


function child_city() {
    // Obtenemos la ID de la página actual.
    $current_page_id = get_the_ID();
    
    // Intentar obtener del caché
    $cache_key = 'child_city_' . $current_page_id;
    $output = wp_cache_get($cache_key, 'ericadventures_shortcodes');
    
    if (false !== $output) {
        return $output;
    }

    // Consulta para obtener los hijos de la página actual.
    $args = array(
        'post_type'      => 'page',
        'post_parent'    => $current_page_id,
        'posts_per_page' => 50, // Limitar a 50 por rendimiento
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'no_found_rows'  => true, // Optimización: no calcular total de posts
        'update_post_meta_cache' => false, // No necesitamos meta en este caso
    );

    $childrenQuery = new WP_Query($args);

    $output = '';

    if ($childrenQuery->have_posts()) {

        	$output .= '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">';
				while ($childrenQuery->have_posts()) {

					$childrenQuery->the_post();

					$output.='
							<div>
                                <div class="border bg-white shadow rounded-md p-1">
                                    <a href="' . get_the_permalink() . '">
                                        <div class="overflow-hidden">';
                                            
                    $output.=get_the_post_thumbnail('','img-city',array( 'class' => 'w-full transform duration-200 hover:scale-110 z-10 rounded-t-md', 'loading' => 'lazy' ));											
                    $output.='</div>
                                    </a>
                                     <a href="' . get_the_permalink() . '" class="hover:text-eric text-gray-800 hover:no-underline transition-all" ><h2 class="text-center font-nunito uppercase text-sm font-bold my-2 ">' . get_the_title() . '</h2></a>
                                     <hr class="mb-1 -mt-1 border-dotted border-b-1 border-gray-600">
                                     <div class="px-2"><p>'.get_the_excerpt().'</p>
                                       
                                     </div>
                                </div>

                            </div>
					';
					
					}
        	$output .= '</div>';
    }

    // Restablecemos el bucle original de WordPress.
    wp_reset_postdata();
    
    // Guardar en caché por 1 hora
    wp_cache_set($cache_key, $output, 'ericadventures_shortcodes', 3600);

    return $output;
}
add_shortcode('child_citys', 'child_city');


function child_card() {
    // Obtenemos la ID de la página actual.
    $current_page_id = get_the_ID();
    
     // Intentar obtener del caché
    $lang_code = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en';
    $cache_key = 'child_card_' . $current_page_id . '_' . $lang_code;
    $output = wp_cache_get($cache_key, 'ericadventures_shortcodes');
    
    if (false !== $output) {
        return $output;
    }

    // Consulta para obtener los hijos de la página actual.
    $args = array(
        'post_type'      => 'page',
        'post_parent'    => $current_page_id,
        'posts_per_page' => 30, // Limitar resultados
        'orderby'        => 'post_date',
        'order'          => 'ASC',
        'no_found_rows'  => true, // Optimización
    );

	// Textos traducidos
	$translations = array(
		'en' => array('price' => "Per Day", 'details' => "MORE DETAILS"),
		'es' => array('price' => "Por Dia", 'details' => "MÁS DETALLES"),
		'it' => array('price' => "Al Giorno", 'details' => "PIÙ DETTAGLI"),
		'pt-br' => array('price' => "Por Dia", 'details' => "MAIS DETALHES"),
		'fr' => array('price' => "Par Jour", 'details' => "PLUS DE DÉTAILS"),
	);
	
	$pricetxt = $translations[$lang_code]['price'] ?? $translations['en']['price'];
	$lang = $translations[$lang_code]['details'] ?? $translations['en']['details'];

    $childrenQuery = new WP_Query($args);

    $output = '';

    if ($childrenQuery->have_posts()) {

        	$output .= ' <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-3 gap-5 xl:gap-8">';
				while ($childrenQuery->have_posts()) {

					$childrenQuery->the_post();

					// Optimización: parsear bloques una sola vez
					$child_blocks = parse_blocks(get_post()->post_content);
					$price_day = '';

					foreach ($child_blocks as $child_block) {
						if ($child_block['blockName'] === 'acf/prices-car' && isset($child_block['attrs']['data']['price_day'])) {
							$price_day = $child_block['attrs']['data']['price_day'];
							break; // Salir del loop cuando encontremos el precio
						}
					}

					$output.='

						<div class="rent">
                        	<h2>' . get_the_title() . '</h2>
							<div class="overflow-hidden">';
					$output.=get_the_post_thumbnail('','imgcategory',array( 'class' => 'h-auto xl:h-40 mx-auto transform duration-200 hover:scale-110 z-10 cursor-pointer', 'loading' => 'lazy' ));
					$output.='</div>';
                            
					if ($price_day) {
						$output .= '<span class="block text-gray-800 my-1 uppercase font-bold text-center">'.$price_day.' - '.$pricetxt.' </span>';
					}

                     $output.='<a href="' . get_the_permalink() . '" class="table mx-auto bg-zinc-600 text-white px-4 hover:text-eric2 mt-1 py-1.5 font-bold rounded text-xs">'.$lang.'</a>
                        
                    	</div>
					';
					
					}
        	$output .= '</div> <div class="clear-both"> </div>';
    }

    // Restablecemos el bucle original de WordPress.
    wp_reset_postdata();
    
    // Guardar en caché por 1 hora
    wp_cache_set($cache_key, $output, 'ericadventures_shortcodes', 3600);

    return $output;
}
add_shortcode('child_cards', 'child_card');


function child_moto() {
    // Obtenemos la ID de la página actual.
    $current_page_id = get_the_ID();
    
    // Intentar obtener del caché
    $lang_code = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en';
    $cache_key = 'child_moto_' . $current_page_id . '_' . $lang_code;
    $output = wp_cache_get($cache_key, 'ericadventures_shortcodes');
    
    if (false !== $output) {
        return $output;
    }

    // Consulta para obtener los hijos de la página actual.
    $args = array(
        'post_type'      => 'page',
        'post_parent'    => $current_page_id,
        'posts_per_page' => 30, // Limitar resultados
        'orderby'        => 'post_date',
        'order'          => 'ASC',
        'no_found_rows'  => true,
    );
	
	// Textos traducidos
	$translations = array(
		'en' => array('price' => "Prices per day", 'details' => "MORE DETAILS"),
		'es' => array('price' => "Precio por día", 'details' => "MÁS DETALLES"),
		'it' => array('price' => "Prices al giorno", 'details' => "PIÙ DETTAGLI"),
		'pt-br' => array('price' => "Prices por dia", 'details' => "MAIS DETALHES"),
		'fr' => array('price' => "PRIX PAR JOUR", 'details' => "PLUS DE DÉTAILS"),
	);
	
	$pricetxt = $translations[$lang_code]['price'] ?? $translations['en']['price'];
	$lang = $translations[$lang_code]['details'] ?? $translations['en']['details'];

    $childrenQuery = new WP_Query($args);

    $output = '';

    if ($childrenQuery->have_posts()) {

        	$output .= '<div class="grid grid-cols-1 sm:grid-cols-2 gap-5 md:grid-cols-3 xl:grid-cols-3 main-moto mb-3 ">';
				while ($childrenQuery->have_posts()) {
					$childrenQuery->the_post();

					// Optimización: parsear bloques una sola vez
					$child_blocks = parse_blocks(get_post()->post_content);
					$prices_list = '';

					foreach ($child_blocks as $child_block) {
						if ($child_block['blockName'] === 'acf/prices-moto' && isset($child_block['attrs']['data']['prices'])) {
							$prices_list .= '<ul>';
							
							for ($i = 0; $i < $child_block['attrs']['data']['prices']; $i++) {
								$range = $child_block['attrs']['data']['prices_' . $i . '_range'] ?? '';
								$price = $child_block['attrs']['data']['prices_' . $i . '_price'] ?? '';
								if ($range && $price) {
									$prices_list .= '<li>' . $range . ' - ' . $price . '</li>';
								}
							}
							
							$prices_list .= '</ul>';
							break; // Salir del loop
						}
					}

					$output.='
					
						<div class="rent">
                            <h2 class="">' . get_the_title() . '</h2>
							<div class="overflow-hidden">
							';
					 $output.= get_the_post_thumbnail('','imgcategory',array( 'class' => 'mx-auto h-52 py-2 transform duration-200 hover:scale-110 z-10 cursor-pointer', 'loading' => 'lazy' ));
                     $output.='</div> <span class="block text-gray-800 my-1 uppercase font-bold text-center">'.$pricetxt.'</span>';

					$output .= $prices_list;

						$output.='<a href="' . get_the_permalink() . '" class="table mx-auto bg-zinc-600 text-white px-4 hover:text-eric2 mt-1 py-1.5 font-bold rounded text-xs">'.$lang.'</a>
                        </div>

					';
					
					}
        	$output .= '</div> <div class="clear-both"> </div>';
    }

    // Restablecemos el bucle original de WordPress.
    wp_reset_postdata();
    
    // Guardar en caché por 1 hora
    wp_cache_set($cache_key, $output, 'ericadventures_shortcodes', 3600);

    return $output;
}
add_shortcode('child_motos', 'child_moto');


function show_child($atts) {
    // Obtener el ID de la página actual
    $pagina_actual_id = get_the_ID();
    
    // Intentar obtener del caché
    $cache_key = 'show_child_' . $pagina_actual_id;
    $output = wp_cache_get($cache_key, 'ericadventures_shortcodes');
    
    if (false !== $output) {
        return $output;
    }

    // Obtener el ID del padre de la página actual
    $pagina_padre_id = wp_get_post_parent_id($pagina_actual_id);

    // Obtener las páginas hijas del padre de la página actual
    $hermanos = get_pages(array(
        'child_of' => $pagina_padre_id,
        'exclude' => $pagina_actual_id,
        'number' => 50, // Limitar resultados
    ));

    // Comprobar si hay hermanos
    if (!empty($hermanos)) {
        $output = '<ul>';
        foreach ($hermanos as $hermano) {
            $output .= '<li><a class="text-gray-700 hover:text-eric-moto" href="' . get_permalink($hermano) . '">' . get_the_title($hermano) . '</a></li>';
        }
        $output .= '</ul>';
    } else {
        $output = 'No hay tours relacionados.';
    }
    
    // Guardar en caché por 1 hora
    wp_cache_set($cache_key, $output, 'ericadventures_shortcodes', 3600);

    return $output;
}

add_shortcode('show_childs', 'show_child');


function mostrar_paginas_con_hijos_shortcode() {
    // Intentar obtener del caché
    $cache_key = 'mostrar_paginas_con_hijos';
    $output = wp_cache_get($cache_key, 'ericadventures_shortcodes');
    
    if (false !== $output) {
        return $output;
    }
    
    $args = array(
        'post_type'      => 'page',
        'post_parent'    => 0,
        'posts_per_page' => 100, // Limitar a 100
        'no_found_rows'  => true,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $output = '<ul>';

        while ($query->have_posts()) {
            $query->the_post();
            $has_children = get_pages(array(
                'child_of' => get_the_ID(),
                'number' => 1, // Solo verificar si existe al menos 1
            ));
            if ($has_children) {
                $output .= '<li><a class="text-gray-700 hover:text-eric-moto" href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
        }

        $output .= '</ul>';
    } else {
        $output = 'No se encontraron páginas con hijos.';
    }

    wp_reset_postdata();
    
    // Guardar en caché por 1 hora
    wp_cache_set($cache_key, $output, 'ericadventures_shortcodes', 3600);

    return $output;
}

add_shortcode('mostrar_paginas_con_hijos', 'mostrar_paginas_con_hijos_shortcode');


if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
}


function mi_login_logo_one() { 
	?>
	<style type="text/css"> 
	body.login div#login h1 a {
		background-image: url(https://www.ericadventures.com/wp-content/uploads/logo-ericadventures.png);
		background-size: contain;
		width: 290px; 
		margin-bottom: 0px;
		background-position: center;
	} 
	.login h1 {
 	 background-color: #aa2525;
	}
	#login #loginform
	{
		margin-top: 0px !important;
	}
	</style>
	<?php 
	} 
	
add_action( 'login_enqueue_scripts', 'mi_login_logo_one' );

// Validación de fechas ahora se carga como script externo en ericadventures_scripts()


function custom_cf7_form_hidden_fields($tag) {
    if (isset($tag['name'])) {
        switch ($tag['name']) {
            case 'Url_Tour':
                $full_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $tag['values'][] = esc_url($full_url);
                break;

            case 'Idioma':
                // Si usas WPML
                if (function_exists('icl_object_id')) {
                    $tag['values'][] = ICL_LANGUAGE_CODE;
                } else {
                    $tag['values'][] = get_locale();
                }
                break;

            case 'Fecha_Hora':
                $tag['values'][] = date_i18n('d/m/Y H:i:s');
                break;

            case 'Ip':
                // Capturar la IP del usuario
                $ip = $_SERVER['REMOTE_ADDR'];
                $tag['values'][] = esc_attr($ip);
                break;
        }
    }
    
    return $tag;
}
add_filter('wpcf7_form_tag', 'custom_cf7_form_hidden_fields', 10);


/**
 * Limpiar caché de shortcodes cuando se actualiza una página
 */
function clear_shortcodes_cache_on_save($post_id) {
    // Verificar que no sea un autoguardado
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Verificar que sea una página
    if (get_post_type($post_id) !== 'page') {
        return;
    }
    
    // Limpiar cachés relacionados con esta página
    wp_cache_delete('child_city_' . $post_id, 'ericadventures_shortcodes');
    wp_cache_delete('child_card_' . $post_id . '_en', 'ericadventures_shortcodes');
    wp_cache_delete('child_card_' . $post_id . '_es', 'ericadventures_shortcodes');
    wp_cache_delete('child_card_' . $post_id . '_it', 'ericadventures_shortcodes');
    wp_cache_delete('child_card_' . $post_id . '_pt-br', 'ericadventures_shortcodes');
    wp_cache_delete('child_card_' . $post_id . '_fr', 'ericadventures_shortcodes');
    wp_cache_delete('child_moto_' . $post_id . '_en', 'ericadventures_shortcodes');
    wp_cache_delete('child_moto_' . $post_id . '_es', 'ericadventures_shortcodes');
    wp_cache_delete('child_moto_' . $post_id . '_it', 'ericadventures_shortcodes');
    wp_cache_delete('child_moto_' . $post_id . '_pt-br', 'ericadventures_shortcodes');
    wp_cache_delete('child_moto_' . $post_id . '_fr', 'ericadventures_shortcodes');
    wp_cache_delete('show_child_' . $post_id, 'ericadventures_shortcodes');
    wp_cache_delete('mostrar_paginas_con_hijos', 'ericadventures_shortcodes');
    
    // Si la página tiene padre, limpiar el caché del padre también
    $parent_id = wp_get_post_parent_id($post_id);
    if ($parent_id) {
        wp_cache_delete('child_city_' . $parent_id, 'ericadventures_shortcodes');
        wp_cache_delete('child_card_' . $parent_id . '_en', 'ericadventures_shortcodes');
        wp_cache_delete('child_card_' . $parent_id . '_es', 'ericadventures_shortcodes');
        wp_cache_delete('child_card_' . $parent_id . '_it', 'ericadventures_shortcodes');
        wp_cache_delete('child_card_' . $parent_id . '_pt-br', 'ericadventures_shortcodes');
        wp_cache_delete('child_card_' . $parent_id . '_fr', 'ericadventures_shortcodes');
        wp_cache_delete('child_moto_' . $parent_id . '_en', 'ericadventures_shortcodes');
        wp_cache_delete('child_moto_' . $parent_id . '_es', 'ericadventures_shortcodes');
        wp_cache_delete('child_moto_' . $parent_id . '_it', 'ericadventures_shortcodes');
        wp_cache_delete('child_moto_' . $parent_id . '_pt-br', 'ericadventures_shortcodes');
        wp_cache_delete('child_moto_' . $parent_id . '_fr', 'ericadventures_shortcodes');
    }
}
add_action('save_post', 'clear_shortcodes_cache_on_save');

// Validación de fechas para formularios
function agregar_validacion_fechas() {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fechaInicio = document.getElementById('inicio');
            const fechaFin = document.getElementById('final');

            if (fechaInicio && fechaFin) {
                fechaInicio.addEventListener('change', function() {
                    fechaFin.min = fechaInicio.value;
                    if (fechaFin.value && fechaFin.value < fechaInicio.value) {
                        fechaFin.value = '';
                    }
                });

                fechaFin.addEventListener('change', function() {
                    if (fechaFin.value && fechaFin.value < fechaInicio.value) {
                        alert('La fecha de fin no puede ser anterior a la fecha de inicio.');
                        fechaFin.value = '';
                    }
                });
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'agregar_validacion_fechas');

// Función para autocompletar el campo oculto con el título del tour
add_filter('wpcf7_form_tag', function($tag, $unused) {
    // Si el nombre del campo no es 'nombre-tour', no hacemos nada
    if ($tag['name'] != 'Nombre_Tour') {
        return $tag;
    }

    // Obtenemos el título del post actual
    $post_title = get_the_title();
    
    // Asignamos el título como valor del campo
    if ($post_title) {
        $tag['values'] = (array) $post_title;
    }

    return $tag;
}, 10, 2);
