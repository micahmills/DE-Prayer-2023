<?php
/**
 * Plugin Name: DE Prayer Campaign 2023
 * Plugin URI: https://github.com/micahmills/DE-Prayer-2023
 * Description: DE Prayer Campaign 2023 prayer request content starter.
 * Text Domain: de-prayer-2023
 * Domain Path: /languages
 * Version:  1.4.1
 * Author URI: https://github.com/Pray4Movement
 * GitHub Plugin URI: https://github.com/micahmills/DE-Prayer-2023
 * Requires at least: 4.7.0
 * (Requires 4.7+ because of the integration of the REST API at 4.7 and the security requirements of this milestone version.)
 * Tested up to: 6.2
 *
 * @package Disciple_Tools
 * @link    https://github.com/Pray4Movement
 * @license GPL-2.0 or later
 *          https://www.gnu.org/licenses/gpl-2.0.html
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Gets the instance of the `De_Prayer_2023` class.
 *
 * @since  0.1
 * @access public
 * @return object|bool
 */
function de_prayer_2023() {
    $de_2023_required_dt_theme_version = '1.30';
    $wp_theme = wp_get_theme();
    $version = $wp_theme->version;

    /*
     * Check if the Disciple.Tools theme is loaded and is the latest required version
     */
    $is_theme_dt = class_exists( 'Disciple_Tools' );
    if ( $is_theme_dt && version_compare( $version, $de_2023_required_dt_theme_version, '<' ) ) {
        add_action( 'admin_notices', 'de_2023_hook_admin_notice' );
        add_action( 'wp_ajax_dismissed_notice_handler', 'dt_hook_ajax_notice_handler' );
        return false;
    }
    if ( !$is_theme_dt ){
        return false;
    }
    /**
     * Load useful function from the theme
     */
    if ( !defined( 'DT_FUNCTIONS_READY' ) ){
        require_once get_template_directory() . '/dt-core/global-functions.php';
    }

    require_once( 'porch/de-porch-settings.php' );
    require_once( 'porch/de-porch-loader.php' );
    // require_once( 'porch/ongoing/de-ongoing-porch-settings.php' );
    // require_once( 'porch/ongoing/de-porch-ongoing-loader.php' );

    return De_Prayer_2023::instance();

}
add_action( 'after_setup_theme', 'de_prayer_2023', 20 );

//register the D.T Plugin
add_filter( 'dt_plugins', function ( $plugins ){
    $plugin_data = get_file_data( __FILE__, [ 'Version' => 'Version', 'Plugin Name' => 'Plugin Name' ], false );
    $plugins['de-2023'] = [
        'plugin_url' => trailingslashit( plugin_dir_url( __FILE__ ) ),
        'version' => $plugin_data['Version'] ?? null,
        'name' => $plugin_data['Plugin Name'] ?? null,
    ];
    return $plugins;
});

/**
 * Singleton class for setting up the plugin.
 *
 * @since  0.1
 * @access public
 */
class De_Prayer_2023 {

    public static $plugin_dir = null;

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
        $is_rest = dt_is_rest();

        self::$plugin_dir = trailingslashit( plugin_dir_path( __FILE__ ) );

        if ( is_admin() ) {
            require_once( 'admin/admin-menu-and-tabs.php' ); // adds starter admin page and section for plugin
        }

        require_once( 'admin/endpoints.php' );

        require_once( 'admin/prayer-field-content.php' );
        $this->i18n();

        function add_de_campaign_type( $wizard_types ){
            // $wizard_types['de-porch'] = [
            //     'campaign_type' => '24hour',
            //     'porch' => 'de-porch',
            //     'label' => '24/7 Digital Engagement Template',
            // ];
            // $wizard_types['de-porch-ongoing'] = [
            //     'campaign_type' => 'ongoing',
            //     'porch' => 'ongoing-porch',
            //     'label' => 'Ongoing Digital Engagement Template',
            // ];
            return $wizard_types;
        }
        add_filter( 'dt_campaigns_wizard_types', 'add_de_campaign_type' );

        if ( is_admin() ) { // adds links to the plugin description area in the plugin admin list.
            add_filter( 'plugin_row_meta', [ $this, 'plugin_description_links' ], 10, 4 );
        }

    }

    /**
     * Filters the array of row meta for each/specific plugin in the Plugins list table.
     * Appends additional links below each/specific plugin on the plugins page.
     */
    public function plugin_description_links( $links_array, $plugin_file_name, $plugin_data, $status ) {
        if ( strpos( $plugin_file_name, basename( __FILE__ ) ) ) {
            // You can still use `array_unshift()` to add links at the beginning.

            $links_array[] = '<a href="https://disciple.tools">Disciple.Tools Community</a>'; // @todo replace with your links.
            // @todo add other links here
        }

        return $links_array;
    }

    /**
     * Method that runs only when the plugin is activated.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public static function activation() {
        // add elements here that need to fire on activation
    }

    /**
     * Method that runs only when the plugin is deactivated.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public static function deactivation() {
        // add functions here that need to happen on deactivation
        delete_option( 'dismissed-de-2023' );
    }

    /**
     * Loads the translation files.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function i18n() {
        $domain = 'de-2023';
        load_plugin_textdomain( $domain, false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ). 'languages' );
    }

    /**
     * Magic method to output a string if trying to use the object as a string.
     *
     * @since  0.1
     * @access public
     * @return string
     */
    public function __toString() {
        return 'de-2023';
    }

    /**
     * Magic method to keep the object from being cloned.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, 'Whoah, partner!', '0.1' );
    }

    /**
     * Magic method to keep the object from being unserialized.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, 'Whoah, partner!', '0.1' );
    }

    /**
     * Magic method to prevent a fatal error when calling a method that doesn't exist.
     *
     * @param string $method
     * @param array $args
     * @return null
     * @since  0.1
     * @access public
     */
    public function __call( $method = '', $args = array() ) {
        _doing_it_wrong( 'ramadan_2023::' . esc_html( $method ), 'Method does not exist.', '0.1' );
        unset( $method, $args );
        return null;
    }
}


// Register activation hook.
register_activation_hook( __FILE__, [ 'De_Prayer_2023', 'activation' ] );
register_deactivation_hook( __FILE__, [ 'De_Prayer_2023', 'deactivation' ] );


if ( ! function_exists( 'de_2023_hook_admin_notice' ) ) {
    function de_2023_hook_admin_notice() {
        global $de_2023_required_dt_theme_version;
        $wp_theme = wp_get_theme();
        $current_version = $wp_theme->version;
        $message = "'DE Prayer Campaign 2023' plugin requires 'Disciple.Tools' theme to work. Please activate 'Disciple.Tools' theme or make sure it is latest version.";
        if ( $wp_theme->get_template() === 'disciple-tools-theme' ){
            $message .= ' ' . sprintf( esc_html( 'Current Disciple.Tools version: %1$s, required version: %2$s' ), esc_html( $current_version ), esc_html( $de_2023_required_dt_theme_version ) );
        }
        // Check if it's been dismissed...
        if ( ! get_option( 'dismissed-de-2023', false ) ) { ?>
            <div class="notice notice-error notice-de-2023 is-dismissible" data-notice="de-2023">
                <p><?php echo esc_html( $message );?></p>
            </div>
            <script>
                jQuery(function($) {
                    $( document ).on( 'click', '.notice-de-2023 .notice-dismiss', function () {
                        $.ajax( ajaxurl, {
                            type: 'POST',
                            data: {
                                action: 'dismissed_notice_handler',
                                type: 'de-2023',
                                security: '<?php echo esc_html( wp_create_nonce( 'wp_rest_dismiss' ) ) ?>'
                            }
                        })
                    });
                });
            </script>
        <?php }
    }
}

/**
 * AJAX handler to store the state of dismissible notices.
 */
if ( !function_exists( 'dt_hook_ajax_notice_handler' ) ){
    function dt_hook_ajax_notice_handler(){
        check_ajax_referer( 'wp_rest_dismiss', 'security' );
        if ( isset( $_POST['type'] ) ){
            $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
            update_option( 'dismissed-' . $type, true );
        }
    }
}


/**
 * Check for plugin updates even when the active theme is not Disciple.Tools
 *
 * Below is the publicly hosted .json file that carries the version information. This file can be hosted
 * anywhere as long as it is publicly accessible. You can download the version file listed below and use it as
 * a template.
 * Also, see the instructions for version updating to understand the steps involved.
 * @see https://github.com/Pray4Movement/disciple-tools-version-control/wiki/How-to-Update-the-Starter-Plugin
 */
add_action( 'plugins_loaded', function (){
    if ( is_admin() && !( is_multisite() && class_exists( 'DT_Multisite' ) ) || wp_doing_cron() ){
        // Check for plugin updates
        if ( ! class_exists( 'Puc_v4_Factory' ) ) {
            if ( file_exists( get_template_directory() . '/dt-core/libraries/plugin-update-checker/plugin-update-checker.php' ) ){
                require( get_template_directory() . '/dt-core/libraries/plugin-update-checker/plugin-update-checker.php' );
            }
        }
        if ( class_exists( 'Puc_v4_Factory' ) ){
            Puc_v4_Factory::buildUpdateChecker(
                'https://raw.githubusercontent.com/micahmills/DE-Prayer-2023/master/version-control.json',
                __FILE__,
                'de-2023'
            );

        }
    }
} );
