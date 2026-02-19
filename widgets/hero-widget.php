<?php
class AT8_Hero_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_hero'; }
    public function get_title() { return 'AT8 Hero Section'; }
    public function get_icon() { return 'eicon-banner'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section('content', ['label' => 'Hero Content']);

        $this->add_control('sub_title', [
            'label' => 'Sub Title',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Infrastructure Excellence',
        ]);

        $this->add_control('main_title_white', [
            'label' => 'Main Title (White Text)',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'EXCELLENCE IN',
        ]);

        $this->add_control('main_title_gradient', [
            'label' => 'Main Title (Gradient Text)',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'AT-8 UTILITIES',
        ]);

        $this->add_control('description', [
            'label' => 'Description',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'Delivering specialist electrical, water, and telecoms civils. From complex high-voltage networks to nationwide fibre rollouts.',
        ]);

        $this->add_control('bg_image', [
            'label' => 'Background Image',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=2000',
            ],
        ]);

        $this->add_control('btn1_text', ['label' => 'Button 1 Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Explore Our Sectors']);
        $this->add_control('btn1_link', ['label' => 'Button 1 Link', 'type' => \Elementor\Controls_Manager::URL]);
        
        $this->add_control('btn2_text', ['label' => 'Button 2 Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Work With Us']);
        $this->add_control('btn2_link', ['label' => 'Button 2 Link', 'type' => \Elementor\Controls_Manager::URL]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $bg_url = !empty($settings['bg_image']['url']) ? $settings['bg_image']['url'] : '';
        
        // Inline style for the specific background image while keeping class for the gradient overlay
        $inline_style = "background-image: linear-gradient(rgba(30, 58, 138, 0.7), rgba(17, 24, 39, 0.9)), url('{$bg_url}');";
        ?>

        <section id="home" class="relative min-h-screen flex items-center pt-20 overflow-hidden hero-bg" style="<?php echo $inline_style; ?>">
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="max-w-4xl">
                    <h2 class="text-at8-yellow font-bold tracking-[0.3em] uppercase mb-4 reveal active"><?php echo $settings['sub_title']; ?></h2>
                    
                    <h1 class="text-5xl md:text-8xl font-extrabold text-white mb-6 leading-tight reveal active" style="transition-delay: 200ms;">
                        <?php echo $settings['main_title_white']; ?> <br>
                        <span class="animate-brand-color"><?php echo $settings['main_title_gradient']; ?></span>
                    </h1>
                    
                    <p class="text-xl text-gray-200 mb-10 leading-relaxed border-l-4 border-at8-yellow pl-6 reveal active" style="transition-delay: 400ms;">
                        <?php echo $settings['description']; ?>
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 reveal active" style="transition-delay: 600ms;">
                        <a href="<?php echo esc_url($settings['btn1_link']['url']); ?>" class="btn-animate btn-yellow-to-blue bg-at8-yellow text-at8-dark px-8 py-4 rounded font-bold text-center shadow-lg uppercase text-xs tracking-widest">
                            <?php echo $settings['btn1_text']; ?>
                        </a>
                        <a href="<?php echo esc_url($settings['btn2_link']['url']); ?>" class="btn-animate btn-ghost-to-yellow bg-white/10 backdrop-blur-md text-white border border-white/30 px-8 py-4 rounded font-bold text-center hover:bg-white/20 uppercase text-xs tracking-widest">
                            <?php echo $settings['btn2_text']; ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <?php
    }
}