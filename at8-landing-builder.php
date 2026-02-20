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