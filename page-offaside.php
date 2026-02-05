<?php
/** * Template Name: Page off aside */

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
          <div class="px-3.5">
               <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<small id="breadcrumbs" class="block -mt-1 mb-3">','</small>' );
                    }
                    ?>
                    <main id="primary" class="site-main mt-3 page-off">
                      <?php
                      while ( have_posts() ) :
                        the_post();

                        get_template_part( 'template-parts/content', 'page-off' );

                      endwhile; // End of the loop.
                      ?>
					        </main>

          </div>
    </div>
</section>

<?php

get_footer();
