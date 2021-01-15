<?php

namespace HashElements\Modules\TickerModule;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-ticker-module';
    }

    public function get_widgets() {
        $widgets = [
            'TickerModule',
        ];
        return $widgets;
    }

}
