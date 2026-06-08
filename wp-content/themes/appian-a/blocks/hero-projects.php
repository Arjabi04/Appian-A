<?php
$block         = get_field('hero_projects');
$section_title = $block['section_title']  ?? '';
$feature_image = $block['feature_image']  ?? null;
$project_cards = $block['project_cards']  ?? [];

if (empty($block) || empty($project_cards)) {
    return;
}
?>
<section class="hero-projects">
    <?php if (!empty($section_title)) : ?>
        <header class="hero-projects__header h2 text-center">
            <?php echo esc_html($section_title); ?>
        </header>
    <?php endif; ?>

    <div class="hero-projects__divider-wrap section-divider section-divider--responsive d-flex justify-content-center" data-section-divider>
        <img
            class="hero-projects__section-divider section-divider__image"
            src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>"
            alt=""
            aria-hidden="true" />
    </div>

    <div class="hero-projects__projects">
        <?php if (!empty($project_cards)) : ?>
            <?php
            $card_index = 0;
            foreach ($project_cards as $card) :
                $card_index++;
                ?>
                <div class="hero-projects__project-item"><?php $card_data = $card; include get_template_directory() . '/template-parts/components/project-card.php'; ?></div>
                
                <?php if ($card_index === 4 && !empty($feature_image) && !empty($feature_image['url'])) : ?>
                    <div class="hero-projects__feature-image">
                        <img
                            src="<?php echo esc_url($feature_image['url']); ?>"
                            alt="<?php echo esc_attr($feature_image['alt'] ?? ''); ?>">
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if ($card_index < 4 && !empty($feature_image) && !empty($feature_image['url'])) : ?>
                <div class="hero-projects__feature-image">
                    <img
                        src="<?php echo esc_url($feature_image['url']); ?>"
                        alt="<?php echo esc_attr($feature_image['alt'] ?? ''); ?>">
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
