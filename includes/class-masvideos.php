<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Mas_Videos' ) ) {
    /**
     * Main plugin class
     *
     * @class Mas_Videos
     * @version 1.0.0
     */
    final class Mas_Videos {
        /**
         * Version
         *
         * @var string
         */
        public $version = '0.0.1';

        /**
         * The single instance of the class.
         *
         * @var Mas_Videos
         */
        protected static $_instance = null;

        /**
         * Main Mas_Videos Instance.
         *
         * Ensures only one instance of Mas_Videos is loaded or can be loaded.
         *
         * @static
         * @return Mas_Videos - Main instance.
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Cloning is forbidden.
         */
        public function __clone() {
            wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'masvideos' ), '2.1' );
        }

        /**
         * Unserializing instances of this class is forbidden.
         */
        public function __wakeup() {
            wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'masvideos' ), '2.1' );
        }

        /**
         * Mas_Videos Constructor.
         */
        public function __construct() {
            $this->define_constants();
            $this->includes();
            $this->init_hooks();

            do_action( 'masvideos_loaded' );
        }

        /**
         * Define constants
         */
        private function define_constants() {
            $this->define( 'MAS_VIDEOS_ABSPATH', dirname( MAS_VIDEOS_PLUGIN_FILE ) . '/' );
            $this->define( 'MAS_VIDEOS_PLUGIN_BASENAME', plugin_basename( MAS_VIDEOS_PLUGIN_FILE ) );
            $this->define( 'MAS_VIDEOS_TEMPLATE_DEBUG_MODE', false );
        }

        /**
         * Init Mas_Videos when Wordpress Initializes
         */
        public function includes() {
        }

        /**
         * Init Mas_Videos when Wordpress Initializes
         */
        public function init_hooks() {
            // add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        }

        /**
         * Enqueue scripts
         */
        public function enqueue_scripts() {
            wp_enqueue_style( 'masvideos-style', plugins_url( 'assets/css/style.css', MAS_VIDEOS_PLUGIN_FILE ), '', $this->version );
            wp_style_add_data( 'masvideos-style', 'rtl', 'replace' );
        }

        /**
         * Get the plugin url.
         * @return string
         */
        public function plugin_url() {
            return untrailingslashit( plugins_url( '/', MAS_VIDEOS_PLUGIN_FILE ) );
        }

        /**
         * Get the plugin path.
         * @return string
         */
        public function plugin_path() {
            return untrailingslashit( plugin_dir_path( MAS_VIDEOS_PLUGIN_FILE ) );
        }

        /**
         * Get the template path.
         * @return string
         */
        public function template_path() {
            return apply_filters( 'masvideos_template_path', 'masvideos/' );
        }

        /**
         * Get Ajax URL.
         * @return string
         */
        public function ajax_url() {
            return admin_url( 'admin-ajax.php', 'relative' );
        }

        /**
         * Define constant if not already set.
         *
         * @param  string $name
         * @param  string|bool $value
         */
        private function define( $name, $value ) {
            if ( ! defined( $name ) ) {
                define( $name, $value );
            }
        }
    }
}