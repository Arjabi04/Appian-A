<?php
$block         = get_field('our_work');
$work_items    = $block['work_items'] ?? [];
$section_title = $block['section_title'] ?? '';

if (empty($block) || empty($work_items)) {
    return;
}
?>
<section class="our-work__wrapper" id="our-work">
    <?php if (!empty($section_title)) : ?>
        <header class="our-work__header h2 text-center"><?php echo esc_html($section_title); ?></header>
        <div class="our-work__divider-wrap section-divider d-flex justify-content-center" data-section-divider>
            <img
                class="our-work__section-divider section-divider__image"
                src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>"
                alt=""
                aria-hidden="true" />
        </div>
    <?php endif; ?>

    <div class="our-work__desktop">
        <?php if (!empty($work_items)) : ?>
            <ul class="our-work__nav d-flex flex-wrap list-unstyled justify-content-center gap-4 m-0" aria-label="Our Work Categories">
                <?php
                $nav_index = 0;
                foreach ($work_items as $item) :
                    if (empty($item['tab_label']) && empty($item['title']) && empty($item['description'])) {
                        continue;
                    }

                    $is_first      = ($nav_index === 0);
                    $li_class      = 'our-work__nav-item' . ($is_first ? ' our-work__nav-item--active' : '');
                    $a_class       = 'nav-link' . ($is_first ? ' active' : '');
                    $aria_current  = $is_first ? ' aria-current="page"' : '';
                    $aria_selected = $is_first ? 'true' : 'false';
                    $tab_id        = 'our-work-tab-' . $nav_index;
                    $panel_id      = 'our-work-panel-' . $nav_index;
                ?>
                    <li class="<?php echo esc_attr($li_class); ?>">
                        <a class="<?php echo esc_attr($a_class); ?>"
                            id="<?php echo esc_attr($tab_id); ?>"
                            data-bs-target="#<?php echo esc_attr($panel_id); ?>"
                            href="#"
                            role="tab"
                            aria-controls="<?php echo esc_attr($panel_id); ?>"
                            aria-selected="<?php echo esc_attr($aria_selected); ?>" <?php echo $aria_current; ?>>
                            <?php echo esc_html($item['tab_label'] ?? ''); ?>
                        </a>
                    </li>
                <?php
                    $nav_index++;
                endforeach;
                ?>
            </ul>

            <?php
            $panel_index = 0;
            foreach ($work_items as $item) :
                if (empty($item['tab_label']) && empty($item['title']) && empty($item['description'])) {
                    continue;
                }

                $is_first  = ($panel_index === 0);
                $tab_id    = 'our-work-tab-' . $panel_index;
                $panel_id  = 'our-work-panel-' . $panel_index;
                $has_image = false;
                $image_url = '';
                $image_alt = '';

                if (!empty($item['image']) && is_array($item['image']) && !empty($item['image']['url'])) {
                    $has_image = true;
                    $image_url = $item['image']['url'];
                    if (!empty($item['image']['alt'])) {
                        $image_alt = $item['image']['alt'];
                    }
                }

                $panel_class = 'our-work__content align-items-center justify-content-center ' . ($is_first ? 'd-flex' : 'd-none');
            ?>
                <div class="<?php echo esc_attr($panel_class); ?>"
                    id="<?php echo esc_attr($panel_id); ?>"
                    role="tabpanel"
                    aria-labelledby="<?php echo esc_attr($tab_id); ?>">
                    <div class="our-work__description flex-grow-1">
                        <div class="description d-flex flex-column">
                            <?php if (!empty($item['title'])) : ?>
                                <h3 class="description__title m-0">
                                    <?php echo esc_html($item['title']); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if (!empty($item['description'])) : ?>
                                <p class="description__content body-large mb-0">
                                    <?php echo nl2br(esc_html($item['description'])); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($has_image) : ?>
                        <div class="our-work__image d-flex flex-start">
                            <img src="<?php echo esc_url($image_url); ?>"
                                alt="<?php echo esc_attr($image_alt); ?>" />
                        </div>
                    <?php endif; ?>
                </div>
            <?php
                $panel_index++;
            endforeach;
            ?>
        <?php endif; ?>
    </div>


    <!-- mobile accordian -->
    <?php if (!empty($work_items)) : ?>
        <div class="our-work__accordion accordion" id="ourWorkAccordion">
            <?php
            $acc_index = 0;
            foreach ($work_items as $item) :
                if (empty($item['tab_label']) && empty($item['title']) && empty($item['description'])) {
                    continue;
                }

                $is_first      = ($acc_index === 0);
                $target_id     = 'our-work-item-' . $acc_index;
                $card_class    = 'our-work__card' . ($is_first ? ' our-work__card--active' : '') . ' accordion-item';
                $btn_class     = 'our-work__nav-item' . ($is_first ? ' our-work__nav-item--active' : '') . ' accordion-button' . ($is_first ? '' : ' collapsed') . ' shadow-none w-100';
                $span_class    = 'nav-link' . ($is_first ? ' active' : '');
                $aria_expanded = $is_first ? 'true' : 'false';
                $panel_class   = 'accordion-collapse collapse' . ($is_first ? ' show' : '');
                $desc_class    = 'our-work__description' . ($is_first ? '' : ' flex-grow-1');
                $title_class   = 'description__title' . ($is_first ? '' : ' m-0');
                $has_image     = false;
                $image_url     = '';
                $image_alt     = '';

                if (!empty($item['image']) && is_array($item['image']) && !empty($item['image']['url'])) {
                    $has_image = true;
                    $image_url = $item['image']['url'];
                    if (!empty($item['image']['alt'])) {
                        $image_alt = $item['image']['alt'];
                    }
                }
            ?>
                <div class="<?php echo esc_attr($card_class); ?>">
                    <h2 class="accordion-header">
                        <button
                            class="<?php echo esc_attr($btn_class); ?>"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#<?php echo esc_attr($target_id); ?>"
                            aria-expanded="<?php echo esc_attr($aria_expanded); ?>"
                            aria-controls="<?php echo esc_attr($target_id); ?>">

                            <span class="<?php echo esc_attr($span_class); ?>">
                                <?php echo esc_html($item['title'] ?? ''); ?>
                            </span>

                        </button>
                    </h2>

                    <div id="<?php echo esc_attr($target_id); ?>" class="<?php echo esc_attr($panel_class); ?>" data-bs-parent="#ourWorkAccordion">
                        <div class="accordion-body p-0">
                            <div class="our-work__content align-items-center d-flex justify-content-center">
                                <div class="<?php echo esc_attr($desc_class); ?>">
                                    <?php if ($has_image) : ?>
                                        <div class="our-work__image d-flex flex-start">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
                                        </div>
                                    <?php endif; ?>
                                    <div class="description d-flex flex-column">
                                        <?php if (!empty($item['title'])) : ?>
                                            <h3 class="<?php echo esc_attr($title_class); ?>">
                                                <?php echo esc_html($item['title']); ?>
                                            </h3>
                                        <?php endif; ?>

                                        <?php if (!empty($item['description'])) : ?>
                                            <p class="description__content body-large mb-0">
                                                <?php echo nl2br(esc_html($item['description'])); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                $acc_index++;
            endforeach;
            ?>
        </div>
    <?php endif; ?>
</section>