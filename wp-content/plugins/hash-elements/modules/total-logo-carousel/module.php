<?php

namespace HashElements\Modules\TotalLogoCarousel;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-logo-carousel';
    }

    public function get_widgets() {
        $widgets = [
            'TotalLogoCarousel',
        ];
        return $widgets;
    }

}
