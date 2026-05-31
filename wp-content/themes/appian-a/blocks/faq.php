<?php

/**
 * FAQ & Process block.
 */

$faq_section_title = get_field('section_title');
$faq_heading       = get_field('heading');
$faq_description   = get_field('description');
$faq_cta_link      = get_field('cta_link');
$faq_items         = get_field('faq_items');

if (empty($faq_section_title) && empty($faq_heading) && empty($faq_description) && empty($faq_cta_link) && empty($faq_items)) {
	return;
}
?>

<section class="faq-module">
	<?php if (! empty($faq_section_title)) : ?>
		<header class="faq__section-header" aria-label="<?php echo esc_attr($faq_section_title); ?>">
			<h2 class="faq__section-title"><?php echo esc_html($faq_section_title); ?></h2>
			<img
				class="faq__section-divider"
				src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>"
				alt=""
				aria-hidden="true" />
		</header>
	<?php endif; ?>
	<div class="faq__grid">
		<div class="faq__process">
			<?php if (! empty($faq_heading)) : ?>
				<h2 class="faq__heading"><?php echo esc_html($faq_heading); ?></h2>
			<?php endif; ?>
			<?php if (! empty($faq_description)) : ?>
				<p class="faq__description">
					<?php echo esc_html($faq_description); ?>
				</p>
			<?php endif; ?>
			<?php if (! empty($faq_cta_link) && is_array($faq_cta_link) && ! empty($faq_cta_link['url'])) : ?>
				<a class="faq__cta-button btn btn-primary" href="<?php echo esc_url($faq_cta_link['url']); ?>"<?php echo ! empty($faq_cta_link['target']) && $faq_cta_link['target'] === '_blank' ? ' target="_blank" rel="noopener noreferrer"' : ''; ?> aria-label="<?php echo esc_attr($faq_cta_link['title']); ?>">
					<span><?php echo esc_html($faq_cta_link['title']); ?></span>
					<span class="faq__cta-icon" aria-hidden="true">
						<?php echo appian_get_svg_icon('arrow-right'); ?>
					</span>
				</a>
			<?php endif; ?>
		</div>

		<div class="faq__faq" data-faq>
			<?php if (! empty($faq_items) && is_array($faq_items)) : ?>
				<?php 
				$visible_index = 0;
				foreach ($faq_items as $index => $item) : 
					if (empty($item['question']) && empty($item['answer'])) {
						continue;
					}
					$is_first = ($visible_index === 0);
					$panel_id = 'faq-panel-' . ($visible_index + 1);
					$item_class = $is_first ? 'faq__item is-open' : 'faq__item';
					$panel_class = $is_first ? 'faq__panel is-open' : 'faq__panel';
					$aria_expanded = $is_first ? 'true' : 'false';
					$hidden_attr = $is_first ? '' : ' hidden';
					$visible_index++;
					?>
					<div class="<?php echo esc_attr($item_class); ?>" data-faq-item>
						<h3 class="faq__question">
							<button
								class="faq__toggle"
								type="button"
								aria-expanded="<?php echo esc_attr($aria_expanded); ?>"
								aria-controls="<?php echo esc_attr($panel_id); ?>">
								<span class="faq__question-text"><?php echo esc_html($item['question']); ?></span>
								<span class="faq__icon" aria-hidden="true">
									<?php echo appian_accordion_toggle_icon(); ?>
								</span>
							</button>
						</h3>
						<div class="<?php echo esc_attr($panel_class); ?>" id="<?php echo esc_attr($panel_id); ?>" role="region"<?php echo $hidden_attr; ?>>
							<?php echo wp_kses_post($item['answer']); ?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
