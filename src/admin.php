<?php

namespace Src;

class Admin extends Base{

    public $sanitize;

    public function __construct(){

        echo "ADMIN";

        $this->sanitize = new Sanitize();

        register_setting(
            'fnsk_options',
            'tel',
            array( $this->validate, 'tel' ),
            'media'
        );
    }

}
