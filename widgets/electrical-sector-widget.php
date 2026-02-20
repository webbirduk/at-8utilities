<?php
class AT8_Electrical_Sector_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_electrical_sector'; }
    public function get_title() { return 'AT8 Electrical Infrastructure (Complete)'; }
    public function get_icon() { return 'eicon-bolt'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {

        // --- HERO SECTION ---
        $this->start_controls_section('hero_section', ['label' => '1. Hero Section']);
        $this->add_control('hero_bg', [
            'label' => 'Hero Background',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => ['url' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&q=80&w=2000'],
        ]);
        $this->add_control('hero_title', [
            'label' => 'Main Title',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => 'ELECTRICAL <br><span class="text-at8-yellow">INFRASTRUCTURE</span>',
        ]);
        $this->add_control('hero_desc', [
            'label' => 'Description',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'Powering the nation with robust LV, HV, and EHV network solutions. From substation construction to smart grid expansion.',
        ]);
        $this->end_controls_section();

        // --- OVERVIEW SECTION ---
        $this->start_controls_section('overview_section', ['label' => '2. Overview Section']);
        $this->add_control('ov_title', [
            'label' => 'Title',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => 'ENERGISING THE <br><span class="text-at8-yellow">MODERN GRID</span>',
        ]);
        $this->add_control('ov_desc_1', [
            'label' => 'Paragraph 1',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'AT-8 Utilities Ltd provides comprehensive electrical engineering services for the UK\'s power networks. We specialise in the installation and maintenance of critical power infrastructure for DNOs, IDNOs, and private developers.',
        ]);
        $this->add_control('ov_image', [
            'label' => 'Side Image',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => ['url' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&q=80&w=1000'],
        ]);
        $this->end_controls_section();

        // --- CORE SERVICES REPEATER ---
        $this->start_controls_section('services_section', ['label' => '3. Core Power Services']);
        $repeater = new \Elementor\Repeater();
        $repeater->add_control('s_icon', ['label' => 'Icon Class', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'fa-charging-station']);
        $repeater->add_control('s_title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Cable Installation']);
        $repeater->add_control('s_desc', ['label' => 'Description', 'type' => \Elementor\Controls_Manager::TEXTAREA]);
        $repeater->add_control('s_list', ['label' => 'Features (One per line)', 'type' => \Elementor\Controls_Manager::TEXTAREA]);
        
        $this->add_control('services_list', [
            'label' => 'Service Cards',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                ['s_title' => 'Cable Installation', 's_icon' => 'fa-charging-station', 's_desc' => 'Expert installation of LV, HV, and EHV cabling.', 's_list' => "HV/LV Jointing\nEHV Cable Pulling"],
                ['s_title' => 'Substations', 's_icon' => 'fa-industry', 's_desc' => 'Turnkey substation solutions including base construction and switchgear.', 's_list' => "Primary Subsites\nSecondary Fit-out"],
                ['s_title' => 'Public Lighting', 's_icon' => 'fa-lightbulb', 's_desc' => 'Specialist street lighting installation and maintenance.', 's_list' => "Highway Lighting\nEV Infrastructure"],
            ],
            'title_field' => '{{{ s_title }}}',
        ]);
        $this->end_controls_section();

        // --- FEATURED PROJECT ---
        $this->start_controls_section('project_section', ['label' => '4. Featured Project']);
        $this->add_control('proj_image', [
            'label' => 'Project Image',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => ['url' => 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&q=80&w=1200'],
        ]);
        $this->add_control('proj_title', [
            'label' => 'Title',
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => 'London <br><span class="text-at8-yellow">Smart Grid Expansion</span>',
        ]);
        $this->add_control('proj_desc', [
            'label' => 'Description',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'Working alongside National Grid Infrastructure, AT-8 Utilities delivered critical HV reinforcement across the capital.',
        ]);
        $this->end_controls_section();

        // --- CTA SECTION ---
        $this->start_controls_section('cta_section', ['label' => '5. CTA Settings']);
        $this->add_control('cta_title', ['label' => 'CTA Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Powering Your Next Project']);
        $this->add_control('cta_phone', ['label' => 'Phone', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '07470 862324']);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <header class="sector-hero min-h-[60vh] flex items-center pt-20" style="background-image: linear-gradient(rgba(30, 58, 138, 0.8), rgba(17, 24, 39, 0.9)), url('<?php echo esc_url($settings['hero_bg']['url']); ?>');">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="max-w-3xl">
                    <h4 class="text-at8-yellow font-bold tracking-[0.3em] uppercase mb-4 reveal">Sector Specialties</h4>
                    <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase reveal" style="transition-delay: 200ms;">
                        <?php echo $settings['hero_title']; ?>
                    </h1>
                    <p class="text-xl text-blue-100 leading-relaxed border-l-4 border-at8-yellow pl-6 reveal" style="transition-delay: 400ms;">
                        <?php echo esc_html($settings['hero_desc']); ?>
                    </p>
                </div>
            </div>
        </header>

        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="reveal">
                        <h2 class="text-at8-blue font-black text-4xl mb-8 uppercase leading-tight"><?php echo $settings['ov_title']; ?></h2>
                        <p class="text-gray-600 text-lg mb-8 leading-relaxed"><?php echo esc_html($settings['ov_desc_1']); ?></p>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="industrial-accent">
                                <h4 class="font-bold text-at8-blue uppercase text-xs tracking-widest mb-1">Voltage Range</h4>
                                <p class="text-xs text-gray-500">LV, HV, and EHV up to 132kV.</p>
                            </div>
                            <div class="industrial-accent">
                                <h4 class="font-bold text-at8-blue uppercase text-xs tracking-widest mb-1">Accreditation</h4>
                                <p class="text-xs text-gray-500">Fully NERS Accredited Provider.</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative reveal" style="transition-delay: 200ms;">
                        <div class="aspect-video rounded-2xl overflow-hidden shadow-2xl">
                            <img src="<?php echo esc_url($settings['ov_image']['url']); ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-6 -left-6 bg-at8-blue p-8 rounded-lg shadow-xl text-white">
                            <i class="fas fa-bolt text-at8-yellow text-4xl mb-4"></i>
                            <h4 class="font-bold uppercase tracking-widest text-xs">Power Solutions</h4>
                            <p class="text-blue-200 text-xs mt-2">Connecting communities to reliable energy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 reveal">
                    <h2 class="text-4xl font-black text-at8-blue uppercase">CORE <span class="text-at8-yellow">POWER SERVICES</span></h2>
                    <div class="h-1.5 w-24 bg-at8-yellow mx-auto mt-4"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php foreach($settings['services_list'] as $idx => $item): ?>
                    <div class="bg-white p-10 rounded-xl service-card reveal" style="transition-delay: <?php echo ($idx+1)*100; ?>ms;">
                        <div class="w-14 h-14 bg-blue-50 text-at8-blue flex items-center justify-center rounded-lg mb-8">
                            <i class="fas <?php echo esc_attr($item['s_icon']); ?> text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-at8-blue mb-4 uppercase"><?php echo esc_html($item['s_title']); ?></h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6"><?php echo esc_html($item['s_desc']); ?></p>
                        <ul class="text-[10px] font-black uppercase tracking-widest text-at8-blue space-y-2">
                            <?php 
                                $lines = explode("\n", $item['s_list']);
                                foreach($lines as $line) if(!empty($line)) echo '<li><i class="fas fa-check text-at8-yellow mr-2"></i>'.esc_html($line).'</li>';
                            ?>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="py-24 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-at8-blue rounded-3xl overflow-hidden shadow-2xl flex flex-col lg:flex-row">
                    <div class="lg:w-1/2 relative h-80 lg:h-auto">
                        <img src="<?php echo esc_url($settings['proj_image']['url']); ?>" class="w-full h-full object-cover">
                        <div class="absolute top-8 left-8 bg-at8-yellow text-at8-dark px-4 py-2 font-black text-xs uppercase tracking-widest">Featured Project</div>
                    </div>
                    <div class="lg:w-1/2 p-12 lg:p-16 text-white flex flex-col justify-center">
                        <h3 class="text-3xl font-black uppercase mb-6 leading-tight"><?php echo $settings['proj_title']; ?></h3>
                        <p class="text-blue-100 mb-8 leading-relaxed"><?php echo esc_html($settings['proj_desc']); ?></p>
                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div><p class="text-at8-yellow font-black uppercase text-[10px] tracking-widest mb-1">Customer</p><p class="text-xl font-bold">National Grid</p></div>
                            <div><p class="text-at8-yellow font-black uppercase text-[10px] tracking-widest mb-1">Status</p><p class="text-xl font-bold">Completed</p></div>
                        </div>
                        <a href="https://at-8utilities.com/contact-us/" class="btn-animate border-2 border-at8-yellow text-at8-yellow px-8 py-3 rounded font-bold text-center uppercase text-xs tracking-widest hover:bg-at8-yellow hover:text-at8-blue transition">Enquire About Power Works</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-at8-yellow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
                <h2 class="text-4xl font-black text-at8-blue uppercase mb-6"><?php echo esc_html($settings['cta_title']); ?></h2>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#" class="bg-at8-blue text-white px-10 py-4 rounded font-bold uppercase text-xs tracking-widest hover:bg-at8-dark transition">Get A Quote</a>
                    <a href="tel:<?php echo esc_attr($settings['cta_phone']); ?>" class="bg-white text-at8-blue border-2 border-at8-blue px-10 py-4 rounded font-bold uppercase text-xs tracking-widest hover:bg-gray-100 transition">Call: <?php echo esc_html($settings['cta_phone']); ?></a>
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