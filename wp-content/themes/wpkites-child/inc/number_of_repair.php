<?php
function enqueue_my_scripts($hook) {
    if ( 'post-new.php' != $hook ) {
        return;
    }
    $count_posts = wp_count_posts('repairs');
    $published_posts = ($count_posts->publish)+1;
    $data_passed=array(
        'title_of_post'=>$published_posts,
    );
    wp_enqueue_script('myscript', get_stylesheet_directory_uri() . '/inc/myscript.js', array(), '', true);
    wp_add_inline_script('myscript','var data_passed='.json_encode($data_passed),'before');
}
add_action('admin_enqueue_scripts', 'enqueue_my_scripts');


function enqueue_my_scripts_popap($hook) {
    if ( 'post.php' != $hook ) {
        return;
    }
    wp_enqueue_script('myscript_popap', get_stylesheet_directory_uri() . '/inc/myscript_popap.js', array(), '', true);
}
add_action('admin_enqueue_scripts', 'enqueue_my_scripts_popap');