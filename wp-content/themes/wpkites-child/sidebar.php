<?php
/**
 * Template file for sidebar
 */
//if (is_active_sidebar('sidebar-2')) :
?>
<div class="col-lg-4 col-md-5 col-sm-12">
    <div class="sidebar">
        <h3><?php _e('Пошук за номером телефону'); ?></h3>

        <div class="q-search">
            <div class="container">
                <div class="q-search-wrap">
                    <form method="POST" action="<?php echo home_url("/repairs"); ?>">
                        <input id="phone_customer" name="phone_customer">
                        <button type="submit" class="btn btn-yellow"><?php _e('Шукати'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //endif; ?>
