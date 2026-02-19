<?php
class AT8_Projects_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_projects'; }
    public function get_title() { return 'AT8 Projects Grid'; }
    public function get_icon() { return 'eicon-gallery-grid'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section('content', ['label' => 'Header']);
        $this->add_control('title_1', ['label' => 'Title Blue', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'OUR']);
        $this->add_control('title_2', ['label' => 'Title Yellow', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'PROJECTS']);
        $this->end_controls_section();

        $this->start_controls_section('projects_section', ['label' => 'Projects List']);
        $repeater = new \Elementor\Repeater();

        $repeater->add_control('p_category', ['label' => 'Category Tag', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'ELECTRICAL']);
        $repeater->add_control('p_title', ['label' => 'Project Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Substation Grid Reinforcement']);
        $repeater->add_control('p_client', ['label' => 'Client Name', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Client: UK Power Networks Partner']);
        $repeater->add_control('p_image', ['label' => 'Project Image', 'type' => \Elementor\Controls_Manager::MEDIA]);
        $repeater->add_control('p_link', ['label' => 'Link', 'type' => \Elementor\Controls_Manager::URL]);

        $this->add_control('projects_list', [
            'label' => 'Project Cards',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                ['p_title' => 'Substation Grid Reinforcement', 'p_category' => 'ELECTRICAL'],
                ['p_title' => 'Kent Mainline Rehabilitation', 'p_category' => 'WATER'],
                ['p_title' => 'South-East Fibre Rollout', 'p_category' => 'TELECOMS'],
            ]
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section id="projects" class="py-24 bg-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12 reveal active">
                    <h2 class="text-4xl font-extrabold text-at8-blue mb-2 uppercase">
                        <?php echo $settings['title_1']; ?> <span class="text-at8-yellow"><?php echo $settings['title_2']; ?></span>
                    </h2>
                    <div class="h-1 w-24 bg-at8-yellow"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php foreach ($settings['projects_list'] as $index => $item) : 
                        $delay = $index * 100;
                    ?>
                    <div class="bg-white group overflow-hidden shadow-lg border-b-8 border-at8-blue reveal active zoom-hover" style="transition-delay: <?php echo $delay; ?>ms;">
                        <div class="relative overflow-hidden h-64">
                            <img src="<?php echo esc_url($item['p_image']['url']); ?>" class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4 bg-at8-yellow text-at8-dark px-3 py-1 font-bold text-xs uppercase">
                                <?php echo $item['p_category']; ?>
                            </div>
                        </div>
                        <div class="p-8">
                            <h4 class="text-lg font-bold mb-2 uppercase"><?php echo $item['p_title']; ?></h4>
                            <p class="text-gray-500 text-sm mb-4"><?php echo $item['p_client']; ?></p>
                            <a href="<?php echo esc_url($item['p_link']['url']); ?>" class="link-animate inline-flex items-center text-at8-blue font-bold transition text-sm">
                                View Case Study <i class="fas fa-chevron-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}