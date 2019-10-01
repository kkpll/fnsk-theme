<?php

if( !defined( 'ABSPATH') ){
    exit;
}

if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ){
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

$fnsk = new Src\Fnsk();

// //テーマ切り替え時
// function fnsk_activate(){
// }
// add_action( 'after_switch_theme', 'fnsk_activate' );
