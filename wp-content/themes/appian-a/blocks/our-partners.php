<?php
$block         = get_field('our_partners');
$section_title = $block['section_title'] ?? '';
$partners      = $block['partners']      ?? [];
$view_all_link = $block['view_all_link'] ?? null;

if (empty($block)) {
    return;
}

$rendered_partners = [];

if (is_array($partners)) {
    foreach ($partners as $item) {
        if (! empty($item['logo']) && ! empty($item['logo']['url'])) {
            $rendered_partners[] = $item;
        }
    }
}

$has_partners = ! empty($rendered_partners);

$has_view_all = ! empty($view_all_link) && ! empty($view_all_link['url']);
$partner_count = count($rendered_partners);
$mobile_span = 2 - ($partner_count % 2);
$desktop_span = 4 - ($partner_count % 4);

if ($mobile_span === 0) {
    $mobile_span = 2;
}

if ($desktop_span === 0) {
    $desktop_span = 4;
}

if (empty($section_title) && ! $has_partners && ! $has_view_all) {
    return;
}
?>

<section class="partners grid-container" aria-label="Our Partners">

    <?php if (! empty($section_title)) : ?>
        <h2 class="partners__heading h2 text-center">
            <?php echo esc_html($section_title); ?>
        </h2>
    <?php endif; ?>

    <?php if (! empty($section_title)) : ?>
        <div class="partners__divider section-divider section-divider--responsive d-flex justify-content-center" data-section-divider>
            <img
                class="section-divider__image"
                src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>"
                alt=""
                aria-hidden="true">
        </div>
    <?php endif; ?>

    <?php if (! empty($partners) || (! empty($view_all_link) && ! empty($view_all_link['url']))) : ?>
        <div class="partners__grid-wrapper">
            <div class="partners__grid">

                <?php if (! empty($rendered_partners)) : ?>
                    <?php foreach ($rendered_partners as $item) : ?>
                        <?php
                        $logo_url      = $item['logo']['url'] ?? '';
                        $logo_alt      = $item['logo']['alt'] ?? '';
                        $has_link      = ! empty($item['link']['url']);
                        $link_url      = $has_link ? $item['link']['url'] : '';
                        $link_target   = $has_link && ! empty($item['link']['target']) ? $item['link']['target'] : '_self';
                        $link_is_blank = ($link_target === '_blank');
                        ?>

                        <div class="partners__cell">
                            <div class="partners__logo-box">
                                <?php if ($has_link) : ?>
                                    <a class="partners__logo-link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" <?php if ($link_is_blank) : ?> rel="noopener noreferrer" <?php endif; ?>>
                                    <?php endif; ?>
                                    <img
                                        class="partners__logo"
                                        src="<?php echo esc_url($logo_url); ?>"
                                        alt="<?php echo esc_attr($logo_alt); ?>"
                                        loading="lazy">
                                    <?php if ($has_link) : ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if (! empty($view_all_link) && ! empty($view_all_link['url'])) : ?>
                    <?php
                    $view_url    = $view_all_link['url'] ?? '';
                    $view_text   = ! empty($view_all_link['title']) ? $view_all_link['title'] : 'View All Partners';
                    $view_target = ! empty($view_all_link['target']) ? $view_all_link['target'] : '_self';
                    $view_rel    = ($view_target === '_blank') ? ' rel="noopener noreferrer"' : '';
                    $view_tag    = '<a class="partners__link btn-text-lg" href="' . esc_url($view_url) . '" target="' . esc_attr($view_target) . '"' . $view_rel . '>';
                    ?>
                    <div
                        class="partners__cell partners__cell--link"
                        style="--partners-span-mobile: <?php echo esc_attr($mobile_span); ?>; --partners-span-desktop: <?php echo esc_attr($desktop_span); ?>;">
                        <?php echo $view_tag; ?>
                        <?php echo esc_html($view_text); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
