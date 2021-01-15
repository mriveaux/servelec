<?php

namespace HashElements\Modules\TotalServiceBlock;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-service-block';
    }

    public function get_widgets() {
        $widgets = [
            'TotalServiceBlock',
        ];
        return $widgets;
    }

}
