<?php
$card_image  = $card_data['image']       ?? null;
$category    = $card_data['category']    ?? '';
$title       = $card_data['title']       ?? '';
$description = $card_data['description'] ?? '';
$link        = $card_data['link']        ?? null;
$link_url    = $link['url']              ?? '#';
$link_target = $link['target']           ?? '_self';

if (empty($title)) {
    return;
}
?>
<article class="project-card">
    <?php if (!empty($card_image) && !empty($card_image['url'])) : ?>
        <img
            class="project-card__image"
            src="<?php echo esc_url($card_image['url']); ?>"
            alt="<?php echo esc_attr($card_image['alt'] ?? ''); ?>">
    <?php endif; ?>

    <div class="project-card__meta d-flex align-items-start">
        <img
            class="project-card__icon"
            src="/wp-content/themes/appian-a/resources/images/svgs/i-icon.svg"
            alt=""
            aria-hidden="true">

        <?php if (!empty($category)) : ?>
            <span class="project-card__category body-xsmall">
                <?php
                $category_parts = preg_split('/\s+/', trim($category));
                $first_word = !empty($category_parts[0]) ? $category_parts[0] : '';
                ?>
                <span class="d-inline d-xl-none"><?php echo esc_html($category); ?></span>
                <span class="d-none d-xl-inline"><?php echo esc_html($first_word); ?></span>
            </span>
        <?php endif; ?>
    </div>

    <div class="project-card__content">
        <h3 class="project-card__title h6"><?php echo esc_html($title); ?></h3>
        <?php if (!empty($description)) : ?>
            <p class="project-card__description body-xsmall"><?php echo nl2br(esc_html($description)); ?></p>
        <?php endif; ?>
    </div>

    <a href="<?php echo esc_url($link_url); ?>" class="project-card__read-more"<?php echo $link_target === '_blank' ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
        <span class="project-card__arrow" aria-hidden="true">
            <img src="/wp-content/themes/appian-a/resources/images/svgs/arrow-right.svg" alt="">
        </span>
        <span class="project-card__read-more-text"><?php echo esc_html(!empty($link['title']) ? $link['title'] : 'read more'); ?></span>
    </a>
</article>
