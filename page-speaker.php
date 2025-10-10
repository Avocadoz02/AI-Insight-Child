<?php
/**
 * Template Name: Speaker
 */
?>

<?php get_header(); ?>

<div id="primary">
    <div class="container archive-header">
        <div class="inner">
            <div class="archive-box bg-ai">
                <div class="archive-detail">
                    <h1 class="archive-title">วิทยากร</h1>
                    <p class="archive-description">
                        AI Insight เรารวมทีมวิทยากรผู้เชี่ยวชาญจากหลากหลายสาขา ทุกคอร์สถูกถ่ายทอดโดยผู้รู้ตัวจริงในแต่ละด้าน เพื่อให้คุณได้เรียนรู้จากประสบการณ์ตรงและต่อยอดทักษะได้อย่างมั่นใจในโลกยุคใหม่ของ AI
                    </p>
                </div>
            </div> 
            <img 
                src="/wp-content/uploads/2025/07/full-circle.webp"
                alt="Full Circle"
                class="full-circle-bg"
            />
        </div>
    </div>

    <div class="container archive-content">
        <div class="inner">
            <div class="grid grid-speaker-listing">
                <?php
                    $speakers = get_terms(array(
                        'taxonomy' => 'speaker',
                        'hide_empty' => false,
                    ));

                    if (!empty($speakers) && !is_wp_error($speakers)) :
                    foreach ($speakers as $speaker) :
                        $term_id = $speaker->term_id;
                        $term_name = $speaker->name;
                        $term_name_display = str_replace('อาจารย์', 'อ.', $term_name);
                        $term_description = $speaker->description;
                        $term_link = get_term_link($speaker);
                        $thumbnail_id = get_field('speaker_thumbnail', 'speaker_' . $term_id);
                        $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'full');
                ?>
                    <div class="listing">
                        <div class="thumbnail-listing">
                            <a href="<?= esc_url($term_link); ?>" class="img-link">
                                <?php if ($thumbnail_url): ?>
                                    <img src="<?= esc_url($thumbnail_url); ?>" class="img-thumbnail" />
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="content-listing">
                            <a href="<?= esc_url($term_link); ?>">
                                <h2 class="title-listing"><?= esc_html($term_name_display); ?></h2>
                            </a>
                            <p class="description-listing">
                                <?= esc_html($term_description); ?>
                            </p>
                        </div>
                    </div>
                <?php
                    endforeach;
                    endif;
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>