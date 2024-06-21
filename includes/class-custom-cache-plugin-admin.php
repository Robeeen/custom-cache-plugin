<?php

if(!class_exists('Custom_Cache_Plugin_Admin')){
class Custom_Cache_Plugin_Admin{
    public function __construct(){
        add_action( 'admin_menu', array($this, 'cache_plugin_menu') );
        add_action( 'admin_init', array($this, 'register_settings_init') );
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
                <?php settings_fields('cache_plugin_settings_group');?>
                <?php do_settings_sections('custom_cache_plugin_settings');?>
                <?php submit_button('Save Settings');?>
            </form>
    </div>        
    <?php
    }

    public function register_settings_init(){
        //For settings
            register_setting(
              'cache_plugin_settings_group',
              'cache_plugin_enable_cache',  
            );   
        //For Settings section   
            add_settings_section(
                'cache_plugin_settings_section',
                __('Setting Section', 'cache_plugin'),
                [$this, 'cache_plugin_section_callback'],
                'cache_plugin_settings'
            );
        //For Settings Field
            add_settings_section(
                'cache_plugin_enable_cache',
                'Enable Cache',
                [$this, 'cache_plugin_field_callback'],
                'cache_plugin_settings',
                'cache_plugin_settings_section'
            );
      }
      public function cache_plugin_section_callback(){
        echo "<p>This ist estes </p>";
      }

      public function cache_plugin_field_callback(){
        $value = get_option('cache_plugin_enable_cache');
        echo '<input type="checkbox" name="cache_plugin_enable_cache" value="1"' . checked($value, 1, false). '/>';

      }
    }
}