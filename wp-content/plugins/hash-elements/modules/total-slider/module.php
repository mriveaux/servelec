<?php

namespace HashElements\Modules\TotalSlider;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-slider';
    }

    public function get_widgets() {
        $widgets = [
            'TotalSlider',
        ];
        return $widgets;
    }

}
