<?php


/**
 * Custom post types for this theme.
 */
require get_stylesheet_directory() . '/inc/post-type.php';



/**
 * Filter function.
 */
require get_stylesheet_directory() . '/inc/filter.php';


/**
 * Enqueue scripts and styles.
 */
function sprepairs_scripts() {
    wp_enqueue_style( 'dark.css', '/wp-content/themes/wpkites/assets/css/');
    wp_enqueue_style( 'default.css', '/wp-content/themes/wpkites/assets/css/');
    wp_enqueue_script('paginate', get_stylesheet_directory_uri() . '/inc/paginate.js', array(), '', true);

}
add_action( 'wp_enqueue_scripts', 'sprepairs_scripts' );


/**
 * Carbon fields.
 */
require get_stylesheet_directory() . '/inc/sp_carbon-fields.php';


/**
 * Enqueue scripts and styles.
 */
require get_stylesheet_directory() . '/inc/number_of_repair.php';


/**
 * Uppercase.
 */
require get_stylesheet_directory() . '/inc/uppercase.php';


/**
 * Calculate.
 */
require get_stylesheet_directory() . '/inc/calculate_total_cost.php';



?>
