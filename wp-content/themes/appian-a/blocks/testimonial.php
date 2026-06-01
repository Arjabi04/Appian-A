<section class="m-testimonial">
    <!-- Red background band -->
    <div class="m-testimonial__red-block"></div>

    <!-- Person photo (in normal flow — drives container height) -->
    <img
        class="m-testimonial__person"
        src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/person.png'); ?>"
        alt="Rob, Global Chief Data and Technology Officer"
    />

    <!-- Arrow + name annotation -->
    <div class="m-testimonial__annotation">
        <img
            class="m-testimonial__arrow"
            src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/arrow.svg'); ?>"
            alt=""
        />
        <p class="m-testimonial__name">
            Rob, Global Chief Data and Technology Officer
        </p>
    </div>

    <!-- Testimonial quote card -->
    <div class="m-testimonial__quote-box">
        <!-- Background container -->
        <div class="m-testimonial__quote-bg-container">
            <picture>
                <source
                    media="(min-width: 1025px)"
                    srcset="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/quote-box.svg'); ?>"
                />
                <img
                    class="m-testimonial__quote-bg"
                    src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/quote-box-mobile.svg'); ?>"
                    alt=""
                />
            </picture>
        </div>
        <!-- Content container -->
        <div class="m-testimonial__quote-content">
            <p class="m-testimonial__quote-text">
                &ldquo;We went from zero to 55% total proficiency across the agency
                &ndash; with a couple of key countries at 100%. Rapid progress not
                only exceeded initial targets but also built a strong foundation.&rdquo;
            </p>
        </div>
    </div>
</section>
