<?php

function calculate_total_cost($id){
    global $wpdb;

        $parts = carbon_get_post_meta( $id, 'parts' ) ;
        $works = carbon_get_post_meta( $id, 'works' ) ;
            $total=0;
            foreach ($parts as $part):
                $total += $part['parts_cost'];
            endforeach;

            foreach ($works as $work):
                $total += $work['work_cost'];
            endforeach;

    $meta_key   = 'total_repair_cost';
    $meta_value = $total;

    $wpdb->query(
        $wpdb->prepare(
            "
		INSERT INTO $wpdb->postmeta
		( post_id, meta_key, meta_value )
		VALUES ( %d, %s, %s )
		",
            $id,
            $meta_key,
            $meta_value
        )
    );


return $total;
    }







