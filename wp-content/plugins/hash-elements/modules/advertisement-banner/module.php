<?php

namespace HashElements\Modules\AdvertisementBanner;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'he-advertisement-banner';
    }

    public function get_widgets() {
        $widgets = [
            'AdvertisementBanner',
        ];
        return $widgets;
    }

}
