<?php

namespace Elementor;

function gen_uid($length = 10)
{
    return substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}
class Custom_Slider_Widget extends Widget_Base
{
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_script('script-handle', plugin_dir_url(__FILE__) . 'assets/scripts/main.js', ['elementor-frontend'], '25.0.0', true);
        wp_register_style('style-handle', plugin_dir_url(__FILE__) . 'assets/styles/main.css');
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
            'imgposition',
            [
                'label' => __('Media File Position', 'plugin-domain'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} img' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
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
            'text_content',
            [
                'label' => __('Text', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Item content. Click the edit button to change this text.', 'plugin-domain'),
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
                    '{{WRAPPER}} .text-content' => 'color: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .text-content',
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
                        <div style="<?php echo "--i:$count"; ?>" class="chamber"></div>
                <?php
                        $count++;
                    }
                }

                ?>
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

                <?php
                ?>
                <div class="meter"></div>
                <div class="cs-range-slider">
                    <input type="range" class="m" name="meter" min="0" max="100" value="0">
                    <span> </span>
                </div>
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
                        <div class="text-container">
                            <# _.each( settings.list, function( item,index ) { #>
                                <div class="text-item" style="display: none; opacity: 0;">
                                    <p>{{{item.text_content}}}</p>
                                </div>
                                <# }); #>
                        </div>

                        <div class="meter"></div>

                        <input type="range" class="m" name="meter" min="0" max="100" value="0">
            </div>

            <div class="hidden-properties" style="display:none">
                <div class="cs-bg">{{settings.bg_color}}</div>
            </div>
        </div>


<?php
    }
}
