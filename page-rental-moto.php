<?php

/** * Template Name: Page Rental Moto */

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
            <div class="w-full md:w-9/12 lg:w-9/12 xl:w-9/12 px-0 xl:px-3">
                    <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<small id="breadcrumbs" class="block -mt-1">','</small>' );
                    }
                    ?>
                    <main id="primary" class="site-main tourcss mt-1">

                        <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/content', 'page-moto' );

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


<?php

get_footer();
