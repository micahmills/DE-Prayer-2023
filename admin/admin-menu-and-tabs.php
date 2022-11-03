<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Class Ramadan_2023_Menu
 */
class Ramadan_2023_Menu {

    public $token = 'ramadan_2023';
    public $page_title = 'Ramadan 2023';

    private static $_instance = null;

    /**
     * Ramadan_2023_Menu Instance
     *
     * Ensures only one instance of Ramadan_2023_Menu is loaded or can be loaded.
     *
     * @since 0.1.0
     * @static
     * @return Ramadan_2023_Menu instance
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()


    /**
     * Constructor function.
     * @access  public
     * @since   0.1.0
     */
    public function __construct() {

        $this->page_title = 'ramadan-2023';

        add_action( 'dt_prayer_campaigns_admin_install_fuel', [ 'Ramadan_2023_Tab_General', 'content' ] );
    } // End __construct()
}
Ramadan_2023_Menu::instance();

/**
 * Class Ramadan_2023_Tab_General
 */
class Ramadan_2023_Tab_General {
    public static function content() {


        ?>
        <div class="wrap">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <!-- Main Column -->

                        <?php self::main_column() ?>

                        <!-- End Main Column -->
                    </div><!-- end post-body-content -->
                    <div id="postbox-container-1" class="postbox-container">
                        <!-- Right Column -->

                        <?php self::right_column() ?>

                        <!-- End Right Column -->
                    </div><!-- postbox-container 1 -->
                    <div id="postbox-container-2" class="postbox-container">
                    </div><!-- postbox-container 2 -->
                </div><!-- post-body meta box container -->
            </div><!--poststuff end -->
        </div><!-- wrap end -->
        <?php
    }

    public static function main_column() {
        $languages_manager = new DT_Campaign_Languages();
        $languages = $languages_manager->get_enabled_languages();

        $fields = DT_Porch_Settings::fields();
        $translations = [];
        $dir = Ramadan_2023::$plugin_dir;
        $installed_languages = get_available_languages( Ramadan_2023::$plugin_dir .'languages/' );
        foreach ( $installed_languages as $language ) {
            $mo = new MO();
            if ( $mo->import_from_file( Ramadan_2023::$plugin_dir . 'languages/' . $language . '.mo' ) ){
                $translations[$language] = $mo->entries;
            }
        }

        global $wpdb;
        $installed_langs_query = $wpdb->get_results( "
            SELECT pm.meta_value, count(*) as count
            FROM $wpdb->posts p
            LEFT JOIN $wpdb->postmeta pm ON ( p.ID = pm.post_id AND meta_key = 'post_language' )
            WHERE post_type = 'landing' and ( post_status = 'publish' or post_status = 'future')
            GROUP BY meta_value
        ", ARRAY_A);
        $installed_langs = [];
        foreach ( $installed_langs_query as $result ){
            if ( $result['meta_value'] === null ){
                $result['meta_value'] = 'en_US';
            }
            if ( !isset( $installed_langs[$result['meta_value']] ) ){
                $installed_langs[$result['meta_value']] = 0;
            }
            $installed_langs[$result['meta_value']] += $result['count'];
        }

        ?>
        <!-- Box -->
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Ramadan 2023 Prayer Fuel</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <table class="">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                                <th>Installed Posts</th>
                                <th>Delete All</th>
                            </tr>
                            </thead>
                            <tbody>

                            <style>
                                .disabled-language {
                                    background-color: darkgrey;
                                }
                                .widefat .disabled-language td {
                                    color: white;
                                }
                            </style>

                            <?php foreach ( $languages as $code => $language ): ?>

                                <tr class="<?php echo $language['enabled'] === false ? 'disabled-language' : '' ?>">
                                    <td><?php echo esc_html( $language['flag'] ) ?> <?php echo esc_html( $language['english_name'] ) ?></td>
                                    <td>
                                        <button class="button install-ramadan-content" value="<?php echo esc_html( $code ) ?>">
                                            Install
                                        </button>
                                    </td>
                                    <td><?php echo esc_html( $installed_langs[$code] ?? 0 ); ?></td>
                                    <td>
                                        <button class="button">
                                            Delete
                                        </button>
                                    </td>

                                </tr>

                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </td>
                </tr>
                <tr id="ramadan-install-row" style="display: none">
                    <td>

                    </td>
                </tr>
            </tbody>
        </table>
        <div id="ramadan-dialog" title="Install Prayer Fuel">
            <form id="ramadan-install-form">
            <h3>Install Ramadan Prayer Fuel for <span class="ramadan-new-language">French</span></h3>

            <p>The Ramadan has some placeholder text that needs to be replaced.</p>

            <h4>1. Replacing: [in location]</h4>
            <div style="margin-inline-start: 50px">
                <p>
                    <strong>Example Sentence:</strong> <span id="ramadan-in-location"><?php esc_html_e( 'Jesus, give the church [in location] grace to cherish your name above all else', 'ramadan-2023' ); ?></span>
                </p>
                <p>
                    [in location] should be replaced with: <input id="ramadan-in-location-input" type="text" placeholder="en France" required>
                </p>
            </div>

            <h4>2. Replacing: [of location]</h4>
            <div style="margin-inline-start: 50px">
                <p>
                    <strong>Example Sentence:</strong> <span id="ramadan-of-location"><?php esc_html_e( 'let the people [of location] grasp the Good News', 'ramadan-2023' ); ?></span>
                </p>
                <p>
                    [of location] should be replaced with: <input id="ramadan-of-location-input" type="text" placeholder="de la France" required>
                </p>
            </div>

            <p>
                This will create a post for each of the 30 days of Ramadan.
            </p>
            <button class="button" type="submit" id="ramadan-install-language">
                Install Prayer Fuel in <span class="ramadan-new-language">French</span> <img id="ramadan-install-spinner" style="height:15px; vertical-align: middle; display: none" src="<?php echo esc_html( get_template_directory_uri() . '/spinner.svg' ) ?>"/>
            </button>
            <p>
<!--                Please review the posts here: link @todo-->
            </p>
            </form>
        </div>

        <script type="application/javascript">
            let translations = <?php echo json_encode( $translations ) ?>;
            let languages = <?php echo json_encode( $languages ) ?>;

            jQuery(document).ready(function ($){
                let code = null;
                $( "#ramadan-dialog" ).dialog({ autoOpen: false, minWidth: 600 });
                $('.install-ramadan-content').on('click', function (){
                    $( "#ramadan-dialog" ).dialog( "open" );
                    code = $(this).val();

                    $('.ramadan-new-language').html(languages[code]?.label || value)

                    if ( translations[`ramadan-2023-${code}`] && translations[`ramadan-2023-${code}`]['Jesus, give the church [in location] grace to cherish your name above all else']){
                        $('#ramadan-in-location').html( translations[`ramadan-2023-${code}`]['Jesus, give the church [in location] grace to cherish your name above all else']['translations'][0] )
                    }

                    if ( translations[`ramadan-2023-${code}`] && translations[`ramadan-2023-${code}`]['let the people [of location] grasp the Good News']){
                        $('#ramadan-of-location').html( translations[`ramadan-2023-${code}`]['let the people [of location] grasp the Good News']['translations'][0] )
                    }
                })

                $('#ramadan-install-form').on('submit', function (e){
                    e.preventDefault()
                    let in_location = $('#ramadan-in-location-input').val();
                    let of_location = $('#ramadan-of-location-input').val();

                    $('#ramadan-install-spinner').show()
                    $.ajax({
                        type: 'POST',
                        contentType: 'application/json; charset=utf-8',
                        dataType: 'json',
                        url: "<?php echo esc_url( rest_url() ) ?>ramadan-2023/install",
                        beforeSend: (xhr) => {
                            xhr.setRequestHeader("X-WP-Nonce",'<?php echo esc_attr( wp_create_nonce( 'wp_rest' ) ) ?>');
                        },
                        data: JSON.stringify({
                            in_location,
                            of_location,
                            lang: code,
                        })
                    }).then(()=>{
                        $('#ramadan-install-spinner').hide()
                        window.location.reload()
                    })

                })
            })


        </script>

        <br>
        <!-- End Box -->
        <?php
    }

    public static function right_column() {
        ?>
        <!-- Box -->
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Information</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    Content
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <!-- End Box -->
        <?php
    }
}

