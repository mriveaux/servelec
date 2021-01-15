<?php

namespace HashElements\Modules\NewsModuleTwelve;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-news-module-twelve';
    }

    public function get_widgets() {
        $widgets = [
            'NewsModuleTwelve',
        ];
        return $widgets;
    }

}
