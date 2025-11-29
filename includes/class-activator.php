<?php
/**
 * Fired during plugin activation
 */

class WP_Branding_Configurator_Activator {

    public static function activate() {
        // Create default options
        if ( ! get_option( 'wp_branding_configurator_settings' ) ) {
            add_option( 'wp_branding_configurator_settings', array(
                'brand_name' => get_bloginfo( 'name' ),
                'setup_completed' => false
            ) );
        }
        
        // Flush rewrite rules
        flush_rewrite_rules();
    }
}
