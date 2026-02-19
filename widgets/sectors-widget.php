<?php
class AT8_Sectors_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_sectors'; }
    public function get_title() { return 'AT8 Sectors Slider'; }
    public function get_icon() { return 'eicon-slider-device'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section('content', ['label' => 'Sectors Content']);

        $this->add_control('title_part1', ['label' => 'Title (Blue)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'OUR']);
        $this->add_control('title_part2', ['label' => 'Title (Yellow)', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'SECTORS']);
        $this->add_control('subtitle', ['label' => 'Subtitle', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Delivering integrated solutions across critical national infrastructure.']);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('sector_type', [
            'label' => 'Sector Theme (Colors)',
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'energy',
            'options' => [
                'energy'   => 'Electrical/Energy (Orange)',
                'water'    => 'Water (Blue)',
                'telecoms' => 'Telecoms (Purple)',
                'civils'   => 'Civils (Green)',
            ],
        ]);

        $repeater->add_control('icon_class', ['label' => 'Icon Class', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'fas fa-bolt']);
        $repeater->add_control('title', ['label' => 'Sector Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Sector Name']);
        $repeater->add_control('description', ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA]);
        
        $repeater->add_control('features', [
            'label' => 'Checklist Features (One per line)',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'placeholder' => "Feature 1\nFeature 2",
        ]);

        $repeater->add_control('link', ['label' => 'Button Link', 'type' => \Elementor\Controls_Manager::URL]);

        $this->add_control('sectors_list', [
            'label' => 'Sector Cards',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'title' => 'Electrical Services',
                    'sector_type' => 'energy',
                    'icon_class' => 'fas fa-bolt',
                    'description' => 'Specialist LV, HV, and EHV infrastructure solutions. We deliver cable pulling, winching, joint bays, switchgear installation, and grid substation support (up to 132kV) nationwide.',
                    'features' => "LV & HV Cable Installation\nPOC & Feeder Pillars\nTransformer & Switchgear"
                ],
                [
                    'title' => 'Water Infrastructure',
                    'sector_type' => 'water',
                    'icon_class' => 'fas fa-tint',
                    'description' => 'Reliable installations and mains renewals. From domestic connections and barrier pipes to large diameter pipeline installations and deep excavations to WRAS requirements.',
                    'features' => "New Service Connections\nOpen-cut Main Replacement\nTrunk Main Capabilities"
                ],
                [
                    'title' => 'Telecoms Civils',
                    'sector_type' => 'telecoms',
                    'icon_class' => 'fas fa-wifi',
                    'description' => 'Supporting fibre rollouts with duct installation, chamber construction, and micro-trenching. We ensure full compliance with NRSWA, HAUC, and SROH standards.',
                    'features' => "FTTP / FTTH Civil Works\nChamber & Frame Installation\nNRSWA Reinstatement"
                ],
                [
                    'title' => 'Fibre Network Civils',
                    'sector_type' => 'civils',
                    'icon_class' => 'fas fa-network-wired',
                    'description' => 'Specialist civil engineering for high-speed broadband infrastructure. Pole base excavation, site clearance, and coordinated traffic management.',
                    'features' => "Micro-trenching\nPole Base Excavation\nFootpath Track Installation"
                ],
                [
                    'title' => 'Ducts & Chambers',
                    'sector_type' => 'energy',
                    'icon_class' => 'fas fa-tools',
                    'description' => 'Expert ducting systems and jointing pit construction. We provide trench excavation, draw pit construction, and reinstatement to high standards.',
                    'features' => "Single & Multi-duct Systems\nPrecast & In-situ Chambers\nDuct Draw Ropes & Markers"
                ],
            ],
            'title_field' => '{{{ title }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section id="sectors" class="py-24 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12 reveal active">
                    <div class="max-w-2xl">
                        <h2 class="text-4xl md:text-5xl font-black text-at8-blue mb-4 uppercase leading-tight">
                            <?php echo $settings['title_part1']; ?> <span class="text-at8-yellow"><?php echo $settings['title_part2']; ?></span>
                        </h2>
                        <div class="h-1.5 w-24 bg-at8-yellow mb-4"></div>
                        <p class="text-gray-500 font-medium"><?php echo $settings['subtitle']; ?></p>
                    </div>
                    <div class="flex space-x-3 mt-6 md:mt-0">
                        <button id="slide-prev" class="btn-animate w-12 h-12 rounded-full border-2 border-at8-blue text-at8-blue hover:bg-at8-blue hover:text-white flex items-center justify-center transition shadow-md">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button id="slide-next" class="btn-animate w-12 h-12 rounded-full bg-at8-blue text-white flex items-center justify-center hover:bg-at8-yellow hover:text-at8-dark transition shadow-md">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <div id="sectors-slider" class="sectors-slider-container">
                    <?php foreach ($settings['sectors_list'] as $item): 
                        $type = $item['sector_type'];
                        $accent_class = 'sector-accent-' . $type;
                        $icon_bg_class = 'sector-icon-bg-' . $type;
                    ?>
                    <div class="sector-card">
                        <div class="bg-white p-8 md:p-10 rounded-xl shadow-xl hover:shadow-2xl transition duration-500 h-full flex flex-col <?php echo $accent_class; ?> border border-gray-100">
                            <div class="w-16 h-16 rounded-2xl <?php echo $icon_bg_class; ?> flex items-center justify-center mb-8 shadow-inner">
                                <i class="<?php echo esc_attr($item['icon_class']); ?> text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-black text-at8-blue mb-4 uppercase"><?php echo $item['title']; ?></h3>
                            <p class="text-gray-600 mb-6 flex-grow leading-relaxed">
                                <?php echo $item['description']; ?>
                            </p>
                            
                            <div class="space-y-2 mb-8 text-xs font-bold text-at8-blue/70">
                                <?php 
                                $lines = explode("\n", $item['features']);
                                foreach($lines as $line) {
                                    if(!empty(trim($line))) {
                                        echo '<div class="flex items-center"><i class="fas fa-check text-at8-yellow mr-2"></i>' . esc_html($line) . '</div>';
                                    }
                                }
                                ?>
                            </div>

                            <a href="<?php echo esc_url($item['link']['url']); ?>" class="btn-animate btn-blue-to-yellow bg-at8-blue text-white py-3 px-6 rounded-lg font-bold text-center text-xs uppercase tracking-widest">
                                View Details
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <script>
        (function() {
            const slider = document.getElementById('sectors-slider');
            const nextBtn = document.getElementById('slide-next');
            const prevBtn = document.getElementById('slide-prev');
            if(!slider || !nextBtn || !prevBtn) return;

            nextBtn.addEventListener('click', () => {
                slider.scrollBy({ left: slider.offsetWidth / 2, behavior: 'smooth' });
            });
            prevBtn.addEventListener('click', () => {
                slider.scrollBy({ left: -slider.offsetWidth / 2, behavior: 'smooth' });
            });
        })();
        </script>
        <?php
    }
}