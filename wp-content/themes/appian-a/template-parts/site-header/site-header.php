<?php
$logo = get_field('logo', 'option');
$phone = get_field('phone_number', 'option');
$linkedin = get_field('linkedin_url', 'option');

// If none of the fields have content, do not render the block.
if ( empty($logo) && empty($phone) && empty($linkedin) ) {
	return;
}

$phone_href = '';
if ( ! empty( $phone ) ) {
	$cleanphone = preg_replace('/[^0-9]/', '', $phone);
	$phone_href = 'tel:+1' . $cleanphone;
}
?>
<header class="site-header">
<div class="site-header__container">
<?php if ( ! empty( $logo ) && is_array( $logo ) && ! empty( $logo['url'] ) ) : ?>
<a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__logo" aria-label="Appian Home">
<img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="site-header__logo-image">
</a>
<?php endif; ?>
        <nav
            class="site-header__nav"
            aria-label="Primary Navigation">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'menu_class' => 'site-header__menu',
                    'container' => false,
                    'fallback_cb' => false,
                    'walker' => new Header_Walker(),
                )
            );
            ?>
        </nav>
        <?php if ( ! empty( $phone ) ) : ?>
        <a href="<?php echo esc_url($phone_href); ?>" class="site-header__contact" aria-label="<?php echo esc_attr($phone); ?>">
            <span class="site-header__contact-label">24/7 Emergency Services</span>
            <span class="site-header__contact-number">
                <img src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/call.svg" alt="" aria-hidden="true" width="18" height="18">
                <span><?php echo esc_html($phone); ?></span>
            </span>
        </a>
        <?php endif; ?>
        <button type="button" class="site-header__mobile-toggle" aria-label="Open navigation menu" aria-expanded="false">
            <span class="site-header__toggle-icon site-header__toggle-icon--open"><img src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/menu.svg" alt="" aria-hidden="true" width="24" height="24"></span>
            <span class="site-header__toggle-icon site-header__toggle-icon--close">
                <img src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/close.svg" alt="" aria-hidden="true" width="24" height="24">
            </span>
        </button>
    </div>
    <div class="site-header__mobile-footer">
        <?php if ( ! empty( $linkedin ) ) : ?>
        <a href="<?php echo esc_url($linkedin); ?>" class="site-header__linkedin" aria-label="Appian on LinkedIn" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/linkedin.svg" alt="LinkedIn">
        </a>
        <?php endif; ?>
        <?php if ( ! empty( $phone ) ) : ?>
        <div class="site-header__contact-wrapper">
            <a href="<?php echo esc_url($phone_href); ?>" class="site-header__contact" aria-label="<?php echo esc_attr($phone); ?>">
                <span class="site-header__contact-label">24/7 Emergency Services</span>
                <span class="site-header__contact-number">
                    <img src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/call.svg" alt="" aria-hidden="true" width="18" height="18">
                    <span><?php echo esc_html($phone); ?></span>
                </span>
            </a>
        </div>
        <?php endif; ?>
    </div>
</header>