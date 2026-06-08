<section class="our-projects">
    <header class="our-projects__header h2 text-center">
        Our Projects
    </header>

    <div class="our-projects__divider-wrap section-divider section-divider--responsive d-flex justify-content-center" data-section-divider>
        <img
            class="our-projects__section-divider section-divider__image"
            src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>"
            alt=""
            aria-hidden="true" />
    </div>
    <div class="our-projects__filters-wrapper grid-container">
        <div class="grid-row">
            <div class="our-projects__filters-shell">
                <ul class="our-projects__filters nav justify-content-center align-items-center list-unstyled d-flex" role="tablist" aria-label="Project filters">
                    <li class="nav-item" role="presentation">
                        <button class="our-projects__filter nav-link body-sm-all m-0 p-0 bg-transparent" type="button" role="tab" aria-selected="true">All Projects</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="our-projects__filter nav-link body-small m-0 p-0 bg-transparent" type="button" role="tab" aria-selected="false">Renovation</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="our-projects__filter nav-link body-small m-0 p-0 bg-transparent" type="button" role="tab" aria-selected="false">Waterproofing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="our-projects__filter nav-link body-small m-0 p-0 bg-transparent" type="button" role="tab" aria-selected="false">Plumbing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="our-projects__filter nav-link body-small m-0 p-0 bg-transparent" type="button" role="tab" aria-selected="false">Electrical</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="our-projects__filter nav-link body-small m-0 p-0 bg-transparent" type="button" role="tab" aria-selected="false">HVAC</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="our-projects__filter nav-link body-small m-0 p-0 bg-transparent" type="button" role="tab" aria-selected="false">Roofing</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="our-projects__cards-wrapper grid-container">
        <div class="grid-row">
            <div class="our-projects__cards-grid">
                <div class="our-projects__card-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
                <div class="our-projects__card-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
                <div class="our-projects__card-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
                <div class="our-projects__card-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
                <div class="our-projects__card-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
                <div class="our-projects__card-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
                <div class="our-projects__card-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
                <div class="our-projects__card-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
                <div class="our-projects__card-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
                <div class="our-projects__card-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
                <div class="our-projects__card-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
                <div class="our-projects__card-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
            </div>
        </div>
    </div>

    <div class="our-projects__pagination-wrapper grid-container">
        <div class="grid-row">
            <nav class="our-projects__pagination-nav" aria-label="Projects pagination">
                <ul class="pagination our-projects__pagination justify-content-center mb-0 d-flex list-unstyled">
                    <li class="page-item">
                        <a class="page-link our-projects__page-arrow our-projects__page-arrow--prev" href="#" aria-label="Previous">
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/arrow-down.svg'); ?>"
                                alt=""
                                aria-hidden="true" />
                        </a>
                    </li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link our-projects__page-link nav-text" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link our-projects__page-link nav-text" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link our-projects__page-link nav-text" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link our-projects__page-link nav-text" href="#">4</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link our-projects__page-link nav-text" href="#">5</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link our-projects__page-arrow our-projects__page-arrow--next" href="#" aria-label="Next">
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/arrow-down.svg'); ?>"
                                alt=""
                                aria-hidden="true" />
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>