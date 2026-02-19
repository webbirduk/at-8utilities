<?php
class AT8_Infrastructure_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_infrastructure_new'; }
    public function get_title() { return 'AT8 Infrastructure (Modern)'; }
    public function get_icon() { return 'eicon-info-box'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section('content', ['label' => 'Text Content']);
        
        $this->add_control('title_1', ['label' => 'Title Blue', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'WE PROVIDE WORLD-CLASS']);
        $this->add_control('title_2', ['label' => 'Title Yellow', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'INFRASTRUCTURE']);
        $this->add_control('desc', ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'AT-8 Utilities Ltd is a multi-disciplinary contractor delivering specialist electrical, water, and telecommunications solutions across the UK.']);
        
        $this->add_control('image', [
            'label' => 'Main Image',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => ['url' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&q=80&w=1000']
        ]);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('text', ['label' => 'Feature', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Safety Focused']);
        $this->add_control('features', [
            'label' => 'Features',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [['text' => 'Safety Focused'], ['text' => 'Quality Driven'], ['text' => 'Client Led'], ['text' => 'Expert Delivery']]
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex flex-col lg:flex-row gap-12 items-center">
                    <div class="lg:w-1/2">
                        <h2 class="text-4xl md:text-5xl font-black text-at8-blue uppercase mb-6">
                            <?php echo $settings['title_1']; ?> <span class="text-at8-yellow"><?php echo $settings['title_2']; ?></span>
                        </h2>
                        <p class="text-gray-600 text-lg mb-8"><?php echo $settings['desc']; ?></p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php foreach ($settings['features'] as $item) : ?>
                                <div class="flex items-center p-4 bg-gray-50 border-l-4 border-at8-yellow shadow-sm">
                                    <i class="fas fa-check-circle text-at8-blue mr-3"></i>
                                    <span class="font-bold text-at8-blue uppercase text-sm"><?php echo $item['text']; ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="lg:w-1/2 relative">
                        <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl border-8 border-white">
                             <img src="<?php echo esc_url($settings['image']['url']); ?>" class="w-full h-auto object-cover">
                        </div>
                        <div class="absolute -bottom-4 -right-4 w-full h-full border-4 border-at8-yellow rounded-2xl -z-10"></div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}