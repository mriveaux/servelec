<?php

namespace HashElements\Modules\SquarePlusSlider;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'square-plus-slider';
    }

    public function get_widgets() {
        $widgets = [
            'SquarePlusSlider',
        ];
        return $widgets;
    }

}
