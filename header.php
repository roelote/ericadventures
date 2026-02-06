<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ericadventures
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<script src="https://analytics.ahrefs.com/analytics.js" data-key="VgBJfeyTy0FZ3+nAYSEXJA" async></script>
	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- <script src="https://cdn.tailwindcss.com"></script> -->
	<?php wp_head(); ?>
</head>
	
	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YX3GTVWS60"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YX3GTVWS60');
</script>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>


<header>
	<div id="masthead" class="site-header bg-eric px-3 xl:px-0">
		<div class="container py-2.5">
				<div class="flex flex-wrap justify-between">
				<div class="site-branding">
					<?php the_custom_logo(); ?>
				</div><!-- .site-branding -->
				<div class="hidden sm:block md:block xl:block">
					<div class="flex flex-col gap-2 h-full font-nunito">
						<div>
							
								<ul class="flex top-menu">
								<?php
									if( have_rows('top_header','option') ):	
										while( have_rows('top_header','option') ) : the_row(); ?>
												<li class="text-eric2"><a href="<?php echo get_sub_field('link'); ?>" class="hover:underline"><?php echo get_sub_field('text'); ?></a></li>
											<?php	
										endwhile;
										else :
										endif;
									?>
								
								<div class="flex gap-2 items-center">
									<a aria-label="facebook" href="https://www.facebook.com/EricAdventures"><i class="fab text-white hover:text-gray-800 text-sm fa-facebook-f"></i></a>
                            		<a aria-label="twitter" href="https://twitter.com/ericadventures"><i class="fab text-white hover:text-gray-800 text-sm fa-twitter"></i></a>
                           			<a aria-label="blog icon" href="/en/blog"><i class="fas text-white hover:text-gray-800 text-sm fa-blog"></i></a>
                           			<!-- <i class="fab text-white text-sm  fa-instagram"></i> -->
								</div>
								</ul>
							
						</div>
						<div class="flex gap-4 justify-end">
							<span class="text-white"><a href="#" class="hover:underline"><i class="fas text-lg fa-mobile-alt"></i> +51 958 346 292</a></span>
							<span class="text-white"><a href="#" class="hover:underline"><i class="far text-lg fa-envelope"></i> eric@ericadventures.com</a></span>
							
						</div>
					</div>
				</div>
				</div>
		</div>		
    </div><!-- #masthead -->
</header>
<div class="border-b shadow-md relative lg:sticky xl:sticky top-0 bg-white z-50">
		<div class="">
			<?php ubermenu( 'main' ); ?>
		</div>
	</div>