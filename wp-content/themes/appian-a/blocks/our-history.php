<?php
$our_history_group = get_field('our_history_group');
// printr($our_history_group);
$our_history_group = is_array($our_history_group) ? $our_history_group : get_field('our_history');
$our_history_group = is_array($our_history_group) ? $our_history_group : [];

$section_title = $our_history_group['section_title'] ?? '';
$raw_slides = $our_history_group['history_slides'] ?? [];
$raw_slides = is_array($raw_slides) ? $raw_slides : [];

$history_slides = [];

foreach ($raw_slides as $slide) {
    $slide = is_array($slide) ? $slide : [];
    $image = $slide['image'] ?? [];
    $image = is_array($image) ? $image : [];

    $year = trim((string) ($slide['year'] ?? ''));
    $image_url = $image['url'] ?? '';
    $image_alt = $image['alt'] ?? '';
    $popup_description = trim((string) ($slide['popup_description'] ?? ''));
    $link_text = trim((string) ($slide['link_text'] ?? ''));

    if ('' === $year && '' === $image_url && '' === $popup_description) {
        continue;
    }

    if ('' === $year || '' === $image_url || '' === $popup_description) {
        continue;
    }

    $history_slides[] = [
        'year' => $year,
        'image_url' => $image_url,
        'image_alt' => $image_alt,
        'popup_description' => $popup_description,
        'link_text' => '' !== $link_text ? $link_text : 'Continue Reading',
    ];
}

if (empty($history_slides)) {
    return;
}

$section_label = ! empty($section_title) ? $section_title : 'Our History';
?>
<section class="m-our-history" aria-label="<?php echo esc_attr($section_label); ?>">
    <div class="grid-container">
        <?php if (! empty($section_title)) : ?>
            <div class="m-our-history__header text-center w-100 mb-0">
                <h2 class="m-our-history__title h2 m-0"><?php echo esc_html($section_title); ?></h2>
                <div class="m-our-history__divider-wrap">
                    <img class="m-our-history__divider"
                        src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>" alt=""
                        aria-hidden="true" />
                </div>
            </div>
        <?php endif; ?>
        <div class="m-our-history__carousel" data-history-carousel>
            <div class="m-our-history__track" data-history-track>
                <?php foreach ($history_slides as $index => $slide): ?>
                    <div class="m-our-history__slide" data-history-slide>
                        <div class="m-our-history__card">
                            <div class="m-our-history__image-year-box">
                                <span class="m-our-history__year body-xlarge d-inline-block m-0"><?php echo esc_html($slide['year']); ?></span>
                                <div class="m-our-history__image-wrapper overflow-hidden">
                                    <img class="m-our-history__image w-100 h-100 d-block" src="<?php echo esc_url($slide['image_url']); ?>"
                                        alt="<?php echo esc_attr($slide['image_alt']); ?>" />
                                </div>
                            </div>
                            <?php
                            $popup_paragraphs = preg_split('/\R{2,}/', $slide['popup_description']);
                            $first_paragraph = isset($popup_paragraphs[0]) ? trim($popup_paragraphs[0]) : '';
                            ?>
                            <p class="m-our-history__description m-our-history__description--desktop body m-0 w-100">
                                <?php echo esc_html($slide['popup_description']); ?>
                            </p>
                            <p class="m-our-history__description m-our-history__description--mobile body m-0 w-100">
                                <?php echo esc_html($first_paragraph); ?>
                            </p>
                            <a class="body-small m-our-history__link text-decoration-none d-inline-block" href="#" data-history-link
                                data-bs-toggle="modal" data-bs-target="#our-history-popup"
                                data-popup-year="<?php echo esc_attr($slide['year']); ?>"
                                data-popup-image="<?php echo esc_url($slide['image_url']); ?>"
                                data-popup-image-alt="<?php echo esc_attr($slide['image_alt']); ?>"
                                data-popup-desc="<?php echo esc_attr($slide['popup_description']); ?>">
                                <?php echo esc_html($slide['link_text']); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="m-our-history__nav">
            <button class="btn btn-primary m-our-history__nav-btn m-our-history__nav-btn--left" data-history-btn-left
                aria-label="Previous slide">
                <?php echo appian_get_svg_icon('arrow-right'); ?>
            </button>
            <button class="btn btn-primary m-our-history__nav-btn m-our-history__nav-btn--right" data-history-btn-right
                aria-label="Next slide">
                <?php echo appian_get_svg_icon('arrow-right'); ?>
            </button>
        </div>
    </div>
</section>
<div class="modal fade m-our-history-popup" id="our-history-popup" tabindex="-1" role="dialog" aria-labelledby="popup-year" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog m-our-history-popup__overlay" role="document">
        <div class="modal-content m-our-history-popup__container w-100 mw-100 m-auto position-relative d-flex flex-column flex-lg-row align-items-lg-stretch">
            <button type="button" class="m-our-history-popup__close position-absolute bg-transparent border-0" aria-label="Close popup" data-bs-dismiss="modal">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/x.svg'); ?>" alt=""
                    aria-hidden="true" />
            </button>
            <div class="m-our-history-popup__image-wrapper w-100 overflow-hidden">
                <img class="m-our-history-popup__image w-100 h-100 d-block" src="" alt="" />
            </div>
            <div class="m-our-history-popup__content">
                <div class="m-our-history-popup__body">
                    <span class="m-our-history-popup__year" id="popup-year"></span>
                    <div class="m-our-history-popup__description-wrapper">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>