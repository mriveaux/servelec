<?php

namespace HashElements\Modules\TotalProgressbar;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-progressbar';
    }

    public function get_widgets() {
        $widgets = [
            'TotalProgressbar',
        ];
        return $widgets;
    }

}
