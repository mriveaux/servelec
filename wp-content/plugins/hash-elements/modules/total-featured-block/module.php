<?php

namespace HashElements\Modules\TotalFeaturedBlock;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-featured-block';
    }

    public function get_widgets() {
        $widgets = [
            'TotalFeaturedBlock',
        ];
        return $widgets;
    }

}
