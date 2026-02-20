<?php
class AT8_Header_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'at8_header'; }
    public function get_title() { return 'AT8 Header (Nav)'; }
    public function get_icon() { return 'eicon-nav-menu'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section('content', ['label' => 'Settings']);
        $this->add_control('logo', ['label' => 'Logo Image', 'type' => \Elementor\Controls_Manager::MEDIA]);
        $this->end_controls_section();
    }

    public function render_static($settings = []) {
        $logo_url = !empty($settings['logo']['url']) ? $settings['logo']['url'] : 'https://webbird.co.uk/wp-content/uploads/2026/02/AT8.png';
        
        // Default contact data if not provided
        $address = "Wellington House, London Colney, AL2 1HA";
        $phone   = "020 8123 4567";
        $email   = "info@at8utilities.co.uk";
        ?>
        <nav class="fixed top-0 w-full z-50 bg-white shadow-md border-b-4 border-at8-yellow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <img src="<?php echo esc_url($logo_url); ?>" alt="AT-8 Utilities Logo" class="h-12 w-auto">
                    </div>
                    
                    <?php 
                    wp_nav_menu([
                        'theme_location' => 'at8_main_menu',
                        'container'      => 'div',
                        'container_class'=> 'hidden md:flex items-center',
                        'menu_class'     => 'at8-desktop-nav',
                        'fallback_cb'    => false,
                        'depth'          => 2,
                    ]); 
                    ?>

                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" class="text-at8-blue text-2xl" aria-label="Toggle Menu">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div id="mobile-menu" class="hidden md:hidden bg-at8-blue text-white p-6 shadow-2xl absolute w-full left-0 top-20">
                <?php 
                wp_nav_menu([
                    'theme_location' => 'at8_main_menu',
                    'menu_class'     => 'at8-mobile-nav',
                    'fallback_cb'    => false,
                    'depth'          => 2,
                ]); 
                ?>

                <div class="mt-8 pt-8 border-t border-white/10 space-y-6">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-at8-yellow mt-1 mr-4"></i>
                        <p class="text-sm opacity-90"><?php echo esc_html($address); ?></p>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone text-at8-yellow mr-4"></i>
                        <p class="text-sm font-bold"><?php echo esc_html($phone); ?></p>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-at8-yellow mr-4"></i>
                        <p class="text-sm opacity-90"><?php echo esc_html($email); ?></p>
                    </div>
                </div>
            </div>
        </nav>

        <script>
            (function() {
                const initMenu = () => {
                    const btn = document.getElementById('mobile-menu-button');
                    const menu = document.getElementById('mobile-menu');
                    if(btn && menu) {
                        btn.onclick = (e) => {
                            e.preventDefault();
                            menu.classList.toggle('hidden');
                        };
                        menu.querySelectorAll('a').forEach(link => {
                            link.onclick = () => menu.classList.add('hidden');
                        });
                    }
                };
                if (document.readyState === "loading") {
                    document.addEventListener("DOMContentLoaded", initMenu);
                } else {
                    initMenu();
                }
            })();
        </script>
        <?php
    }

    protected function render() {
        $this->render_static($this->get_settings_for_display());
    }
}