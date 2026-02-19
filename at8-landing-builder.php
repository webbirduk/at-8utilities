<?php
/**
 * Plugin Name: AT-8 Utilities Landing Builder
 * Description: Dynamic Infrastructure Widgets with Lead Dashboard and fixed FontAwesome Icons.
 * Version: 1.7
 * Author: Gemini
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Force Load Dependencies
function at8_force_load_assets() {
    // Force Load FontAwesome 6.0.0
    wp_enqueue_style('font-awesome-6', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    
    // Tailwind
    wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null);

    // Master CSS
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
        'footer-widget.php'         => 'AT8_Footer_Widget'
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

// 3. Admin Lead Dashboard Logic
register_activation_hook(__FILE__, 'at8_setup_db');
function at8_setup_db() {
    global $wpdb;
    $table = $wpdb->prefix . 'at8_leads';
    $charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name text NOT NULL,
        email varchar(100) NOT NULL,
        service text NOT NULL,
        message text NOT NULL,
        PRIMARY KEY  (id)
    ) $charset;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

add_action('admin_post_at8_submit_contact', 'at8_process_lead');
add_action('admin_post_nopriv_at8_submit_contact', 'at8_process_lead');
function at8_process_lead() {
    global $wpdb;
    if (isset($_POST['at8_name'])) {
        $wpdb->insert($wpdb->prefix . 'at8_leads', [
            'time' => current_time('mysql'),
            'name' => sanitize_text_field($_POST['at8_name']),
            'email' => sanitize_email($_POST['at8_email']),
            'service' => sanitize_text_field($_POST['at8_service']),
            'message' => sanitize_textarea_field($_POST['at8_message']),
        ]);
        wp_redirect(add_query_arg('at8_success', '1', wp_get_referer()));
        exit;
    }
}

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

// Global Color Injections
add_action('wp_head', function() {
    $blue = get_option('at8_primary_blue', '#1e3a8a');
    $yellow = get_option('at8_primary_yellow', '#fbbf24');
    echo "<style>:root { --at8-blue: $blue; --at8-yellow: $yellow; }</style>";
});