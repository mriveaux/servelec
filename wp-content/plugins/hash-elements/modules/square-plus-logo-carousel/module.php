<?php

namespace HashElements\Modules\SquarePlusLogoCarousel;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'square-plus-logo-carousel';
    }

    public function get_widgets() {
        $widgets = [
            'SquarePlusLogoCarousel',
        ];
        return $widgets;
    }

}
