<?php

namespace HashElements\Modules\NewsModuleFifteen;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-news-module-fifteen';
    }

    public function get_widgets() {
        $widgets = [
            'NewsModuleFifteen',
        ];
        return $widgets;
    }

}
