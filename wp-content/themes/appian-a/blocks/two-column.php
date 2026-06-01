<?php
/**
 * Two Column Block Template (Construction & Service Departments).
 *
 * @package Appian_A
 */
?>

<section class="m-two-column">
    <div class="m-two-column__container">
        <!-- Card 1: Construction Department -->
        <div class="m-two-column__card m-two-column__card--construction" data-node-id="4045:2396">
            <div class="m-two-column__image-wrapper" data-node-id="4045:2397">
                <picture class="m-two-column__picture">
                    <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri() . '/resources/images/construction-department-mobile.png'); ?>">
                    <img
                        class="m-two-column__image"
                        src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/construction-department.png'); ?>"
                        alt="<?php esc_attr_e('Construction workers discussing project details at a site', 'outside-traineeship-boilerplate'); ?>"
                    />
                </picture>
            </div>
            <div class="m-two-column__overlay" data-node-id="4045:2399"></div>
            <div class="m-two-column__content" data-node-id="4045:2407">
                <span class="m-two-column__eyebrow"><?php esc_html_e('Leaders in the field', 'outside-traineeship-boilerplate'); ?></span>
                <h2 class="m-two-column__heading">
                    <?php echo wp_kses_post(__('Construction<br>Department', 'outside-traineeship-boilerplate')); ?>
                </h2>
            </div>
            <a
                class="m-two-column__button"
                href="https://example.com/construction"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="<?php esc_attr_e('Visit Construction Department (opens in a new window)', 'outside-traineeship-boilerplate'); ?>"
                data-node-id="4045:2400"
            >
                <span class="m-two-column__button-inner" data-node-id="4045:2401">
                    <?php echo appian_get_svg_icon('arrow-right'); ?>
                </span>
            </a>
        </div>

        <!-- Card 2: Service Department -->
        <div class="m-two-column__card m-two-column__card--service" data-node-id="4045:2410">
            <div class="m-two-column__image-wrapper" data-node-id="4045:2411">
                <picture class="m-two-column__picture">
                    <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri() . '/resources/images/service-department-mobile.png'); ?>">
                    <img
                        class="m-two-column__image"
                        src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/service-department.png'); ?>"
                        alt="<?php esc_attr_e('Service technician working on equipment panels', 'outside-traineeship-boilerplate'); ?>"
                    />
                </picture>
            </div>
            <div class="m-two-column__overlay" data-node-id="4045:2413"></div>
            <div class="m-two-column__content" data-node-id="4045:2421">
                <span class="m-two-column__eyebrow"><?php esc_html_e('Experience that matters', 'outside-traineeship-boilerplate'); ?></span>
                <h2 class="m-two-column__heading">
                    <?php echo wp_kses_post(__('Service<br>Department', 'outside-traineeship-boilerplate')); ?>
                </h2>
            </div>
            <a
                class="m-two-column__button"
                href="https://example.com/service"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="<?php esc_attr_e('Visit Service Department (opens in a new window)', 'outside-traineeship-boilerplate'); ?>"
                data-node-id="4045:2414"
            >
                <span class="m-two-column__button-inner" data-node-id="4045:2415">
                    <?php echo appian_get_svg_icon('arrow-right'); ?>
                </span>
            </a>
        </div>
    </div>
</section>
