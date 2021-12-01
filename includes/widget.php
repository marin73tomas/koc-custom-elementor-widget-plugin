<?php

namespace Elementor;


class Custom_Slider_Widget extends Widget_Base
{
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

        wp_register_script('script-handle', KOC_CW_PATH . 'assets/scripts/bundle.min.js', ['elementor-frontend'], '25.0.0', true);
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

        <div class="cs-wrapper">


            <div class="img-container">
                <?php



                if ($settings['list']) {
                    foreach ($settings['list'] as $item) {
                ?>
                        <div class="media <?php echo 'elementor-repeater-item-' . $item['_id']; ?>">
                            <img style="
                             top: <?php

                                    echo $item['imgpostop1']['size'] . $item['imgpostop1']['unit'];

                                    ?>;
                            left: <?php echo $item['imgposleft1']['size'] . $item['imgposleft1']['unit']; ?>;
                            width: <?php echo $item['imgsize1']['size'] . $item['imgsize1']['unit']; ?>;
                            min-width: <?php echo $item['imgminsize1']['size'] . $item['imgminsize1']['unit']; ?>;
                            max-width: <?php echo $item['imgmaxsize1']['size'] . $item['imgmaxsize1']['unit']; ?>;
                            display:none;
                            opacity: <?php echo $item['opacity']; ?>;
                             <?php if ($item['repeat_animation1']) { ?>
                        animation-iteration-count: <?php echo $item['animation_repeat_times_1'] ? $item['animation_repeat_times_1'] : 'infinite'; ?> !important;
                        <?php } ?>
                        animation-duration: <?php echo $item['animation_delay1'] ?> !important;
                            " class="<?php echo  $item['entrance_animation1'];
                                        echo " repeat-" . $item['repeat_animation1'];

                                        ?> " loading=" lazy" src="<?php echo $item['media1']['url']; ?>" alt="<?php echo $item['media1']['id']; ?>">


                            <img style="
                             top: <?php

                                    echo $item['imgpostop2']['size'] . $item['imgpostop2']['unit'];

                                    ?>;
                            left: <?php echo $item['imgposleft2']['size'] . $item['imgposleft2']['unit']; ?>;
                            width: <?php echo $item['imgsize2']['size'] . $item['imgsize2']['unit']; ?>;
                            min-width: <?php echo $item['imgminsize2']['size'] . $item['imgminsize2']['unit']; ?>;
                            max-width: <?php echo $item['imgmaxsize2']['size'] . $item['imgmaxsize2']['unit']; ?>;
                            display:none;
                            opacity: <?php echo $item['opacity']; ?>;
                             <?php if ($item['repeat_animation2']) { ?>
                        animation-iteration-count: <?php echo $item['animation_repeat_times_2'] ? $item['animation_repeat_times_2'] : 'infinite'; ?> !important;
                        <?php } ?>
                        animation-duration: <?php echo $item['animation_delay2'] ?> !important;
                            " class="<?php echo  $item['entrance_animation2'];
                                        echo " repeat-" . $item['repeat_animation2'];

                                        ?> " loading=" lazy" src="<?php echo $item['media2']['url']; ?>" alt="<?php echo $item['media2']['id']; ?>">
                            <img style="
                             top: <?php

                                    echo $item['imgpostop3']['size'] . $item['imgpostop']['unit'];

                                    ?>;
                            left: <?php echo $item['imgposleft3']['size'] . $item['imgposleft3']['unit']; ?>;
                            width: <?php echo $item['imgsize3']['size'] . $item['imgsize3']['unit']; ?>;
                            min-width: <?php echo $item['imgminsize3']['size'] . $item['imgminsize3']['unit']; ?>;
                            max-width: <?php echo $item['imgmaxsize3']['size'] . $item['imgmaxsize3']['unit']; ?>;
                            display:none;
                            opacity: <?php echo $item['opacity']; ?>;
                             <?php if ($item['repeat_animation3']) { ?>
                        animation-iteration-count: <?php echo $item['animation_repeat_times_3'] ? $item['animation_repeat_times_3'] : 'infinite'; ?> !important;
                        <?php } ?>
                        animation-duration: <?php echo $item['animation_delay3'] ?> !important;
                            " class="<?php echo  $item['entrance_animation3'];
                                        echo " repeat-" . $item['repeat_animation3'];

                                        ?> " loading=" lazy" src="<?php echo $item['media3']['url']; ?>" alt="<?php echo $item['media3']['id']; ?>">
                            <img style="
                             top: <?php

                                    echo $item['imgpostop4']['size'] . $item['imgpostop4']['unit'];

                                    ?>;
                            left: <?php echo $item['imgposleft4']['size'] . $item['imgposleft4']['unit']; ?>;
                            width: <?php echo $item['imgsize4']['size'] . $item['imgsize4']['unit']; ?>;
                            min-width: <?php echo $item['imgminsize4']['size'] . $item['imgminsize4']['unit']; ?>;
                            max-width: <?php echo $item['imgmaxsize4']['size'] . $item['imgmaxsize4']['unit']; ?>;
                            display:none;
                            opacity: <?php echo $item['opacity']; ?>;
                             <?php if ($item['repeat_animation4']) { ?>
                        animation-iteration-count: <?php echo $item['animation_repeat_times_4'] ? $item['animation_repeat_times_4'] : 'infinite';  ?> !important;
                        <?php } ?>
                        animation-duration: <?php echo $item['animation_delay4'] ?> !important;

                            " class="<?php echo  $item['entrance_animation4'];


                                        ?> " loading=" lazy" src="<?php echo $item['media4']['url']; ?>" alt="<?php echo $item['media4']['id']; ?>">

                        </div>
                <?php

                    }
                }
                ?>
            </div>


            <div class="text-container">
                <?php



                if ($settings['list']) {
                    foreach ($settings['list'] as $item) {
                ?>

                        <div class="text-item" style="display: none; opacity: 0;">
                            <p><?php echo $item['text_content']; ?></p>

                        </div>
                <?php

                    }
                }
                ?>

            </div>
            <div class="gauge_main custom-slider-container" id="<?php echo $this->gen_uid(); ?>" style='position:relative'>
                <div class=" gradient-filled" style="<?php

                                                        echo
                                                        "background: linear-gradient(90deg, {$settings['fill_left_color']}  0%, {$settings['fill_right_color']} 100%, black 0%);
                 ";
                                                        ?>"></div>
                <div class=" gradient" style="<?php
                                                echo "
                 background: rgba(0, 0, 0, 0) linear-gradient(0deg, {$settings['empty_section_color']} 0%, {$settings['empty_section_color']} 50%, transparent 50%) repeat scroll 0% 0%;
                "; ?>"></div>

                <div class="white"></div>
                <div class="black"></div>
                <div class="tick"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="633.1px" height="120.1px" viewBox="0 0 633.1 120.1" style="enable-background:new 0 0 633.1 120.1;" xml:space="preserve">
                        <style type="text/css">
                            .st0 {
                                fill: #464646;
                            }

                            .st1 {
                                fill: #FFFFFF;
                            }

                            .st2 {
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                                fill: #EEEEEE;
                            }
                        </style>
                        <defs>
                        </defs>
                        <g>
                            <path class="st0" d="M68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8   L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8l2.4-73.6l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   c0,0,470.8,24.3,498.8,26.3l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c28.8,2.1,59.2,7,59.2,11.6l0,0l0,0l0,0l0,0   l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c0,4.6-28.4,11.7-59.2,13.7l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   C538.7,76.8,68.2,96.8,68.2,96.8z" />
                            <path class="st1" d="M63.7,101.5l2.8-82.8l4.5,0.2c4.7,0.2,471.2,24.3,498.9,26.3c14.9,1.1,29.8,2.9,40.9,4.9   c16.5,3,22.4,5.9,22.4,11.1c0,4.2-3.6,7.9-21.5,12.1c-12,2.8-27.3,5-41.9,6c-30.5,2-496.7,21.8-501.4,22L63.7,101.5z M75,27.9   l-2.1,64.3c49.7-2.1,467.7-19.9,496.4-21.8c24.4-1.6,43.3-5.9,51.5-9c-8.1-2.4-26.4-5.6-51.5-7.4C543,52.1,123.4,30.4,75,27.9z" />
                            <path class="st0" d="M60,115.7c-30.7,0-55.6-24.9-55.6-55.6l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   C4.4,29.3,29.3,4.4,60,4.4l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c30.7,0,55.6,24.9,55.6,55.6l0,0l0,0l0,0l0,0   l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0C115.7,90.8,90.8,115.7,60,115.7z" />
                            <path class="st1" d="M60,120.1c-33.1,0-60-26.9-60-60.1C0,26.9,26.9,0,60,0c33.1,0,60.1,26.9,60.1,60.1   C120.1,93.2,93.2,120.1,60,120.1z M60,8.9c-28.2,0-51.2,23-51.2,51.2c0,28.2,23,51.2,51.2,51.2c28.2,0,51.2-23,51.2-51.2   C111.2,31.8,88.3,8.9,60,8.9z" />
                            <path class="st2" d="M60.1,78.4c4.9,0,9.2-1.7,12.7-5.2l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   c3.5-3.5,5.2-7.7,5.2-12.7l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c0-4.9-1.7-9.2-5.2-12.7l0,0l0,0l0,0l0,0l0,0   l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c-3.5-3.5-7.7-5.2-12.7-5.2l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   c-4.9,0-9.2,1.7-12.7,5.2l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c-3.5,3.5-5.2,7.7-5.2,12.7l0,0l0,0l0,0l0,0l0,0   l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c0,4.9,1.7,9.2,5.2,12.7l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   C50.9,76.6,55.1,78.4,60.1,78.4" />
                            <path class="st1" d="M60.1,82.8c-6.1,0-11.5-2.2-15.8-6.5c-4.3-4.3-6.5-9.7-6.5-15.8c0-6.1,2.2-11.5,6.5-15.8   c4.3-4.3,9.7-6.5,15.8-6.5s11.5,2.2,15.8,6.5c4.3,4.3,6.5,9.7,6.5,15.8c0,6.1-2.2,11.5-6.5,15.8C71.5,80.6,66.2,82.8,60.1,82.8z    M60.1,47c-3.8,0-6.9,1.3-9.5,3.9c-2.7,2.7-3.9,5.8-3.9,9.5s1.3,6.9,3.9,9.5c2.7,2.7,5.8,3.9,9.5,3.9s6.9-1.3,9.5-3.9   c2.7-2.7,3.9-5.8,3.9-9.5s-1.3-6.9-3.9-9.5C66.9,48.3,63.8,47,60.1,47z" />
                        </g>
                    </svg></div>

                <?php

                $count = 1;
                if ($settings['list']) {
                    foreach ($settings['list'] as $item) {
                ?>
                        <div style="<?php echo "--i:$count"; ?>; width:250% !important" class="chamber">

                        </div>
                <?php
                        $count++;
                    }
                }

                ?>

                <?php
                ?>
                <div class="meter"></div>
            </div>

            <div class="cs-range-slider">
                <p class="label-slider label-left"><?php echo $settings['label_left']; ?></p>
                <p class="label-slider label-right"><?php echo $settings['label_right']; ?></p>
                <input type="range" class="m" name="meter" min="0" max="100" value="0">
                <span style="display:none"> </span>
            </div>
            <div class="hidden-properties" style="display:none">
                <div class="cs-bg"><?php echo $settings["bg_color"]; ?></div>
                <div class="track-color"><?php echo $settings["slider_track_color"]; ?></div>
                <div class="thumb-color"><?php echo $settings["slider_thumb_color"]; ?></div>
                <div class="thumb-hover-color"><?php echo $settings["slider_thumb_hover_color"]; ?></div>
                <div class="gap-size"><?php echo $settings["gap_size"]; ?></div>
                <div class="needle_position"><?php echo $settings["needle_position"]['size'] . $settings["needle_position"]['unit']; ?></div>
            </div>
        </div>

    <?php
    }

    protected function _content_template()
    {
    ?>
        <div class="cs-wrapper">


            <div class="img-container">
                <# _.each( settings.list, function( item,index ) { #>
                    <div class="media elementor-repeater-item-{{ item._id }}">
                        <img style="
                         top:{{{item.imgpostop1.size}}}{{{item.imgpostop1.unit}}};
                        left:{{{item.imgposleft1.left}}}{{{item.imgposleft1.unit}}};
                        width: {{{item.imgsize1.size}}}{{{item.imgsize1.unit}}};
                        min-width: {{{item.imgminsize1.size}}}{{{item.imgminsize1.unit}}};
                        max-width: {{{item.imgmaxsize1.size}}}{{{item.imgmaxsize1.unit}}};
                        display:none;
                        opacity: {{{item.opacity1}}};
                         <# if (item.repeat_animation1) { #>
                        animation-iteration-count: <# 
                        if (item.animation_repeat_times_1){
                            #> {{{item.animation_repeat_times_1}}} <#
                        }
                        else {
                                #> infinite  <#
                        }
                        
                        #> !important;

                        <# } #>
                        animation-duration: {{{item.animation_delay1}}} !important;
                        " class="{{ item.entrance_animation1 }} repeat-{{ item.repeat_animation1 }}" loading=" lazy" src="{{{item.media1.url}}}" alt="{{{item.media1.id}}}">
                        <img style="
                         top:{{{item.imgpostop2.size}}}{{{item.imgpostop2.unit}}};
                        left:{{{item.imgposleft2.left}}}{{{item.imgposleft2.unit}}};
                        width: {{{item.imgsize2.size}}}{{{item.imgsize2.unit}}};
                        min-width: {{{item.imgminsize2.size}}}{{{item.imgminsize2.unit}}};
                        max-width: {{{item.imgmaxsize2.size}}}{{{item.imgmaxsize2.unit}}};
                        display:none;
                        opacity: {{{item.opacity2}}};
                         <# if (item.repeat_animation2) { #>
                         animation-iteration-count: <# 
                        if (item.animation_repeat_times_2){
                            #> {{{item.animation_repeat_times_2}}} <#
                        }
                        else {
                                #> infinite  <#
                        }
                        
                        #> !important;
                        <# } #>
                        animation-duration: {{{item.animation_delay2}}} !important;
                        " class="{{ item.entrance_animation2 }} repeat-{{ item.repeat_animation2 }}" loading=" lazy" src="{{{item.media2.url}}}" alt="{{{item.media2.id}}}">
                        <img style="
                         top:{{{item.imgpostop3.size}}}{{{item.imgpostop3.unit}}};
                        left:{{{item.imgposleft3.left}}}{{{item.imgposleft3.unit}}};
                        width: {{{item.imgsize3.size}}}{{{item.imgsize3.unit}}};
                        min-width: {{{item.imgminsize3.size}}}{{{item.imgminsize3.unit}}};
                        max-width: {{{item.imgmaxsize3.size}}}{{{item.imgmaxsize3.unit}}};
                        display:none;
                        opacity: {{{item.opacity3}}};
                         <# if (item.repeat_animation3) { #>
                         animation-iteration-count: <# 
                        if (item.animation_repeat_times_3){
                            #> {{{item.animation_repeat_times_3}}} <#
                        }
                        else {
                                #> infinite  <#
                        }
                        
                        #> !important;
                        <# } #>
                        animation-duration: {{{item.animation_delay3}}} !important;
                        " class="{{ item.entrance_animation3 }} repeat-{{ item.repeat_animation3 }}" loading=" lazy" src="{{{item.media3.url}}}" alt="{{{item.media3.id}}}">
                        <img style="
                         top:{{{item.imgpostop4.size}}}{{{item.imgpostop4.unit}}};
                        left:{{{item.imgposleft4.left}}}{{{item.imgposleft4.unit}}};
                        width: {{{item.imgsize4.size}}}{{{item.imgsize4.unit}}};
                        min-width: {{{item.imgminsize4.size}}}{{{item.imgminsize4.unit}}};
                        max-width: {{{item.imgmaxsize4.size}}}{{{item.imgmaxsize4.unit}}};
                        display:none;
                        opacity: {{{item.opacity4}}};
                        <# if (item.repeat_animation4) { #>
                         animation-iteration-count: <# 
                        if (item.animation_repeat_times_4){
                            #> {{{item.animation_repeat_times_4}}} <#
                        }
                        else {
                                #> infinite  <#
                        }
                        
                        #> !important;
                        <# } #>
                        animation-duration: {{{item.animation_delay4}}} !important;
                        " class="{{ item.entrance_animation4 }} " loading=" lazy" src="{{{item.media4.url}}}" alt="{{{item.media4.id}}}">
                    </div>
                    <# }); #>
            </div>

            <div class="text-container">

                <# _.each( settings.list, function( item,index ) { #>

                    <div class="text-item" style="display: none; opacity: 0;">
                        <p>{{{item.text_content}}}</p>
                    </div>
                    <# }); #>
            </div>

            <div class="gauge_main custom-slider-container" id="<?php echo $this->gen_uid(); ?>" style='position:relative;'>
                <div class=" gradient-filled" style="
                 background: linear-gradient(90deg, {{{settings.fill_left_color}}} 0%, {{{settings.fill_right_color}}} 100%, black 0%);
                "></div>
                <div class=" gradient" style="
                 background: rgba(0, 0, 0, 0) linear-gradient(0deg, {{{settings.empty_section_color}}} 0%, {{{settings.empty_section_color}}} 50%, transparent 50%) repeat scroll 0% 0%;
                "></div>
                <div class="white"></div>
                <div class="black"></div>
                <div class="tick"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="633.1px" height="120.1px" viewBox="0 0 633.1 120.1" style="enable-background:new 0 0 633.1 120.1;" xml:space="preserve">
                        <style type="text/css">
                            .st0 {
                                fill: #464646;
                            }

                            .st1 {
                                fill: #FFFFFF;
                            }

                            .st2 {
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                                fill: #EEEEEE;
                            }
                        </style>
                        <defs>
                        </defs>
                        <g>
                            <path class="st0" d="M68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8   L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8L68.2,96.8l2.4-73.6l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   c0,0,470.8,24.3,498.8,26.3l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c28.8,2.1,59.2,7,59.2,11.6l0,0l0,0l0,0l0,0   l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c0,4.6-28.4,11.7-59.2,13.7l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   C538.7,76.8,68.2,96.8,68.2,96.8z" />
                            <path class="st1" d="M63.7,101.5l2.8-82.8l4.5,0.2c4.7,0.2,471.2,24.3,498.9,26.3c14.9,1.1,29.8,2.9,40.9,4.9   c16.5,3,22.4,5.9,22.4,11.1c0,4.2-3.6,7.9-21.5,12.1c-12,2.8-27.3,5-41.9,6c-30.5,2-496.7,21.8-501.4,22L63.7,101.5z M75,27.9   l-2.1,64.3c49.7-2.1,467.7-19.9,496.4-21.8c24.4-1.6,43.3-5.9,51.5-9c-8.1-2.4-26.4-5.6-51.5-7.4C543,52.1,123.4,30.4,75,27.9z" />
                            <path class="st0" d="M60,115.7c-30.7,0-55.6-24.9-55.6-55.6l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   C4.4,29.3,29.3,4.4,60,4.4l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c30.7,0,55.6,24.9,55.6,55.6l0,0l0,0l0,0l0,0   l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0C115.7,90.8,90.8,115.7,60,115.7z" />
                            <path class="st1" d="M60,120.1c-33.1,0-60-26.9-60-60.1C0,26.9,26.9,0,60,0c33.1,0,60.1,26.9,60.1,60.1   C120.1,93.2,93.2,120.1,60,120.1z M60,8.9c-28.2,0-51.2,23-51.2,51.2c0,28.2,23,51.2,51.2,51.2c28.2,0,51.2-23,51.2-51.2   C111.2,31.8,88.3,8.9,60,8.9z" />
                            <path class="st2" d="M60.1,78.4c4.9,0,9.2-1.7,12.7-5.2l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   c3.5-3.5,5.2-7.7,5.2-12.7l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c0-4.9-1.7-9.2-5.2-12.7l0,0l0,0l0,0l0,0l0,0   l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c-3.5-3.5-7.7-5.2-12.7-5.2l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   c-4.9,0-9.2,1.7-12.7,5.2l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c-3.5,3.5-5.2,7.7-5.2,12.7l0,0l0,0l0,0l0,0l0,0   l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c0,4.9,1.7,9.2,5.2,12.7l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   C50.9,76.6,55.1,78.4,60.1,78.4" />
                            <path class="st1" d="M60.1,82.8c-6.1,0-11.5-2.2-15.8-6.5c-4.3-4.3-6.5-9.7-6.5-15.8c0-6.1,2.2-11.5,6.5-15.8   c4.3-4.3,9.7-6.5,15.8-6.5s11.5,2.2,15.8,6.5c4.3,4.3,6.5,9.7,6.5,15.8c0,6.1-2.2,11.5-6.5,15.8C71.5,80.6,66.2,82.8,60.1,82.8z    M60.1,47c-3.8,0-6.9,1.3-9.5,3.9c-2.7,2.7-3.9,5.8-3.9,9.5s1.3,6.9,3.9,9.5c2.7,2.7,5.8,3.9,9.5,3.9s6.9-1.3,9.5-3.9   c2.7-2.7,3.9-5.8,3.9-9.5s-1.3-6.9-3.9-9.5C66.9,48.3,63.8,47,60.1,47z" />
                        </g>
                    </svg></div>

                <# _.each( settings.list, function( item,index ) { #>
                    <div style="--i:{{{index}}}; width:99.5% !important" class=" chamber">
                    </div>



                    <# }); #>

                        <div class="meter"></div>
            </div>

            <div class=" cs-range-slider">
                <p class="label-slider label-left">{{settings.label_left}}</p>
                <p class="label-slider label-right">{{settings.label_right}}</p>
                <input type="range" class="m" name="meter" min="0" max="100" value="0">
                <span style="display:none"> </span>
            </div>
            <div class="hidden-properties" style="display:none">
                <div class="cs-bg">{{settings.bg_color}}</div>
                <div class="track-color">{{settings.slider_track_color}}</div>
                <div class="thumb-color">{{settings.slider_thumb_color}}</div>
                <div class="thumb-hover-color">{{settings.slider_thumb_hover_color}}</div>
                <div class="needle_position">{{settings.needle_position.size}}{{settings.needle_position.unit}} </div>
            </div>
        </div>


<?php
    }
}
