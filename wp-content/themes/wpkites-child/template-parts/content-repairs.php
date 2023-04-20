
        <div class="entry-meta">
            <header class="entry-header">
                <h5 class="entry-title"><?php _e('Акт виконаних робіт'); ?>&nbsp;№&nbsp;<?php the_title();?>
                </h5>
            </header>
                <div class="entry-content-left col-lg-12 col-md-12">
                    <p><?php _e('Інструмент:');?>&nbsp;
                        <?php $instrument=carbon_get_post_meta( get_the_ID(), 'instrument_type' );
                        echo uppercase($instrument); ?>
                        </p>
                        <p><?php _e('Замовник:');?>&nbsp;
                            <?php $company = carbon_get_post_meta(get_the_ID(), 'company');
                            if($company!="") : echo uppercase($company);
                            else: echo carbon_get_post_meta( get_the_ID(), 'phone_customer');  endif;?>
                        </p>
                 <?php  $parts = carbon_get_post_meta( get_the_ID(), 'parts' ) ;
                        $works = carbon_get_post_meta( get_the_ID(), 'works' ) ;
                        $total=0;

                        if($works || $parts): ?>
<div class="col-sm-12 col-md-12">

            <?php if($works): ?>
                <div class="col-md-6 col-sm-12 <?php if($parts): echo ' left'; endif;?>">
    <table class="act_form table table-bordered">
        <thead>
        <tr>
            <th class="col_name" scope="col"><?php _e('Найменування&nbsp;робіт(послуги)');?></th>
            <th class="col_value" scope="col"><?php _e('Вартість');?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php foreach ($works as $work): ?>
            <td> <?php $work_elem= $work['works'];
                echo uppercase($work_elem); ?>
            </td>
            <td> <?php echo intval($work['work_cost']);?> &nbsp;<?php _e('грн'); ?>
               <?php $total += intval($work['work_cost']); ?></td></tr>
        <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    <?php endif; ?>
    <?php if($parts): ?>

        <div class="col-md-6 col-sm-12 <?php if($works): echo ' right'; endif;?>">
    <table class="act_form table table-bordered">
        <thead>
        <tr>
            <th class="col_name" scope="col"><?php _e('Запчастини');?></th>
            <th class="col_value" scope="col"><?php _e('Вартість');?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php foreach ($parts as $part): ?>
            <td> <?php $part_elem=$part['parts'];
                echo uppercase($part_elem); ?>
                </td>
            <td> <?php echo $part['parts_cost'];?> &nbsp;<?php _e('грн'); ?> </td></tr>
        <?php $total += intval($part['parts_cost']);
        endforeach;?>

        </tbody>
    </table>

    </div>
    <?php endif; ?>
        <div class="total col-6">
            <table class="table-bordered"><tr><td> <?php _e('Загалом');?>&nbsp;&nbsp;&nbsp;<?php echo $total; ?> &nbsp;<?php _e('грн'); ?></td></tr></table>
        </div>
</div>
</div>
<?php endif;?>

            <?php
            if(has_post_thumbnail()):?>
                <div class="thumbnail-repairs">
                    <p><?php _e('Доданє фото');?></p>
                    <figure class="post-thumbnail">
                        <?php
                        the_post_thumbnail( 'medium',array('class'=>'img-fluid','alt'=>'blog-image'));?>
                    </figure>
                </div>
            <?php endif;?>
            </div>
</br></br></br>


