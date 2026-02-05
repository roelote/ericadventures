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


<section>
<?php
echo do_shortcode('[smartslider3 slider="2"]');
?> 
</section>

<section class="py-5 px-3 xl:px-0 bg-zinc-50">
    <div class="container">
            <div>
                <div class="bg-eric text-white rounded px-3 text-center py-2 mb-3">
                    <h1>Machu Picchu Tours / Logistics for Movie Filming Tour Packages / Shooting Trips / Luxury Taylor Made Tours</h1>
                    <h2>Official Tour operator since 1993</h2>
                </div>
                <main id="primary" class="site-main">
                    <?php
                    while ( have_posts() ) :
                        the_post();

                        get_template_part( 'template-parts/content', 'page-home' );

                    endwhile; // End of the loop.
                    ?>
                    </main><!-- #main -->
            </div>
    </div>
</section>

<?php
        
        if (ICL_LANGUAGE_CODE == 'en') {
            $priceday = "Book Now";
         }
        if (ICL_LANGUAGE_CODE == 'es') {
            $priceday = "Reservar Ahora";
         }
    
        if (ICL_LANGUAGE_CODE == 'it') { 
            $priceday = "Prenota Ora";
         }
        if (ICL_LANGUAGE_CODE == 'pt-br') { 
            $priceday = "Reserve Agora";
         }
    
        if (ICL_LANGUAGE_CODE == 'fr') { 
            $priceday = "Réserver";
         }
?>

<?php $section1 = get_field('section_01');
    if ($section1) : ?>
    <section class="border-y py-10 bg-zinc-100 px-3 xl:px-0">
        <div class="container">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-5">
                    <?php $repeater = $section1['box'];
                        	foreach ($repeater as $value) { ?>
                                    <div class="relative">
                                    <a href="<?php echo $value['link'] ?>">
                                            <div class="overflow-hidden">
                                                <img src="<?php echo $value['image'] ?>" class="w-full transform duration-200 hover:scale-110 z-10" alt="">
                                            </div>
                                            <div class="absolute bottom-0 w-full px-0 pt-5 pb-1 bg-gradient-to-t from-zinc-950">
                                                <div class="pt-5 mb-1 px-2 text-center">
                                                    <span class=" block font-bold text-sm text-left text-white uppercase hover:underline"><?php echo $value['title'] ?></span>
                                                    <span class="text-sm block text-left text-orange-400 hover:underline "><?=$priceday?></span>
                                                </div>
                                            </div>
                                    </a>
                                    </div>
                                 <?php   } ?>     
                </div>
        </div>
    </section>
<?php endif; ?>	

<?php $section2 = get_field('section_02');
    if ($section2) : ?>
<section class="my-5 pb-10 px-3 xl:px-0">
    <div class="container">
                <h2 class="uppercase font-bold text-xl text-zinc-700 text-center mb-4"><?php echo $section2['title']; ?></h2>
                 <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
                    <?php $repeater = $section2['box'];
                        	foreach ($repeater as $value) { ?>
                        <div>
                            <div class="bg-zinc-500">
                                  <a href="<?php echo $value['link'] ?>"> <h2 class="text-center font-bold text-white py-1 hover:underline "><?php echo $value['title'] ?></h2></a>
                             </div>
                            <a href="<?php echo $value['link'] ?>">
                                <div class="overflow-hidden">
                                    <img src="<?php echo $value['image'] ?>" class="w-full transform duration-200 hover:scale-110 z-10" alt="">
                                </div>
                           </a>
                        </div>
                        <?php   } ?>      
            </div>
    </div>
</section>
<?php endif; ?>	

<section class="bg-zinc-200 py-5 px-3 xl:px-0">
    <div class="container">
        <h2 class="uppercase font-bold text-lg text-zinc-600 text-center mb-4">eric adventures membership</h2>
        <img class="mx-auto" src="<?php echo esc_url(get_template_directory_uri()) ?>/img/membership-ericadventures.png" alt="">
    </div>
</section>
<?php

get_footer();
