<?php

namespace HashElements\Modules\SquarePlusElasticGallery;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'square-plus-elastic-gallery';
    }

    public function get_widgets() {
        $widgets = [
            'SquarePlusElasticGallery',
        ];
        return $widgets;
    }

}
