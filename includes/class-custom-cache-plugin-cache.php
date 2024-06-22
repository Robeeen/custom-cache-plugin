<?php

class Custom_Cahe_plugin_Cache{
    public function __construct(){
        $this->init();
    }

    public function init(){
        if(!$this->is_cache_enabled() || is_user_logged_in()){
            return;
        }
        add_action( 'wp_head', [$this, 'cache_start'], 0 );
        add_action( 'wp_footer', [$this, 'cache_ends'], PHP_INT_MAX );

    }

    public function is_cache_enabled(){
        return get_option('cache_plugin_enable_cache');
    }

    public function cache_start(){
        if($this->is_page_cached()){
            $cache_file = $this->get_cache_file();
            readfile($cache_file);
            exit;
        }
    }

    
}