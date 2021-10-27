<?php

namespace Elementor;

class Custom_Slider_Widget extends Widget_Base
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
        //content tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'list_color',
            [
                'label' => __('Slice Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
                ],
                'default' => "#F4F4F4"
            ]
        );

        $repeater->add_control(
            'list_media',
            [
                'name' => 'Choose Media File',
                'label' => __('Animate Media', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'Media File Size',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'large',
            ]
        );

        $repeater->add_control(
            'imgposition',
            [
                'label' => __('Media File Position', 'plugin-domain'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['top', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .your-class' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __('Repeater List', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_content' => __('Item content. Click the edit button to change this text.', 'plugin-domain'),
                    ],
                ],
            ]
        );
        $repeater->add_control(
            'content',
            [
                'label' => __('Content', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('List Content', 'plugin-domain'),
                'show_label' => false,
            ]
        );



        $this->end_controls_section();

        //styles tab
        $this->start_controls_section(
            'styles_section',
            [
                'label' => __('Styles', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
    }
}
