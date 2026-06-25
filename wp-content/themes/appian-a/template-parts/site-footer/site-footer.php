<?php

$footer_fields = get_field('footer_group', 'option');

$footer_fields = is_array($footer_fields) ? $footer_fields : [];

$has_explore_group = array_key_exists('explore_group', $footer_fields);

$branding_group  = (isset($footer_fields['branding_group']) && is_array($footer_fields['branding_group'])) ? $footer_fields['branding_group'] : [];
$subscribe_group = (isset($footer_fields['subscribe_group']) && is_array($footer_fields['subscribe_group'])) ? $footer_fields['subscribe_group'] : [];
$address_group   = (isset($footer_fields['address_group']) && is_array($footer_fields['address_group'])) ? $footer_fields['address_group'] : [];
$contact_group   = (isset($footer_fields['contact_group']) && is_array($footer_fields['contact_group'])) ? $footer_fields['contact_group'] : [];
$explore_group   = (isset($footer_fields['explore_group']) && is_array($footer_fields['explore_group'])) ? $footer_fields['explore_group'] : [];
$social_links = get_field('social_links', 'option');
$social_items = $social_links['social_items'] ?? [];

$appian_footer_warn = static function ($message) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        trigger_error($message, E_USER_WARNING);
    }
    error_log($message);
};

$footer_logo = $branding_group['footer_logo'] ?? [];
$footer_logo = is_array($footer_logo) ? $footer_logo : [];
$footer_logo_url = $footer_logo['url'] ?? '';
$footer_logo_alt = $footer_logo['alt'] ?? '';

// print_r($explore_group);

?>

<footer class="site-footer">

    <div class="site-footer__inner">

        <!-- Column 1: Logo + Subscribe -->
        <div class="site-footer__col site-footer__col--brand">

            <?php if (!empty($footer_logo_url)) : ?>
                <a
                    href="<?php echo esc_url(home_url('/')); ?>"
                    class="site-footer__logo"
                    aria-label="Appian Home">

                    <img
                        src="<?php echo esc_url($footer_logo_url); ?>"
                        alt="<?php echo esc_attr($footer_logo_alt); ?>"
                        />

                </a>
            <?php endif; ?>

            <div class="site-footer__subscribe">

                <label
                    class="c3 site-footer__label"
                    for="footer-email">

                    <?php echo esc_html($subscribe_group['subscribe_label'] ?? ''); ?>

                </label>

                <form
                    class="site-footer__form"
                    role="form"
                    aria-label="Newsletter subscription"
                    data-footer-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
                    data-footer-ajax-nonce="<?php echo esc_attr(wp_create_nonce('appian_footer_email')); ?>"
                    novalidate>

                    <div class="site-footer__input-group">

                        <input
                            id="footer-email"
                            name="email"
                            type="email"
                            class="site-footer__input body"
                            placeholder="<?php echo esc_attr($subscribe_group['subscribe_placeholder'] ?? ''); ?>"
                            maxlength="254"
                            autocomplete="email"
                            aria-label="Email address" />

                        <button
                            type="submit"
                            class="site-footer__submit"
                            aria-label="Submit subscription">

                            <img
                                src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/arrow-right.svg"
                                alt=""
                                aria-hidden="true"
                                width="24"
                                height="24" />

                        </button>

                    </div>

                    <div class="site-footer__input-error c3" data-footer-email-error aria-live="polite"></div>

                </form>

            </div>

        </div>

        <!-- Column 2: Address + Contact + Social -->
        <div class="site-footer__col site-footer__col--contact">

            <!-- Address -->
            <div class="site-footer__section site-footer__section--address">

                <span class="c3 site-footer__label">

                    <?php echo esc_html($address_group['address_eyebrow'] ?? ''); ?>

                </span>

                <address class="sh3 site-footer__text">

                    <?php echo nl2br(esc_html($address_group['company_name'] ?? '')); ?><br>

                    <?php echo nl2br(esc_html($address_group['street_address'] ?? '')); ?>

                </address>

            </div>

            <!-- Contact -->
            <div class="site-footer__section site-footer__section--contact-info">

                <span class="c3 site-footer__label">

                    <?php echo esc_html($contact_group['contact_eyebrow'] ?? ''); ?>

                </span>

                <p class="sh3 site-footer__text">

                    <a href="tel:<?php echo esc_attr($contact_group['phone_number'] ?? ''); ?>">

                        Phone: <?php echo esc_html($contact_group['phone_number'] ?? ''); ?>

                    </a>

                    <br>

                    <?php if (!empty($contact_group['fax_number'])) : ?>

                        <a href="tel:<?php echo esc_attr($contact_group['fax_number']); ?>">

                            Fax: <?php echo esc_html($contact_group['fax_number']); ?>

                        </a>

                        <br>

                    <?php endif; ?>

                    <a href="mailto:<?php echo esc_attr($contact_group['email_address'] ?? ''); ?>">

                        <?php echo esc_html($contact_group['email_address'] ?? ''); ?>

                    </a>

                </p>

            </div>

            <!-- Social Links -->
            <?php if ( ! empty($social_items) ) : ?>

                <div class="site-footer__socials">

                    <?php foreach ( $social_items as $item ) :
                        $icon     = $item['icon']     ?? null;
                        $platform = $item['platform'] ?? '';
                        $url      = $item['url']      ?? '';
                        if ( empty($url) ) continue;
                    ?>
                        <a
                            class="site-footer__social"
                            href="<?php echo esc_url($url); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="<?php echo esc_attr($platform); ?>">
                            <?php if ( ! empty($icon) && ! empty($icon['url']) ) : ?>
                                <img
                                    src="<?php echo esc_url($icon['url']); ?>"
                                    alt="<?php echo esc_attr($platform); ?>"
                                    width="24"
                                    height="24">
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

            <!-- Column 3: Explore Links -->
            <div class="site-footer__col site-footer__col--nav">

            <?php
            $explore_links_field = $explore_group['explore_links'] ?? [];
            if (!is_array($explore_links_field) && $has_explore_group) {
                $appian_footer_warn('Footer explore links field is not an array; hiding block.');
            }

            $explore_links_raw = is_array($explore_links_field) ? $explore_links_field : [];
            $explore_links = array_values(array_filter($explore_links_raw, static function ($item) {
                if (!is_array($item)) return false;
                if (empty($item['link_url']) || !is_array($item['link_url'])) return false;
                if (empty($item['link_url']['url'])) return false;
                if (empty($item['link_text'])) return false;
                return true;
            }));
            ?>

            <?php if ($has_explore_group && empty($explore_links_raw)) : ?>
                <?php $appian_footer_warn('Footer explore links block has no items; hiding block.'); ?>
            <?php elseif (!empty($explore_links_raw) && empty($explore_links)) : ?>
                <?php $appian_footer_warn('Footer explore links block has no valid items; hiding block.'); ?>
            <?php endif; ?>

            <?php if (!empty($explore_group['explore_eyebrow']) || !empty($explore_links)) : ?>
                <span
                    class="c3 site-footer__label"
                    id="footer-nav-label">

                    <?php echo esc_html($explore_group['explore_eyebrow'] ?? ''); ?>

                </span>

                <nav aria-labelledby="footer-nav-label">

                    <?php if (!empty($explore_links)) : ?>

                    <ul class="site-footer__menu">

                        <?php foreach ($explore_links as $link_item) : ?>
                            <?php $link = $link_item['link_url']; ?>

                            <li>

                                <a
                                    class="sh0 site-footer__link"
                                    href="<?php echo esc_url($link['url']); ?>"
                                    target="<?php echo esc_attr($link['target'] ?? '_self'); ?>">

                                    <?php echo esc_html($link_item['link_text']); ?>

                                </a>

                            </li>

                        <?php endforeach; ?>

                    </ul>

                <?php endif; ?>

                </nav>
            <?php endif; ?>

        </div>

    </div>

</footer>
