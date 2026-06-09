<?php
$block = get_field('tertiary_hero');

if (empty($block)) {
    return;
}
$eyebrow     = $block['eyebrow_text'] ?? '';
$heading     = $block['heading']     ?? '';
$description = $block['description'] ?? '';
$caption     = $block['caption']     ?? '';
$image       = $block['image']       ?? null;
?>
<section class="m-tertiary-hero" aria-label="Tertiary Hero">
    <div class="m-tertiary-hero__content-wrapper">
        <div class="m-tertiary-hero__text-container">
            <div class="m-tertiary-hero__text-box">
                <?php if (!empty($eyebrow)) : ?>
                    <p class="m-tertiary-hero__eyebrow sh3 text-white mb-0">
                        <?php echo esc_html($eyebrow); ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($heading)) : ?>
                    <h2 class="m-tertiary-hero__heading h2 text-white mb-0">
                        <?php echo esc_html($heading); ?>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($description)) : ?>
                    <p class="m-tertiary-hero__description body-large text-white mb-0">
                        <?php echo nl2br(esc_html($description)); ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($caption)) : ?>
                    <p class="m-tertiary-hero__caption mb-0">
                        <?php echo esc_html($caption); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if (!empty($image['url'])) : ?>
        <div class="m-tertiary-hero__image-wrapper">
            <img
                class="m-tertiary-hero__image"
                src="<?php echo esc_url($image['url']); ?>"
                alt="<?php echo esc_attr(!empty($image['alt']) ? $image['alt'] : ''); ?>"
                loading="eager"
                fetchpriority="high" />
        </div>
    <?php endif; ?>
</section>

