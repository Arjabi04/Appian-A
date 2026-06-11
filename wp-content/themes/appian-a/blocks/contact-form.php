<?php
/**
 * Contact Form block template.
 *
 * @package Appian_A
 */

$heading = get_field('contact_form_heading') ?: 'A New Chapter in Student Living';
$text    = get_field('contact_form_text') ?: 'Quisque quis nisl vel elit tristique mollis vel ut ex. Integer et est enim. Nullam sagittis nibh sit amet ornare pretium. Sed eget tellus a ex sagittis accumsan lobortis id ipsum.';

if (! function_exists('appian_cf7_submit_button_replace')) {
    /**
     * Replaces the standard Contact Form 7 submit input with a button element containing the theme arrow SVG.
     *
     * @param string $content The form elements HTML content.
     * @return string Modified HTML content.
     */
    function appian_cf7_submit_button_replace($content) {
        $arrow_svg = appian_get_svg_icon('arrow-right');
        
        // Match <input type="submit"> elements
        $pattern = '/<input\s+([^>]*\s+)?type="submit"([^>]*)\s*\/?>/i';
        $content = preg_replace_callback($pattern, function($matches) use ($arrow_svg) {
            $attrs = $matches[1] . $matches[2];
            
            // Extract the value attribute (button text)
            preg_match('/value="([^"]*)"/i', $attrs, $value_match);
            $value = $value_match ? $value_match[1] : 'Submit';
            
            // Extract the class attribute
            preg_match('/class="([^"]*)"/i', $attrs, $class_match);
            $classes = $class_match ? $class_match[1] : '';
            
            // Strip out default class if present to normalize class string
            $classes = str_replace('wpcf7-submit', '', $classes);
            // Append standard theme button classes and BEM class
            $classes = trim($classes) . ' btn btn-primary wpcf7-submit m-contact-form__submit-btn';
            
            // Clean up attributes for the button tag
            $attrs_clean = preg_replace('/value="[^"]*"/i', '', $attrs);
            $attrs_clean = preg_replace('/class="[^"]*"/i', '', $attrs_clean);
            $attrs_clean = trim(preg_replace('/\s+/', ' ', $attrs_clean));
            
            return '<button type="submit" class="' . esc_attr($classes) . '" ' . $attrs_clean . '>'
                . '<span>' . esc_html($value) . '</span>'
                . $arrow_svg
                . '</button>';
        }, $content);
        
        return $content;
    }
}
?>

<section class="m-contact-form" aria-label="Contact Us">
    <div class="grid-container">
        <div class="m-contact-form__inner">
            
            <div class="m-contact-form__content">
                <div class="m-contact-form__heading-group">
                    <h2 class="h2 m-contact-form__heading">
                        <?php echo esc_html($heading); ?>
                    </h2>
                </div>
                <p class="body-sm-all m-contact-form__text">
                    <?php echo esc_html($text); ?>
                </p>
            </div>
            
            <div class="m-contact-form__form-wrapper">
                <?php
                // Apply filter to replace the input submit with standard theme button markup
                add_filter('wpcf7_form_elements', 'appian_cf7_submit_button_replace');
                
                echo do_shortcode('[contact-form-7 id="71bf36f" title="Appian - Contact Form"]');
                
                // Remove the filter so it doesn't affect other forms globally
                remove_filter('wpcf7_form_elements', 'appian_cf7_submit_button_replace');
                ?>
            </div>
            
        </div>
    </div>
</section>
