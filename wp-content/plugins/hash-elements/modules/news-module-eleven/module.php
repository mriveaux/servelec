<?php

namespace HashElements\Modules\NewsModuleEleven;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-news-module-eleven';
    }

    public function get_widgets() {
        $widgets = [
            'NewsModuleEleven',
        ];
        return $widgets;
    }

}
