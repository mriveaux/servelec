<?php

namespace HashElements\Modules\NewsModuleEight;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-news-module-eight';
    }

    public function get_widgets() {
        $widgets = [
            'NewsModuleEight',
        ];
        return $widgets;
    }

}
