<?php

namespace Src\Callbacks;

use Src\Template;

class Section extends Template{

    public function dashboard(){
         $template = $this->template;
         echo $template->render( 'dashboard_section.html' );
    }

    public function cpt(){
        $template = $this->template;
        echo $template->render( 'cpt_section.html' );
    }



}
