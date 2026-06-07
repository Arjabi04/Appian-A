<section class="hero-projects">
    <header class="hero-projects__header h2 text-center">
        Hero Projects
    </header>

    <div class="hero-projects__divider-wrap section-divider section-divider--responsive d-flex justify-content-center" data-section-divider>
        <img
            class="hero-projects__section-divider section-divider__image"
            src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>"
            alt=""
            aria-hidden="true" />
    </div>

    <div class="hero-projects__projects">
        <div class="hero-projects__project-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
        <div class="hero-projects__project-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
        <div class="hero-projects__project-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
        <div class="hero-projects__project-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>

        <div class="hero-projects__feature-image">
            <img
                src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/heroProject-image.png'); ?>"
                alt="Featured construction project overview">
        </div>

        <div class="hero-projects__project-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
        <div class="hero-projects__project-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
        <div class="hero-projects__project-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
        <div class="hero-projects__project-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
        <div class="hero-projects__project-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
        <div class="hero-projects__project-item"><?php include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
    </div>
</section>
