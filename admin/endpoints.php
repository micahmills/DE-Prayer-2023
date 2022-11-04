<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class Ramadan_2023_Endpoints {
    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'add_api_routes' ] );
    }
    public function add_api_routes() {
        $namespace = 'ramadan-2023';
        register_rest_route(
            $namespace, '/install', [
                'methods'  => 'POST',
                'callback' => [ $this, 'dt_ramadan_install_content' ],
                'permission_callback' => function(){
                    return current_user_can( 'manage_dt' );
                },
            ]
        );
        register_rest_route(
            $namespace, '/delete', [
                'methods'  => 'POST',
                'callback' => [ $this, 'dt_ramadan_delete_content' ],
                'permission_callback' => function(){
                    return current_user_can( 'manage_dt' );
                },
            ]
        );
    }

    public function dt_ramadan_install_content( WP_REST_Request $request ){
        $params = $request->get_params();

        P4_Ramadan_2023_Content::install_content(
            $params['lang'] ?? 'en_US',
            [
                'in_location' => $params['in_location'] ?? '[in location]',
                'of_location' => $params['of_location'] ?? '[of location]'
            ]
        );

        return true;
    }

    public function dt_ramadan_delete_content( WP_REST_Request $request ){
        $params = $request->get_params();

        if ( empty( $params['lang'] ) ){
            return new WP_Error( __METHOD__, 'Missing language code', [ 'status' => 400 ] );
        }
        global $wpdb;
        $wpdb->query( $wpdb->prepare( "
            DELETE t1 FROM $wpdb->posts t1
            LEFT JOIN $wpdb->postmeta t1m ON ( t1m.post_ID = t1.ID and t1m.meta_key = 'post_language')
            WHERE t1m.meta_value = %s
            AND ( t1.post_status = 'publish' OR t1.post_status = 'future' )
            AND t1.post_type = 'landing'
        ", esc_sql( $params['lang'] ) ) );
        if ( $params['lang'] === 'en_US' ){
            $wpdb->query( "
                DELETE t1 FROM $wpdb->posts t1
                LEFT JOIN $wpdb->postmeta t1m ON ( t1m.post_ID = t1.ID and t1m.meta_key = 'post_language')
                WHERE t1m.meta_value IS NULL
                AND ( t1.post_status = 'publish' OR t1.post_status = 'future' )
                AND t1.post_type = 'landing'
            " );
        }
        return true;
    }
};
new Ramadan_2023_Endpoints();


