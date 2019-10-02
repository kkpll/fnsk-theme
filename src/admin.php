<?php

namespace Src;

class Admin extends Base{

    public $validate;

    public function __construct(){

        echo "ADMIN";

        $this->validate = new Validate();

        register_setting(
            'fnsk_options',
            'tel',
            array( $this->validate, 'tel' ),
            'media'
        );
    }

}
