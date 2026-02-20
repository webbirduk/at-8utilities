<?php
class AT8_Contactus_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_contact_page'; }
    public function get_title() { return 'AT8 Contact Page (Complete)'; }
    public function get_icon() { return 'eicon-envelope'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {

        // --- HERO SECTION ---
        $this->start_controls_section('hero_section', ['label' => '1. Hero Section']);
        $this->add_control('hero_bg', [
            'label' => 'Background Image',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => ['url' => 'https://images.unsplash.com/photo-1516937941344-00b4e0337589?auto=format&fit=crop&q=80&w=2000'],
        ]);
        $this->add_control('hero_title', [
            'label' => 'Main Title',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => "LET'S BUILD <br><span class='text-at8-yellow'>TOGETHER</span>",
        ]);
        $this->add_control('hero_desc', [
            'label' => 'Description',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'Have a project in mind? Our specialist teams are ready to provide expert multi-utility solutions across the UK.',
        ]);
        $this->end_controls_section();

        // --- COMPANY INFO ---
        $this->start_controls_section('info_section', ['label' => '2. Company Information']);
        $this->add_control('phone', [
            'label' => 'Phone Number',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '07470 862324',
        ]);
        $this->add_control('email', [
            'label' => 'Email Address',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'info@at-8utilities.com',
        ]);
        $this->add_control('address', [
            'label' => 'Office Address',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => "8 Brattle, Woodchurch,\nAshford, Kent, TN26 3SW",
        ]);
        $this->end_controls_section();

        // --- FORM SETTINGS ---
        $this->start_controls_section('form_section', ['label' => '3. Form Settings']);
        $this->add_control('form_shortcode', [
            'label' => 'Form Shortcode (Optional)',
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => '[contact-form-7 id="..."]',
            'description' => 'If left empty, a placeholder professional form will be shown.',
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <header class="contact-hero min-h-[50vh] flex items-center pt-20" style="background-image: linear-gradient(rgba(30, 58, 138, 0.85), rgba(17, 24, 39, 0.95)), url('<?php echo esc_url($settings['hero_bg']['url']); ?>');">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <div class="max-w-3xl">
                    <h2 class="text-at8-yellow font-bold tracking-[0.3em] uppercase mb-4 reveal">Get In Touch</h2>
                    <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase reveal" style="transition-delay: 200ms;">
                        <?php echo $settings['hero_title']; ?>
                    </h1>
                    <p class="text-xl text-blue-100 leading-relaxed border-l-4 border-at8-yellow pl-6 reveal" style="transition-delay: 400ms;">
                        <?php echo esc_html($settings['hero_desc']); ?>
                    </p>
                </div>
            </div>
        </header>

        <section class="py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                    
                    <div class="lg:col-span-5 reveal">
                        <h2 class="text-4xl font-black text-at8-blue uppercase mb-8">COMPANY <span class="text-at8-yellow">INFORMATION</span></h2>
                        
                        <div class="space-y-10">
                            <div class="flex items-start">
                                <div class="w-14 h-14 bg-at8-blue text-at8-yellow flex items-center justify-center rounded-lg mr-6 flex-shrink-0 shadow-lg">
                                    <i class="fas fa-phone-alt text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-black uppercase text-xs tracking-widest text-gray-400 mb-1">Call Us Directly</h4>
                                    <a href="tel:<?php echo esc_attr($settings['phone']); ?>" class="text-2xl font-bold text-at8-blue hover:text-at8-yellow transition"><?php echo esc_html($settings['phone']); ?></a>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="w-14 h-14 bg-at8-blue text-at8-yellow flex items-center justify-center rounded-lg mr-6 flex-shrink-0 shadow-lg">
                                    <i class="fas fa-envelope text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-black uppercase text-xs tracking-widest text-gray-400 mb-1">Email Our Team</h4>
                                    <a href="mailto:<?php echo esc_attr($settings['email']); ?>" class="text-2xl font-bold text-at8-blue hover:text-at8-yellow transition"><?php echo esc_html($settings['email']); ?></a>
                                </div>
                            </div>

                            <div class="flex items-start border-t border-gray-200 pt-10">
                                <div class="w-14 h-14 bg-at8-yellow text-at8-blue flex items-center justify-center rounded-lg mr-6 flex-shrink-0 shadow-lg">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-black uppercase text-xs tracking-widest text-gray-400 mb-1">Visit Our Base</h4>
                                    <p class="text-xl font-bold text-at8-blue leading-tight">
                                        <?php echo nl2br(esc_html($settings['address'])); ?>
                                    </p>
                                </div>
                            </div>

                            <div class="bg-at8-blue p-8 rounded-xl text-white relative overflow-hidden mt-12 shadow-2xl">
                                <div class="relative z-10">
                                    <h4 class="text-at8-yellow font-black uppercase text-[10px] tracking-widest mb-4">Service Area</h4>
                                    <h3 class="text-2xl font-bold mb-2">Nationwide Coverage</h3>
                                    <p class="text-blue-100 text-sm leading-relaxed">
                                        Operating from our Kent headquarters, we provide multi-utility contracting services for large-scale developments and infrastructure upgrades throughout the UK.
                                    </p>
                                </div>
                                <i class="fas fa-globe-europe absolute -bottom-6 -right-6 text-9xl text-white/5"></i>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-7 bg-white p-10 md:p-16 rounded-2xl shadow-2xl reveal border-t-8 border-at8-yellow" style="transition-delay: 300ms;">
                        <h3 class="text-3xl font-black text-at8-blue uppercase mb-8">Send A <span class="text-at8-yellow">Message</span></h3>
                        
                        <?php if ( ! empty( $settings['form_shortcode'] ) ) : ?>
                            <?php echo do_shortcode( $settings['form_shortcode'] ); ?>
                        <?php else : ?>
                            <form action="#" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-at8-blue mb-2">Full Name</label>
                                        <input type="text" placeholder="John Smith" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-lg input-focus transition shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-at8-blue mb-2">Phone Number</label>
                                        <input type="tel" placeholder="07123 456789" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-lg input-focus transition shadow-sm">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-at8-blue mb-2">Email Address</label>
                                    <input type="email" placeholder="john@example.com" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-lg input-focus transition shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-at8-blue mb-2">Project Description</label>
                                    <textarea rows="5" placeholder="Tell us about your requirements..." class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-lg input-focus transition shadow-sm"></textarea>
                                </div>
<button type="submit" class="btn-animate w-full bg-at8-blue text-white py-5 rounded-lg font-black uppercase tracking-widest text-xs shadow-xl hover:bg-at8-yellow hover:text-at8-dark group transition-all duration-400">
    Submit Inquiry 
    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform duration-300"></i>
</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>


        <script>
            jQuery(document).ready(function($) {
                const obs = new IntersectionObserver((entries) => {
                    entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('active'); });
                }, { threshold: 0.1 });
                document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
            });
        </script>
        <?php
    }
}