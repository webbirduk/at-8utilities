<?php
class AT8_News_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_news'; }
    public function get_title() { return 'AT8 Latest News'; }
    public function get_icon() { return 'eicon-post-list'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section('header_content', ['label' => 'Section Header']);
        
        $this->add_control('title_1', ['label' => 'Title Blue', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'LATEST']);
        $this->add_control('title_2', ['label' => 'Title Yellow', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'NEWS']);
        $this->add_control('view_all_text', ['label' => 'Link Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'View All News']);
        $this->add_control('view_all_link', ['label' => 'Link URL', 'type' => \Elementor\Controls_Manager::URL]);

        $this->end_controls_section();

        $this->start_controls_section('news_items', ['label' => 'News Articles']);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('n_tag', ['label' => 'Category Tag', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Framework Award']);
        $repeater->add_control('n_title', ['label' => 'Title', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'AT-8 Secures Kent Infrastructure Partnership']);
        $repeater->add_control('n_desc', ['label' => 'Excerpt', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'We are proud to announce our selection for a new 5-year framework agreement...']);
        $repeater->add_control('n_image', ['label' => 'Image', 'type' => \Elementor\Controls_Manager::MEDIA]);
        $repeater->add_control('n_link', ['label' => 'Read More Link', 'type' => \Elementor\Controls_Manager::URL]);

        $this->add_control('news_list', [
            'label' => 'News List',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'n_tag' => 'Framework Award',
                    'n_title' => 'AT-8 Secures Kent Infrastructure Partnership',
                    'n_desc' => 'We are proud to announce our selection for a new 5-year framework agreement delivering electrical grid upgrades across Kent.'
                ],
                [
                    'n_tag' => 'Investment',
                    'n_title' => 'Investing in New Specialist Fleet',
                    'n_desc' => "We've expanded our capabilities with a £1.5m investment in specialized cable pulling and winching equipment."
                ],
                [
                    'n_tag' => 'Safety Milestone',
                    'n_title' => '1,500 Days Without a Lost Time Incident',
                    'n_desc' => 'Safety remains our core value. Our team reaches a significant milestone across all water and electrical worksites.'
                ],
            ],
            'title_field' => '{{{ n_title }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="flex justify-between items-end mb-16 reveal active">
                    <div>
                        <h2 class="text-4xl font-extrabold text-at8-blue mb-4 uppercase">
                            <?php echo $settings['title_1']; ?> <span class="text-at8-yellow"><?php echo $settings['title_2']; ?></span>
                        </h2>
                        <div class="h-1 w-24 bg-at8-yellow"></div>
                    </div>
                    <?php if ( ! empty( $settings['view_all_link']['url'] ) ) : ?>
                        <a href="<?php echo esc_url( $settings['view_all_link']['url'] ); ?>" class="link-animate text-at8-blue font-bold transition uppercase text-xs tracking-widest">
                            <?php echo $settings['view_all_text']; ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <?php foreach ($settings['news_list'] as $index => $item) : 
                        $delay = $index * 100;
                    ?>
                    <div class="reveal active group cursor-pointer" style="transition-delay: <?php echo $delay; ?>ms;">
                        <div class="overflow-hidden rounded-xl mb-6 shadow-md">
                            <img src="<?php echo esc_url($item['n_image']['url']); ?>" 
                                 class="w-full h-48 object-cover group-hover:scale-110 transition duration-500" 
                                 alt="<?php echo esc_attr($item['n_title']); ?>">
                        </div>
                        <p class="text-at8-yellow text-xs font-bold mb-2 uppercase tracking-widest"><?php echo $item['n_tag']; ?></p>
                        <h3 class="font-bold text-xl mb-4 group-hover:text-at8-blue transition"><?php echo $item['n_title']; ?></h3>
                        <p class="text-gray-500 text-sm"><?php echo $item['n_desc']; ?></p>
                        
                        <?php if ( ! empty( $item['n_link']['url'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['n_link']['url'] ); ?>" class="mt-4 inline-block text-at8-blue font-bold text-xs uppercase tracking-tighter">Read Article <i class="fas fa-arrow-right ml-1"></i></a>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>
        <?php
    }
}