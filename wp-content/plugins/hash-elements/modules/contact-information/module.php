<?php

namespace HashElements\Modules\ContactInformation;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-contact-information';
    }

    public function get_widgets() {
        $widgets = [
            'ContactInformation',
        ];
        return $widgets;
    }

}
