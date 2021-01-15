<?php

namespace HashElements\Modules\TotalCounterBlock;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-counter-block';
    }

    public function get_widgets() {
        $widgets = [
            'TotalCounterBlock',
        ];
        return $widgets;
    }

}
