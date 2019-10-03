<?php

namespace Src;

class Init{

    public function __construct (){

        $classes = array(
            Pages\Admin::class,
            Enqueue::class,
        );

        foreach($classes as $class){
            new $class();
        }

    }

}
