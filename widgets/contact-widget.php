<?php
class AT8_Contact_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_contact'; }
    public function get_title() { return 'AT8 Contact & Leads'; }
    public function get_icon() { return 'eicon-envelope'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section('content', ['label' => 'Contact Details']);

        $this->add_control('phone', [
            'label' => 'Mobile Contact',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '07470 862324',
        ]);

        $this->add_control('email', [
            'label' => 'Send Email',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'info@at8utilities.co.uk',
        ]);

        $this->add_control('address', [
            'label' => 'Global HQ Address',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => "8 Brattle, Woodchurch,\nAshford, Kent, TN26 3SW",
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section id="contact" class="bg-white py-24 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <?php if (isset($_GET['at8_success'])): ?>
                    <div class="bg-green-600 text-white p-4 mb-8 rounded shadow-lg flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        <span>Thank you! Your infrastructure enquiry has been received and saved to our dashboard.</span>
                    </div>
                <?php endif; ?>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 shadow-2xl rounded-2xl overflow-hidden reveal active">
                    <div class="bg-at8-blue p-12 md:p-16 text-white flex flex-col justify-between">
                        <div>
                            <h2 class="text-4xl md:text-5xl font-black mb-6 uppercase leading-tight">LET'S BUILD THE <span class="text-at8-yellow">FUTURE</span></h2>
                            <p class="text-blue-100 text-lg mb-12">Contact us today to discuss your infrastructure requirements. Our specialist team is available for national project support.</p>
                            
                            <div class="space-y-8">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-at8-yellow flex items-center justify-center rounded-full mr-6 text-at8-blue">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <div>
                                        <p class="text-at8-yellow font-bold uppercase text-[10px] tracking-widest">Mobile Contact</p>
                                        <p class="text-xl font-bold"><?php echo esc_html($settings['phone']); ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-at8-yellow flex items-center justify-center rounded-full mr-6 text-at8-blue">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <p class="text-at8-yellow font-bold uppercase text-[10px] tracking-widest">Send Email</p>
                                        <p class="text-xl font-bold"><?php echo esc_html($settings['email']); ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-at8-yellow flex items-center justify-center rounded-full mr-6 text-at8-blue">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <p class="text-at8-yellow font-bold uppercase text-[10px] tracking-widest">Global HQ</p>
                                        <p class="text-lg font-bold leading-tight"><?php echo nl2br(esc_html($settings['address'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-12 md:p-16">
                        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="space-y-6">
                            <input type="hidden" name="action" value="at8_submit_contact">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-at8-blue font-black uppercase text-[10px] tracking-widest mb-2">Your Name</label>
                                    <input type="text" name="at8_name" placeholder="Full Name" required class="w-full px-5 py-4 rounded bg-white border border-gray-200 focus:border-at8-yellow outline-none transition shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-at8-blue font-black uppercase text-[10px] tracking-widest mb-2">Email Address</label>
                                    <input type="email" name="at8_email" placeholder="Email" required class="w-full px-5 py-4 rounded bg-white border border-gray-200 focus:border-at8-yellow outline-none transition shadow-sm">
                                </div>
                            </div>
                            <div>
                                <label class="block text-at8-blue font-black uppercase text-[10px] tracking-widest mb-2">Service Interest</label>
                                <select name="at8_service" class="w-full px-5 py-4 rounded bg-white border border-gray-200 focus:border-at8-yellow outline-none transition shadow-sm appearance-none">
                                    <option>Electrical Services (LV/HV/EHV)</option>
                                    <option>Water Infrastructure</option>
                                    <option>Telecommunications Civils</option>
                                    <option>Fibre Network Support</option>
                                    <option>General Civil Engineering</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-at8-blue font-black uppercase text-[10px] tracking-widest mb-2">Your Message</label>
                                <textarea name="at8_message" rows="4" placeholder="How can we help with your project?" class="w-full px-5 py-4 rounded bg-white border border-gray-200 focus:border-at8-yellow outline-none transition shadow-sm"></textarea>
                            </div>
                            <button type="submit" class="btn-animate btn-yellow-to-blue w-full bg-at8-yellow text-at8-dark py-5 rounded font-black uppercase tracking-widest text-xs shadow-lg">
                                Submit Project Enquiry <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}