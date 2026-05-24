<footer class="site-footer">
    <div class="site-footer__inner">

        <!-- Column 1: Logo + Subscribe -->
        <div class="site-footer__col site-footer__col--brand">
            <a
                href="<?php echo esc_url(home_url('/')); ?>"
                class="site-footer__logo"
                aria-label="Appian Home">
                <img
                    src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/logo.svg"
                    alt="Appian logo" />
            </a>

            <div class="site-footer__subscribe">
                <label class="c3 site-footer__label" for="footer-email">Subscribe</label>
                <form class="site-footer__form" role="form" aria-label="Newsletter subscription">
                    <div class="site-footer__input-group">
                        <input
                            id="footer-email"
                            type="email"
                            class="site-footer__input body"
                            placeholder="Email *"
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

        <!-- Column 2: Address + Contact + LinkedIn -->
        <div class="site-footer__col site-footer__col--contact">
            <div class="site-footer__section site-footer__section--address">
                <span class="c3 site-footer__label">Address</span>
                <address class="sh3 site-footer__text">
                    Heffron Company, Inc.<br>
                    4940 Nicholson Ct Ste 100,<br>
                    Kensington, MD 20895
                </address>
            </div>

            <div class="site-footer__section site-footer__section--contact-info">
                <span class="c3 site-footer__label">Contact</span>
                <p class="sh3 site-footer__text">
                    Phone: <a href="tel:+13018162088">(301) 816-2088</a><br>
                    <span class="site-footer__fax">Fax: 301-816-2177<br></span>
                    <a href="mailto:info@heffroncompany.com">info@heffroncompany.com</a>
                </p>
            </div>

            <a
                class="site-footer__social"
                href="https://www.linkedin.com/company/heffroncompany"
                aria-label="Appian on LinkedIn"
                target="_blank"
                rel="noopener noreferrer">
                <img
                    src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/linkedin.svg"
                    alt=""
                    aria-hidden="true"
                    width="24"
                    height="24" />
            </a>
        </div>

        <!-- Column 3: Explore Links -->
        <div class="site-footer__col site-footer__col--nav">
            <span class="c3 site-footer__label" id="footer-nav-label">Explore</span>
            <nav aria-labelledby="footer-nav-label">
                <ul class="site-footer__menu">
                    <li><a class="sh0 site-footer__link" href="#">Our Projects</a></li>
                    <li><a class="sh0 site-footer__link" href="#">Construction</a></li>
                    <li><a class="sh0 site-footer__link" href="#">Service Department</a></li>
                    <li><a class="sh0 site-footer__link" href="#">Fab Shop</a></li>
                    <li><a class="sh0 site-footer__link" href="#">Sustainability</a></li>
                </ul>
            </nav>
        </div>

    </div><!-- /.site-footer__inner -->
</footer>