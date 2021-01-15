<?php

namespace HashElements\Modules\TotalPortfolioMasonary;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-portfolio-masonary';
    }

    public function get_widgets() {
        $widgets = [
            'TotalPortfolioMasonary',
        ];
        return $widgets;
    }

}
