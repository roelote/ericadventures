<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ericadventures
 */

get_header();
?>
<section class="h-72 bg-center bg-[url(https://makostoursperu.com/wp-content/themes/makos/img/blogs.png)]">
	<div class="flex h-full w-full items-center justify-center bg-black bg-opacity-25">
		<h1 class="text-4xl font-bold uppercase text-white">Blog</h1>
	</div>
</section>

<?php
$args = array(
    'posts_per_page' => 4,  // Número de posts a mostrar
    'orderby'        => 'date',  // Ordenar por fecha
    'order'          => 'DESC',  // Orden descendente (muestra los últimos)
);

$recent_posts = get_posts($args);

?>


<section class="my-10">
	<div class="container">
		<div class="flex">
			<div class="w-full md:w-9/12 lg:w-9/12 xl:w-9/12 pl-0 xl:pl-3 pr-0 xl:pr-5">
					<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-2 gap-10">
						<?php
						foreach ($recent_posts as $post) {
							setup_postdata($post);
							// Puedes mostrar la información del post aquí
							?>
						
						<div>
							<?php the_post_thumbnail('img-blog'); // 'thumbnail' es el tamaño de imagen predeterminado, puedes cambiarlo según tus necesidades ?>
							 <a href="<?php the_permalink(); ?>"><h2 class="text-xl text-center text-gray-900 font-extrabold my-2"><?php the_title(); ?></h2></a>
							  <hr class="w-24 mx-auto border-2 border-eric-moto">
							  <small class="italic text-gray-600 block text-center my-2 text-sm"><?php the_time('j \d\e F, Y'); ?></small>
							  <p><?php the_excerpt() ?></p>

						</div>
						
						
							<?php
						}

						wp_reset_postdata();
						?>
						
				

				</div>
			</div>
			<div class="w-full xl:w-3/12">
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
