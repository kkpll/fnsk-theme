<?php

namespace Src;

class Fnsk{

    public function __construct (){

        $classes = array(
            Admin::class,
            Enqueue::class,
        );

        foreach($classes as $class){
            new $class();
        }

    }

}
