<?php
$partner_images = [
    'our-partners-1.png',
    'our-partners-2.png',
    'our-partners-1.png',
    'our-partners-2.png',
    'our-partners-1.png',
    'our-partners-2.png',
    'our-partners-1.png',
    'our-partners-2.png',
    'our-partners-1.png',
    'our-partners-2.png',
    'our-partners-1.png',
    'our-partners-2.png',
    'our-partners-1.png',
    'our-partners-2.png',
    'our-partners-1.png',
];
?>
<section class="partners grid-container" aria-label="Our Partners">
    <h2 class="partners__heading h2 text-center">Our Partners</h2>

    <div class="partners__divider section-divider section-divider--responsive d-flex justify-content-center" data-section-divider>
        <img
            class="section-divider__image"
            src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>"
            alt=""
            aria-hidden="true">
    </div>

    <div class="partners__grid-wrapper r">
        <div class="partners__grid ">
            <?php foreach ($partner_images as $partner_image) : ?>
                <div class="partners__cell">
                    <img
                        class="partners__logo"
                        src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/' . $partner_image); ?>"
                        alt="Partner logo">
                </div>
            <?php endforeach; ?>

            <div class="partners__cell partners__cell--link">
                <a class="partners__link btn-text-lg" href="#">View All Partners</a>
            </div>
        </div>
    </div>
</section>