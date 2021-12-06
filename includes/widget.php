<?php

namespace Elementor;


class Custom_Slider_Widget extends Widget_Base
{
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

        wp_register_script('script-handle', KOC_CW_PATH . 'assets/scripts/bundle.min.js?defer', ['elementor-frontend'], '25.0.0', true);
        wp_register_style('style-handle', KOC_CW_PATH . 'assets/styles/bundle.min.css');
    }
    private function gen_uid($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function get_script_depends()
    {
        return ['script-handle'];
    }

    public function get_style_depends()
    {
        return ['style-handle', 'ca-handle'];
    }

    public function get_name()
    {
        return 'customslider';
    }

    public function get_title()
    {
        return __('Custom Slider', 'plugin-name');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
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

        $this->add_control(
            'label_left',
            [
                'label' => __('Left Label', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Less Hard Sell', 'plugin-domain'),
                'placeholder' => __('Type your title here', 'plugin-domain'),
            ]
        );
        $this->add_control(
            'label_right',
            [
                'label' => __('Right Label', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('More Hard Sell', 'plugin-domain'),
                'placeholder' => __('Type your title here', 'plugin-domain'),
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->start_controls_tabs('tabs_medias');

        $repeater->add_control(
            'segment_color',
            [
                'label' => __('Segment Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'black',
            ]
        );
        $repeater->start_controls_tab(
            'tab_media_1',
            [
                'label' => __('Media 1', 'elementor'),
            ]
        );

        $repeater->add_control(
            'media1',
            [
                'name' => 'Choose Media File 1',
                'label' => __('Animate Media', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
        );
        $repeater->add_responsive_control(
            'imgpostop1',
            [
                'label' => __('Media Top Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(1)' => 'top: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgposleft1',
            [
                'label' => __('Media Left Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(1)' => 'left: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );


        $repeater->add_responsive_control(
            'imgsize1',
            [
                'label' => __('Size (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(1)' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgminsize1',
            [
                'label' => __('Min Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(1)' => 'min-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgmaxsize1',
            [
                'label' => __('Max Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(1)' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_control(
            'opacity1',
            [
                'label' => __('Opacity (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(1)' => 'opacity: {{SIZE}} !important;',
                ],
            ]
        );

        $repeater->add_control(
            'entrance_animation1',
            [
                'label' => __('Media File Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
                'render_type' => 'template',
            ]
        );

        $repeater->add_control(
            'repeat_animation1',
            [
                'label' => __('Repeat Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __(
                    'NO',
                    'your-plugin'
                ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'animation_delay1',
            [
                'label' => __('Animation Delay In Seconds', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('4', 'plugin-domain'),
                'render_type' => 'template',
            ]
        );
        $repeater->add_control(
            'animation_repeat_times_1',
            [
                'label' => __('Repeat animation No. times (0 infinite)', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 0,
            ]
        );
        $repeater->end_controls_tab();


        $repeater->start_controls_tab(
            'tab_media_2',
            [
                'label' => __('Media 2', 'elementor'),
            ]
        );


        //media 2



        $repeater->add_control(
            'media2',
            [
                'name' => 'Choose Media File 2',
                'label' => __('Animate Media', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
        );
        $repeater->add_responsive_control(
            'imgpostop2',
            [
                'label' => __('Media Top Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(2)' => 'top: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgposleft2',
            [
                'label' => __('Media Left Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(2)' => 'left: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );


        $repeater->add_responsive_control(
            'imgsize2',
            [
                'label' => __('Size (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(2)' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgminsize2',
            [
                'label' => __('Min Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(2)' => 'min-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgmaxsize2',
            [
                'label' => __('Max Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(2)' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_control(
            'opacity2',
            [
                'label' => __('Opacity (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(2)' => 'opacity: {{SIZE}} !important;',
                ],
            ]
        );
        $repeater->add_control(
            'entrance_animation2',
            [
                'label' => __('Media File Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
                'render_type' => 'template',
            ]
        );


        $repeater->add_control(
            'repeat_animation2',
            [
                'label' => __('Repeat Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __(
                    'NO',
                    'your-plugin'
                ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'animation_delay2',
            [
                'label' => __('Animation Delay In Seconds', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('4', 'plugin-domain'),
                'render_type' => 'template',
            ]
        );
        $repeater->add_control(
            'animation_repeat_times_2',
            [
                'label' => __('Repeat animation No. times (0 infinite)', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 0,
            ]
        );


        $repeater->end_controls_tab();







        $repeater->start_controls_tab(
            'tab_media_3',
            [
                'label' => __('Media 3', 'elementor'),
            ]
        );





        // media 3

        $repeater->add_control(
            'media3',
            [
                'name' => 'Choose Media File 3',
                'label' => __('Animate Media', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
        );
        $repeater->add_responsive_control(
            'imgpostop3',
            [
                'label' => __('Media Top Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(3)' => 'top: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgposleft3',
            [
                'label' => __('Media Left Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(3)' => 'left: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );


        $repeater->add_responsive_control(
            'imgsize3',
            [
                'label' => __('Size (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(3)' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgminsize3',
            [
                'label' => __('Min Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(3)' => 'min-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgmaxsize3',
            [
                'label' => __('Max Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(3)' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_control(
            'opacity3',
            [
                'label' => __('Opacity (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(3)' => 'opacity: {{SIZE}} !important;',
                ],
            ]
        );
        $repeater->add_control(
            'entrance_animation3',
            [
                'label' => __('Media File Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
                'render_type' => 'template',
            ]
        );


        $repeater->add_control(
            'repeat_animation3',
            [
                'label' => __('Repeat Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __(
                    'NO',
                    'your-plugin'
                ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'animation_delay3',
            [
                'label' => __('Animation Delay In Seconds', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('4', 'plugin-domain'),
                'render_type' => 'template',
            ]
        );
        $repeater->add_control(
            'animation_repeat_times_3',
            [
                'label' => __('Repeat animation No. times (0 infinite)', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 0,
            ]
        );

        $repeater->end_controls_tab();

        //media 4


        $repeater->start_controls_tab(
            'tab_media_4',
            [
                'label' => __('Media 4', 'elementor'),
            ]
        );


        $repeater->add_control(
            'media4',
            [
                'name' => 'Choose Media File 4',
                'label' => __('Animate Media', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
        );
        $repeater->add_responsive_control(
            'imgpostop4',
            [
                'label' => __('Media Top Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(4)' => 'top: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgposleft4',
            [
                'label' => __('Media Left Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(4)' => 'left: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );


        $repeater->add_responsive_control(
            'imgsize4',
            [
                'label' => __('Size (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(4)' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgminsize4',
            [
                'label' => __('Min Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(4)' => 'min-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgmaxsize4',
            [
                'label' => __('Max Width (px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(4)' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_control(
            'opacity4',
            [
                'label' => __('Opacity (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img:nth-child(4)' => 'opacity: {{SIZE}} !important;',
                ],
            ]
        );
        $repeater->add_control(
            'entrance_animation4',
            [
                'label' => __('Media File Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
                'render_type' => 'template',
            ]
        );


        $repeater->add_control(
            'repeat_animation4',
            [
                'label' => __('Repeat Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'your-plugin'),
                'label_off' => __(
                    'NO',
                    'your-plugin'
                ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'animation_delay4',
            [
                'label' => __('Animation Delay In Seconds', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('4', 'plugin-domain'),
                'render_type' => 'template',
            ]
        );
        $repeater->add_control(
            'animation_repeat_times_4',
            [
                'label' => __('Repeat animation No. times (0 infinite)', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 0,
            ]
        );
        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();



        // $repeater->add_group_control(
        //     \Elementor\Group_Control_Image_Size::get_type(),
        //     [
        //         'name' => 'media_file_size',
        //         'exclude' => ['custom'],
        //         'include' => [],
        //         'default' => 'large',
        //     ]
        // );


        $repeater->add_control(
            'text_content',
            [
                'label' => __('Text', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __(' ', 'plugin-domain'),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __('Slider Items', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text_content' => __('Item content. Click the edit button to change this text.', 'plugin-domain'),
                    ],
                ],
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

        $this->add_responsive_control(
            'sectionminheight',
            [
                'label' => __('Section Min Height (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => 'vh',
                ],
                'size_units' => ['vh', '%', 'px', 'em', 'rem'],
                'range' => [
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 3000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cs-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'speedosize',
            [
                'label' => __('Speedometer Size (vw,px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 17,
                    'unit' => 'vw',
                ],
                'tablet_default' => [
                    'unit' => 'vw',
                ],
                'mobile_default' => [
                    'unit' => 'vw',
                ],
                'size_units' => ['vw', 'px'],
                'range' => [
                    'vw' => [
                        'min' => 17,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 280,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .gradient,{{WRAPPER}} .gradient-filled, {{WRAPPER}} .gauge_main' => 'height: {{SIZE}}{{UNIT}} !important; width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'speedoinnersize',
            [
                'label' => __('Speedometer Inner Circle Size (vw,px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 11,
                    'unit' => 'vw',
                ],
                'tablet_default' => [
                    'unit' => 'vw',
                ],
                'mobile_default' => [
                    'unit' => 'vw',
                ],
                'size_units' => ['vw', 'px'],
                'range' => [
                    'vw' => [
                        'min' => 9,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 153,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .white' => 'height: {{SIZE}}{{UNIT}} !important; width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'speedometerpos',
            [
                'label' => __('Speedometer position (Top)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 70,
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px', 'em', 'rem'],
                'range' => [
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 3000,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .gauge_main, 
                    {{WRAPPER}} .gauge_main .black,
                     {{WRAPPER}} .gauge_main .meter' => 'top: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'gap_size',
            [
                'label' => __('Gap SIze', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 4,
                    'unit' => 'px',
                ],
                'size_units' => ['%', 'px', 'em', 'rem'],
                'range' => [
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .chamber' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'gap_color',
            [
                'label' => __('Gap Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'purple',

                'selectors' => [
                    '{{WRAPPER}} .chamber' => 'background: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'black',

                'selectors' => [
                    '{{WRAPPER}} .text-item p, {{WRAPPER}} .label-slider' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Text Typography', 'plugin-domain'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .text-item p',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Text Alignment', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __('Left', 'elementor'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elementor'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'elementor'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'elementor'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
                'default' => 'center',
            ]
        );
        $this->add_responsive_control(
            'textposition',
            [
                'label' => __('Text Position (Top)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 40,
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px', 'em', 'rem'],
                'range' => [
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 3000,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .text-item' => 'top: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'textwidth',
            [
                'label' => __('Text Max Width', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 80,
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px', 'em', 'rem'],
                'range' => [
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 3000,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .text-item' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => __('Background Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'white',
                'selectors' => [
                    '{{WRAPPER}} .cs-wrapper,{{WRAPPER}} .meter , {{WRAPPER}} .white,  
                    {{WRAPPER}} .tick path:last-child,  
                    {{WRAPPER}} .gauge_main, {{WRAPPER}} .gauge_main::after
                    ' => 'background-color: {{VALUE}} !important; border: 2px solid {{VALUE}} !important; fill: {{VALUE}} !important',
                ],

            ]
        );

        $this->add_control(
            'empty_section_color',
            [
                'label' => __('Empty Section Speedometer Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'black',


            ]
        );

        $this->add_control(
            'fill_left_color',
            [
                'label' => __('Section Speedometer Right Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'blue',


            ]
        );
        $this->add_control(
            'fill_right_color',
            [
                'label' => __('Section Speedometer Left Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'green',


            ]
        );
        $this->add_responsive_control(
            'slider_track_height',
            [
                'label' => __('Slider Track Height (%,px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cs-range-slider input' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'slider_track_width',
            [
                'label' => __('Slider Track Width (%,px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cs-range-slider' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'slider_track_color',
            [
                'label' => __('Slider Track Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'black',
            ]


        );

        $this->add_control(
            'slider_thumb_color',
            [
                'label' => __('Slider Thumb Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'black',
            ]


        );
        $this->add_control(
            'slider_thumb_hover_color',
            [
                'label' => __('Slider Thumb Color Hover', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'blue',
            ]


        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => __('Slider Labels Typography', 'plugin-domain'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .label-slider',
            ]
        );
        $this->add_responsive_control(
            'label_position',
            [
                'label' => __('Slider Labels Position', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .label-slider' => 'bottom: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'needle_color',
            [
                'label' => __('Slider Needle Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tick path:not(:last-child)' => 'fill: {{VALUE}} !important',
                ],
                'default' => 'black'
            ]
        );
        $this->add_responsive_control(
            'needle_size',
            [
                'label' => __('Slider Needle Size (%, px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 13,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tick' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'needle_position',
            [
                'label' => __('Slider Needle Left Position (%, px)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'template',
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 5000,
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();


?>
        <div class="koc-slider-wrapper">
            <div class="items" style="display:none !important" data-gap-color="<?php echo $settings['gap_color']; ?>">
                <?php
                if ($settings['list']) {
                    foreach ($settings['list'] as $key => $item) {
                ?>
                        <div class=" item <?php echo 'elementor-repeater-item-' . $item['_id']; ?>" data-index="<?php echo esc_attr($key); ?>" data-color="<?php echo esc_attr($item['segment_color']); ?>">

                            <div class="text"><?php echo wp_strip_all_tags(esc_html($item['text_content'])); ?></div>
                            <div class="medias">
                                <div class="media media1">
                                    <?php echo esc_url($item['media1']['url']); ?>
                                </div>
                                <div class="media media2">
                                    <?php echo esc_url($item['media2']['url']); ?>
                                </div>
                                <div class="media media3">
                                    <?php echo esc_url($item['media3']['url']); ?>
                                </div>
                                <div class="media media3">
                                    <?php echo esc_url($item['media4']['url']); ?>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                }

                ?>
            </div>
            <div class="slider-container" id="<?php echo $this->gen_uid(); ?>">

            </div>

        </div>
    <?php
    }

    protected function _content_template()
    {
    ?>
        <div class="slider-container" id="<?php echo $this->gen_uid(); ?>">

        </div>

<?php
    }
}
