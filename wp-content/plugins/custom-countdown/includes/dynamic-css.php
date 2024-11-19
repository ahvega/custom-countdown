<?php
if (!defined('ABSPATH')) exit;

/**
 * Handles dynamic CSS generation for the countdown timer
 * 
 * Generates CSS based on user settings from the admin panel
 * 
 * @since 1.0.0
 */
class CustomCountdownCSS {
    /**
     * Generates CSS rules based on saved settings
     * 
     * @since 1.0.0
     * @return string Generated CSS rules
     */
    public static function generateCSS() {
        $options = get_option('custom_countdown_settings');
        
        $css = "
        .custom-countdown {
            font-family: " . esc_attr($options['font_family']) . ";
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(1rem, 2vw, 12px);
        }

        .custom-countdown .countdown-box {
            background-color: " . esc_attr($options['box_background']) . ";
            text-align: center;
            margin: 0 5px;
            border: " . esc_attr($options['border_width']) . " " . esc_attr($options['border_style']) . " " . esc_attr($options['border_color']) . ";
            border-radius: " . esc_attr($options['border_radius']) . ";
            padding: 0 clamp(.5rem, 2vw, 12px) clamp(.5rem, 2vw, 8px);
        }

        .custom-countdown .countdown-number {
            font-size: " . esc_attr($options['number_font_size']) . ";
            font-weight: 600;
            color: " . esc_attr($options['number_color']) . ";
            display: block;
        }

        .custom-countdown .countdown-label {
            color: " . esc_attr($options['label_color']) . ";
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: clamp(.65rem, 1.5vw, 14px);
            font-weight: 100;
            display: block;
        }
        ";

        return $css;
    }
} 