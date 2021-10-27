<?php

function widget_error_notice()
{
    $class = 'notice notice-error';
    $message = __('The custom slider widget could not be loaded. Make sure to install and active Elementor.', 'sample-text-domain');
    printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
}


add_action('elementor/widgets/widgets_registered', 'widgets_registered');
function widgets_registered()
{

    // We check if the Elementor plugin has been installed / activated.
    if (defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {

        require_once('widget.php');
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Custom_Slider_Widget());
    } else {
        add_action('admin_notices', 'widget_error_notice');
    }
}
