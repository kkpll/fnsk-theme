<?php

namespace Src\Callbacks;

use Src\Base;

class Section extends Base{

    public function dashboard(){
         require_once( $this->plugin_path . 'template/tpl_dashboard.php' );
    }

}
