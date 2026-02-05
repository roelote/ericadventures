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

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

    <?php $title_moto = get_field('title_moto'); ?>

        <table class="table-moto">
            <tbody>
                <tr>
                    <td colspan="2"><strong><?php echo $title_moto ?></strong></td>
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