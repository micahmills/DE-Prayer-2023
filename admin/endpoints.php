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
};
new Ramadan_2023_Endpoints();


