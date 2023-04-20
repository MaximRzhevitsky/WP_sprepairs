<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action( 'carbon_fields_register_fields', 'max_carbon' );
function max_carbon() {

    Container::make( 'post_meta', 'Реєстраційні дані' )
        ->where( 'post_type', '=', 'repairs' )
        ->add_fields( array(
                Field::make( 'text', 'phone_customer', __( 'Телефон замовника' ) ),
                Field::make( 'text', 'company', 'Замовник' ),
                Field::make( 'text', 'instrument_type', 'Інструмент' ),
                Field::make( 'text', 'complaint', 'Скарга' ),
                Field :: factory ( "checkbox" , "repeat" , "Повтор" ) -> set_option_value ( 'yes' ),
                Field::make( 'text', 'repeat_number', 'Попередній номер' ),
));

    Container::make( 'post_meta', 'Роботи' )
        ->where( 'post_type', '=', 'repairs' )
        ->add_fields( array(
            Field::make( 'complex', 'works', '' )
                ->add_fields( array(
    Field::make( 'text', 'works', 'Роботи' ),
    Field::make( 'text', 'work_cost','Вартість робіт'  )
         ->set_attribute( 'type', 'number' ),
                ))));


    Container::make( 'post_meta', 'Запчастини' )
        ->where( 'post_type', '=', 'repairs' )
        ->add_fields( array(
    Field::make( 'complex', 'parts', '' )
        ->add_fields( array(
            Field::make( 'text', 'parts','Запчастини'  ),
            Field::make( 'text', 'parts_cost', 'Вартість запчастини' ),
        ))));

    Container::make( 'post_meta', 'Виконання робіт' )
        ->where( 'post_type', '=', 'repairs' )
        ->add_fields( array(
                Field :: factory ( "checkbox" , "agreement" , "Узгоджено" ) -> set_option_value ( 'yes' ),
                Field :: factory ( "checkbox" , "done" , "Виконано" ) -> set_option_value ( 'yes' ),
                Field :: factory ( "checkbox" , "given" , "Видано" ) -> set_option_value ( 'yes' ),
            ));}