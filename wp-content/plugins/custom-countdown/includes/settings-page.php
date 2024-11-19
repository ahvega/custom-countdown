<?php
if (!defined('ABSPATH')) exit;

/**
 * Handles the admin settings page functionality
 * 
 * Manages the registration and rendering of plugin settings
 * 
 * @since 1.0.0
 */
class CustomCountdownSettings {
    /** @var array Plugin options */
    private $options;

    /**
     * Constructor - registers admin hooks
     * 
     * @since 1.0.0
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'addSettingsPage'));
        add_action('admin_init', array($this, 'registerSettings'));
    }

    /**
     * Adds the settings page to WordPress admin menu
     * 
     * @since 1.0.0
     * @return void
     */
    public function addSettingsPage() {
        add_options_page(
            __('Countdown Settings', 'custom-countdown'),
            __('Countdown', 'custom-countdown'),
            'manage_options',
            'custom-countdown',
            array($this, 'renderSettingsPage')
        );
    }

    /**
     * Registers plugin settings and sections
     * 
     * @since 1.0.0
     * @return void
     */
    public function registerSettings() {
        register_setting('custom_countdown_options', 'custom_countdown_settings');

        add_settings_section(
            'countdown_style_section',
            __('Countdown Style Settings', 'custom-countdown'),
            null,
            'custom-countdown'
        );

        // Register all style settings
        $this->addStyleSettings();
    }

    /**
     * Adds style settings fields
     * 
     * @since 1.0.0
     * @access private
     * @return void
     */
    private function addStyleSettings() {
        $settings = array(
            'hide_expired' => array(
                'label' => __('Hide When Expired', 'custom-countdown'),
                'default' => 'no',
                'type' => 'checkbox'
            ),
            'font_family' => array(
                'label' => __('Font Family', 'custom-countdown'),
                'default' => 'system-ui'
            ),
            'number_font_size' => array(
                'label' => __('Numbers Font Size', 'custom-countdown'),
                'default' => '36px'
            ),
            'number_color' => array(
                'label' => __('Numbers Color', 'custom-countdown'),
                'default' => '#37a19a'
            ),
            'label_color' => array(
                'label' => __('Labels Color', 'custom-countdown'),
                'default' => '#f68f19'
            ),
            'box_background' => array(
                'label' => __('Box Background Color', 'custom-countdown'),
                'default' => '#0006'
            ),
            'border_style' => array(
                'label' => __('Border Style', 'custom-countdown'),
                'default' => 'dashed'
            ),
            'border_color' => array(
                'label' => __('Border Color', 'custom-countdown'),
                'default' => '#8e1d7f99'
            ),
            'border_width' => array(
                'label' => __('Border Width', 'custom-countdown'),
                'default' => '2px'
            ),
            'border_radius' => array(
                'label' => __('Border Radius', 'custom-countdown'),
                'default' => '6px'
            ),
        );

        foreach ($settings as $key => $setting) {
            add_settings_field(
                $key,
                $setting['label'],
                array($this, 'renderField'),
                'custom-countdown',
                'countdown_style_section',
                array(
                    'id' => $key,
                    'default' => $setting['default'],
                    'type' => isset($setting['type']) ? $setting['type'] : 'text'
                )
            );
        }
    }

    /**
     * Renders individual settings field
     * 
     * @since 1.0.0
     * @param array $args Field arguments including id and default value
     * @return void
     */
    public function renderField($args) {
        $options = get_option('custom_countdown_settings');
        $value = isset($options[$args['id']]) ? $options[$args['id']] : $args['default'];
        
        if ($args['type'] === 'checkbox') {
            ?>
            <input type="checkbox" 
                   name="custom_countdown_settings[<?php echo esc_attr($args['id']); ?>]" 
                   value="yes"
                   <?php checked($value, 'yes'); ?>>
            <?php
        } else {
            ?>
            <input type="text" 
                   name="custom_countdown_settings[<?php echo esc_attr($args['id']); ?>]" 
                   value="<?php echo esc_attr($value); ?>" 
                   class="regular-text">
            <?php
        }
    }
} 