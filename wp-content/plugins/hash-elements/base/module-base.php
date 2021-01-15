<?php

namespace HashElements\Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

abstract class Module_Base {

    /**
     * @var \ReflectionClass
     */
    private $reflection;
    private $components = [];

    /**
     * @var Element_Pack_Module_Base
     */
    protected static $_instances = [];

    public static function class_name() {
        return get_called_class();
    }

    /**
     * @return static
     */
    public static function instance() {
        if (empty(static::$_instances[static::class_name()])) {
            static::$_instances[static::class_name()] = new static();
        }

        return static::$_instances[static::class_name()];
    }

    abstract public function get_name();

    public function get_widgets() {
        return [];
    }

    public function __construct() {
        $this->reflection = new \ReflectionClass($this);

        add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
    }

    public function init_widgets() {
        $widget_manager = \Elementor\Plugin::instance()->widgets_manager;

        foreach ($this->get_widgets() as $widget) {
            $class_name = $this->reflection->getNamespaceName() . '\Widgets\\' . $widget;
            $widget_manager->register_widget_type(new $class_name());
        }
    }

    public function add_component($id, $instance) {
        $this->components[$id] = $instance;
    }

    public function get_component($id) {
        if (isset($this->components[$id])) {
            return $this->components[$id];
        }

        return false;
    }

}
