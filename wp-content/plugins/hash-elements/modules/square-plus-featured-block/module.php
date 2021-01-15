<?php

namespace HashElements\Modules\SquarePlusFeaturedBlock;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'square-plus-featured-block';
    }

    public function get_widgets() {
        $widgets = [
            'SquarePlusFeaturedBlock',
        ];
        return $widgets;
    }

}
