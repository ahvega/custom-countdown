<?php
/*
Plugin Name: Custom Countdown
Plugin URI: 
Description: A customizable countdown timer with shortcode support
Version: 1.0
Author: Your Name
Text Domain: custom-countdown
Domain Path: /languages
*/

if (!defined('ABSPATH')) exit;

/**
 * Main plugin class for Custom Countdown
 * 
 * Handles initialization of the plugin including scripts, settings, and shortcode registration
 * 
 * @since 1.0.0
 */
class CustomCountdown {
    /** @var CustomCountdown|null Singleton instance */
    private static $instance = null;
    
    /**
     * Gets the singleton instance of the plugin
     * 
     * @since 1.0.0
     * @return CustomCountdown Plugin instance
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor - registers all action hooks
     * 
     * @since 1.0.0
     * @access private
     */
    private function __construct() {
        add_action('plugins_loaded', array($this, 'loadTextDomain'));
        add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
        add_action('admin_menu', array($this, 'addSettingsPage'));
        add_action('admin_init', array($this, 'registerSettings'));
        add_shortcode('countdown', array($this, 'countdownShortcode'));
    }

    /**
     * Loads plugin text domain for translations
     * 
     * @since 1.0.0
     * @return void
     */
    public function loadTextDomain() {
        load_plugin_textdomain('custom-countdown', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    /**
     * Enqueues required scripts and styles
     * 
     * @since 1.0.0
     * @return void
     */
    public function enqueueScripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-countdown', 
            'https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js', 
            array('jquery'), 
            null, 
            true
        );
        wp_enqueue_style('custom-countdown-style', 
            plugins_url('css/countdown.css', __FILE__)
        );
    }
}

// Initialize plugin
CustomCountdown::getInstance(); 