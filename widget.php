<?php
class Elementor_Test_Widget extends \Elementor\Widget_Base
{
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_script('script-handle', 'assets/scripts/animation.js', [], '1.0.0', true);
        wp_register_style('style-handle', 'assets/styles/main.css');
    }

    public function get_script_depends()
    {
        return ['script-handle'];
    }

    public function get_style_depends()
    {
        return ['style-handle'];
    }

    public function get_name()
    {
        return 'Custom Slider';
    }

    public function get_title()
    {
        return __('Custom Slider', 'plugin-name');
    }

    public function get_icon()
    {
        return 'fa fa-dot-circle';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => __('URL to embed', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __('https://your-link.com', 'plugin-name'),
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $html = wp_oembed_get($settings['url']);

        echo '<div class="oembed-elementor-widget">';

        echo ($html) ? $html : $settings['url'];

        echo '</div>';
    }
}
