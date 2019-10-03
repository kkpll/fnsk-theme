<?php

namespace Src;

class Init{

    public function __construct (){

        $classes = array(
            Pages\Admin::class,
            Pages\Cpt::class,
            Enqueue::class,
        );

        foreach($classes as $class){
            new $class();
        }

    }

}
