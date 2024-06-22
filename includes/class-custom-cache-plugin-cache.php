<?php

class Custom_Cahe_plugin_Cache{
    public function __construct(){
        $this->init();
    }

    public function init(){
        if(!$this->is_cache_enabled()){
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

        ob_start();
        echo '<!-- The Cache plugin has started its operation --!>' . PHP_EOL;
    }

    public function cache_ends(){
        if(!ob_get_length()){
            return;
        }

        $output = ob_get_contents();
        ob_end_clean();

        $cache_file = $this->get_cache_file();
        file_put_contents($cache_file, $output);

        echo $output;
    }

    public function is_page_cached(){
        $cache_file = $this->get_cache_file();

        return file_exists($cache_file) && filesize($cache_file) > 0;
    }

    public function get_cache_file(){
        $page_name = get_query_var('pagename') ?: 'index';
        $file_name = $page_name .  '.html';
        $cache_directory = WP_CONTENT_DIR . '/plugins/custom-cache-plugin/cache/';

        if(!is_dir($cache_directory)){
            mkdir($cache_directory, 0755, true);
        }
        return $cache_directory . $file_name;
    }


}