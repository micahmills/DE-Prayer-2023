<?php

class PluginTest extends TestCase
{
    public function test_plugin_installed() {
        activate_plugin( 'de-prayer-2023/de-prayer-2023.php' );

        $this->assertContains(
            'de-prayer-2023/de-prayer-2023.php',
            get_option( 'active_plugins' )
        );
    }
}
