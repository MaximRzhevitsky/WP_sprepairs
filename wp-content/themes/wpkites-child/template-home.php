<?php
/**
 * Template name: Homepage
 */

get_header();
global $template;
wpkites_breadcrumbs();
?>
    <section class="page-section-space blog bg-default <?php echo esc_attr($wpkites_page_class);?>" id="content">
        <?php if ( is_user_logged_in() ) : ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="q-search">
                            <div class="q-search-wrap">
                                <form method="POST" action="<?php echo home_url("/repairs"); ?>">
                                    <label><?php _e('Введіть номер телефону'); ?></label>
                                    <input id="phone_customer" name="phone_customer">
                                    <button type="submit" class="btn btn-yellow"><?php _e('Шукати'); ?></button></br></br>
                                </form>
                            </div>
                        </div>

                        <div class="q-search">
                            <div class="q-search-wrap">
                                <form method="POST" action="<?php echo home_url("/repairs"); ?>">
                                    <label><?php _e('Введіть назву компанії'); ?></label>
                                    <input id="phone_customer" name="company_customer">
                                    <button type="submit" class="btn btn-yellow"><?php _e('Шукати'); ?></button></br></br>
                                </form>
                            </div>
                        </div>

                    </div>

<!--                    <div class="col-md-4 col-sm-2">-->
<!--                        <form method="POST" action="--><?php //echo home_url("/repairs"); ?><!--">-->
<!--                            <label>--><?php //_e('Минулий:'); ?><!--</label>-->
<!--                            <button type="submit" name="week" value="">--><?php //_e('тиждень'); ?><!--</button>-->
<!--                            <button type="submit" name="month" value="">--><?php //_e('місяць'); ?><!--</button>-->
<!--                            <button type="submit" name="year" value="">--><?php //_e('рік'); ?><!--</button>-->
<!--                        </form>-->
<!--                    </div>-->

                    <div class="col-sm-4 col-md-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <form method="POST" action="<?php echo home_url("/repairs"); ?>">
                                    <div class="input-group">
                                        <div class="input-group-addon"><?php _e('від'); ?>&nbsp;</div>
                                        <input type="date" class="form-control" name="date_start">
                                    </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-addon"><?php _e('по'); ?>&nbsp;</div>
                                    <input type="date" class="form-control" name="date_finish">
                                </div>
                            </div>
                            <input type="submit" value="<?php _e('Звіт'); ?>">
                            </form>
                        </div>

                    </div>
                </div>
                </br>



                <div class="col-lg-12 col-md-12 col-sm-12">
                    <table id = "empInfo" class="table table-hover table-bordered table-dark">
                        <thead>
                        <tr>
                            <th scope="col"><?php _e('Дата'); ?></th>
                            <th scope="col"><?php _e('Час'); ?></th>
                            <th scope="col">№ <?php _e('заказу'); ?></th>
                            <th scope="col"><?php _e('Телефон'); ?> </th>
                            <th scope="col"><?php _e('Інструмент'); ?></th>
                            <th width="15%" scope="col"><?php _e('Скарга'); ?></th>
                            <th scope="col"><?php _e('Повтор'); ?></th>
                            <th scope="col"><?php _e('Узгоджено'); ?></th>
                            <th scope="col"><?php _e('Готовність'); ?></th>
                            <th scope="col"><?php _e('Видача'); ?></th>
                            <th scope="col"><?php _e('Фірма'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                     <?php

                         $repairs_query = new WP_Query(array('post_type' => 'repairs','order'=>'DESC'));
                        $i = 0;
                        if ($repairs_query->have_posts()) :
                            while ($repairs_query->have_posts()) :
                                $repairs_query->the_post();
                                ?>
                                <tr>
                                    <th scope="row"><?php echo esc_html(get_the_date()); ?></th>
                                    <th scope="row"><?php echo esc_html(get_the_time( 'H:i:s' )); ?></th>
                                    <td>
                                        <?php the_title();?>
                                    </td>
                                    <td> <?php echo carbon_get_post_meta( get_the_ID(), 'phone_customer' );?></td>
                                    <td> <a class="rm-h4" href="<?php the_permalink();?>"><?php $instrument=carbon_get_post_meta( get_the_ID(), 'instrument_type' );
                                        echo uppercase($instrument); ?></a></td>
                                    <td><?php $complaint= carbon_get_post_meta( get_the_ID(), 'complaint' );
                                        echo uppercase($complaint); ?>
                                    </td>
                                    <td<?php if( carbon_get_post_meta( get_the_ID(), 'repeat' ) ):  ?>
                                        class="bg-warning"
                                    <?php endif; ?>>
                                        <?php $repeat_number=carbon_get_post_meta( get_the_ID(), 'repeat_number' ); ?>
                                        <a class="rm-h4" href="<?php echo $repeat_number;?>" style="color: #0c0c0c;"> <?php echo $repeat_number; ?></a>

                                    </td>
                                    <td <?php if( carbon_get_post_meta( get_the_ID(), 'agreement' ) ): ?>
                                        class="bg-success"
                                    <?php else: ?>
                                            class="bg-danger"><?php endif; ?>
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                    </td>
                                    <td <?php if( carbon_get_post_meta( get_the_ID(), 'done' ) ):  ?>
                                        class="bg-success"
                                    <?php else: ?>
                                            class="bg-danger"><?php endif; ?>
                                        <?php if( carbon_get_post_meta( get_the_ID(), 'done' ) ):
                                            calculate_total_cost(get_the_ID()); endif;?>
                                    </td>
                                    <td <?php if( carbon_get_post_meta( get_the_ID(), 'given' ) ):  ?>
                                        class="bg-success"
                                    <?php else: ?>
                                            class="bg-danger"><?php endif; ?>
                                    </td>
                                    <td> <?php $company= carbon_get_post_meta( get_the_ID(), 'company' );
                                        echo uppercase($company); ?></td>
                                </tr>
                        <?php    endwhile; endif; ?>
                 <?php    wp_reset_postdata(); ?>
                        </tbody>
                    </table>
                </div>

            </div>
        <?php else: ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <div class="q-search">
                            <div class="q-search-wrap">
                                <form method="POST" action="<?php echo home_url("/repairs"); ?>">
                                    <label><?php _e('Введить номер телефону'); ?></label>
                                    <input id="phone_customer" name="phone_customer">
                                    <button type="submit" class="btn btn-yellow"><?php _e('Шукати'); ?></button></br></br>
                                </form>
                            </div>
                            <div class="q-search">
                                <div class="q-search-wrap">
                                    <form method="POST" action="<?php echo home_url("/repairs"); ?>">
                                        <label><?php _e('Введить назву компанії'); ?></label>
                                        <input id="phone_customer" name="company_customer">
                                        <button type="submit" class="btn btn-yellow"><?php _e('Шукати'); ?></button></br></br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif;
    ?>


    </section>
<?php get_footer();
