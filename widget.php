<?php

namespace Elementor;

function gen_uid($length = 10)
{
    return substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

function lorem($count = 1, $max = 20, $std = TRUE)
{
    $out = '';
    if ($std)
        $out = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, ' .
            'sed do eiusmod tempor incididunt ut labore et dolore magna ' .
            'aliqua.';
    $rnd = explode(
        ' ',
        'a ab ad accusamus adipisci alias aliquam amet animi aperiam ' .
            'architecto asperiores aspernatur assumenda at atque aut beatae ' .
            'blanditiis cillum commodi consequatur corporis corrupti culpa ' .
            'cum cupiditate debitis delectus deleniti deserunt dicta ' .
            'dignissimos distinctio dolor ducimus duis ea eaque earum eius ' .
            'eligendi enim eos error esse est eum eveniet ex excepteur ' .
            'exercitationem expedita explicabo facere facilis fugiat harum ' .
            'hic id illum impedit in incidunt ipsa iste itaque iure iusto ' .
            'laborum laudantium libero magnam maiores maxime minim minus ' .
            'modi molestiae mollitia nam natus necessitatibus nemo neque ' .
            'nesciunt nihil nisi nobis non nostrum nulla numquam occaecati ' .
            'odio officia omnis optio pariatur perferendis perspiciatis ' .
            'placeat porro possimus praesentium proident quae quia quibus ' .
            'quo ratione recusandae reiciendis rem repellat reprehenderit ' .
            'repudiandae rerum saepe sapiente sequi similique sint soluta ' .
            'suscipit tempora tenetur totam ut ullam unde vel veniam vero ' .
            'vitae voluptas'
    );
    $max = $max <= 3 ? 4 : $max;
    for ($i = 0, $add = $count - (int)$std; $i < $add; $i++) {
        shuffle($rnd);
        $words = array_slice($rnd, 0, mt_rand(3, $max));
        $out .= (!$std && $i == 0 ? '' : ' ') . ucfirst(implode(' ', $words)) . '.';
    }
    return $out;
}

class Custom_Slider_Widget extends Widget_Base
{
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_script('script-handle', plugin_dir_url(__FILE__) . 'assets/scripts/main.js', ['elementor-frontend'], '25.0.0', true);
        wp_register_style('style-handle', plugin_dir_url(__FILE__) . 'assets/styles/main.css');
        wp_register_style('ca-handle', plugin_dir_url(__FILE__) . 'assets/styles/custom_animations.css');
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


        $repeater->add_control(
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
            ]
        );

        $repeater->add_control(
            'delete_content',
            [
                'label' => __('Delete Content', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::BUTTON,
                'separator' => 'before',
                'button_type' => 'success',
                'text' => __('Delete', 'plugin-domain'),
                'event' => 'namespace:editor:delete',
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


        $repeater->add_control(
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


        $repeater->add_control(
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


        $repeater->add_control(
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
                'default' => __(lorem(1, 1), 'plugin-domain'),
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


        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'white', 's
                
                electors' => [
                    '{{WRAPPER}} .text-item p' => 'color: {{VALUE}}',
                ],
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
                    '{{WRAPPER}} .cs-wrapper' => 'background-color: {{VALUE}}',
                ],

            ]
        );

        $this->add_control(
            'empty_section_color',
            [
                'label' => __('Empty Section Background Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'black',


            ]
        );

        $this->add_control(
            'fill_section_color',
            [
                'label' => __('Fill Section Background Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => 'blue',


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
                'default' => '',
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
                        animation-iteration-count: infinite !important;
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
                        animation-iteration-count: infinite !important;
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
                        animation-iteration-count: infinite !important;
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
                        animation-iteration-count: infinite !important;
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
            <div class="gauge_main custom-slider-container" id="<?php echo gen_uid(); ?>">
                <div class=" gradient" style="<?php
                                                echo "
                 background: linear-gradient(0deg, rgba(29, 216, 255, 1) 0%, {$settings['fill_section_color']} 50%, {$settings['empty_section_color']} 50%);
                "


                                                ?>"></div>
                <div class="white"></div>
                <div class="black"></div>
                <div class="tick"></div>
                <?php
                $count = 1;
                if ($settings['list']) {
                    foreach ($settings['list'] as $item) {
                ?>
                        <div style="<?php echo "--i:$count"; ?>" class="chamber">

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
                <input type="range" class="m" name="meter" min="0" max="100" value="0">
                <span> </span>
            </div>
            <div class="hidden-properties" style="display:none">
                <div class="cs-bg"><?php echo $settings["bg_color"]; ?></div>
                <div class="track-color"><?php echo $settings["slider_track_color"]; ?></div>
                <div class="thumb-color"><?php echo $settings["slider_thumb_color"]; ?></div>
                <div class="thumb-hover-color"><?php echo $settings["slider_thumb_hover_color"]; ?></div>
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
                        animation-iteration-count: infinite !important;
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
                        animation-iteration-count: infinite !important;
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
                        animation-iteration-count: infinite !important;
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
                        animation-iteration-count: infinite !important;
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

            <div class="gauge_main custom-slider-container" id="<?php echo gen_uid(); ?>">
                <div class=" gradient" style="
                 background: linear-gradient(0deg, rgba(29, 216, 255, 1) 0%, {{{settings.fill_section_color}}} 50%, {{{settings.empty_section_color}}} 50%);
                "></div>
                <div class="white"></div>
                <div class="black"></div>
                <div class="tick"></div>

                <# _.each( settings.list, function( item,index ) { #>
                    <div style="--i:{{{index}}}" class="chamber">
                    </div>



                    <# }); #>

                        <div class="meter"></div>


            </div>
            <div class="cs-range-slider">
                <input type="range" class="m" name="meter" min="0" max="100" value="0">
                <span> </span>
            </div>
            <div class="hidden-properties" style="display:none">
                <div class="cs-bg">{{settings.bg_color}}</div>
                <div class="track-color">{{settings.slider_track_color}}</div>
                <div class="thumb-color">{{settings.slider_thumb_color}}</div>
                <div class="thumb-hover-color">{{settings.slider_thumb_hover_color}}</div>
            </div>
        </div>


<?php
    }
}
