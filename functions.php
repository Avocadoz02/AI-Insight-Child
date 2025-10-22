<?php
/**
 * Enqueue child styles.
 */
function child_enqueue_styles() {
	wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() . '/style.css', array(), 100 );
}

// add_action( 'wp_enqueue_scripts', 'child_enqueue_styles' ); // Remove the // from the beginning of this line if you want the child theme style.css file to load on the front end of your site.

/**
 * Add custom functions here
 */

function shared_styles_for_special_pages() {
    if (
        is_tax('speaker') || // taxonomy-speaker.php
        is_tax('service') || // taxonomy-service.php
        is_page_template('template-special.php') || // ถ้ามี template พิเศษ
        is_page_template( 'page-speaker.php' ) || // page-speaker.php
        is_search() || // search.php
        is_front_page() || // Home page
        is_page('home-test') // Home page by slug
    ) {
        wp_enqueue_style(
            'special-style',
            get_stylesheet_directory_uri() . '/special-page-style.css',
            array(),
            '1.2.21'
        );
    }
}
add_action('wp_enqueue_scripts', 'shared_styles_for_special_pages');


function enqueue_product_single_styles() {
    if ( is_singular('product') ) {
        wp_enqueue_style(
        'product-single-style',
        get_stylesheet_directory_uri() . '/single-post-style.css',
            array(),
            null
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_product_single_styles');
