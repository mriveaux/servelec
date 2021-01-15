<?php

namespace HashElements\Modules\SquarePlusTabBlock;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'square-plus-tab-block';
    }

    public function get_widgets() {
        $widgets = [
            'SquarePlusTabBlock',
        ];
        return $widgets;
    }

}
