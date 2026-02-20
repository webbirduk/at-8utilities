<?php
class AT8_About_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_about_page_full'; }
    public function get_title() { return 'AT8 About Page (Complete)'; }
    public function get_icon() { return 'eicon-post-content'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {

        // --- HERO SECTION ---
        $this->start_controls_section('hero_section', ['label' => '1. Hero Section']);
        $this->add_control('hero_bg', [
            'label' => 'Background Image',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => ['url' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&q=80&w=2000'],
        ]);
        $this->add_control('hero_sub', [
            'label' => 'Sub-title',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Trusted Infrastructure Partners',
        ]);
        $this->add_control('hero_title', [
            'label' => 'Main Title',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => 'BUILDING THE <br><span class="text-at8-yellow">BACKBONE</span> OF THE UK',
        ]);
        $this->add_control('hero_desc', [
            'label' => 'Description',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'AT-8 Utilities Ltd is a trusted multi-utility contractor based in Ashford, Kent, delivering end-to-end solutions across Electrical, Water, and Telecommunications infrastructure.',
        ]);
        $this->end_controls_section();

        // --- MISSION SECTION ---
        $this->start_controls_section('mission_section', ['label' => '2. Mission & Background']);
        $this->add_control('mission_title', [
            'label' => 'Title',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'A Commitment to Excellence',
        ]);
        $this->add_control('mission_desc_1', [
            'label' => 'Paragraph 1',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'We are dedicated to providing safe, compliant, and high-quality services that support commercial, industrial, and utility projects throughout the UK.',
        ]);
        $this->add_control('mission_desc_2', [
            'label' => 'Paragraph 2',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'With years of hands-on experience, our teams bring the knowledge, technical capability, and commitment required to deliver complex infrastructure works — on time, within budget, and to the highest standards.',
        ]);
        $this->add_control('mission_image', [
            'label' => 'Side Image',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => ['url' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&q=80&w=1000'],
        ]);
        $this->end_controls_section();

        // --- EXPERTISE SECTION ---
        $this->start_controls_section('expertise_section', ['label' => '3. Our Expertise']);
        $repeater_exp = new \Elementor\Repeater();
        $repeater_exp->add_control('icon', ['label' => 'Icon Class', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'fa-bolt']);
        $repeater_exp->add_control('title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Electrical Infrastructure']);
        $repeater_exp->add_control('desc', ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'LV, HV & EHV cable installation, joint bays, substations, and street lighting.']);
        
        $this->add_control('expertise_list', [
            'label' => 'Expertise Items',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater_exp->get_controls(),
            'default' => [
                ['title' => 'Electrical Infrastructure', 'icon' => 'fa-bolt', 'desc' => 'LV, HV & EHV cable installation, joint bays, substations, and street lighting.'],
                ['title' => 'Water Infrastructure', 'icon' => 'fa-tint', 'desc' => 'Service connections, mains renewals, and trunk main installations.'],
                ['title' => 'Telecommunications Civils', 'icon' => 'fa-broadcast-tower', 'desc' => 'Fibre network civils, ducting, chamber construction, and reinstatement.'],
                ['title' => 'Civil Engineering', 'icon' => 'fa-hard-hat', 'desc' => 'Excavation, ducting, formwork, backfill, and reinstatement.'],
            ],
            'title_field' => '{{{ title }}}',
        ]);
        $this->end_controls_section();

        // --- COMMITMENT SECTION ---
        $this->start_controls_section('commitment_section', ['label' => '4. Commitment & Reasons']);
        $repeater_reasons = new \Elementor\Repeater();
        $repeater_reasons->add_control('text', ['label' => 'Reason', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Proven experience in infrastructure']);
        
        $this->add_control('reasons_list', [
            'label' => 'Why Choose Us Reasons',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater_reasons->get_controls(),
            'default' => [
                ['text' => 'Proven experience in multi-utility infrastructure'],
                ['text' => 'Fully trained and accredited professionals'],
                ['text' => 'Safe, efficient, and compliant delivery'],
                ['text' => 'End-to-end project management'],
                ['text' => 'Commitment to quality and client satisfaction'],
            ],
        ]);
        $this->end_controls_section();

        // --- COVERAGE & CTA ---
        $this->start_controls_section('coverage_section', ['label' => '5. Coverage & CTA']);
        $this->add_control('cov_image', [
            'label' => 'Map/Coverage Image',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => ['url' => 'https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&q=80&w=1000'],
        ]);
        $this->add_control('address_text', [
            'label' => 'Address Display',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => "AT-8 Utilities Ltd\n8 Brattle, Woodchurch, Ashford, Kent, TN26 3SW",
        ]);
        $this->add_control('phone', ['label' => 'Phone', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '07470 862324']);
        $this->add_control('email', ['label' => 'Email', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'info@at-8utilities.com']);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <section class="about-hero min-h-[70vh] flex items-center pt-20" style="background-image: linear-gradient(rgba(30, 58, 138, 0.8), rgba(17, 24, 39, 0.95)), url('<?php echo esc_url($settings['hero_bg']['url']); ?>');">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="max-w-3xl">
                    <h4 class="text-at8-yellow font-bold tracking-[0.3em] uppercase mb-4 reveal"><?php echo esc_html($settings['hero_sub']); ?></h4>
                    <div class="text-5xl md:text-7xl font-black text-white mb-8 leading-tight reveal" style="transition-delay: 200ms;">
                        <?php echo $settings['hero_title']; ?>
                    </div>
                    <p class="text-xl text-blue-100 leading-relaxed border-l-4 border-at8-yellow pl-6 reveal" style="transition-delay: 400ms;">
                        <?php echo esc_html($settings['hero_desc']); ?>
                    </p>
                </div>
            </div>
        </section>

        <section class="py-24 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="reveal">
                        <h2 class="text-at8-blue font-black text-4xl mb-8 uppercase"><?php echo esc_html($settings['mission_title']); ?></h2>
                        <p class="text-gray-600 text-lg mb-6 leading-relaxed"><?php echo esc_html($settings['mission_desc_1']); ?></p>
                        <p class="text-gray-600 text-lg mb-8 leading-relaxed"><?php echo esc_html($settings['mission_desc_2']); ?></p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <?php $f_icons = ['Expert Management', 'Safe Delivery', 'UK Wide Coverage', 'Full Compliance'];
                            foreach($f_icons as $f): ?>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-at8-yellow mt-1 mr-3"></i>
                                <span class="font-bold text-at8-blue uppercase text-xs tracking-wider"><?php echo $f; ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="relative reveal shadow-2xl rounded-lg overflow-hidden lg:rotate-2">
                        <img src="<?php echo esc_url($settings['mission_image']['url']); ?>" alt="Onsite" class="w-full h-full object-cover">
                        <div class="absolute bottom-0 right-0 bg-at8-yellow p-6">
                            <p class="text-at8-blue font-black text-3xl">25+</p>
                            <p class="text-at8-dark font-bold text-[10px] uppercase tracking-widest">Years Experience</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 reveal">
                    <h2 class="text-4xl font-black text-at8-blue uppercase">OUR <span class="text-at8-yellow">EXPERTISE</span></h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php foreach($settings['expertise_list'] as $idx => $item): ?>
                    <div class="expertise-card bg-white p-8 reveal" style="transition-delay: <?php echo ($idx+1)*100; ?>ms;">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-50 flex items-center justify-center rounded text-at8-blue mr-4">
                                <i class="fas <?php echo esc_attr($item['icon']); ?> text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold uppercase tracking-tight"><?php echo esc_html($item['title']); ?></h3>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed"><?php echo esc_html($item['desc']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="py-24 bg-at8-blue text-white slant-box">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                    <div class="reveal">
                        <h2 class="text-4xl font-black uppercase mb-8">OUR <span class="text-at8-yellow">COMMITMENT</span></h2>
                        <p class="text-blue-100 text-lg mb-8">Safety and compliance are at the heart of everything we do. We operate in full accordance with NRSWA, WRAS, and Industry standards.</p>
                        <div class="space-y-6">
                            <div class="flex"><div class="w-10 h-10 bg-at8-yellow text-at8-blue flex items-center justify-center rounded-full mr-4"><i class="fas fa-shield-alt"></i></div><div><h4 class="font-bold text-at8-yellow uppercase text-xs">Health & Safety</h4><p class="text-sm">Strict site-safety practices.</p></div></div>
                            <div class="flex"><div class="w-10 h-10 bg-at8-yellow text-at8-blue flex items-center justify-center rounded-full mr-4"><i class="fas fa-leaf"></i></div><div><h4 class="font-bold text-at8-yellow uppercase text-xs">Sustainability</h4><p class="text-sm">Long-term infrastructure solutions.</p></div></div>
                        </div>
                    </div>
                    <div class="bg-white/5 backdrop-blur-md p-10 rounded-xl border border-white/10 reveal">
                        <h3 class="text-2xl font-black uppercase mb-6 text-at8-yellow">Why Choose Us</h3>
                        <ul class="space-y-6">
                            <?php foreach($settings['reasons_list'] as $i => $r): ?>
                            <li class="flex items-center space-x-4 border-b border-white/10 pb-4">
                                <span class="text-at8-yellow font-black text-lg">0<?php echo $i+1; ?>.</span>
                                <span class="font-bold uppercase text-xs tracking-widest"><?php echo esc_html($r['text']); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center gap-16">
                    <div class="w-full md:w-1/2 reveal">
                        <img src="<?php echo esc_url($settings['cov_image']['url']); ?>" alt="UK Coverage" class="rounded-2xl shadow-xl grayscale hover:grayscale-0 transition duration-700">
                    </div>
                    <div class="w-full md:w-1/2 reveal">
                        <h2 class="text-4xl font-black text-at8-blue uppercase mb-6"><span class="text-at8-yellow">NATIONWIDE</span> COVERAGE</h2>
                        <p class="text-gray-600 text-lg mb-6">From our base in <strong>Ashford, Kent</strong>, we operate across the UK, supporting large-scale developments and infrastructure upgrades.</p>
                        <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-at8-yellow">
                            <p class="text-at8-blue font-bold uppercase text-xs tracking-widest mb-2">Base Location</p>
                            <p class="text-gray-900 font-bold"><?php echo nl2br(esc_html($settings['address_text'])); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-at8-yellow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
                <h2 class="text-4xl font-black text-at8-blue uppercase mb-6">Ready to start your project?</h2>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="tel:<?php echo esc_attr($settings['phone']); ?>" class="bg-at8-blue text-white px-10 py-4 rounded font-bold uppercase text-xs tracking-widest hover:bg-at8-dark transition">Call: <?php echo esc_html($settings['phone']); ?></a>
                    <a href="mailto:<?php echo esc_attr($settings['email']); ?>" class="bg-white text-at8-blue border-2 border-at8-blue px-10 py-4 rounded font-bold uppercase text-xs tracking-widest hover:bg-gray-100 transition">Email Team</a>
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