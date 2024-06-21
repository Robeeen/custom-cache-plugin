<?php

if(!class_exists('Custom_Cache_Plugin_Admin')){
class Custom_Cache_Plugin_Admin{
    public function __construct(){
        add_action( 'admin_menu', array($this, 'cache_plugin_menu') );
        add_action( 'admin_init', array($this, 'register_section') );
    }

    public function cache_plugin_menu(){
        add_options_page(
            'Custom Cache Plugin Settings', // Page title
            'Custom Cache Plugin',  // Menu title
            'manage_options', // Capability
            'custom-cache-plugin', // Menu slug
            array($this, 'settings_page') // Callback function
        );
    }

    public function settings_page(){?>
    <div class="wrap">
                <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
                    <form action="options.php" method="post">
                        <?php settings_field('cache-plugin-settings-group');?>
                        <?php do_settings_section('custom-cache-plugin-settings');?>
                        <?php submit_button('Save Settings');?>
                    </form>
    </div>        
    <?php
        }
    }

}