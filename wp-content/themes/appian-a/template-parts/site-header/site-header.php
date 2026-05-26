<header class="site-header" data-site-header>

    <div class="site-header__container" data-site-header-bar>

        <!-- Logo -->
        <a
            href="<?php echo esc_url(home_url('/')); ?>"
            class="site-header__logo"
            aria-label="Appian Home">

            <img
                src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/logo.svg"
                alt="Appian logo"
                class="site-header__logo-image">
        </a>

        <!-- Navigation -->
        <nav
            class="site-header__nav"
            id="site-header-navigation"
            aria-label="Primary Navigation">

            <div class="site-header__nav-scroll">

                <ul class="site-header__menu">

                    <!-- Home -->
                    <li class="site-header__menu-item">
                        <a
                            href="#"
                            class="site-header__menu-link"
                            aria-current="page">
                            Home
                        </a>
                    </li>

                    <!-- Our Projects -->
                    <li class="site-header__menu-item">
                        <a
                            href="#"
                            class="site-header__menu-link">
                            Our Projects
                        </a>
                    </li>

                    <!-- What we build -->
                    <li class="site-header__menu-item">
                        <a
                            href="#"
                            class="site-header__menu-link"
                            aria-current="page">
                            What We Build
                        </a>
                    </li>

                    <!-- Construction Dropdown -->
                    <li class="site-header__menu-item site-header__menu-item--dropdown">

                        <button
                            type="button"
                            class="site-header__menu-button"
                            aria-expanded="false"
                            aria-label="Construction submenu">
                            <span>Construction</span>
                            <span class="site-header__menu-icon">
                                <img
                                    src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/arrow-down.svg"
                                    alt=""
                                    aria-hidden="true">
                            </span>
                        </button>

                        <ul
                            class="site-header__dropdown"
                            aria-label="Construction submenu">

                            <li class="site-header__dropdown-item">
                                <a href="#" class="site-header__dropdown-link">Pre-Construction</a>
                            </li>

                            <li class="site-header__dropdown-item">
                                <a href="#" class="site-header__dropdown-link">Post-Construction</a>
                            </li>

                            <li class="site-header__dropdown-item">
                                <a href="#" class="site-header__dropdown-link">Fab Shop</a>
                            </li>

                        </ul>

                    </li>

                    <!-- Service Department Dropdown -->
                    <li class="site-header__menu-item site-header__menu-item--dropdown">

                        <button
                            type="button"
                            class="site-header__menu-button"
                            aria-expanded="false"
                            aria-label="Service Department submenu">
                            <span>Service Department</span>
                            <span class="site-header__menu-icon">
                                <img
                                    src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/arrow-down.svg"
                                    alt=""
                                    aria-hidden="true">
                            </span>
                        </button>

                        <ul
                            class="site-header__dropdown"
                            aria-label="Service Department submenu">

                            <li class="site-header__dropdown-item">
                                <a href="#" class="site-header__dropdown-link">Consulting Services</a>
                            </li>

                            <li class="site-header__dropdown-item">
                                <a href="#" class="site-header__dropdown-link">Implementation Services</a>
                            </li>

                            <li class="site-header__dropdown-item">
                                <a href="#" class="site-header__dropdown-link">Support & Maintenance</a>
                            </li>

                            <li class="site-header__dropdown-item">
                                <a href="#" class="site-header__dropdown-link">Training & Optimization</a>
                            </li>

                        </ul>

                    </li>

                    <!-- Contact -->
                    <li class="site-header__menu-item">
                        <a
                            href="#"
                            class="site-header__menu-link">
                            Contact
                        </a>
                    </li>

                </ul>

            </div><!-- /.site-header__nav-scroll -->

            <!-- Mobile Footer (inside overlay so it can't leak into desktop or disappear) -->
            <div class="site-header__mobile-footer">

                <!-- LinkedIn -->
                <a
                    href="https://www.linkedin.com/company/outsidektm"
                    class="site-header__linkedin"
                    aria-label="Appian on LinkedIn">

                    <img
                        src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/linkedin.svg"
                        alt="LinkedIn">

                </a>

                <!-- Contact Wrapper -->
                <div class="site-header__contact-wrapper">

                    <a
                        href="tel:+13018162088"
                        class="site-header__contact"
                        aria-label="Call emergency services at 301 816 2088">

                        <span class="site-header__contact-label">
                            24/7 Emergency Services
                        </span>

                        <span class="site-header__contact-number">
                            <img
                                src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/call.svg"
                                alt=""
                                aria-hidden="true"
                                width="18"
                                height="18">
                            <span>(301) 816-2088</span>
                        </span>

                    </a>

                </div><!-- /.site-header__contact-wrapper -->

            </div><!-- /.site-header__mobile-footer -->

        </nav>

        <!-- Desktop Contact -->
        <a
            href="tel:+13018162088"
            class="site-header__contact"
            aria-label="Call emergency services at 301 816 2088">

            <span class="site-header__contact-label">
                24/7 Emergency Services
            </span>

            <span class="site-header__contact-number">
                <img
                    src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/call.svg"
                    alt=""
                    aria-hidden="true"
                    width="18"
                    height="18">
                <span>(301) 816-2088</span>
            </span>

        </a>

        <!-- Mobile Toggle -->
        <button
            type="button"
            class="site-header__mobile-toggle"
            aria-label="Open navigation menu"
            aria-expanded="false"
            aria-controls="site-header-navigation">

            <span class="site-header__toggle-icon site-header__toggle-icon--open">
                <img
                    src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/menu.svg"
                    alt=""
                    aria-hidden="true"
                    width="24"
                    height="24">
            </span>

            <span class="site-header__toggle-icon site-header__toggle-icon--close">
                <img
                    src="<?php echo get_template_directory_uri(); ?>/resources/images/svgs/close.svg"
                    alt=""
                    aria-hidden="true"
                    width="24"
                    height="24">
            </span>

        </button>

    </div><!-- /.site-header__container -->

</header>
