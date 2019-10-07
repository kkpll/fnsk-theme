<?php
/*
Plugin Name: fnsk
Description: This is fnsk plugin
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

class Fnsk {

    private $plugins = array();

    public function __construct(){

        $this->plugins = array(
            'dashboard' => App\Controllers\Dashboard::class,
            'cpt'       => App\Controllers\Cpt::class,
            'redirect'  => App\Controllers\Redirect::class,
        );

        foreach( $this->plugins as $name => $plugin ){
            $this->plugins[$name] = new $plugin();
        }

        register_activation_hook( __FILE__, array( $this, 'register_activation_hook' ) );
        register_deactivation_hook( __FILE__, array( $this, 'register_deactivation_hook' ) );

        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

    }

    public function register_activation_hook(){

        $defaults = array();

        if( !get_option('fnsk') ){
            update_option( 'fnsk', $defaults );
        }

    }

    public function register_deactivation_hook(){

        if( get_option( 'fnsk' ) ){
            delete_option( 'fnsk' );
        }

    }

    public function admin_init(){
        $this->__activated_plugins_method( __FUNCTION__ );
    }

    public function admin_menu(){
        $this->__activated_plugins_method( __FUNCTION__ );
    }

    public function admin_enqueue_scripts( $page ){

        $data = array(
            'ajaxurl' => admin_url( 'admin-ajax.url' ),
        );

        wp_localize_script( 'jquery', 'fnsk', $data );

        foreach( $this->plugins as $name => $plugin ){
            if( method_exists( $plugin, __FUNCTION__ ) ){
                if( $page === 'fnsk_page_fnsk_' . $name . '_page' ){
                    call_user_func( array( $plugin,  __FUNCTION__ ) );
                }
            }
        }

    }

    private function __activated_plugins_method( $function_name ){
        foreach( $this->plugins as $plugin ){
            if( method_exists( $plugin, $function_name ) ){
                call_user_func( array( $plugin, $function_name ) );
            }
        }
    }

}

new Fnsk();
