<?php

namespace Src\Pages;

use Src\Base;
use Src\Callbacks\Sanitize;

class Cpt extends Base{

    public $sanitize;

    public function __construct(){

        parent::__construct();

        $this->sanitize = new Sanitize();

        add_action( 'admin_init', array( $this, 'set_admin_form' ) );
        add_action( 'admin_menu', array( $this, 'set_admin_page' ) );
    }

    public function set_admin_page(){

        add_submenu_page(
            'fnsk',
            'カスタム投稿',
            'カスタム投稿',
            'manage_options',
            'fnsk_ctp_page',
            array( $this, 'render_admin_ctp_page'),
        );

    }

    public function set_admin_form(){

        register_setting(
            'fnsk_ctp_group',
            'fnsk_ctp_name',
            array( $this->sanitize, 'ctp')
        );

        add_settings_section(
            'fnsk_ctp_section',
            'カスタム投稿セクション',
            array( $this, 'render_ctp_section' ),
            'fnsk_ctp_page'
        );

        add_settings_field(
            'fnsk_ctp_field',
            'カスタム投稿フィールド',
            array( $this, 'render_ctp_field' ),
            'fnsk_ctp_page',
            'fnsk_ctp_section'
        );

    }

    public function render_admin_ctp_page(){
        ?>

        <div class="wrap">
            <h1 class="wp-heading-inline">カスタム投稿ページ</h1>
            <a href="#" class="page-title-action">新規追加</a>
            <form method="post" action="options.php">
                <?php
                    settings_fields( 'fnsk_ctp_group' );
                    do_settings_sections( 'fnsk_ctp_page' );
                    submit_button();
                 ?>
            </form>
        </div>

        <?php
    }

    public function render_ctp_section(){
        echo "カスタム投稿セクション";
    }

    public function render_ctp_field(){
        echo "<input type='text' name='fnsk_ctp_name' value='".get_option('fnsk_ctp_name')."' />";
    }

}
