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
    <div class="m-our-history__header">
        <h2 class="m-our-history__title h2">Our History</h2>
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
                            <span class="m-our-history__year body-xlarge"><?php echo esc_html($slide['year']); ?></span>
                            <div class="m-our-history__image-wrapper">
                                <img class="m-our-history__image" src="<?php echo esc_url($slide['image_url']); ?>"
                                    alt="<?php echo esc_attr($slide['image_alt']); ?>" />
                            </div>
                        </div>
                        <?php
                        $popup_paragraphs = preg_split('/\R{2,}/', $slide['popup_description']);
                        $first_paragraph = isset($popup_paragraphs[0]) ? trim($popup_paragraphs[0]) : '';
                        ?>
                        <p class="m-our-history__description m-our-history__description--desktop body">
                            <?php echo esc_html($slide['popup_description']); ?>
                        </p>
                        <p class="m-our-history__description m-our-history__description--mobile body">
                            <?php echo esc_html($first_paragraph); ?>
                        </p>
                        <a class="body-small m-our-history__link" href="#" data-history-link
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
        <button class="m-our-history__nav-btn m-our-history__nav-btn--left" data-history-btn-left
            aria-label="Previous slide">
            <?php echo appian_get_svg_icon('arrow-left'); ?>
        </button>
        <button class="m-our-history__nav-btn m-our-history__nav-btn--right" data-history-btn-right
            aria-label="Next slide">
            <?php echo appian_get_svg_icon('arrow-right'); ?>
        </button>
    </div>
</section>

<div class="m-our-history-popup" id="our-history-popup" aria-hidden="true" role="dialog" aria-modal="true"
    aria-labelledby="popup-year">
    <div class="m-our-history-popup__overlay" data-popup-close>
        <div class="m-our-history-popup__container">
            <button class="m-our-history-popup__close" aria-label="Close popup" data-popup-close>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/x.svg'); ?>" alt=""
                    aria-hidden="true" />
            </button>
            <div class="m-our-history-popup__image-wrapper">
                <img class="m-our-history-popup__image" src="" alt="" />
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