<?php get_header(); ?>

<?php 
    $term = get_queried_object();
    $term_id = $term->term_id;
    $term_name = $term->name;
    $term_description = $term->description;
    $tax_name = $term->taxonomy;
    
    $term_sub_title = get_field('sub_title' , $tax_name . '_' . $term_id);

    $term_labels = [
        32 => 'คอร์ส',
        33 => 'การวางระบบ',
        34 => 'ที่ปรึกษา'
    ];
?>

<div class="container archive-header">
    <div class="inner">
        <div class="archive-box service bg-orange">
            <div class="archive-detail">
                <h1 class="archive-title"><?= esc_html($term_name); ?></h1>
                <h2 class="archive-sub-title"><?= esc_html($term_sub_title); ?></h2>
                <p class="archive-description">
                    <?= esc_html($term_description); ?>
                </p>
            </div>
        </div>            
    </div>
</div>

<div class="container archive-content">
    <div class="inner">
        <h2 class="title">
            <?php
                    if (isset($term_labels[$term_id])) {
                        echo '<span style="color: #f36523;">' . esc_html($term_labels[$term_id]) . '</span>';
                    } else {
                        echo '';
                    }
                ?>
            </span>
            ทั้งหมด
        </h2>
        <div class="grid grid-listing">
            <?php
                $loop = new WP_Query(array( 
                    'post_type' => 'product', 
                    'posts_per_page' => -1 ,
                    'tax_query' => array(
                    array(
                        'taxonomy' => $tax_name,
                        'field' => 'term_id',
                        'terms' => $term_id,
                    ),
                    ),
                ));
            ?> 

            <?php if ( $loop->have_posts() ) : ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                
                <div class="listing">
                    <?php 
                        $file = get_field('pdf_attachment');
                        $file_url = wp_get_attachment_url($file); 
                        $post_id = get_the_ID();
                        $post_title = get_the_title();
                    ?>

                    <div class="thumbnail-listing">
                        <a href="<?= esc_url($file_url); ?>" target="_blank" class="img-link">
                            <?php echo get_the_post_thumbnail($post_id,'full',array('class' => 'img-thumbnail')); ?>
                        </a>
                    </div>
                    <div class="content-listing">
                        <a href="<?= esc_url($file_url); ?>" target="_blank">
                            <h2 class="title-listing">
                                <?= esc_html($post_title); ?>
                            </h2> 
                        </a>
                    </div>
                </div>

                <?php endwhile; ?>
            <?php else : ?>
                <p style="grid-column: 1 / 4; text-align:center; font-family: LINESeedSansTH; font-size:3em; font-weight: bold; color:#fff; margin: 50px!important;">Coming soon</p>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>