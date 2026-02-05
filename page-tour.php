<?php

/** * Template Name: Page Tour */

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ericadventures
 */

get_header();

// Traducciones según idioma
$translations = [
    'en' => [
        'desde' => 'From US$'
    ],
    'es' => [
        'desde' => 'Desde US$'
    ],
    'fr' => [
        'desde' => 'À partir de US$'
    ],
    'it' => [
        'desde' => 'A partire da US$'
    ],
    'pt-br' => [
        'desde' => 'A partir de US$'
    ]
];

// Obtener idioma actual
$current_lang = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'es';
$t = isset($translations[$current_lang]) ? $translations[$current_lang] : $translations['es'];

?>

<section class="px-3 xl:px-0 bg-gray-50">
    <header class="entry-header bg-gray-100 border-b">
		<div class="container px-3">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-2 md:space-y-0">
                <?php the_title( '<h1 class="text-base xl:text-lg text-gray-900 py-2.5 font-black uppercase">', '</h1>' ); ?>
                
                <!-- Diseño de Precio -->
                <?php 
                // Obtener precio del tour desde ACF - siempre del idioma principal
                $post_id = get_the_ID();
                $original_post_id = apply_filters('wpml_object_id', $post_id, 'page', false, wpml_get_default_language());
                $precio_tour = get_field('precio_tour', $original_post_id);
                
                if( $precio_tour ): ?>
                <a href="#<?php echo ($current_lang == 'en') ? 'prices-section' : (($current_lang == 'fr') ? 'prix-section' : (($current_lang == 'it') ? 'prezzi-section' : (($current_lang == 'pt-br') ? 'precos-section' : 'precios-section'))); ?>" class="price-container bg-gradient-to-r from-red-600 to-red-600 px-6 py-1.5 rounded-lg shadow-lg self-start md:self-auto hover:from-red-700 hover:to-red-700 transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center space-x-2">
                        <span class="text-xs text-red-100 font-medium uppercase tracking-wide"><?php echo esc_html($t['desde']); ?></span>
                        <span class="text-lg xl:text-xl text-white font-bold"><?php echo esc_html($precio_tour); ?></span>
                        <span class="text-xs text-red-100 font-medium uppercase">USD</span>
                    </div>
                </a>
                <?php endif; ?>
            </div>
        </div>
	</header><!-- .entry-header -->
    <div class="container py-2">
           <div class="flex flex-wrap">
            <div class="w-full md:w-9/12 lg:w-9/12 xl:w-9/12 pl-0 xl:pl-3 pr-0 xl:pr-5">
                    <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<small id="breadcrumbs" class="block -mt-1 mb-1">','</small>' );
                    }
                    ?>
                    <main id="primary" class="site-main tourcss">

                        <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/content', 'page-tour' );

                        endwhile; // End of the loop.
                        ?>

                    </main><!-- #main -->
            </div>
            <div class="w-full md:w-3/12 lg:w-3/12 xl:w-3/12">
                <div class="tourcss asidet">
                    <?php get_sidebar(); ?>
                </div>
            </div>
           </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Obtener el idioma actual desde PHP
    const currentLang = '<?php echo $current_lang; ?>';
    
    // Buscar todos los H2 en el contenido
    const h2Elements = document.querySelectorAll('.entry-content h2');
    
    // Palabras para "precios" en los 5 idiomas y sus respectivos ids
    const pricesConfig = {
        'en': { words: ['PRICES', 'PRICE'], id: 'prices-section' },
        'es': { words: ['PRECIOS', 'PRECIO'], id: 'precios-section' },
        'fr': { words: ['PRIX'], id: 'prix-section' },
        'it': { words: ['PREZZI', 'PREZZO'], id: 'prezzi-section' },
        'pt-br': { words: ['PREÇOS', 'PREÇO'], id: 'precos-section' }
    };
    
    // Obtener todas las palabras de precios de todos los idiomas
    const allPricesWords = Object.values(pricesConfig).flatMap(config => config.words);
    
    // Obtener el id para el idioma actual
    const currentLangId = pricesConfig[currentLang]?.id || 'prices-section';
    
    h2Elements.forEach(function(h2) {
        const h2Text = h2.textContent.toUpperCase();
        
        // Verificar si el texto contiene alguna palabra de precios
        const containsPricesWord = allPricesWords.some(word => h2Text.includes(word));
        
        if (containsPricesWord) {
            h2.id = currentLangId;
        }
    });
});
</script>

<?php

get_footer();
