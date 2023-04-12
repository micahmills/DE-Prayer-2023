<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Adds the porch specific settings to the porch settings array
 */
class DE_Porch_Settings {

    private $defaults = [];

    public function __construct() {
        $this->load_defaults();
        add_filter( 'dt_campaign_porch_settings', [ $this, 'dt_prayer_campaigns_porch_settings' ], 10, 1 );
        add_filter( 'dt_campaign_porch_theme_options', [ $this, 'de_porch_themes' ], 10, 1 );
        add_filter( 'dt_campaign_porch_default_settings', [ $this, 'dt_campaign_porch_default_settings' ], 10, 1 );
    }

    public function dt_prayer_campaigns_porch_settings( $settings ) {
        $this->load_defaults(); //load defaults again to get current translations
        return array_merge( $settings, $this->defaults );
    }

    public function de_porch_themes( $theme_options ) {
        $theme_options['mauve'] = [
            'color' => '#9c617b',
        ];

        return $theme_options;
    }

    public function dt_campaign_porch_default_settings( $defaults ) {
        $this->load_defaults();
        return array_merge( $defaults, $this->defaults );
    }

    private function load_defaults() {
        $current_campaign = DT_Campaign_Settings::get_campaign();

        $campaign_name = isset( $current_campaign['name'] ) ? $current_campaign['name'] : '';

        $this->defaults = [
            'campaign_name' => [
                'label' => 'Campaign Name',
                'value' => $campaign_name,
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
            ],
            'title' => [
                'label' => 'Campaign/Site Title',
                'value' => get_bloginfo( 'name' ),
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::HERO,
            ],
            'subtitle' => [
                'label' => 'Subtitle',
                'default' => __( 'Praying that people around the globe would hear the Gospel', 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::HERO,
            ],
            'vision_title' => [
                'label' => 'Vision Title',
                'default' => __( 'Our Vision', 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::VISION,
            ],
            'vision' => [
                'label' => 'Vision',
                'default' => __( 'The internet and social media give us extraordinary access to get the gospel to people worldwide. Join us in praying for these digital outreach efforts to be effective.', 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::VISION,
            ],
            'pray_section_title' => [
                'label' => 'Prayer section Title',
                'default' => __( 'Extraordinary Prayer', 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::THREE,
            ],
            'pray_section_text' => [
                'label' => 'Prayer section Text',
                'default' => __( 'May the cries of God’s children be a sweet sound of praise! Join us in fervently praying that the Holy Spirit would draw people to repentance.', 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::THREE,
            ],
            'movement_section_title' => [
                'label' => 'Digital Engagement section Title',
                'default' => __( 'Digital Engagement', 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::THREE,
            ],
            'movement_section_text' => [
                'label' => 'Digital Engagement section Text',
                'default' => __( 'May the digital, technological, and artistic skills of God’s people cause those who are in darkness to pause and consider their position before the Creator of the Universe.' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::THREE,
            ],
            'time_section_title' => [
                'label' => 'Time section Title',
                'default' => __( '24/7 Every Day', 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::THREE,
            ],
            'time_section_text' => [
                'label' => 'Time section Text',
                'default' => __( 'Choose a 15-minute (or more!) time slot that you can pray during each day. Invite someone else to sign up too.', 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::THREE,
            ],
            'what_content' => [
                'label' => 'Prayer Content Message next to calendar',
                'default' => 'Over the next several weeks, there will be a concentrated effort to share the gospel with people in our region using social media and web platforms. As we bring light to these digital dark places, there will be opposition. Join us in praying fervently for God to use these digital engagement efforts for His name and glory.',
                'value' => '',
                'type' => 'textarea',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::WHAT,
            ],
            'prayer_fuel_name' => [
                'label' => 'Prayer Prompts Name',
                'default' => __( 'Prayer Prompts', 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::FUEL,
            ],
            'prayer_fuel_title' => [
                'label' => 'Prayer Prompts Title',
                'default' => __( 'Prayer Prompts', 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::FUEL,
            ],
            'prayer_fuel_description' => [
                'label' => 'Prayer Prompts Description',
                'default' => __( 'Use these resources to help pray specifically each day.', 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::FUEL,
            ],
            'todays_fuel_title' => [
                'label' => 'Todays Prayer Prompt Title',
                'default' => __( "Today's Prayer Prompt", 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::FUEL,
            ],
            'all_fuel_title' => [
                'label' => 'All Prayer Prompts Title',
                'default' => __( 'All Prayer Prompts', 'disciple-tools-prayer-campaigns' ),
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
                'section' => DE_Porch_Translation_Sections::FUEL,
            ],
            'country_name' => [
                'label' => 'Location Name',
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
            ],
            'people_name' => [
                'label' => 'People Name',
                'value' => '',
                'type' => 'text',
                'translations' => [],
                'tab' => 'translations',
            ],
        ];
    }
}

/**
 * Replacement for proper enum types in pre PHP8
 */
class DE_Porch_Translation_Sections {
    const HERO = 'Hero';
    const VISION = 'Vision';
    const THREE = 'Three Sections';
    const WHAT = 'What';
    const FUEL = 'Prayer Prompt';
}