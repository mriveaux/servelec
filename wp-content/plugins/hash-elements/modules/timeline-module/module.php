<?php

namespace HashElements\Modules\TimelineModule;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-timeline-module';
    }

    public function get_widgets() {
        $widgets = [
            'TimelineModule',
        ];
        return $widgets;
    }

}
