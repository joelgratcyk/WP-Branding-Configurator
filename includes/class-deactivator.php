<?php
/**
 * Fired during plugin deactivation
 */

class WP_Branding_Configurator_Deactivator {

    public static function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();
    }
}
