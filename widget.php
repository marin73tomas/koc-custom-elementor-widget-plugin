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

        $repeater->add_control(
            'media',
            [
                'name' => 'Choose Media File',
                'label' => __('Animate Media', 'elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
        );

        // $repeater->add_group_control(
        //     \Elementor\Group_Control_Image_Size::get_type(),
        //     [
        //         'name' => 'media_file_size',
        //         'exclude' => ['custom'],
        //         'include' => [],
        //         'default' => 'large',
        //     ]
        // );

        $repeater->add_responsive_control(
            'imgposition',
            [
                'label' => __('Media File Position', 'plugin-domain'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'allowed_dimensions' => ['top', 'left'],
                'selectors' => [
                    '{{WRAPPER}} .copy img' => 'top: {{TOP}}{{UNIT}} !important; right: {{RIGHT}}{{UNIT}} !important; bottom: {{BOTTOM}}{{UNIT}} !important; left: {{LEFT}}{{UNIT}} !important; ',
                ],
            ]
        );
        $repeater->add_control(
            'imgsize',
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
                    '{{WRAPPER}} .copy img' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgminsize',
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
                    '{{WRAPPER}} copy img' => 'min-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'imgmaxsize',
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
                    '{{WRAPPER}} copy img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $repeater->add_control(
            'opacity',
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
                    '{{WRAPPER}} copy img' => 'opacity: {{SIZE}} !important;',
                ],
            ]
        );
        $repeater->add_control(
            'entrance_animation',
            [
                'label' => __('Media File Animation', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
            ]
        );


        $repeater->add_control(
            'repeat_animation',
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
            'animation_delay',
            [
                'label' => __('Animation Delay In Seconds', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('4', 'plugin-domain'),
            ]
        );

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
                'selectors' => [
                    '{{WRAPPER}} .text-item p' => 'color: {{VALUE}}',
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
            <div class="text-container">
                <?php
                if ($settings['list']) {
                    foreach ($settings['list'] as $item) {
                ?>
                        <div class="text-item" style="display: none; opacity: 0;">
                            <p><?php echo $item['text_content']; ?></p>
                            <img style="
                             top: <?php
                                    $unit = $item['imgposition']['unit'];
                                    echo $item['imgposition']['top'] . $unit;

                                    ?>;
                            left: <?php echo $item['imgposition']['left'] . $unit; ?>;
                            width: <?php echo $item['imgsize']['size'] . $item['imgsize']['unit']; ?>;
                            min-width: <?php echo $item['imgminsize']['size'] . $item['imgminsize']['unit']; ?>;
                            max-width: <?php echo $item['imgmaxsize']['size'] . $item['imgmaxsize']['unit']; ?>;
                            display:none;
                            opacity: <?php echo $item['opacity']; ?>;
                            " class="<?php echo  $item['entrance_animation'];
                                        echo " repeat-" . $item['repeat_animation'];

                                        ?> " loading=" lazy" src="<?php echo $item['media']['url']; ?>" alt="<?php echo $item['media']['id']; ?>">
                            <div class="a-delay" style="display:none"><?php echo  $item['animation_delay']; ?></div>
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
            </div>
        </div>

    <?php
    }

    protected function _content_template()
    {
    ?>
        <div class="cs-wrapper">
            <div class="text-container">
                <# _.each( settings.list, function( item,index ) { #>
                    <div class="text-item" style="display: none; opacity: 0;">
                        <p>{{{item.text_content}}}</p>
                        <img style="
                         top:{{{item.imgposition.top}}}{{{item.imgposition.unit}}};
                        left:{{{item.imgposition.left}}}{{{item.imgposition.unit}}};
                        width: {{{item.imgsize.size}}}{{{item.imgsize.unit}}};
                        min-width: {{{item.imgminsize.size}}}{{{item.imgminsize.unit}}};
                        max-width: {{{item.imgmaxsize.size}}}{{{item.imgmaxsize.unit}}};
                        display:none;
                        opacity: {{{item.opacity}}};
                        " class="{{ item.entrance_animation }} repeat-{{ item.repeat_animation }}" loading=" lazy" src="{{{item.media.url}}}" alt="{{{item.media.id}}}">
                        <div class="a-delay" style="display:none">{{{item.animation_delay}}}</div>
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
            </div>
        </div>


<?php
    }
}
