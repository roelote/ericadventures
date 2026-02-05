<?php
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
?>


<section class="px-3 xl:px-0 bg-gray-50">
    <header class="entry-header bg-gray-100 border-b">
		<div class="container px-3">
            <?php the_title( '<h1 class="text-base xl:text-lg text-gray-900 px-1 py-2.5 font-black uppercase">', '</h1>' ); ?>
        </div>
	</header><!-- .entry-header -->
    <div class="container py-2">
           <div class="flex flex-wrap">
            <div class="w-full md:w-9/12 lg:w-9/12 xl:w-9/12 pl-0 xl:pl-3 pr-0 xl:pr-5">
                    <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<small id="breadcrumbs" class="block -mt-1 mb-3">','</small>' );
                    }
                    ?>
                    <main id="primary" class="site-main main-page">
                      <?php
                      while ( have_posts() ) :
                        the_post();

                        get_template_part( 'template-parts/content', 'page' );

                      endwhile; // End of the loop.
                      ?>
                    </main><!-- #main -->

            </div>
            <div class="w-full md:w-3/12 lg:w-3/12 xl:w-3/12">
                       
            <div class="tourcss asidet">
                <h3 class="pl-2">Related Trekking Tours</h3>
                <ul>
                    <li>Inca Trail 4 Days</li>
                    <li>Inca Trail 2 Days</li>
                    <li>Inca Trail Gold Service</li>
                    <li>Trek Salkantay 7 Days</li>
                    <li>Trek Choquequirao 4 Days</li>
                    <li>Trek Choquequirao 5 Days</li>
                    <li>Rainbow Mountain & Ausangate Trek 5 Days</li>
                    <li>Ausangate Colorful Mountain Full</li>
                    <li>Ausangate Colorful Mountain - Pachanta 2 Days</li>
                    <li>Trek Espiritupampa 10 Days</li>
                    <li>Trek Lares 4 Days</li>
                    <li>Inka Jungle 4 Days</li>
                    <li>Trekking Salcantay 5 Days</li>
                    <li>Trek Chokequirao Machupicchu 8 Days</li>
                    <li>Esoteric Trek Keros 6 Days</li>
                </ul>
                <br>
                <h3 class="pl-2">We are recommended by</h3>
                <img src="<?php echo esc_url(get_template_directory_uri()) ?>/img/tripadvisor_logo.jpg" alt="logo" class="w-full">
                <img src="<?php echo esc_url(get_template_directory_uri()) ?>/img/recommended.jpg" alt="logo" class="w-full">

                <br>
                <h3 class="pl-2">membership</h3>
                <img src="<?php echo esc_url(get_template_directory_uri()) ?>/img/membership1.jpg" alt="logo" class="w-full">

            </div>
            </div>
           </div>
    </div>
</section>


<?php

get_footer();
