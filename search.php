<?php
/**
 * Search result page.
 */
get_header();
// global $wp_query;

// echo '<pre/>';
// print_r($wp_query);
// wp_die();


$search_term = get_search_query();

// Custom query รวม post และ custom post type
$args = array(
    'post_type' => array('post', 'product'),
    'posts_per_page' => -1,
    's' => $search_term,
    'orderby' => 'post_type',
);

$custom_query = new WP_Query($args);
?>

<div class="container archive-header">
    <div class="inner">
        <div class="archive-box service bg-orange">
            <div class="archive-detail">
                <h1 class="archive-title">
                    <?php _e('ผลการค้นหาของ', 'locale'); ?>: "<?php echo esc_html($search_term); ?>"
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="container archive-content">
    <div class="inner">
    <?php    
        $service_terms = array('training', 'system-implementation', 'consulting');

        // วนลูปแต่ละ taxonomy term
        foreach ($service_terms as $term_slug) {
            $product_query = new WP_Query(array(
                'post_type' => 'product',
                's' => $search_term,
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'service',
                        'field' => 'slug',
                        'terms' => $term_slug
                    )
                )
            ));

            if ($product_query->have_posts()) {
                echo '<h2 class="tax-title">หมวดหมู่บริการ: ' . esc_html($term_slug) . '</h2>';
                echo '<div class="grid grid-listing">';
                while ($product_query->have_posts()) : $product_query->the_post();
                    $file = get_field('pdf_attachment');
                    $file_url = wp_get_attachment_url($file);
                    ?>
                    <div class="listing">
                        <div class="thumbnail-listing">
                            <a href="<?= esc_url($file_url); ?>" target="_blank" class="img-link">
                                <?= get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-thumbnail')); ?>
                            </a>
                        </div>
                        <div class="content-listing">
                            <a href="<?= esc_url($file_url); ?>" target="_blank">
                                <h2 class="title-listing"><?= esc_html(get_the_title()); ?></h2>
                            </a>
                            <p class="excerpt-listing"><?= get_the_excerpt(); ?></p>
                        </div>
                    </div>
                    <?php
                endwhile;
                echo '</div>';
            }
            wp_reset_postdata();
        }

        // Query สำหรับ post ธรรมดา
        $post_query = new WP_Query(array(
            'post_type' => 'post',
            's' => $search_term,
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        ));

        if ($post_query->have_posts()) {
            echo '<h2 class="tax-title">บทความทั่วไป</h2>';
            echo '<div class="grid grid-listing">';
            while ($post_query->have_posts()) : $post_query->the_post();
                ?>
                <div class="listing">
                    <div class="thumbnail-listing">
                        <a href="<?= get_permalink(); ?>" class="img-link">
                            <?= get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-thumbnail')); ?>
                        </a>
                    </div>
                    <div class="content-listing">
                        <a href="<?= get_permalink(); ?>">
                            <h2 class="title-listing"><?= esc_html(get_the_title()); ?></h2>
                        </a>
                        <p class="excerpt-listing"><?= get_the_excerpt(); ?></p>
                    </div>
                </div>
                <?php
            endwhile;
            echo '</div>';
        }
    ?>
    </div>
</div>

<?php
    wp_reset_postdata(); 
    get_footer(); 
?>