<?php

/**
 * FAQ & Process block (static content).
 */
?>

<section class="faq-module">
	<header class="faq__section-header" aria-label="FAQ">
		<h2 class="faq__section-title">FAQ</h2>
		<img
			class="faq__section-divider"
			src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>"
			alt=""
			aria-hidden="true" />
	</header>
	<div class="faq__grid">
		<div class="faq__process">
			<h2 class="faq__heading">How will we achieve this?</h2>
			<p class="faq__description">
				We achieve this by following a structured and transparent construction process that ensures quality, efficiency, and client satisfaction at every stage. Our team begins with detailed planning and requirement analysis, followed by precise architectural and engineering design tailored to the project goals.
			</p>
			<a class="faq__cta-button btn btn-primary" href="#" aria-label="Our Story">
				<span>Our Story</span>
				<?php echo appian_get_svg_icon('arrow-right'); ?>
			</a>
		</div>

		<div class="faq__faq" data-faq>
			<div class="faq__item is-open" data-faq-item>
				<h3 class="faq__question">
					<button
						class="faq__toggle"
						type="button"
						aria-expanded="true"
						aria-controls="faq-panel-1">
						<span class="faq__question-text">What services do you provide?</span>
						<span class="faq__icon" aria-hidden="true">
							<?php echo appian_accordion_toggle_icon(); ?>
						</span>
					</button>
				</h3>
				<div class="faq__panel is-open" id="faq-panel-1" role="region">
					<p>
						We provide complete construction solutions for residential, commercial, and industrial projects. Our team manages every stage of the construction process, from initial planning and architectural design to final execution and finishing. Whether you are building a new property, renovating an existing space, or developing a large-scale infrastructure project, we focus on delivering high-quality workmanship, efficient project management, and long-lasting results.
					</p>
					<p>
						Our services are designed to meet the needs of homeowners, businesses, and property developers. We work closely with clients to understand their vision, budget, and timeline while ensuring every project follows modern construction standards and safety requirements. By combining skilled professionals, quality materials, and innovative building techniques, we create functional and visually impressive spaces.
					</p>
					<p class="faq__list-heading">Our construction services include:</p>
					<ul>
						<li>Residential Construction</li>
						<li>Commercial Building Projects</li>
						<li>Renovation &amp; Remodeling</li>
						<li>Interior Fit-Out Services</li>
						<li>Architectural Design &amp; Planning</li>
						<li>Civil &amp; Structural Works</li>
						<li>Plumbing &amp; Electrical Installation</li>
						<li>Roofing &amp; Waterproofing</li>
						<li>Landscaping &amp; Exterior Development</li>
						<li>Project Management &amp; Consultation</li>
						<li>Building Maintenance Services</li>
						<li>Turnkey Construction Solutions</li>
					</ul>
				</div>
			</div>

			<div class="faq__item" data-faq-item>
				<h3 class="faq__question">
					<button
						class="faq__toggle"
						type="button"
						aria-expanded="false"
						aria-controls="faq-panel-2">
						<span class="faq__question-text">How long does construction take?</span>
						<span class="faq__icon" aria-hidden="true">
							<?php echo appian_accordion_toggle_icon(); ?>
						</span>
					</button>
				</h3>
				<div class="faq__panel" id="faq-panel-2" role="region" hidden>
					<p>
						We provide complete construction solutions for residential, commercial, and industrial projects. Our team manages every stage of the construction process, from initial planning and architectural design to final execution and finishing. Whether you are building a new property, renovating an existing space, or developing a large-scale infrastructure project, we focus on delivering high-quality workmanship, efficient project management, and long-lasting results.
					</p>
					<p>
						Our services are designed to meet the needs of homeowners, businesses, and property developers. We work closely with clients to understand their vision, budget, and timeline while ensuring every project follows modern construction standards and safety requirements. By combining skilled professionals, quality materials, and innovative building techniques, we create functional and visually impressive spaces.
					</p>
					<p class="faq__list-heading">Our construction services include:</p>
					<ul>
						<li>Residential Construction</li>
						<li>Commercial Building Projects</li>
						<li>Renovation &amp; Remodeling</li>
						<li>Interior Fit-Out Services</li>
						<li>Architectural Design &amp; Planning</li>
						<li>Civil &amp; Structural Works</li>
						<li>Plumbing &amp; Electrical Installation</li>
						<li>Roofing &amp; Waterproofing</li>
						<li>Landscaping &amp; Exterior Development</li>
						<li>Project Management &amp; Consultation</li>
						<li>Building Maintenance Services</li>
						<li>Turnkey Construction Solutions</li>
					</ul>
				</div>
			</div>

			<div class="faq__item" data-faq-item>
				<h3 class="faq__question">
					<button
						class="faq__toggle"
						type="button"
						aria-expanded="false"
						aria-controls="faq-panel-3">
						<span class="faq__question-text">Do you handle project permits?</span>
						<span class="faq__icon" aria-hidden="true">
							<?php echo appian_accordion_toggle_icon(); ?>
						</span>
					</button>
				</h3>
				<div class="faq__panel" id="faq-panel-3" role="region" hidden>
					<p>
						We provide complete construction solutions for residential, commercial, and industrial projects. Our team manages every stage of the construction process, from initial planning and architectural design to final execution and finishing. Whether you are building a new property, renovating an existing space, or developing a large-scale infrastructure project, we focus on delivering high-quality workmanship, efficient project management, and long-lasting results.
					</p>
					<p>
						Our services are designed to meet the needs of homeowners, businesses, and property developers. We work closely with clients to understand their vision, budget, and timeline while ensuring every project follows modern construction standards and safety requirements. By combining skilled professionals, quality materials, and innovative building techniques, we create functional and visually impressive spaces.
					</p>
					<p class="faq__list-heading">Our construction services include:</p>
					<ul>
						<li>Residential Construction</li>
						<li>Commercial Building Projects</li>
						<li>Renovation &amp; Remodeling</li>
						<li>Interior Fit-Out Services</li>
						<li>Architectural Design &amp; Planning</li>
						<li>Civil &amp; Structural Works</li>
						<li>Plumbing &amp; Electrical Installation</li>
						<li>Roofing &amp; Waterproofing</li>
						<li>Landscaping &amp; Exterior Development</li>
						<li>Project Management &amp; Consultation</li>
						<li>Building Maintenance Services</li>
						<li>Turnkey Construction Solutions</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
