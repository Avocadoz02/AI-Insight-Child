<?php
/**
 * Single post template file.
 *
 *
 */

get_header();

// $fields = get_fields();
// global $post;
// echo '<pre>';
// var_dump($post);
// echo '</pre>';
// echo '<pre>';
// var_dump($fields);
// echo '</pre>';
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="container">
        <div class="inner">
            <h1 class="product-title"><?php the_title(); ?></h1>
            <div class="product-content">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="product-image">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>
                    
                <?php
                    $pdf = get_field('pdf_attachment');
                    $pdf_url = wp_get_attachment_url($pdf); 
                    if ( $pdf_url ) :
                ?>
                <a href="<?php echo esc_url($pdf_url); ?>" class="btn-download" target="_blank" rel="noopener">
                    <span class="btn-text">รายละเอียดหลักสูตร</span>
                </a>
            </div>
            <?php endif; ?>
        </div>

    </div>

<?php endwhile; endif; ?>


<?php
get_footer();
?>