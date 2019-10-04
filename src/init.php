<?php

namespace Src;

class Init{

    public function __construct (){

        $classes = array(
            Pages\Dashboard::class,
            Pages\Cpt::class,
            Pages\Redirect::class,
            Enqueue::class,
        );

        foreach($classes as $class){
            new $class();
        }

    }

}
