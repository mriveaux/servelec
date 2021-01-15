<?php

namespace HashElements\Modules\TotalBlogModule;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-blog-module';
    }

    public function get_widgets() {
        $widgets = [
            'TotalBlogModule',
        ];
        return $widgets;
    }

}
