<?php

namespace Src\Pages;

use Src\Base;
use Src\Csv;
use Src\Callbacks\Page;
use Src\Callbacks\Field;
use Src\Callbacks\Sanitize;

class Redirect extends Base{

    public $csv;
    public $page;
    public $field;
    public $sanitize;

    public function __construct(){

        parent::__construct();

        $this->csv = new Csv('redirect');
        $this->page = new Page();
        $this->field = new Field();
        $this->sanitize = new Sanitize();

        add_action( 'admin_init', array( $this, 'set_admin_form' ) );
        add_action( 'admin_menu', array( $this, 'set_admin_page' ) );

    }

    public function set_admin_page(){

        $page = add_submenu_page(
            'fnsk',
            'リダイレクト設定',
            'リダイレクト設定',
            'manage_options',
            'fnsk_redirect_page',
            array( $this->page, 'redirect' )
        );

        add_action( 'admin_print_scripts-' . $page, array( $this, 'admin_print_scripts') );

    }

    public function set_admin_form(){

        register_setting(
            'fnsk_redirect_group',
            'fnsk_redirect_name',
            array( $this->sanitize, 'redirect' )
        );

        add_settings_section(
            'fnsk_redirect_section',
            'リダイレクト設定セクション',
            array( $this, 'render_redirect_section' ),
            'fnsk_redirect_page'
        );

        add_settings_field(
            'fnsk_redirect_field',
            'リダイレクト設定フィールド',
            array($this->field, 'redirect' ),
            'fnsk_redirect_page',
            'fnsk_redirect_section',
            array(
                'class' => 'fnsk_redirect_field'
            )
        );

    }

    public function render_redirect_section(){
        echo "リダイレクト設定セクション";
    }


    public function admin_print_scripts(){
        wp_enqueue_script( 'redirect.js', $this->plugin_url . 'assets/js/admin/redirect.js', array( 'jquery' ), filemtime( $this->plugin_path . 'assets/js/admin/redirect.js' ), true );
    }



}
