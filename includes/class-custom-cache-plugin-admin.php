<?php

if(!class_exists('Custom_Cache_Plugin_Admin')){
class Custom_Cache_Plugin_Admin{
    public function __construct(){
        add_action( 'admin_menu', array( $this, 'cache_plugin_menu' ) ); //To create Page, Menu & Capability under Settings.
        add_action( 'admin_init', array( $this, 'register_settings_init' ) );//To create and add section,fields
        add_action( 'admin_bar_menu', array( $this, 'clear_cache_link'), 999); //Add link to Admin menu bar
        add_action( 'admin_post_custom_cache_plugin_clear', array( $this, 'handle_clear_cache_req'));
    }

    public function cache_plugin_menu(){
        add_options_page(
            'Custom Cache Plugin Settings', // Page title
            'Custom Cache Plugin',  // Menu title
            'manage_options', // Capability
            'custom-cache-plugin', // page appeared on URL "page=custom-cache-plugin"
            array( $this, 'settings_page' ) // Callback function to add Capabilities
        );
    }

    public function settings_page(){
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        } 
        ?>
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
                'cache_plugin_settings_section', //ID
                __('Settings Section'), //Title
                array($this, 'cache_plugin_section_callback'), //callback
                'custom_cache_plugin_settings' //page
            );
        //For Settings Field
        add_settings_field(
                'cache_plugin_enable_cache', //id
                __('Enable Cache'), //title
                array($this, 'cache_plugin_field_callback'), //callback
                'custom_cache_plugin_settings', //page
                'cache_plugin_settings_section' //section
            );
      }
      public function cache_plugin_section_callback(){
        print 'Click on the CheckBox to enable Cache';
      }

      public function cache_plugin_field_callback(){
        $value = get_option('cache_plugin_enable_cache');
        echo "<input type='checkbox' name='cache_plugin_enable_cache' value='1' " . checked($value, 1, false) . " />";
      }
      
      //Create a admin bar menu for "Clear Cache"
      public function clear_cache_link($admin_bar){
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        } 
        $admin_bar->add_menu([
            'id' => 'custom_cache_plugin_clear',
            'title' => __('Clear Cache'),
            'href' => wp_nonce_url(admin_url('admin-post.php?action=custom_cache_plugin_clear'), 'custom_cache_plugin_clear'),
        ]);

      }

      public function handle_clear_cache_req(){
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        } 

        $this->clear_cache();
        wp_redirect(wp_get_referer());
        exit;

      }

      public function clear_cache(){
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        } 

        $cache_directory = WP_CONTENT_DIR . '/plugins/custom-cache-plugin/cache/';
        $this->delete_directory($cache_directory);

        wp_redirect(wp_get_referer());
        exit;
      }

      public function delete_directory($directory){
        if(!is_dir($directory)){
            return true;
        }

        $files = array_diff(scandir($directory), ['.', '..']);

        foreach($files as $file){
            $path =   $directory . '/' . $file;
        }

        if(is_dir($path)){
            $this->delete_directory($path);
        }else{
            unlink($path);
        }

        return rmdir($directory);

      }

    
    }
}