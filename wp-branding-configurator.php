<?php
/**
 * Plugin Name: WP Branding Configurator
 * Plugin URI: https://github.com/joelgratcyk/WP-Branding-Configurator
 * Description: Community-driven WordPress plugin that transforms the admin dashboard into a custom-branded content management platform.
 * Version: 0.1.0-alpha
 * Author: FriedEggBurger
 * Author URI: https://github.com/joelgratcyk
 * License: GPL v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: wp-branding-configurator
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 * Network: false
 *
 * WP Branding Configurator is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * WP Branding Configurator is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 0.1.0-alpha and use SemVer - https://semver.org
 */
define( 'WP_BRANDING_CONFIGURATOR_VERSION', '0.1.0-alpha' );
define( 'WP_BRANDING_CONFIGURATOR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_BRANDING_CONFIGURATOR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function activate_wp_branding_configurator() {
    require_once WP_BRANDING_CONFIGURATOR_PLUGIN_DIR . 'includes/class-activator.php';
    WP_Branding_Configurator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_wp_branding_configurator() {
    require_once WP_BRANDING_CONFIGURATOR_PLUGIN_DIR . 'includes/class-deactivator.php';
    WP_Branding_Configurator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_branding_configurator' );
register_deactivation_hook( __FILE__, 'deactivate_wp_branding_configurator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require WP_BRANDING_CONFIGURATOR_PLUGIN_DIR . 'includes/class-wp-branding-configurator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
function run_wp_branding_configurator() {
    $plugin = new WP_Branding_Configurator();
    $plugin->run();
}

/**
 * Initialize the plugin once WordPress is loaded.
 */
add_action( 'plugins_loaded', 'run_wp_branding_configurator' );

/**
 * Add a notice to the admin dashboard for early adopters
 */
function wp_branding_configurator_alpha_notice() {
    if ( current_user_can( 'manage_options' ) ) {
        ?>
        <div class="notice notice-info">
            <p>
                <strong>WP Branding Configurator (Alpha)</strong> - 
                Thanks for being an early adopter! This plugin is in active development. 
                <a href="https://github.com/joelgratcyk/WP-Branding-Configurator" target="_blank">
                    Follow development on GitHub
                </a> | 
                <a href="https://github.com/joelgratcyk/WP-Branding-Configurator/issues" target="_blank">
                    Report issues
                </a>
            </p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'wp_branding_configurator_alpha_notice' );

/**
 * Add basic admin menu item for now
 */
function wp_branding_configurator_admin_menu() {
    add_menu_page(
        'WP Branding Configurator',
        'Brand Config',
        'manage_options',
        'wp-branding-configurator',
        'wp_branding_configurator_admin_page',
        'dashicons-admin-appearance',
        30
    );
}
add_action( 'admin_menu', 'wp_branding_configurator_admin_menu' );

/**
 * Basic admin page for early adopters
 */
function wp_branding_configurator_admin_page() {
    ?>
    <div class="wrap">
        <h1>WP Branding Configurator</h1>
        <div class="notice notice-success">
            <p><strong>Welcome to the future of WordPress client management!</strong></p>
        </div>
        
        <div class="card">
            <h2>🚀 Development Status</h2>
            <p>You're running <strong>version <?php echo WP_BRANDING_CONFIGURATOR_VERSION; ?></strong></p>
            <p>This plugin is in active development. Current features coming in Phase 1:</p>
            <ul>
                <li>✅ Plugin foundation (you're here!)</li>
                <li>⏳ Dashboard replacement system</li>
                <li>⏳ Basic branding customization</li>
                <li>⏳ Menu system override</li>
            </ul>
        </div>

        <div class="card">
            <h2>🤝 Get Involved</h2>
            <p>Help shape the future of WordPress white-labeling:</p>
            <p>
                <a href="https://github.com/joelgratcyk/WP-Branding-Configurator" class="button button-primary" target="_blank">
                    View on GitHub
                </a>
                <a href="https://github.com/joelgratcyk/WP-Branding-Configurator/issues" class="button" target="_blank">
                    Report Issues
                </a>
                <a href="https://github.com/joelgratcyk/WP-Branding-Configurator/discussions" class="button" target="_blank">
                    Join Discussions
                </a>
            </p>
        </div>

        <div class="card">
            <h2>🎯 Coming Soon</h2>
            <p>Features being built in upcoming phases:</p>
            <ul>
                <li><strong>Custom Dashboard:</strong> Replace WordPress admin with your brand</li>
                <li><strong>Content Modules:</strong> "Post News" instead of "Add Post"</li>
                <li><strong>Media Optimization:</strong> Auto-convert images to WebP</li>
                <li><strong>Page Builder:</strong> Drag-and-drop without the complexity</li>
                <li><strong>Social Integration:</strong> Auto-post to business channels</li>
            </ul>
        </div>
    </div>
    <style>
        .card { 
            background: white; 
            padding: 20px; 
            margin: 20px 0; 
            border-left: 4px solid #0073aa; 
        }
    </style>
    <?php
}
