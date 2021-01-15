<?php

namespace HashElements\Modules\NewsModuleFive;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-news-module-five';
    }

    public function get_widgets() {
        $widgets = [
            'NewsModuleFive',
        ];
        return $widgets;
    }

}
