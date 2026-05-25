<?php

$footer_fields = get_field('footer_group', 'option');

$branding_group  = $footer_fields['branding_group'];
$subscribe_group = $footer_fields['subscribe_group'];
$address_group   = $footer_fields['address_group'];
$contact_group   = $footer_fields['contact_group'];
$explore_group   = $footer_fields['explore_group'];
$social_group    = $footer_fields['social_group'];

// print_r($explore_group);

?>

<footer class="site-footer">

    <div class="site-footer__inner">

        <!-- Column 1: Logo + Subscribe -->
        <div class="site-footer__col site-footer__col--brand">

            <a
                href="<?php echo esc_url(home_url('/')); ?>"
                class="site-footer__logo"
                aria-label="Appian Home">

                <img
                    src="<?php echo esc_url($branding_group['footer_logo']['url']); ?>"
                    alt="<?php echo esc_attr($branding_group['footer_logo']['alt']); ?>" />

            </a>

            <div class="site-footer__subscribe">

                <label
                    class="c3 site-footer__label"
                    for="footer-email">

                    <?php echo esc_html($subscribe_group['subscribe_label']); ?>

                </label>

                <form
                    class="site-footer__form"
                    role="form"
                    aria-label="Newsletter subscription">

                    <div class="site-footer__input-group">

                        <input
                            id="footer-email"
                            type="email"
                            class="site-footer__input body"
                            placeholder="<?php echo esc_attr($subscribe_group['subscribe_placeholder']); ?>"
                            required
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

                </form>

            </div>

        </div>

        <!-- Column 2: Address + Contact + Social -->
        <div class="site-footer__col site-footer__col--contact">

            <!-- Address -->
            <div class="site-footer__section site-footer__section--address">

                <span class="c3 site-footer__label">

                    <?php echo esc_html($address_group['address_eyebrow']); ?>

                </span>

                <address class="sh3 site-footer__text">

                    <?php echo nl2br(esc_html($address_group['company_name'])); ?><br>

                    <?php echo nl2br(esc_html($address_group['street_address'])); ?>

                </address>

            </div>

            <!-- Contact -->
            <div class="site-footer__section site-footer__section--contact-info">

                <span class="c3 site-footer__label">

                    <?php echo esc_html($contact_group['contact_eyebrow']); ?>

                </span>

                <p class="sh3 site-footer__text">

                    <a href="tel:<?php echo esc_attr($contact_group['phone_number']); ?>">

                        <?php echo esc_html($contact_group['phone_number']); ?>

                    </a>

                    <br>

                    <a href="mailto:<?php echo esc_attr($contact_group['email_address']); ?>">

                        <?php echo esc_html($contact_group['email_address']); ?>

                    </a>

                </p>

            </div>

            <!-- Social Links -->
            <?php if (!empty($social_group['social_links'])) : ?>

                <?php foreach ($social_group['social_links'] as $social_link) : ?>

                    <a class="site-footer__social">

                        <img
                            src="<?php echo esc_url($social_link['icon']['url']); ?>"
                            alt="<?php echo esc_attr($social_link['icon']['alt']); ?>"
                            width="24"
                            height="24" />

                    </a>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

        <!-- Column 3: Explore Links -->
        <div class="site-footer__col site-footer__col--nav">

            <span
                class="c3 site-footer__label"
                id="footer-nav-label">

                <?php echo esc_html($explore_group['explore_eyebrow']); ?>

            </span>

            <nav aria-labelledby="footer-nav-label">

                <?php if (!empty($explore_group['explore_links'])) : ?>

                    <ul class="site-footer__menu">

                        <?php foreach ($explore_group['explore_links'] as $link_item) :

                            $link = $link_item['link_url'];

                        ?>

                            <li>

                                <a
                                    class="sh0 site-footer__link"
                                    href="<?php echo esc_url($link['url']); ?>"
                                    target="<?php echo esc_attr($link['target']); ?>">

                                    <?php echo esc_html($link_item['link_text']); ?>

                                </a>

                            </li>

                        <?php endforeach; ?>

                    </ul>

                <?php endif; ?>

            </nav>

        </div>

    </div>

</footer>