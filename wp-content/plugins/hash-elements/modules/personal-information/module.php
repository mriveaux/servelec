<?php

namespace HashElements\Modules\PersonalInformation;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-personal-information';
    }

    public function get_widgets() {
        $widgets = [
            'PersonalInformation',
        ];
        return $widgets;
    }

}
