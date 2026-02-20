<?php
/**
 * Plugin Name: AT-8 Utilities Landing Builder
 * Description: Dynamic Infrastructure Widgets with Lead Dashboard and site-wide Header/Footer.
 * Version: 2.0
 * Author: Gemini
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Force Load Dependencies
function at8_force_load_assets() {
    wp_enqueue_style('font-awesome-6', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null);
    wp_enqueue_style('at8-master-style', plugin_dir_url(__FILE__) . 'assets/at8-style.css', array(), time());
}
add_action('wp_enqueue_scripts', 'at8_force_load_assets');
add_action('elementor/editor/after_enqueue_scripts', 'at8_force_load_assets');

// 2. Register all Widgets
add_action('elementor/widgets/register', function($widgets_manager) {
    $widget_list = [
        'header-widget.php'         => 'AT8_Header_Widget',
        'hero-widget.php'           => 'AT8_Hero_Widget',
        'stats-widget.php'          => 'AT8_Stats_Widget',
        'sectors-widget.php'        => 'AT8_Sectors_Widget',
        'infrastructure-widget.php' => 'AT8_Infrastructure_Widget',
        'projects-widget.php'       => 'AT8_Projects_Widget',
        'news-widget.php'           => 'AT8_News_Widget',
        'accredited-widget.php'     => 'AT8_Accredited_Widget',
        'contact-widget.php'        => 'AT8_Contact_Widget',
        'footer-widget.php'         => 'AT8_Footer_Widget',
        'about-widget.php'         => 'AT8_About_Widget',
        'contactus-widget.php'         => 'AT8_Contactus_Widget',
        'water-sector-widget.php'         => 'AT8_Water_Sector_Widget',
        'electrical-sector-widget.php'         => 'AT8_Electrical_Sector_Widget',
                'telecoms-sector-widget.php'         => 'AT8_Telecoms_Sector_Widget',
                                'civils-sector-widget.php'         => 'AT8_Civils_Sector_Widget',
                                                                'support-services-widget.php'         => 'AT8_Support_Services_Widget'
    ];

    foreach ($widget_list as $file => $class) {
        $path = plugin_dir_path(__FILE__) . 'widgets/' . $file;
        if (file_exists($path)) {
            require_once($path);
            if (class_exists($class)) {
                $widgets_manager->register(new $class());
            }
        }
    }
});

// 3. Automatic Site-Wide Header & Footer Injection
add_action('wp_body_open', function() {
    if (class_exists('AT8_Header_Widget')) {
        $header = new AT8_Header_Widget();
        $header->render_static();
    }
});

// Change this line in at8-landing-builder.php
add_action('wp_footer', function() { // Use wp_footer instead of get_footer
    if (class_exists('AT8_Footer_Widget')) {
        $footer = new AT8_Footer_Widget();
        $footer->render_static();
    }
}, 5); // Priority 5 helps it load early in the footer sequence

// 4. Admin Lead Dashboard & Global Colors
add_action('admin_menu', function() {
    add_menu_page('AT-8 Leads', 'AT-8 Leads', 'manage_options', 'at8-leads', 'at8_render_leads', 'dashicons-id-alt', 6);
});

function at8_render_leads() {
    global $wpdb;
    $leads = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}at8_leads ORDER BY time DESC");
    echo '<div class="wrap"><h1 style="color:#1e3a8a;">Project Leads</h1><table class="wp-list-table widefat fixed striped"><thead><tr><th>Date</th><th>Name</th><th>Email</th><th>Service</th><th>Message</th></tr></thead><tbody>';
    foreach($leads as $l) echo "<tr><td>{$l->time}</td><td><b>{$l->name}</b></td><td>{$l->email}</td><td>{$l->service}</td><td>{$l->message}</td></tr>";
    echo '</tbody></table></div>';
}

add_action('wp_head', function() {
    $blue = get_option('at8_primary_blue', '#1e3a8a');
    $yellow = get_option('at8_primary_yellow', '#fbbf24');
    echo "<style>:root { --at8-blue: $blue; --at8-yellow: $yellow; } body { padding-top: 80px; }</style>";
});

// Register Menu Locations
add_action('init', function() {
    register_nav_menus([
        'at8_main_menu'   => 'AT8 Main Header Menu',
        'at8_quick_links' => 'AT8 Footer Quick Links',
        'at8_sectors'     => 'AT8 Footer Sectors',
        'at8_legal'       => 'AT8 Footer Legal (Bottom)',
    ]);
});

/**
 * Forceful Single Post Template Injection
 */
add_filter( 'the_content', function( $content ) {
    // Only target single blog posts in the main loop
    if ( is_singular('post') && in_the_loop() && is_main_query() ) {
        
        $post_id    = get_the_ID();
        $title      = get_the_title();
        $date       = get_the_date('F j, Y');
        $thumb      = get_the_post_thumbnail_url($post_id, 'full') ?: 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&q=80&w=2000';
        $author     = get_the_author();
        
        // --- DYNAMIC CATEGORY LOGIC ---
        $categories = get_the_category($post_id);
        $cat_name   = !empty($categories) ? $categories[0]->name : 'Industry Insights';

        // --- DYNAMIC RECENT POSTS LOGIC ---
        $recent_posts_query = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post__not_in'   => [$post_id],
        ]);

        $recent_html = '';
        if ( $recent_posts_query->have_posts() ) {
            while ( $recent_posts_query->have_posts() ) {
                $recent_posts_query->the_post();
                $r_thumb = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') ?: 'https://via.placeholder.com/150';
                $recent_html .= '
                <a href="' . get_permalink() . '" class="group flex items-start space-x-4 transition no-underline mb-6">
                    <div class="w-20 h-20 bg-gray-200 flex-shrink-0 rounded overflow-hidden">
                        <img src="' . $r_thumb . '" alt="' . get_the_title() . '" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
                    </div>
                    <div>
                        <h5 class="text-sm font-bold text-gray-800 group-hover:text-blue-800 transition m-0">' . get_the_title() . '</h5>
                        <p class="text-[10px] uppercase font-bold text-gray-400 mt-1 m-0">' . get_the_date('M j, Y') . '</p>
                    </div>
                </a>';
            }
            wp_reset_postdata();
        }

        // --- HERO SECTION (With Dynamic Category Badge) ---
        $hero = '
        <header class="post-hero">
            <div class="post-hero-bg">
                <img src="' . $thumb . '" alt="' . $title . '">
            </div>
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="reveal active">
                    <div class="flex items-center space-x-4 mb-6">
                        <span class="bg-at8-yellow text-at8-dark px-3 py-1 font-black uppercase text-[10px] tracking-widest">' . $cat_name . '</span>
                        <span class="text-blue-100 text-xs font-bold uppercase tracking-widest">' . $date . '</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black uppercase leading-tight mb-8 text-white m-0">' . $title . '</h1>
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-at8-yellow rounded-full flex items-center justify-center text-at8-blue"><i class="fas fa-user"></i></div>
                        <div><p class="text-xs font-black uppercase tracking-widest m-0">Posted By</p><p class="text-sm font-bold text-at8-yellow m-0">' . $author . '</p></div>
                    </div>
                </div>
            </div>
        </header>';

        // --- MAIN CONTENT & SIDEBAR ---
        $layout = '
        <main class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                    <article class="lg:col-span-8 article-content">
                        ' . $content . '
                    </article>

                    <aside class="lg:col-span-4 space-y-12">
                        <div class="bg-gray-50 p-8 sidebar-box shadow-sm">
                                                    <div class="mt-6 mb-4">
                                <img src="https://webbird.co.uk/wp-content/uploads/2026/02/AT8.png" alt="AT-8 Logo" class="h-10 w-auto">
                            </div>
                            <h4 class="font-black uppercase text-xs tracking-widest text-at8-blue mb-4 m-0">The Contractor</h4>
                            <p class="text-sm text-gray-500 leading-relaxed m-0">AT-8 Utilities Ltd is a trusted multi-utility contractor delivering end-to-end infrastructure solutions across the UK. Based in Ashford, Kent.</p>

                            <a href="/about-us" class="inline-block text-at8-blue font-bold text-xs uppercase tracking-widest hover:text-at8-yellow transition no-underline">Learn More &rarr;</a>
                        </div>

                        <div>
                            <h4 class="font-black uppercase text-xs tracking-widest text-at8-blue mb-6 border-b-2 border-at8-yellow pb-2 inline-block">Recent Updates</h4>
                            <div class="mt-4">' . $recent_html . '</div>
                        </div>
                    </aside>
                </div>
            </div>
        </main>';

        return $hero . $layout;
    }
    return $content;
});