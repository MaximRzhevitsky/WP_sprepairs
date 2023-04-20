<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wpkites
 */
get_header();

wpkites_breadcrumbs();

if((get_post_meta(get_the_ID(),'wpkites_site_layout', true ) == 'wpkites_site_layout_stretched') || (get_theme_mod('single_post_sidebar_layout','right')=='stretched')) {
    $wpkites_page_class='stretched';   
}
else {
    $wpkites_page_class='';
}

$wpkites_page_sidebar = get_post_meta(get_the_ID(),'wpkites_page_sidebar', true );
if($wpkites_page_sidebar =='') { 
    $wpkites_page_sidebar = 'sidebar-1'; 
}  
?>
<section class="page-section-space blog bg-default <?php echo esc_attr($wpkites_page_class);?>" id="content">
    <div class="container<?php echo esc_html(wpkites_single_post_container());?>">
        <div class="row">           
            <?php

                echo '<div class="col-lg-12 col-md-12 col-sm-12">';
            while (have_posts()): the_post();
                    get_template_part('template-parts/content', 'repairs');
            endwhile;
            echo '</div>';             
            if(((get_theme_mod('single_post_sidebar_layout','right')=='right') && get_post_meta(get_the_ID(),'wpkites_site_layout', true )=='') ||  get_post_meta(get_the_ID(),'wpkites_site_layout', true )=='wpkites_site_layout_right'):
                echo '<div class="col-lg-4 col-md-5 col-sm-12"><div class="sidebar s-l-space">';
//                   dynamic_sidebar($wpkites_page_sidebar);
                echo '</div></div>';
            endif;?>
        </div>

       <?php echo do_shortcode('[print-me target="body"/]'); ?>
    </div>
</section>
<?php get_footer(); ?>