<?php
class AT8_Stats_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_stats'; }
    public function get_title() { return 'AT8 Statistics Section'; }
    public function get_icon() { return 'eicon-counter'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section(
            'section_stats',
            [
                'label' => 'Statistics',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'stat_number', [
                'label' => 'Number (e.g. 25+)',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '25+',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'stat_label', [
                'label' => 'Label (e.g. Years of Excellence)',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Years of Infrastructure Excellence',
                'rows' => 2,
            ]
        );

        $this->add_control(
            'stats_list',
            [
                'label' => 'Statistic Items',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'stat_number' => '25+',
                        'stat_label' => 'Years of Infrastructure Excellence',
                    ],
                    [
                        'stat_number' => '£100m+',
                        'stat_label' => 'Project Value Successfully Delivered',
                    ],
                    [
                        'stat_number' => '500+',
                        'stat_label' => 'Qualified Multi-Skilled Personnel',
                    ],
                    [
                        'stat_number' => '99%',
                        'stat_label' => 'Overall Client Satisfaction Rate',
                    ],
                ],
                'title_field' => '{{{ stat_number }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section id="stats-section" class="relative z-10 overflow-hidden border-b border-gray-200">
            <div class="stats-segment-container">
                <?php 
                $counter = 1;
                foreach ( $settings['stats_list'] as $item ) : 
                    // This generates classes like stat-segment-1, stat-segment-2 for the gradients
                    $segment_class = 'stat-segment-' . $counter;
                ?>
                    <div class="stat-segment <?php echo esc_attr($segment_class); ?> elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                        <div class="stat-number"><?php echo $item['stat_number']; ?></div>
                        <div class="stat-info-box">
                            <div class="stat-accent-bar"></div>
                            <div class="stat-label"><?php echo $item['stat_label']; ?></div>
                        </div>
                    </div>
                <?php 
                    $counter++;
                    // Reset counter if it exceeds 4 to maintain gradient loop
                    if($counter > 4) $counter = 1;
                endforeach; 
                ?>
            </div>
        </section>
        <?php
    }
}