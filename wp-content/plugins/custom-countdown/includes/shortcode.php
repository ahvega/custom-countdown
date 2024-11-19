<?php
if (!defined('ABSPATH')) exit;

/**
 * Handles the countdown shortcode functionality
 * 
 * Manages rendering of the countdown timer on the frontend
 * 
 * @since 1.0.0
 */
class CustomCountdownShortcode {
    /**
     * Renders the countdown shortcode output
     * 
     * @since 1.0.0
     * @param array|string $atts Shortcode attributes
     * @return string HTML output for countdown timer
     */
    public static function render($atts) {
        $atts = shortcode_atts(
            array(
                'deadline' => '2024-12-31 00:00:00',
                'separator' => '∙',
            ),
            $atts
        );

        $options = get_option('custom_countdown_settings');
        $hide_expired = isset($options['hide_expired']) && $options['hide_expired'] === 'yes';
        
        ob_start();
        ?>
        <div class="custom-countdown" 
             data-deadline="<?php echo esc_attr($atts['deadline']); ?>"
             data-hide-expired="<?php echo esc_attr($hide_expired ? 'true' : 'false'); ?>">
        </div>
        <script>
            jQuery(function ($) {
                var deadline = new Date("<?php echo esc_js($atts['deadline']); ?>");
                var countdownElement = $(".custom-countdown");
                var hideExpired = <?php echo $hide_expired ? 'true' : 'false'; ?>;

                if (hideExpired && new Date() >= deadline) {
                    countdownElement.hide();
                    return;
                }

                countdownElement.countdown(deadline, function (event) {
                    if (event.elapsed && hideExpired) {
                        $(this).hide();
                        return;
                    }

                    var days = event.offset.totalDays.toString().padStart(2, '0');
                    var hours = event.offset.hours.toString().padStart(2, '0');
                    var minutes = event.offset.minutes.toString().padStart(2, '0');
                    var seconds = event.offset.seconds.toString().padStart(2, '0');
                    var separator = '<?php echo esc_js($atts['separator']); ?>';
                    
                    var countdownHtml = `
                        <div class="countdown-box">
                            <span class="countdown-number">${days}</span>
                            <span class="countdown-label"><?php _e('Days', 'custom-countdown'); ?></span>
                        </div>
                        <span class="countdown-separator">${separator}</span>
                        <div class="countdown-box">
                            <span class="countdown-number">${hours}</span>
                            <span class="countdown-label"><?php _e('Hrs', 'custom-countdown'); ?></span>
                        </div>
                        <span class="countdown-separator">${separator}</span>
                        <div class="countdown-box">
                            <span class="countdown-number">${minutes}</span>
                            <span class="countdown-label"><?php _e('Mins', 'custom-countdown'); ?></span>
                        </div>
                        <span class="countdown-separator">${separator}</span>
                        <div class="countdown-box">
                            <span class="countdown-number">${seconds}</span>
                            <span class="countdown-label"><?php _e('Secs', 'custom-countdown'); ?></span>
                        </div>
                    `;
                    $(this).html(countdownHtml);
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }
} 