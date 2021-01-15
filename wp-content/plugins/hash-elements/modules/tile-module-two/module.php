<?php

namespace HashElements\Modules\TileModuleTwo;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-tile-module-two';
    }

    public function get_widgets() {
        $widgets = [
            'TileModuleTwo',
        ];
        return $widgets;
    }

}
