<?php
function filter_repairs_by_phone($data){

 $phone=$data['phone_customer'];

	$args = array(
        'post_type'=>'repairs',
		'posts_per_page' => -1,
        'meta_query' => array(
            array('key' => '_phone_customer',
                'value' => $phone,
                'compare' => '=',)
        ));

	$custom_filter = new WP_Query($args);
	if(!empty($_POST)){
		if ( $custom_filter->have_posts() ) :
			while ( $custom_filter->have_posts() ) :
				$custom_filter->the_post();
                get_template_part( 'template-parts/content-repairs' );
			endwhile;
		else : get_template_part( 'template-parts/content-none' );
		endif;
    }
    wp_reset_postdata();
}


    function filter_repairs_by_company($data){
        $company=$data['company_customer'];
        $args = array(
            'post_type'=>'repairs',
            'posts_per_page' => -1,
            'meta_query' => array(
                array('key' => '_company',
                    'value' => $company,
                    'compare' => '=',)
            ));

        $custom_filter = new WP_Query($args);
        if(!empty($_POST)){
            if ( $custom_filter->have_posts() ) :
                while ( $custom_filter->have_posts() ) :
                    $custom_filter->the_post();
                    get_template_part( 'template-parts/content-repairs' );
                endwhile;
            else : get_template_part( 'template-parts/content-none' );
            endif;
        }
        wp_reset_postdata();
    }


function filter_repairs_by_date($data)
{
    $args = array(
        'post_type'=>'repairs',
        'meta_query' => array(
            array('key' => 'done',
                'value' => 'yes',
                'compare' => '=')),
            'relation' => 'AND',
            'date_query' => array(),
            'orderby' => 'date');

//    if(isset($data['week'])):
//        $week = date('W');
//        if ($week != 1) :
//        $lastweek = $week - 1;
//        else :
//        $lastweek = 52;
//        endif;
//        if ($lastweek != 52) :
//        $year = date('Y');
//        else:
//        $year = date('Y') -1;
//        endif;
//        array_push($args['date_query'], array(
//            'week' => $lastweek,
//            'year' => $year));
//        endif;
//
//    if(isset($data['month'])):
//        $month = date('n');
//        if ($month != 1) :
//            $lastmonth = $month - 1;
//        else :
//            $lastmonth = 12;
//        endif;
//        if ($lastmonth != 12) :
//            $year = date('Y');
//        else:
//            $year = date('Y') -1;
//        endif;
//        array_push($args['date_query'], array(
//            'monthnum' => $lastmonth,
//            'year' => $year));
//        endif;
//
//    if(isset($data['year'])):
//        $year = date('Y')-1;
//        array_push($args['date_query'], array(
//            'year' => $year,));
//    endif;

    if($data['date_start'] && $data['date_finish'] !== null):
        $after = $data['date_start'];
        $before = $data['date_finish'];

        array_push($args['date_query'], array(
            'after'     => $after,
            'before'    => $before));
    endif;

    $custom_filter = new WP_Query($args);
    $count_posts = $custom_filter->post_count;
    $total_work_cost=0;
    $total_spare_cost=0;
    $total = 0;

    if (!empty($_POST)){

                $total_cost = get_post_meta( get_the_ID(), 'total_repair_cost', true  );
                $total += intval($total_cost);
?>

<section class="page-section-space blog bg-default" id="content">
        <div class="container<?php echo esc_html(wpkites_blog_post_container());?>">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <table class="table table-sm table-bordered table-order">
                        <thead>
                        <tr>
                            <th scope="col"><?php _e('Номер ремонту');?></th>
                            <th scope="col"><?php _e('Найменування');?></th>
                            <th scope="col"><?php _e('Запчастини');?></th>
                            <th scope="col"><?php _e('Вартість робіт');?></th>
                        </tr>
                        </thead>
                        <tbody>
                       <?php if ($custom_filter->have_posts()) :
                        while ($custom_filter->have_posts()) :
                        $custom_filter->the_post(); ?>

                        <tr>
                            <td><?php the_title();?></td>
                            <td> <?php $instrument=carbon_get_post_meta( get_the_ID(), 'instrument_type' );
                                echo uppercase($instrument);?></td>
                            <td><?php $parts = carbon_get_post_meta( get_the_ID(), 'parts' ) ;
                                foreach ($parts as $part): ?>
                                <?php echo $part['parts']?> &nbsp;-&nbsp;<?php echo $part['parts_cost']?> &nbsp;<?php _e('грн'); echo '</br>'; ?>
                                    <?php $total_spare_cost += $part['parts_cost'];
                                endforeach; ?>
                            </td>
                             <td>
                            <?php $works = carbon_get_post_meta( get_the_ID(), 'works' ) ;
                                     foreach ($works as $work):?>
                                    <?php echo $work['works']?> &nbsp;-&nbsp;<?php echo $work['work_cost'];?> &nbsp;<?php _e('грн');
                                     $total_work_cost += $work['work_cost']; echo '</br>'; ?>
                                   <?php  endforeach; ?></td>
                                   </tr>
                                 <?php endwhile;
                                    endif;   ?>
                              <tr>
                                 <td>
                                     <?php _e('Кількість ремонтів');?> &nbsp;-&nbsp;<?php echo $count_posts ; ?>
                                 </td>
                                  <td></td>
                                  <td>
                                      <?php _e('Витрати на запчастини');?> &nbsp;-&nbsp;<?php echo $total_spare_cost ; ?> &nbsp;<?php _e('грн'); ?>
                                  </td>
                            <td> <?php _e('Загалом');?> &nbsp;-&nbsp;<?php echo $total_work_cost ; ?> &nbsp;<?php _e('грн'); ?></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
        </div>
    </section>
<?php
}
wp_reset_postdata();
} ?>