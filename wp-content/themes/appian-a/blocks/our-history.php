<?php
$history_slides = [
    [
        'year' => '1922',
        'image_url' => get_template_directory_uri() . '/resources/images/history-1.png',
        'image_alt' => 'Appian foundation in 1922',
        'popup_description' => "The stock market crash had a tremendous impact on the company and Heffron himself. Known as a generous and sensitive man, Heffron signed a great number of promissory notes for employees to help them obtain loans during this time of financial difficulty. After the crash the banks came to Heffron to collect on the notes,\n\nAt the same time, his business shrank to one-tenth the size it was before 1929. He devoted himself to finding a way to pay off the notes as well as his own debts so that the business could once again thrive. Although he had lost dozens of accounts in the crash.\n\nHeffron still had one good customer, Potomac Electric Power. His good record with the giant utility bought in just enough business to keep the company afloat during those dark days.",
    ],
    [
        'year' => '1928',
        'image_url' => get_template_directory_uri() . '/resources/images/history-2.png',
        'image_alt' => 'Appian expanding operations in 1928',
        'popup_description' => "The stock market crash had a tremendous impact on the company and Heffron himself. Known as a generous and sensitive man, Heffron signed a great number of promissory notes for employees to help them obtain loans during this time of financial difficulty. After the crash the banks came to Heffron to collect on the notes,\n\nAt the same time, his business shrank to one-tenth the size it was before 1929. He devoted himself to finding a way to pay off the notes as well as his own debts so that the business could once again thrive. Although he had lost dozens of accounts in the crash.\n\nHeffron still had one good customer, Potomac Electric Power. His good record with the giant utility bought in just enough business to keep the company afloat during those dark days.",
    ],
    [
        'year' => '1929',
        'image_url' => get_template_directory_uri() . '/resources/images/history-3.png',
        'image_alt' => 'Appian projects in 1929',
        'popup_description' => "The stock market crash had a tremendous impact on the company and Heffron himself. Known as a generous and sensitive man, Heffron signed a great number of promissory notes for employees to help them obtain loans during this time of financial difficulty. After the crash the banks came to Heffron to collect on the notes,\n\nAt the same time, his business shrank to one-tenth the size it was before 1929. He devoted himself to finding a way to pay off the notes as well as his own debts so that the business could once again thrive. Although he had lost dozens of accounts in the crash.\n\nHeffron still had one good customer, Potomac Electric Power. His good record with the giant utility bought in just enough business to keep the company afloat during those dark days.",
    ],
];
?>
<section class="m-our-history" aria-label="Our History">
    <div class="m-our-history__header text-center w-100 mb-0">
        <h2 class="m-our-history__title h2 m-0">Our History</h2>
        <img class="m-our-history__divider"
            src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>" alt=""
            aria-hidden="true" />
    </div>
    <div class="m-our-history__carousel" data-history-carousel>
        <div class="m-our-history__track" data-history-track>
            <?php foreach ($history_slides as $index => $slide): ?>
                <div class="m-our-history__slide" data-history-slide>
                    <div class="m-our-history__card">
                        <div class="m-our-history__image-year-box">
                            <span class="m-our-history__year body-xlarge d-inline-block m-0"><?php echo esc_html($slide['year']); ?></span>
                            <div class="m-our-history__image-wrapper w-100 overflow-hidden">
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
                            Continue Reading
                        </a>
                    </div>
                    <?php if ($index < count($history_slides) - 1): ?>
                        <div class="m-our-history__divider-line"></div>
                    <?php endif; ?>
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
            <div class="m-our-history-popup__content d-flex flex-column justify-content-end w-100">
                <div class="m-our-history-popup__body d-flex flex-column justify-content-end w-100">
                    <span class="m-our-history-popup__year d-block h2" id="popup-year"></span>
                    <div class="m-our-history-popup__description-wrapper w-100 d-flex flex-column gap-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>