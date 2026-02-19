<?php
class AT8_Accredited_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_accredited'; }
    public function get_title() { return 'AT8 Accreditations'; }
    public function get_icon() { return 'eicon-certificate'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section('content', ['label' => 'Header Content']);

        $this->add_control('sub_title', ['label' => 'Sub Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Compliance & Quality']);
        $this->add_control('main_title_1', ['label' => 'Main Title (Blue)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'INDUSTRY']);
        $this->add_control('main_title_2', ['label' => 'Main Title (Yellow)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'ACCREDITED']);
        $this->add_control('desc', ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Operating to HAUC, NRSWA, and WRAS standards. We maintain the highest industry certifications to ensure safety and quality.']);

        $this->end_controls_section();

        $this->start_controls_section('badges_section', ['label' => 'Accreditation Badges']);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('label', ['label' => 'Badge Name', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'CHAS Platinum']);
        $repeater->add_control('icon', ['label' => 'Icon Class', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'fas fa-shield-alt']);
        $repeater->add_control('color_class', [
            'label' => 'Badge Style',
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'accred-chas',
            'options' => [
                'accred-chas'     => 'CHAS (Red)',
                'accred-achilles' => 'Achilles (Blue)',
                'accred-cline'    => 'Constructionline (Teal)',
                'accred-iso9'     => 'ISO 9001 (Green)',
                'accred-iso14'    => 'ISO 14001 (Orange)',
                'accred-safe'     => 'Safe Contractor (Purple)',
            ],
        ]);

        $this->add_control('badges_list', [
            'label' => 'Accreditations',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                ['label' => 'CHAS Platinum', 'icon' => 'fas fa-shield-alt', 'color_class' => 'accred-chas'],
                ['label' => 'Achilles UVDB', 'icon' => 'fas fa-certificate', 'color_class' => 'accred-achilles'],
                ['label' => 'Constructionline', 'icon' => 'fas fa-check-double', 'color_class' => 'accred-cline'],
                ['label' => 'ISO 9001:2015', 'icon' => 'fas fa-award', 'color_class' => 'accred-iso9'],
                ['label' => 'ISO 14001', 'icon' => 'fas fa-leaf', 'color_class' => 'accred-iso14'],
                ['label' => 'Safe Contractor', 'icon' => 'fas fa-user-shield', 'color_class' => 'accred-safe'],
            ],
            'title_field' => '{{{ label }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="py-24 bg-gray-50 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="text-center mb-20 reveal active">
                    <h3 class="text-at8-blue font-black uppercase tracking-[0.4em] text-[10px] mb-3"><?php echo $settings['sub_title']; ?></h3>
                    <h2 class="text-4xl font-extrabold text-at8-blue mb-4 uppercase">
                        <?php echo $settings['main_title_1']; ?> <span class="text-at8-yellow"><?php echo $settings['main_title_2']; ?></span>
                    </h2>
                    <div class="h-1.5 w-16 bg-at8-yellow mx-auto"></div>
                    <p class="mt-6 text-gray-500 max-w-2xl mx-auto"><?php echo $settings['desc']; ?></p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                    <?php foreach ($settings['badges_list'] as $index => $badge) : 
                        $delay = ($index * 100) + 50; 
                    ?>
                    <div class="accred-badge <?php echo esc_attr($badge['color_class']); ?> reveal active" style="transition-delay: <?php echo $delay; ?>ms;">
                        <div class="accred-logo-box shadow-md">
                            <i class="<?php echo esc_attr($badge['icon']); ?> text-3xl"></i>
                        </div>
                        <span class="accred-label"><?php echo $badge['label']; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>
        <?php
    }
}