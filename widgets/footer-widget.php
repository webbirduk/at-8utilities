<?php
class AT8_Footer_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_footer'; }
    public function get_title() { return 'AT8 Dynamic Footer'; }
    public function get_icon() { return 'eicon-footer'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section('info', ['label' => 'Company Info']);
        $this->add_control('footer_logo', ['label' => 'Footer Logo', 'type' => \Elementor\Controls_Manager::MEDIA]);
        $this->add_control('about_text', ['label' => 'About Text', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Delivering world-class utility infrastructure solutions across the United Kingdom. Specialist directional drilling, energy networks, and multi-utility expertise since 1998.']);
        $this->end_controls_section();

        $this->start_controls_section('contact', ['label' => 'Contact Details']);
        $this->add_control('f_address', ['label' => 'Address', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => "Wellington House,\nLondon Colney, AL2 1HA"]);
        $this->add_control('f_phone', ['label' => 'Phone', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '020 8123 4567']);
        $this->add_control('f_email', ['label' => 'Email', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'info@at8utilities.co.uk']);
        $this->end_controls_section();
    }

    public function render_static($settings = []) {
        if (empty($settings)) {
            $settings = [
                'footer_logo' => ['url' => 'https://webbird.co.uk/wp-content/uploads/2026/02/AT8.png'],
                'about_text'  => 'Delivering world-class utility infrastructure solutions across the United Kingdom. Specialist directional drilling, energy networks, and multi-utility expertise since 1998.',
                'f_address'   => "Wellington House,\nLondon Colney, AL2 1HA",
                'f_phone'     => '020 8123 4567',
                'f_email'     => 'info@at8utilities.co.uk'
            ];
        }
        ?>
        <footer class="bg-at8-blue text-white pt-24 pb-12 relative overflow-hidden border-t-8 border-at8-yellow">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 -skew-x-12 translate-x-32 -translate-y-32"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-20">
                    
                    <div class="md:col-span-4 flex flex-col items-center text-center md:items-start md:text-left">
                        <div class="bg-white inline-block p-4 rounded-lg mb-8 shadow-xl">
                            <img src="<?php echo esc_url($settings['footer_logo']['url']); ?>" alt="AT-8 Utilities Logo" class="h-10 w-auto">
                        </div>
                        <p class="text-blue-50 text-sm leading-relaxed mb-8 md:pr-12">
                            <?php echo esc_html($settings['about_text']); ?>
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="btn-animate btn-ghost-to-yellow w-10 h-10 bg-white/10 border border-white/20 rounded flex items-center justify-center hover:text-at8-blue"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="btn-animate btn-ghost-to-yellow w-10 h-10 bg-white/10 border border-white/20 rounded flex items-center justify-center hover:text-at8-blue"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn-animate btn-ghost-to-yellow w-10 h-10 bg-white/10 border border-white/20 rounded flex items-center justify-center hover:text-at8-blue"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <h4 class="text-at8-yellow font-black uppercase tracking-widest text-[11px] mb-8">Quick Links</h4>
                        <?php wp_nav_menu([
                            'theme_location' => 'at8_quick_links',
                            'menu_class'     => 'space-y-4 text-blue-100 text-sm at8-footer-menu',
                            'fallback_cb'    => false,
                        ]); ?>
                    </div>

                    <div class="md:col-span-3">
                        <h4 class="text-at8-yellow font-black uppercase tracking-widest text-[11px] mb-8">Our Sectors</h4>
                        <?php wp_nav_menu([
                            'theme_location' => 'at8_sectors',
                            'menu_class'     => 'space-y-4 text-blue-100 text-sm at8-footer-menu',
                            'fallback_cb'    => false,
                        ]); ?>
                    </div>

                    <div class="md:col-span-3">
                        <h4 class="text-at8-yellow font-black uppercase tracking-widest text-[11px] mb-8">Global HQ</h4>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-at8-yellow mt-1 mr-4"></i>
                                <p class="text-blue-50 text-sm"><?php echo nl2br(esc_html($settings['f_address'])); ?></p>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone text-at8-yellow mr-4"></i>
                                <p class="text-blue-50 text-sm font-bold"><?php echo esc_html($settings['f_phone']); ?></p>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-at8-yellow mr-4"></i>
                                <p class="text-blue-50 text-sm"><?php echo esc_html($settings['f_email']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-white/10 flex flex-col md:flex-row justify-between items-center text-center text-[10px] uppercase tracking-[0.2em] text-blue-200 font-bold">
                    <p>&copy; <?php echo date('Y'); ?> AT-8 Utilities Ltd. All Rights Reserved.</p>
                    <?php wp_nav_menu([
                        'theme_location' => 'at8_legal',
                        'container'      => 'div',
                        'container_class'=> 'mt-6 md:mt-0',
                        'menu_class'     => 'flex flex-wrap justify-center space-x-8 at8-legal-nav',
                        'fallback_cb'    => false,
                    ]); ?>
                </div>
            </div>
        </footer>
        <?php
    }

    protected function render() {
        $this->render_static($this->get_settings_for_display());
    }
}