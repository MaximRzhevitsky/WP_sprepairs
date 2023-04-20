<?php

/**
 * Template name: Archive-repairs
 */

get_header();

global $template;
wpkites_breadcrumbs();
    ?>
<section class="page-section-space blog bg-default" id="content">
<div class="container<?php echo esc_html(wpkites_blog_post_container());?>">
    <div class="row">
    <?php
    echo '<div class="col-lg-12 col-md-12 col-sm-12">';

    if($_POST['phone_customer']!== null):
    filter_repairs_by_phone($_POST);
   else:
   if($_POST['company_customer']!== null):
    filter_repairs_by_company($_POST);
    else:
        filter_repairs_by_date($_POST);
  endif;
  endif;
                echo '</div>';


    echo '</div></div>';
   echo do_shortcode('[print-me target="body"/]');
      ?>
    </div>

    </div>

</section>

<?php get_footer();
