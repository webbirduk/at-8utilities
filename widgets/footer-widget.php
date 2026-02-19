<?php
class AT8_Footer_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_footer'; }
    public function get_title() { return 'AT8 Dynamic Footer'; }
    public function get_icon() { return 'eicon-footer'; }

    protected function register_controls() {
        $this->start_controls_section('info', ['label' => 'Company Info']);
        $this->add_control('footer_logo', ['label' => 'Footer Logo', 'type' => \Elementor\Controls_Manager::MEDIA]);
        $this->add_control('about_text', ['label' => 'About Text', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Specialist utility infrastructure solutions across the United Kingdom.']);
        $this->end_controls_section();

        $this->start_controls_section('contact', ['label' => 'Contact Details']);
        $this->add_control('f_address', ['label' => 'Address', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => "8 Brattle, Woodchurch,\nAshford, Kent, TN26 3SW"]);
        $this->add_control('f_phone', ['label' => 'Phone', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '07470 862324']);
        $this->add_control('f_email', ['label' => 'Email', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'info@at8utilities.co.uk']);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <footer class="bg-at8-blue text-white pt-24 pb-12 relative overflow-hidden border-t-8 border-at8-yellow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-20">
                    <div class="md:col-span-4">
                        <div class="bg-white inline-block p-4 rounded-lg mb-8 shadow-xl">
                            <img src="<?php echo esc_url($settings['footer_logo']['url']); ?>" class="h-10 w-auto">
                        </div>
                        <p class="text-blue-50 text-sm leading-relaxed mb-8 pr-12"><?php echo $settings['about_text']; ?></p>
                    </div>

                    <div class="md:col-span-4">
                        <h4 class="text-at8-yellow font-black uppercase tracking-widest text-[11px] mb-8">Head Office</h4>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-at8-yellow mt-1 mr-4"></i>
                                <p class="text-blue-50 text-sm"><?php echo nl2br($settings['f_address']); ?></p>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-mobile-alt text-at8-yellow mr-4"></i>
                                <p class="text-blue-50 text-sm font-bold"><?php echo $settings['f_phone']; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-4">
                        <h4 class="text-at8-yellow font-black uppercase tracking-widest text-[11px] mb-8">Newsletter & Enquiries</h4>
                        <p class="text-blue-50 text-sm mb-4">Email us directly at:</p>
                        <p class="text-at8-yellow font-bold"><?php echo $settings['f_email']; ?></p>
                    </div>
                </div>

                <div class="pt-10 border-t border-white/10 text-center text-[10px] uppercase tracking-[0.2em] text-blue-200 font-bold">
                    <p>&copy; <?php echo date('Y'); ?> AT-8 Utilities Ltd. All Rights Reserved. Design By WebBird</p>
                </div>
            </div>
        </footer>
        <?php
    }
}