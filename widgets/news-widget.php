<?php
class AT8_News_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_news'; }
    public function get_title() { return 'AT8 Latest News (Dynamic)'; }
    public function get_icon() { return 'eicon-post-list'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        // Section Header Controls - Remain Editable
        $this->start_controls_section('header_content', ['label' => 'Section Header']);
        
        $this->add_control('title_1', ['label' => 'Title Blue', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'LATEST']);
        $this->add_control('title_2', ['label' => 'Title Yellow', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'NEWS']);
        $this->add_control('view_all_text', ['label' => 'Link Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'View All News']);
        $this->add_control('view_all_link', ['label' => 'Link URL', 'type' => \Elementor\Controls_Manager::URL]);

        $this->end_controls_section();

        // Query Controls - Added to allow editing the number of posts
        $this->start_controls_section('query_settings', ['label' => 'Query Settings']);
        
        $this->add_control('posts_count', [
            'label' => 'Number of Posts',
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 3,
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // 1. Dynamic WP_Query to fetch real posts
        $query_args = array(
            'post_type'      => 'post',
            'posts_per_page' => $settings['posts_count'],
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC'
        );

        $news_query = new \WP_Query($query_args);
        ?>

        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="flex justify-between items-end mb-16 reveal active">
                    <div>
                        <h2 class="text-4xl font-extrabold text-at8-blue mb-4 uppercase">
                            <?php echo esc_html($settings['title_1']); ?> <span class="text-at8-yellow"><?php echo esc_html($settings['title_2']); ?></span>
                        </h2>
                        <div class="h-1 w-24 bg-at8-yellow"></div>
                    </div>
                    <?php if ( ! empty( $settings['view_all_link']['url'] ) ) : ?>
                        <a href="<?php echo esc_url( $settings['view_all_link']['url'] ); ?>" class="link-animate text-at8-blue font-bold transition uppercase text-xs tracking-widest">
                            <?php echo esc_html($settings['view_all_text']); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <?php 
                    if ($news_query->have_posts()) :
                        $index = 0;
                        while ($news_query->have_posts()) : $news_query->the_post(); 
                            $delay = $index * 100;
                            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: 'https://via.placeholder.com/800x600';
                            $categories = get_the_category();
                            $cat_name = !empty($categories) ? $categories[0]->name : 'Industry Update';
                            ?>
                            
                            <div class="reveal active group cursor-pointer" style="transition-delay: <?php echo $delay; ?>ms;">
                                <a href="<?php the_permalink(); ?>" class="block no-underline">
                                    <div class="overflow-hidden rounded-xl mb-6 shadow-md bg-gray-100">
                                        <img src="<?php echo esc_url($thumb); ?>" 
                                             class="w-full h-48 object-cover group-hover:scale-110 transition duration-500 grayscale group-hover:grayscale-0" 
                                             alt="<?php the_title_attribute(); ?>">
                                    </div>
                                    <p class="text-at8-yellow text-xs font-bold mb-2 uppercase tracking-widest"><?php echo esc_html($cat_name); ?></p>
                                    <h3 class="font-bold text-xl mb-4 group-hover:text-at8-blue transition text-gray-900"><?php the_title(); ?></h3>
                                    <p class="text-gray-500 text-sm mb-4">
                                        <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                    </p>
                                    <span class="inline-block text-at8-blue font-bold text-xs uppercase tracking-tighter border-b-2 border-at8-yellow pb-1">
                                        Read Article <i class="fas fa-arrow-right ml-1"></i>
                                    </span>
                                </a>
                            </div>

                            <?php 
                            $index++;
                        endwhile; 
                        wp_reset_postdata(); 
                    else : 
                        echo '<p>No news articles found.</p>';
                    endif; 
                    ?>
                </div>

            </div>
        </section>
        <?php
    }
}