<?php

if(!class_exists('Custom_Cache')){

    class Custom_Cache{
        
        public function __construct(){
            $this->load_classes();
            $this->init();
        }

        private function load_classes(){
            include( 'class-custom-cache-plugin-admin.php' );
            include( 'class-custom-cache-plugin-cache.php' );
        }

        private function init(){
            $admin = new Custom_Cache_Plugin_Admin();
            $cache = new Custom_Cahe_plugin_Cache();
        }
    }

}