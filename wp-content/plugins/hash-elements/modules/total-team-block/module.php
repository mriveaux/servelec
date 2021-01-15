<?php

namespace HashElements\Modules\TotalTeamBlock;

use HashElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-team-block';
    }

    public function get_widgets() {
        $widgets = [
            'TotalTeamBlock',
        ];
        return $widgets;
    }

}
