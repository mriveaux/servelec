<?php

namespace HashElements\Modules\TileModuleThree;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-tile-module-three';
    }

    public function get_widgets() {
        $widgets = [
            'TileModuleThree',
        ];
        return $widgets;
    }

}
