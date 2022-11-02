<?php

class PluginTest extends TestCase
{
    public function test_plugin_installed() {
        activate_plugin( 'ramadan-2023/ramadan-2023.php' );

        $this->assertContains(
            'ramadan-2023/ramadan-2023.php',
            get_option( 'active_plugins' )
        );
    }
}
