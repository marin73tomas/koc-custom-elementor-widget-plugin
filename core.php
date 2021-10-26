<?php


function load_elementor_widget()
{
    require('widget.php');
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Custom_Slider_Widget());
}
add_action('init', load_elementor_widget());
