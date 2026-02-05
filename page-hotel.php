<?php

/** * Template Name: Page Hotel */

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


<?php
/**
 * Modal de Mapa de Hotel con ACF y Tailwind CSS
 * Agregar este código en tu template de WordPress
 */

$ubicacion = get_field('ubicacion_hotel');

// El campo de Google Maps de ACF guarda estos datos automáticamente:
// $ubicacion['address'] = Dirección completa
// $ubicacion['lat'] = Latitud
// $ubicacion['lng'] = Longitud
// $ubicacion['zoom'] = Nivel de zoom
// $ubicacion['place_id'] = ID del lugar en Google
// $ubicacion['name'] = Nombre del negocio (si lo tiene)

// Traducciones según idioma
$translations = [
    'en' => [
        'ver_ubicacion' => 'View Location',
        'ver_galeria' => 'View Gallery',
        'fotos' => 'photos',
        'abrir_google_maps' => 'Open in Google Maps',
        'no_ubicacion' => 'No location available',
        'nuestra_ubicacion' => 'Our Location'
    ],
    'es' => [
        'ver_ubicacion' => 'Ver Ubicación',
        'ver_galeria' => 'Ver Galería',
        'fotos' => 'fotos',
        'abrir_google_maps' => 'Abrir en Google Maps',
        'no_ubicacion' => 'No hay ubicación disponible',
        'nuestra_ubicacion' => 'Nuestra Ubicación'
    ],
    'fr' => [
        'ver_ubicacion' => 'Voir l\'emplacement',
        'ver_galeria' => 'Voir la galerie',
        'fotos' => 'photos',
        'abrir_google_maps' => 'Ouvrir dans Google Maps',
        'no_ubicacion' => 'Aucun emplacement disponible',
        'nuestra_ubicacion' => 'Notre emplacement'
    ],
    'it' => [
        'ver_ubicacion' => 'Vedi posizione',
        'ver_galeria' => 'Vedi galleria',
        'fotos' => 'foto',
        'abrir_google_maps' => 'Apri in Google Maps',
        'no_ubicacion' => 'Nessuna posizione disponibile',
        'nuestra_ubicacion' => 'La nostra posizione'
    ],
    'pt-br' => [
        'ver_ubicacion' => 'Ver Localização',
        'ver_galeria' => 'Ver Galeria',
        'fotos' => 'fotos',
        'abrir_google_maps' => 'Abrir no Google Maps',
        'no_ubicacion' => 'Nenhuma localização disponível',
        'nuestra_ubicacion' => 'Nossa Localização'
    ]
];

// Obtener idioma actual
$current_lang = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'es';
$t = isset($translations[$current_lang]) ? $translations[$current_lang] : $translations['es'];

$nombre = !empty($ubicacion['name']) ? $ubicacion['name'] : $t['nuestra_ubicacion'];
$direccion = $ubicacion['address'];

?>

<section class="px-3 xl:px-0 bg-gray-50">
  
    <div class="container py-2">
          <div class="bg-white shadow-sm mx-2 rounded-md">
                        <div class="container mx-auto px-4 pb-3 pt-6">
							<div class="flex items-center justify-between">
								
									<div>
								<?php 
								// Obtener rating del hotel desde ACF - siempre del idioma principal
								$post_id = get_the_ID();
								$original_post_id = apply_filters('wpml_object_id', $post_id, 'page', false, wpml_get_default_language());
								$rating_hotel = get_field('rating_hotel', $original_post_id);
								$rating = !empty($rating_hotel) ? intval($rating_hotel) : 5; // Default 5 estrellas
								?>
								<span class="text-yellow-500">
									<?php for($i = 1; $i <= 5; $i++): ?>
										<?php if($i <= $rating): ?>
											<i class="fas fa-star"></i>
										<?php else: ?>
											<i class="far fa-star"></i>
										<?php endif; ?>
									<?php endfor; ?>
								</span>

								<h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
									<?php the_title(); ?>
								</h1>

								<div class="flex flex-wrap items-center gap-2 text-sm">
									<div class="flex items-center gap-1">
										<svg xmlns="http://www.w3.org/2000/svg" 
											class="w-4 h-4 text-blue-600 flex-shrink-0" 
											fill="currentColor" viewBox="0 0 24 24">
											<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
										</svg>
										<span class="text-gray-700">
											<?php echo esc_html($direccion); ?>
										</span>
									</div>
								</div>
								
							</div>
								
								<div>
									 <button 
    onclick="openMapModal()" 
    class="bg-[#aa2525] hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center gap-2">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
    </svg>
    <?php echo esc_html($t['ver_ubicacion']); ?>
</button>
								</div>
								
							</div>
						
                         

                        </div>
             </div>
		
		
		
           <div class="flex flex-wrap">
            <div class="w-full md:w-9/12 lg:w-9/12 xl:w-9/12 pl-0 xl:pl-3 pr-0 xl:pr-5">
                 
   <main id="primary" class="site-main tourcss hotelcss">

             <?php $imagenes = get_field('galeria_hoteles'); ?>

<?php if( $imagenes && count($imagenes) > 0 ): ?>
<section class="container mx-auto px-2 py-2">
  <?php
  $total_imagenes = count($imagenes);
  $mostrar_boton = $total_imagenes > 8; // Si hay más de 8 imágenes, mostrar botón
  $imagenes_a_mostrar = $mostrar_boton ? 7 : min(8, $total_imagenes); // 7 + botón o máximo 8
  ?>
  
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
    
    <!-- IMAGEN PRINCIPAL (Imagen 1) -->
    <div class="lg:col-span-2 relative">
      <a data-fancybox="gallery" href="<?php echo esc_url($imagenes[0]['url']); ?>">
        <img src="<?php echo esc_url($imagenes[0]['url']); ?>"
             alt="<?php echo esc_attr($imagenes[0]['alt']); ?>"
             class="w-full h-[400px] object-cover rounded-lg shadow-lg">
      </a>
    </div>

    <!-- GRILLA SUPERIOR (Imágenes 2-5) -->
    <div class="grid grid-cols-2 grid-rows-2 gap-2">
      <?php for($i = 1; $i <= 4 && $i < $total_imagenes; $i++): ?>
        <a data-fancybox="gallery" href="<?php echo esc_url($imagenes[$i]['url']); ?>">
          <img src="<?php echo esc_url($imagenes[$i]['url']); ?>"
               alt="<?php echo esc_attr($imagenes[$i]['alt']); ?>"
               class="w-full h-48 object-cover rounded-lg shadow">
        </a>
      <?php endfor; ?>
    </div>
  </div>

  <!-- GRILLA INFERIOR (Imágenes 6-8 o 6-7 + Botón) -->
  <?php if($total_imagenes > 5): ?>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 mt-2">
    <?php
    // Calcular cuántas imágenes mostrar en la fila inferior
    $inicio_fila_inferior = 5;
    $fin_fila_inferior = $mostrar_boton ? 7 : min($total_imagenes, 8);
    
    // Mostrar imágenes normales de la fila inferior
    for($i = $inicio_fila_inferior; $i < $fin_fila_inferior; $i++):
    ?>
      <a data-fancybox="gallery" href="<?php echo esc_url($imagenes[$i]['url']); ?>">
        <img src="<?php echo esc_url($imagenes[$i]['url']); ?>"
             alt="<?php echo esc_attr($imagenes[$i]['alt']); ?>"
             class="w-full h-40 object-cover rounded-lg shadow">
      </a>
    <?php endfor; ?>
    
    <?php if($mostrar_boton): ?>
    <!-- BOTÓN "VER GALERÍA" -->
    <a data-fancybox="gallery" href="<?php echo esc_url($imagenes[7]['url']); ?>" class="relative group">
      <div class="absolute inset-0 bg-gray-900 bg-opacity-70 flex flex-col items-center justify-center rounded-lg shadow-lg cursor-pointer transition-opacity duration-300 group-hover:bg-opacity-80">
        <span class="text-white text-lg font-bold"><?php echo esc_html($t['ver_galeria']); ?></span>
        <span class="text-white text-sm mt-1">(+<?php echo $total_imagenes - 7; ?> <?php echo esc_html($t['fotos']); ?>)</span>
      </div>
      <img src="<?php echo esc_url($imagenes[7]['url']); ?>"
           alt="<?php echo esc_attr($imagenes[7]['alt']); ?>"
           class="w-full h-40 object-cover rounded-lg shadow-lg">
    </a>
    
    <?php
    // Enlaces ocultos para las imágenes restantes (desde la 8 en adelante)
    for($j = 8; $j < $total_imagenes; $j++):
    ?>
      <a data-fancybox="gallery" href="<?php echo esc_url($imagenes[$j]['url']); ?>" class="hidden"></a>
    <?php endfor; ?>
    
    <?php endif; ?>
  </div>
  <?php endif; ?>
</section>
<?php endif; ?>

     <section class="mx-2 mt-2">
                          <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/content', 'page-hotel' );

                        endwhile; // End of the loop.
                        ?>
                      </section>

                     

                    </main><!-- #main -->

                    
            </div>
            <div class="w-full md:w-3/12 lg:w-3/12 xl:w-3/12">
                 <div class=" mt-1 mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
					 
					<?php
if (defined('ICL_LANGUAGE_CODE')) {
    if (ICL_LANGUAGE_CODE == 'en') {
        echo do_shortcode('[contact-form-7 id="d5be5f8" title="Form Hotel En"]');
    } elseif (ICL_LANGUAGE_CODE == 'es') {
        echo do_shortcode('[contact-form-7 id="d042915" title="Form Hotel Es"]');
    } elseif (ICL_LANGUAGE_CODE == 'fr') {
        echo do_shortcode('[contact-form-7 id="2f00aef" title="Form Hotel Fr"]');
    } elseif (ICL_LANGUAGE_CODE == 'it') {
        echo do_shortcode('[contact-form-7 id="5bcd8cc" title="Form Hotel It"]');
    } elseif (ICL_LANGUAGE_CODE == 'pt-br') {
        echo do_shortcode('[contact-form-7 id="d142978" title="Form Hotel Pt-br"]');
    } else {
        // idioma por defecto (ejemplo: español)
        echo do_shortcode('[contact-form-7 id="d042915" title="Form Hotel Es"]');
    }
}
?>
					 

            </div>
           </div>
    </div>
	</div>
</section>

<!-- Modal -->
<!-- Modal -->
<div 
    id="mapModal" 
    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4"
    style="display: none;"
    onclick="closeMapModal(event)">
    
    <div 
        class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden"
        onclick="event.stopPropagation()">
        
        <!-- Header del Modal -->
        <div class="bg-gradient-to-r from-red-600 to-red-800 text-white p-6 relative">
            <button 
                onclick="closeMapModal()" 
                class="absolute top-4 right-4 text-white hover:text-gray-200 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            <h2 class="text-2xl font-bold mb-2"><?php echo esc_html($nombre); ?></h2>
            <div class="flex items-start gap-2">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <p class="text-blue-100"><?php echo esc_html($direccion); ?></p>
            </div>
        </div>
        
        <!-- Contenido del Modal -->
        <div class="p-6">
            <?php if ($ubicacion): ?>
                <!-- Mapa -->
                <div class="acf-map rounded-lg overflow-hidden shadow-lg" data-zoom="16">
                    <div class="marker" 
                         data-lat="<?php echo esc_attr($ubicacion['lat']); ?>" 
                         data-lng="<?php echo esc_attr($ubicacion['lng']); ?>">
                        <h4 class="font-bold text-lg"><?php echo esc_html($nombre); ?></h4>
                        <p class="text-gray-600"><?php echo esc_html($direccion); ?></p>
                    </div>
                </div>
                
                <!-- Botón de Google Maps -->
                <div class="mt-4 flex gap-3">
                    <a 
                        href="https://www.google.com/maps/search/?api=1&query=<?php echo esc_attr($ubicacion['lat']); ?>,<?php echo esc_attr($ubicacion['lng']); ?>" 
                        target="_blank"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 text-center">
                        <?php echo esc_html($t['abrir_google_maps']); ?>
                    </a>
                   
                </div>
            <?php else: ?>
                <p class="text-gray-500 text-center py-8"><?php echo esc_html($t['no_ubicacion']); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php

get_footer();
