<?php


if (!class_exists('KOC_Widget_Builder')) {
     include_once("class-koc-custom-animations.php");
     class KOC_Widget_Builder
     {

          public function __construct()
          {
               add_action('elementor/widgets/widgets_registered', array($this, 'widgets_registered'));
          }
          function widget_error_notice()
          {
               $class = 'notice notice-error';
               $message = __('The custom slider widget could not be loaded. Make sure to install and active Elementor.', 'sample-text-domain');
               printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
          }
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
     }
     new KOC_Widget_Builder();
}
