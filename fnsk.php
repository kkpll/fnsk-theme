<?php
/*
Plugin Name: Fnsk
Description: Description
Version: 1.0.0
Author: DAISUKE IZUTSU
Text Domain: fnsk
Domain Path: /languages
*/

if( !defined( 'ABSPATH') ){
    exit;
}

if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ){
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

$fnsk = new Src\Init();
