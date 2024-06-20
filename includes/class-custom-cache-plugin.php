<?php

class Custom_Cache{
    public function __construct(){
        $this->load_classes();
        $this->init();
    }

    public function load_classes(){
        require_once('class-custom-cache-plugin-admin' );
        require_once('class-custom-cache-plugin-cache' );
    }
    
    public function init(){
        $admin = new Custom_Cache_Plugin_Admin();
        $cache = new Custom_Cahe_plugin_Cache();
    }

}