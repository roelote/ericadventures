<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ericadventures
 */

get_header();
?>

<section class="h-32 bg-center bg-[url(https://makostoursperu.com/wp-content/themes/makos/img/blogs.png)]">
	<div class="flex h-full w-full items-center justify-center bg-black bg-opacity-25">
		<h1 class="text-4xl font-bold uppercase text-white"><?php the_title(); ?></h1>
	</div>
</section>

<section class="my-5">
    <div class="container">
        <div class="flex -mx-3"> <!-- Agregado -mx-3 para compensar el padding -->

            <!-- Columna principal -->
            <div class="w-full md:w-9/12 px-3"> <!-- Agregado px-3 para padding horizontal -->
                <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb( '<small id="breadcrumbs" class="block -mt-1 mb-1">','</small>' );
                    }
                ?>

                <main id="primary" class="site-main post-blog">

                    <?php
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'template-parts/content', get_post_type() );
                        endwhile;
                    ?>

                </main><!-- #main -->
            </div>

            <!-- Sidebar -->
            <div class="w-full md:w-3/12 px-3 mt-5 md:mt-0"> <!-- Agregado px-3 y mt para separación en móviles -->
                <aside class="tourcss asidet bg-gray-50 p-4 rounded">
                    <h3 class="pl-2 font-semibold">Related Trekking Tours</h3>
                    <ul class="list-disc list-inside text-sm">
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

                    <div class="mt-6">
                        <h3 class="pl-2 font-semibold">We are recommended by</h3>
                        <img src="<?php echo esc_url(get_template_directory_uri()) ?>/img/tripadvisor_logo.jpg" alt="TripAdvisor logo" class="w-full mt-2">
                        <img src="<?php echo esc_url(get_template_directory_uri()) ?>/img/recommended.jpg" alt="Recommended" class="w-full mt-2">
                    </div>

                    <div class="mt-6">
                        <h3 class="pl-2 font-semibold">Membership</h3>
                        <img src="<?php echo esc_url(get_template_directory_uri()) ?>/img/membership1.jpg" alt="Membership" class="w-full mt-2">
                    </div>
                </aside>
            </div>

        </div>
    </div>
</section>


<?php

get_footer();
