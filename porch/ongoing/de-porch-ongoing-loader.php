<?php

class DE_Porch_Ongoing_Loader extends DT_Generic_Porch_Loader {

    public $id = 'de-porch-ongoing';

    public function __construct() {
        parent::__construct( __DIR__ );

        $this->label = __( 'Digital Engagement Ongoing Landing Page', 'disciple-tools-prayer-campaign' );

        add_filter( 'dt_campaigns_wizard_types', array( $this, 'wizard_types' ) );
    }

    public function wizard_types( $wizard_types ) {
        $wizard_types[$this->id] = [
            'campaign_type' => 'ongoing',
            'porch' => $this->id,
            'label' => 'Digital Engagement Ongoing Template',
        ];
        return $wizard_types;
    }

    public function load_porch_settings() {
        parent::load_porch_settings();
        
        require_once( __DIR__ . '/de-ongoing-porch-settings.php' );
        new DE_Ongoing_Porch_Settings();
    }
}
( new DE_Porch_Ongoing_Loader() )->register_porch();