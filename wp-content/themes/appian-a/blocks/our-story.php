<?php

/**
 * Our Story CTA block (mobile).
 */

$eyebrow  = get_field('eyebrow_text');
$body     = get_field('body_text');
$cta_link = get_field('cta_link');

// If all three fields are empty, return early and do not render the block at all.
if (empty($eyebrow) && empty($body) && empty($cta_link)) {
    return;
}
?>

<section class="our-story" aria-label="Our Story">
    <div class="our-story__inner">
        <?php if (!empty($eyebrow)) : ?>
            <p class="our-story__eyebrow"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>
        <?php if (!empty($body)) : ?>
            <div class="our-story__body">
                <?php echo wp_kses_post($body); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($cta_link) && !empty($cta_link['url'])) : ?>
            <?php
            $target_attr = '';
            if (!empty($cta_link['target']) && $cta_link['target'] === '_blank') {
                $target_attr = ' target="_blank" rel="noopener noreferrer"';
            }
            ?>
            <div class="our-story__cta">
                <a href="<?php echo esc_url($cta_link['url']); ?>" class="btn btn-primary btn--small our-story__cta-btn our-story__cta-btn--mobile"<?php echo $target_attr; ?>>
                    <?php echo esc_html($cta_link['title']); ?> <?php echo appian_get_svg_icon('arrow-right'); ?>
                </a>
                <a href="<?php echo esc_url($cta_link['url']); ?>" class="btn btn-primary our-story__cta-btn our-story__cta-btn--desktop"<?php echo $target_attr; ?>>
                    <?php echo esc_html($cta_link['title']); ?> <?php echo appian_get_svg_icon('arrow-right'); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>
