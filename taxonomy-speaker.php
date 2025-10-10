<?php get_header(); ?>

<?php 
    $term = get_queried_object();
    $term_id = $term->term_id;
    $term_name = $term->name;
    $term_description = $term->description;
	$tax_name = $term->taxonomy;

    $thumbnail = get_field('speaker_thumbnail', 'speaker_' . $term->term_id);
    $thumbnail_img = wp_get_attachment_image_url($thumbnail, 'full');

?>

<div class="container archive-header">
    <div class="inner">
        <div class="archive-box speaker">
            <div class="archive-thumbnail">
                <img src="<?= esc_url($thumbnail_img) ?>" alt="<?= $term_name; ?>" />
            </div>
            <div class="archive-detail">
                <h1 class="archive-title">
                    <?= esc_html($term_name); ?>
                </h1>
                <p class="archive-description">
                    <?= esc_html($term_description); ?>
                </p>
            </div>
        </div>            
    </div>
</div>

<div class="container archive-content">
    <div class="inner">
        <h2 class="title"><span style="color: #f36523;">หลักสูตรทั้งหมด</span>ของวิทยากร</h2>
        <div class="grid grid-listing">
            <?php
                $loop = new WP_Query(array( 
                    'post_type' => 'product', 
                    'posts_per_page' => -1 ,
                    'tax_query' => array(
						'relation' => 'AND',
                        array(
                            'taxonomy' => $tax_name,
                            'field' => 'term_id',
                            'terms' => $term_id
                        ),
						array(
                            'taxonomy' => 'service',
                            'field' => 'term_id',
                            'terms' => 32
                        )
                    )
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
                            <?= get_the_post_thumbnail($post_id,'full',array('class' => 'img-thumbnail')); ?>
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

                <?php endwhile;?>
            <?php else : ?>
                <p style="grid-column: 1 / 4; text-align:center; font-family: LINESeedSansTH; font-size:3em; font-weight: bold; color:#fff; margin: 50px!important;">Coming soon</p>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>