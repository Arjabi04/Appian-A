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
		<div class="faq__section-header">
			<h2 class="faq__section-title h2 text-center"><?php echo esc_html($faq_section_title); ?></h2>
			<div class="faq__section-divider-wrap section-divider" data-section-divider>
				<img
					class="faq__section-divider section-divider__image"
					src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>"
					alt=""
					aria-hidden="true" />
			</div>
		</div>
	<?php endif; ?>
	<div class="faq__grid">
		<div class="faq__process">
			<?php if (! empty($faq_heading)) : ?>
				<h2 class="faq__heading h5"><?php echo esc_html($faq_heading); ?></h2>
			<?php endif; ?>
			<?php if (! empty($faq_description)) : ?>
				<p class="faq__description body-sm-all">
					<?php echo esc_html($faq_description); ?>
				</p>
			<?php endif; ?>
			<?php if (! empty($faq_cta_link) && is_array($faq_cta_link) && ! empty($faq_cta_link['url'])) : ?>
				<a class="faq__cta-button btn btn-primary" href="<?php echo esc_url($faq_cta_link['url']); ?>" <?php echo ! empty($faq_cta_link['target']) && $faq_cta_link['target'] === '_blank' ? ' target="_blank" rel="noopener noreferrer"' : ''; ?> aria-label="<?php echo esc_attr($faq_cta_link['title']); ?>">
					<span><?php echo esc_html($faq_cta_link['title']); ?></span>
					<span class="faq__cta-icon" aria-hidden="true">
						<?php echo appian_get_svg_icon('arrow-right'); ?>
					</span>
				</a>
			<?php endif; ?>
		</div>

		<div class="faq__faq accordion" id="faqAccordion">
			<?php if (! empty($faq_items) && is_array($faq_items)) : ?>
				<?php
				$visible_index = 0;
				foreach ($faq_items as $item) :
					if (empty($item['question']) && empty($item['answer'])) {
						continue;
					}

					$is_first = ($visible_index === 0);
					$item_id = 'faq-item-' . $visible_index;
					$heading_id = 'faq-heading-' . $visible_index;
					$button_class = 'faq__toggle accordion-button shadow-none' . ($is_first ? '' : ' collapsed');
					$panel_class = 'accordion-collapse collapse' . ($is_first ? ' show' : '');
					$visible_index++;
				?>
					<div class="faq__item accordion-item">
						<h3 class="faq__question accordion-header" id="<?php echo esc_attr($heading_id); ?>">
							<button
								class="<?php echo esc_attr($button_class); ?>"
								type="button"
								data-bs-toggle="collapse"
								data-bs-target="#<?php echo esc_attr($item_id); ?>"
								aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
								aria-controls="<?php echo esc_attr($item_id); ?>">
								<span class="faq__question-text sh3"><?php echo esc_html($item['question']); ?></span>
								<span class="faq__icon" aria-hidden="true">
									<?php echo appian_accordion_toggle_icon(); ?>
								</span>
							</button>
						</h3>
						<div
							id="<?php echo esc_attr($item_id); ?>"
							class="<?php echo esc_attr($panel_class); ?>"
							aria-labelledby="<?php echo esc_attr($heading_id); ?>">
							<div class="accordion-body faq__panel-body body-small">
								<?php echo wp_kses_post($item['answer']); ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>