<?php

namespace Src\Callbacks;

class Sanitize extends Base{

    public function __construct(){
    }

    public function tel($input){
        return $input;
    }

    public function ctp($input){
        return $input;
    }

}
