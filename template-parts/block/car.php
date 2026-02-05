<?php

/**
 *  block gallery
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'item-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'item';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}



?>

<!--Markup for citys-->

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> px-2 xl:px-10">

    <?php $price_day = get_field('price_day'); ?>
    <?php $price_week = get_field('price_week'); ?>
    <?php $km_day = get_field('km_day'); ?>
    <?php $note = get_field('notas'); ?>

        <?php
        
        if (ICL_LANGUAGE_CODE == 'en') {
            $priceday = "Prices per day";
            $priceweek = "PRICE PER WEEK";
            $pricekm = "FREE KM PER DAY";
         }
        if (ICL_LANGUAGE_CODE == 'es') {
            $priceday = "Precio por día";
            $priceweek = "Precio por Semana";
            $pricekm = "KM LIBRES POR DÍA";
         }
    
        if (ICL_LANGUAGE_CODE == 'it') { 
            $priceday = "PREZZO AL GIORNO";
            $priceweek = "PREZZO PER SETTIMANA";
            $pricekm = "KM LIBERI PER GIORNATA"; 
         }
        if (ICL_LANGUAGE_CODE == 'pt-br') { 
            $priceday = "PREÇO POR DIA";
            $priceweek = "PREÇOS POR SEMANA";
            $pricekm = "KM LIVRES POR DIA";
         }
    
        if (ICL_LANGUAGE_CODE == 'fr') { 
            $priceday = "PRIX PAR JOUR";
            $priceweek = "PRIX PAR SEMAINE";
            $pricekm = "KM LIBRES PAR JOUR";
         }
    

        ?>

        <table class="table-car w-full mb-4">
            <tbody>
                <tr>
                    <td class="uppercase"><?=$priceday?></td>
                    <td class="uppercase"><?=$priceweek?></td>
                    <td class="uppercase"><?=$pricekm?></td>
                </tr>
                <tr>
                    <td><?=$price_day?></td>
                    <td><?=$price_week?></td>
                    <td><?=$km_day?></td>
                </tr>
                <tr>
                    <td colspan="3"><?=$note?></td>
                </tr>
                <?php
                  // Check rows exists.
                     if( have_rows('prices') ):

                        // Loop through rows.
                        while( have_rows('prices') ) : the_row(); ?>

                            <tr>
                                <td><strong><?=get_sub_field('range') ?></strong></td><td><?=get_sub_field('price') ?></td>
                            </tr>
                
                        <?php endwhile;
                     endif;
                ?>

            </tbody>
        </table>

</div>