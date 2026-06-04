<section class="our-work__wrapper" id="our-work">
    <header class="our-work__header h2 text-center">Our Work</header>
    <div class="our-work__divider-wrap  d-flex justify-content-center">
        <img
            class="our-work__section-divider pt-4"
            src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>"
            alt=""
            aria-hidden="true" />
    </div>

    <div class="our-work__desktop">
        <ul class="our-work__nav d-flex flex-wrap list-unstyled justify-content-center gap-4 m-0" aria-label="Our Work Categories">
            <li class="our-work__nav-item our-work__nav-item--active">
                <a class="nav-link active" aria-current="page" href="#">Modern</a>
            </li>
            <li class="our-work__nav-item">
                <a class="nav-link" href="#">Reliable</a>
            </li>
            <li class="our-work__nav-item">
                <a class="nav-link" href="#">Innovative</a>
            </li>
            <li class="our-work__nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Trusted</a>
            </li>
        </ul>

        <div class="our-work__content align-items-center d-flex justify-content-center">
            <div class="our-work__description flex-grow-1">
                <div class="description d-flex flex-column">
                    <h3 class="description__title m-0">
                        Modern Infrastructure Solutions
                    </h3>

                    <p class="description__content body-large mb-0">
                        Delivering durable, efficient, and future-ready construction projects with precision and expertise.
                    </p>
                </div>
            </div>

            <div class="our-work__image d-flex flex-start">
                <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/construction-department.png'); ?>"
                    alt="Our Work Image" />
            </div>
        </div>
    </div>


    <!-- mobile accordian -->
    <div class="our-work__accordion accordion" id="ourWorkAccordion">
        <!-- modern -->
        <div class="our-work__card our-work__card--active accordion-item">
            <h2 class="accordion-header">
                <button
                    class="our-work__nav-item our-work__nav-item--active accordion-button shadow-none w-100"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#modern"
                    aria-expanded="true"
                    aria-controls="modern">

                    <span class="nav-link active">
                        Modern Infrastructure Solutions
                    </span>

                </button>
            </h2>

            <div id="modern" class="accordion-collapse collapse show" data-bs-parent="#ourWorkAccordion">
                <div class="accordion-body p-0">
                    <div class="our-work__content align-items-center d-flex justify-content-center">
                        <div class="our-work__description">
                            <div class="our-work__image d-flex flex-start">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/construction-department.png'); ?>" alt="Our Work Image" />
                            </div>
                            <div class="description d-flex flex-column">
                                <h3 class="description__title">Modern Infrastructure Solutions</h3>
                                <p class="description__content body-large mb-0">
                                    Delivering durable, efficient, and future-ready construction projects with precision and expertise.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Reliable -->
        <div class="our-work__card accordion-item">
            <h2 class="accordion-header">
                <button
                    class="our-work__nav-item accordion-button collapsed shadow-none w-100"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#Reliable"
                    aria-expanded="false"
                    aria-controls="Reliable">

                    <span class="nav-link">
                        Reliable Infrastructure Solutions
                    </span>

                </button>
            </h2>

            <div id="Reliable" class="accordion-collapse collapse" data-bs-parent="#ourWorkAccordion">
                <div class="accordion-body p-0">
                    <div class="our-work__content align-items-center d-flex justify-content-center">
                        <div class="our-work__description flex-grow-1">
                            <div class="our-work__image d-flex flex-start">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/service-department.png'); ?>" alt="Our Work Image" />
                            </div>
                            <div class="description d-flex flex-column">
                                <h3 class="description__title m-0">Reliable Infrastructure Solutions</h3>
                                <p class="description__content body-large mb-0">
                                    Delivering durable, efficient, and future-ready construction projects with precision and expertise.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- innovative -->
        <div class="our-work__card accordion-item">
            <h2 class="accordion-header">
                <button
                    class="our-work__nav-item accordion-button collapsed shadow-none w-100"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#innovative"
                    aria-expanded="false"
                    aria-controls="innovative">

                    <span class="nav-link">
                        Innovative Construction Services
                    </span>

                </button>
            </h2>

            <div id="innovative" class="accordion-collapse collapse" data-bs-parent="#ourWorkAccordion">
                <div class="accordion-body p-0">
                    <div class="our-work__content align-items-center d-flex justify-content-center">
                        <div class="our-work__description flex-grow-1">
                            <div class="our-work__image d-flex flex-start">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/service-department.png'); ?>" alt="Our Work Image" />
                            </div>
                            <div class="description d-flex flex-column">
                                <h3 class="description__title m-0">Innovative Construction Services</h3>
                                <p class="description__content body-large mb-0">
                                    Delivering durable, efficient, and future-ready construction projects with precision and expertise.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- trsuted -->
        <div class="our-work__card accordion-item">
            <h2 class="accordion-header">
                <button
                    class="our-work__nav-item accordion-button collapsed shadow-none w-100"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#trusted"
                    aria-expanded="false"
                    aria-controls="trusted">

                    <span class="nav-link">
                        Trusted Project Builders </span>

                </button>
            </h2>

            <div id="trusted" class="accordion-collapse collapse" data-bs-parent="#ourWorkAccordion">
                <div class="accordion-body p-0">
                    <div class="our-work__content align-items-center d-flex justify-content-center">
                        <div class="our-work__description flex-grow-1">
                            <div class="our-work__image d-flex flex-start">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/service-department.png'); ?>" alt="Our Work Image" />
                            </div>
                            <div class="description d-flex flex-column">
                                <h3 class="description__title m-0">Trusted Project Builders</h3>
                                <p class="description__content body-large mb-0">
                                    Delivering durable, efficient, and future-ready construction projects with precision and expertise.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
