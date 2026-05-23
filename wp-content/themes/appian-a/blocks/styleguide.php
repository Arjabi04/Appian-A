<?php

/**
 * Style Guide Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inline content.
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

/**
 * Render a dark code-snippet block with a copy button.
 */
if (! function_exists('sg_code_block')) :
    function sg_code_block($code)
    {
        $escaped = htmlspecialchars(trim($code), ENT_QUOTES, 'UTF-8');
        echo '<div class="m-styleguide__demo-code">';
        echo '<button type="button" class="m-styleguide__copy-btn" data-copy-code>Copy</button>';
        echo '<pre><code>' . $escaped . '</code></pre>';
        echo '</div>';
    }
endif;

$id = 'styleguide-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}

$classes = 'm-styleguide';
if (! empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}


// Brand colors — hex values are populated at runtime from CSS custom properties.
$brand_colors = [
    ['name' => 'Primary Red',     'var' => '$primary-red',     'slug' => 'primary-red'],
    ['name' => 'Dark Red',        'var' => '$dark-red',        'slug' => 'dark-red'],
    ['name' => 'Darkest Red',     'var' => '$darkest-red',     'slug' => 'darkest-red'],
    ['name' => 'Light Red',       'var' => '$light-red',       'slug' => 'light-red'],
    ['name' => 'Ultra Light Red', 'var' => '$ultra-light-red', 'slug' => 'ultra-light-red'],
];

$secondary_colors = [
    ['name' => 'Secondary',       'var' => '$secondary-dark',  'slug' => 'secondary-dark'],
    ['name' => 'Dark',            'var' => '$dark',            'slug' => 'dark'],
    ['name' => 'Light',           'var' => '$light',           'slug' => 'light'],
    ['name' => 'Ultra Light',     'var' => '$ultra-light',     'slug' => 'ultra-light'],
];

$neutral_colors = [
    ['name' => 'Neutral 600',  'var' => '$neutral-600',  'slug' => 'neutral-600'],
    ['name' => 'Neutral 500',  'var' => '$neutral-500',  'slug' => 'neutral-500'],
    ['name' => 'Neutral 400',  'var' => '$neutral-400',  'slug' => 'neutral-400'],
    ['name' => 'Neutral 300',  'var' => '$neutral-300',  'slug' => 'neutral-300'],
    ['name' => 'Neutral 200',  'var' => '$neutral-200',  'slug' => 'neutral-200'],
    ['name' => 'Neutral 100',  'var' => '$neutral-100',  'slug' => 'neutral-100'],
    ['name' => 'Neutral 75',   'var' => '$neutral-75',   'slug' => 'neutral-75'],
    ['name' => 'White',        'var' => '$white',         'slug' => 'white'],
];

$overlay_colors = [
    ['name' => 'Overlay 68%',  'var' => 'var(--overlay-68)', 'slug' => 'overlay-68'],
    ['name' => 'Overlay 50%',  'var' => 'var(--overlay-50)', 'slug' => 'overlay-50'],
    ['name' => 'Overlay 30%',  'var' => 'var(--overlay-30)', 'slug' => 'overlay-30'],
    ['name' => 'Overlay 20%',  'var' => 'var(--overlay-20)', 'slug' => 'overlay-20'],
];

// Typography definitions: [class, label]
// Specs (font, sizes, weights, line-heights) are defined in _type.scss and exposed
// as CSS custom properties (--typo-{class}-*). The styleguide JS reads them at runtime.
$typography_display = [
    ['d1', 'Display 1'],
    ['d2', 'Display 2'],
];

$typography_headings = [
    ['h1', 'Heading 1'],
    ['h2', 'Heading 2'],
    ['h3', 'Heading 3'],
    ['h4', 'Heading 4'],
    ['h5', 'Heading 5'],
    ['h6', 'Heading 6'],
];

$typography_subheadings = [
    ['sh0', 'Subheading 0'],
    ['sh1', 'Subheading 1'],
    ['sh2', 'Subheading 2'],
    ['sh3', 'Subheading 3'],
];

$typography_body = [
    ['body-xlarge', 'Body XL'],
    ['body-large',  'Body Large'],
    ['body',        'Body'],
    ['body-small',  'Body Small'],
    ['body-xsmall', 'Body XS'],
];

$typography_caption = [
    ['c1', 'Caption 1'],
    ['c2', 'Caption 2'],
    ['c3', 'Caption 3'],
];

// Load centralized SVG icon registry.
require_once get_template_directory() . '/inc/svg-icons.php';
$icons = appian_get_svg_icons();


?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">

    <!-- Main Content Area -->
    <main class="m-styleguide__main">

        <!-- Header -->
        <header class="m-styleguide__header">
            <h1 class="m-styleguide__title">Appian Design System</h1>
            <p class="m-styleguide__subtitle">Living style guide &amp; design token reference</p>
        </header>

        <!-- ============================================
             1. COLORS
             ============================================ -->
        <section id="sg-colors" class="m-styleguide__section">
            <div class="m-styleguide__section-header">
                <h2 class="m-styleguide__section-heading">Colors</h2>
                <p class="m-styleguide__section-desc">Brand and neutral palette. Click any swatch to copy its hex code.</p>
            </div>

            <h3 class="m-styleguide__subsection-title">Primary</h3>
            <div class="m-styleguide__color-grid">
                <?php foreach ($brand_colors as $color) : ?>
                    <div class="m-styleguide__swatch" data-css-var="--<?php echo esc_attr($color['slug']); ?>">
                        <div class="m-styleguide__swatch-preview bg-<?php echo esc_attr($color['slug']); ?>"></div>
                        <div class="m-styleguide__swatch-info">
                            <span class="m-styleguide__swatch-name"><?php echo esc_html($color['name']); ?></span>
                            <code class="m-styleguide__swatch-hex" data-hex></code>
                            <code class="m-styleguide__swatch-var">var(--<?php echo esc_html($color['slug']); ?>)</code>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">Secondary</h3>
            <div class="m-styleguide__color-grid">
                <?php foreach ($secondary_colors as $color) : ?>
                    <div class="m-styleguide__swatch" data-css-var="--<?php echo esc_attr($color['slug']); ?>">
                        <div class="m-styleguide__swatch-preview bg-<?php echo esc_attr($color['slug']); ?>"></div>
                        <div class="m-styleguide__swatch-info">
                            <span class="m-styleguide__swatch-name"><?php echo esc_html($color['name']); ?></span>
                            <code class="m-styleguide__swatch-hex" data-hex></code>
                            <code class="m-styleguide__swatch-var">var(--<?php echo esc_html($color['slug']); ?>)</code>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">Neutrals</h3>
            <div class="m-styleguide__color-grid">
                <?php foreach ($neutral_colors as $color) : ?>
                    <div class="m-styleguide__swatch" data-css-var="--<?php echo esc_attr($color['slug']); ?>" <?php echo $color['slug'] === 'white' ? ' data-color="#ffffff"' : ''; ?>>
                        <div class="m-styleguide__swatch-preview bg-<?php echo esc_attr($color['slug']); ?><?php echo in_array($color['name'], ['White', 'Neutral 75', 'Neutral 100']) ? ' m-styleguide__swatch-preview--light' : ''; ?>"></div>
                        <div class="m-styleguide__swatch-info">
                            <span class="m-styleguide__swatch-name"><?php echo esc_html($color['name']); ?></span>
                            <code class="m-styleguide__swatch-hex" data-hex><?php echo $color['slug'] === 'white' ? '#ffffff' : ''; ?></code>
                            <code class="m-styleguide__swatch-var"><?php echo $color['slug'] === 'white' ? '$white' : 'var(--' . esc_html($color['slug']) . ')'; ?></code>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">Overlays</h3>
            <div class="m-styleguide__color-grid">
                <?php foreach ($overlay_colors as $color) : ?>
                    <div class="m-styleguide__swatch" data-css-var="--<?php echo esc_attr($color['slug']); ?>">
                        <div class="m-styleguide__swatch-preview bg-<?php echo esc_attr($color['slug']); ?>"></div>
                        <div class="m-styleguide__swatch-info">
                            <span class="m-styleguide__swatch-name"><?php echo esc_html($color['name']); ?></span>
                            <code class="m-styleguide__swatch-var">var(--<?php echo esc_html($color['slug']); ?>)</code>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php sg_code_block(
                '<!-- Background color utility -->
<div class="bg-primary-red">...</div>

<!-- Text color utility -->
<span class="text-primary-red">...</span>

<!-- CSS custom property -->
color: var(--primary-red);
background-color: var(--dark-red);'
            ); ?>
        </section>

        <!-- ============================================
             2. TYPOGRAPHY
             ============================================ -->
        <section id="sg-typography" class="m-styleguide__section">
            <div class="m-styleguide__section-header">
                <h2 class="m-styleguide__section-heading">Typography</h2>
                <p class="m-styleguide__section-desc">Headings &amp; display use <strong>Reckless Neue</strong> (serif). Body &amp; UI use <strong>General Sans</strong> (sans-serif). Toggle between desktop and mobile previews.</p>
            </div>

            <div class="m-styleguide__typo-controls">
                <button type="button" class="m-styleguide__typo-toggle active" data-view="desktop">Desktop</button>
                <button type="button" class="m-styleguide__typo-toggle" data-view="mobile">Mobile</button>
            </div>

            <?php
            $typo_groups = [
                'Display'     => $typography_display,
                'Headings'    => $typography_headings,
                'Subheadings' => $typography_subheadings,
                'Body'        => $typography_body,
                'Captions'    => $typography_caption,
            ];
            ?>
            <?php foreach ($typo_groups as $group_label => $group_items) : ?>
                <h3 class="m-styleguide__subsection-title"><?php echo esc_html($group_label); ?></h3>
                <div class="m-styleguide__typo-list">
                    <?php foreach ($group_items as $type) : ?>
                        <div class="m-styleguide__typo-row" data-typo-class="<?php echo esc_attr($type[0]); ?>">
                            <div class="m-styleguide__typo-meta">
                                <code class="m-styleguide__typo-tag"><?php echo esc_html($type[1]); ?></code>
                                <div class="m-styleguide__typo-specs">
                                    <span>Font: <span data-typo-font></span></span>
                                    <span>Weight: <span data-typo-weight></span></span>
                                    <span class="m-styleguide__typo-spec-desktop">Desktop: <span data-typo-desktop></span></span>
                                    <span class="m-styleguide__typo-spec-mobile">Mobile: <span data-typo-mobile></span></span>
                                </div>
                            </div>
                            <div class="m-styleguide__typo-preview">
                                <div class="m-styleguide__typo-sample <?php echo esc_attr($type[0]); ?>">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </section>

        <!-- ============================================
             3. BUTTONS
             ============================================ -->
        <section id="sg-buttons" class="m-styleguide__section">
            <div class="m-styleguide__section-header">
                <h2 class="m-styleguide__section-heading">Buttons</h2>
                <p class="m-styleguide__section-desc">Button variants using centralized <code>.btn</code> classes from <code>_buttons.scss</code>.</p>
            </div>

            <?php
            // Arrow SVG used across buttons
            $arrow_right = appian_get_svg_icon('arrow-right');

            // Tertiary button underline (the "line" that sits beneath tertiary buttons)
            $tertiary_line = '<span class="m-styleguide__btn-line">' . appian_get_svg_icon('tertiary-underline') . '</span>';
            ?>

            <?php
            // Button types: [label, classes, has_arrow, is_tertiary]
            $button_types = [
                ['Primary',               'btn btn-primary',          true,  false],
                ['Primary Small',         'btn btn-primary btn--small', true, false],
                ['Secondary',             'btn btn-outline',          true,  false],
                ['Secondary (no arrow)',  'btn btn-outline',          false, false],
                ['Tertiary',              'btn btn-link',             true,  true],
            ];
            ?>

            <div class="m-styleguide__btn-list">
                <?php foreach ($button_types as $btn_type) :
                    $label     = $btn_type[0];
                    $classes   = $btn_type[1];
                    $has_arrow = $btn_type[2];
                    $is_tert   = $btn_type[3];
                    $arrow_html = $has_arrow ? ' ' . $arrow_right : '';

                    // States to render: [state-label, extra-preview-classes]
                    $states = [
                        ['Default',  ''],
                        ['Hover',    ' m-styleguide__btn--hover'],
                        ['Disabled', ' m-styleguide__btn--disabled'],
                    ];

                    // Code snippet — use appian_get_svg_icon for the arrow
                    $arrow_php = "<?php echo appian_get_svg_icon( 'arrow-right' ); ?>";
                    $code_snippet = '<a href="#" class="' . $classes . '">' . 'Label' . ($has_arrow ? ' ' . $arrow_php : '') . '</a>';
                ?>
                    <div class="m-styleguide__btn-group-row">
                        <div class="m-styleguide__btn-info">
                            <span class="m-styleguide__btn-label"><?php echo esc_html($label); ?></span>
                            <?php sg_code_block($code_snippet); ?>
                        </div>
                        <div class="m-styleguide__btn-previews">
                            <?php foreach ($states as $state) :
                                $state_label     = $state[0];
                                $state_preview   = $state[1];
                                $btn_text        = $state_label === 'Disabled' ? 'Disabled' : $state_label;
                            ?>
                                <div class="m-styleguide__btn-preview-item">
                                    <span class="m-styleguide__btn-state-label"><?php echo esc_html($state_label); ?></span>
                                    <div class="m-styleguide__btn-preview-wrap">
                                        <?php if ($is_tert) : ?>
                                            <span class="m-styleguide__btn-wrap<?php echo esc_attr($state_preview); ?>">
                                                <a href="#" class="<?php echo esc_attr($classes . $state_preview); ?>" onclick="return false;" <?php echo $state_label === 'Disabled' ? ' tabindex="-1"' : ''; ?>><?php echo $btn_text . $arrow_html; ?></a>
                                                <?php echo $tertiary_line; ?>
                                            </span>
                                        <?php else : ?>
                                            <a href="#" class="<?php echo esc_attr($classes . $state_preview); ?>" onclick="return false;" <?php echo $state_label === 'Disabled' ? ' tabindex="-1"' : ''; ?>><?php echo $btn_text . $arrow_html; ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>





        <!-- ============================================
             9. ICONS
             ============================================ -->
        <section id="sg-icons" class="m-styleguide__section">
            <div class="m-styleguide__section-header">
                <h2 class="m-styleguide__section-heading">Icons</h2>
                <p class="m-styleguide__section-desc">Inline SVG icons from the design system. Click any icon card to copy its PHP reference snippet.</p>
            </div>

            <?php
            $sg_icon_names = [
                'arrow-down',
                'arrow-left',
                'arrow-right',
                'close',
                'linkedin',
                'menu',
                'play',
                'pause',
                'quote',
                'call',
            ];
            ?>

            <div class="m-styleguide__icon-grid">
                <?php foreach ($sg_icon_names as $name) : ?>
                    <div class="m-styleguide__icon-card" data-icon-class="<?php echo esc_attr($name); ?>">
                        <div class="m-styleguide__icon-svg"><?php echo $icons[$name]; ?></div>
                        <span class="m-styleguide__icon-name"><?php echo esc_html($name); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


        <!-- ============================================
             10. COMPONENTS
             ============================================ -->
        <!-- ============================================
             10a. FORMS
             ============================================ -->
        <section id="sg-forms" class="m-styleguide__section">
            <div class="m-styleguide__section-header">
                <h2 class="m-styleguide__section-heading">Forms</h2>
                <p class="m-styleguide__section-desc">Contact Form layout and input fields from the design system.</p>
            </div>

            <div class="m-styleguide__form-demo">
                <div class="m-styleguide__form-wrapper">
                    <form class="m-styleguide__form-el" novalidate>
                        <!-- Name row (First & Last) -->
                        <div class="m-styleguide__form-row m-styleguide__form-row--inline">
                            <div class="m-styleguide__form-col">
                                <div class="m-styleguide__input-group">
                                    <input type="text" class="m-styleguide__input" placeholder="First Name *" required>
                                </div>
                                <span class="m-styleguide__input-error">Please fill out this field.</span>
                            </div>
                            <div class="m-styleguide__form-col">
                                <div class="m-styleguide__input-group">
                                    <input type="text" class="m-styleguide__input" placeholder="Last Name *" required>
                                </div>
                                <span class="m-styleguide__input-error">Please fill out this field.</span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="m-styleguide__form-row">
                            <div class="m-styleguide__input-group">
                                <input type="email" class="m-styleguide__input" placeholder="Email *" required>
                            </div>
                            <span class="m-styleguide__input-error">Please fill out this field.</span>
                        </div>

                        <!-- Phone -->
                        <div class="m-styleguide__form-row">
                            <div class="m-styleguide__input-group">
                                <input type="tel" class="m-styleguide__input" placeholder="Phone Number *" required>
                            </div>
                            <span class="m-styleguide__input-error">Please fill out this field.</span>
                        </div>

                        <!-- Move-in Date -->
                        <div class="m-styleguide__form-row">
                            <div class="m-styleguide__input-group">
                                <input type="text" class="m-styleguide__input" placeholder="Move-In Date *" required>
                            </div>
                            <span class="m-styleguide__input-error">Please fill out this field.</span>
                        </div>

                        <!-- Unit Type -->
                        <div class="m-styleguide__form-row">
                            <div class="m-styleguide__input-group m-styleguide__input-group--select">
                                <select class="m-styleguide__select" required>
                                    <option value="">Unit Type *</option>
                                    <option value="studio">Studio</option>
                                    <option value="1bed">1 Bedroom</option>
                                    <option value="2bed">2 Bedroom</option>
                                </select>
                                <span class="m-styleguide__select-arrow">
                                    <?php echo appian_get_svg_icon('arrow-down'); ?>
                                </span>
                            </div>
                            <span class="m-styleguide__input-error">Please select a unit type.</span>
                        </div>

                        <!-- Radio buttons list -->
                        <div class="m-styleguide__form-row">
                            <div class="m-styleguide__radio-list">
                                <label class="m-styleguide__radio-option">
                                    <input type="radio" name="sg_unit_type" value="studio" class="m-styleguide__radio">
                                    <span class="m-styleguide__radio-label">Studio</span>
                                </label>
                                <label class="m-styleguide__radio-option">
                                    <input type="radio" name="sg_unit_type" value="1bed" class="m-styleguide__radio" checked>
                                    <span class="m-styleguide__radio-label">1 Bedroom</span>
                                </label>
                                <label class="m-styleguide__radio-option">
                                    <input type="radio" name="sg_unit_type" value="2bed" class="m-styleguide__radio">
                                    <span class="m-styleguide__radio-label">2 Bedroom</span>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="m-styleguide__form-row">
                            <button type="submit" class="btn btn-primary m-styleguide__form-submit">
                                <span>Submit</span>
                                <?php echo appian_get_svg_icon('arrow-right'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php sg_code_block(
                <<<'HTML'
<div class="contact-form">
    <form class="contact-form__el">
        <div class="contact-form__row contact-form__row--inline">
            <div class="contact-form__col">
                <input type="text" class="contact-form__input" placeholder="First Name *" required>
            </div>
            <div class="contact-form__col">
                <input type="text" class="contact-form__input" placeholder="Last Name *" required>
            </div>
        </div>
        <div class="contact-form__row">
            <input type="email" class="contact-form__input" placeholder="Email *" required>
        </div>
        <div class="contact-form__row">
            <input type="tel" class="contact-form__input" placeholder="Phone Number *" required>
        </div>
        <div class="contact-form__row">
            <input type="text" class="contact-form__input contact-form__input--error" placeholder="Move-In Date *" required>
            <span class="contact-form__input-error">Please fill out this field.</span>
        </div>
        <div class="contact-form__row">
            <div class="contact-form__select-wrapper">
                <select class="contact-form__select">
                    <option>Unit Type *</option>
                </select>
                <span class="contact-form__select-arrow">
                    <?php echo appian_get_svg_icon('arrow-down'); ?>
                </span>
            </div>
        </div>
        <div class="contact-form__row">
            <div class="contact-form__radio-list">
                <label class="contact-form__radio-option">
                    <input type="radio" name="unit_type" value="studio" class="contact-form__radio">
                    <span class="contact-form__radio-label">Studio</span>
                </label>
                <label class="contact-form__radio-option">
                    <input type="radio" name="unit_type" value="1bed" class="contact-form__radio" checked>
                    <span class="contact-form__radio-label">1 Bedroom</span>
                </label>
                <label class="contact-form__radio-option">
                    <input type="radio" name="unit_type" value="2bed" class="contact-form__radio">
                    <span class="contact-form__radio-label">2 Bedroom</span>
                </label>
            </div>
        </div>
        <div class="contact-form__row">
            <button type="submit" class="btn btn-primary">
                <span>Submit</span>
                <?php echo appian_get_svg_icon('arrow-right'); ?>
            </button>
        </div>
    </form>
</div>
HTML
            ); ?>
        </section>
        <!-- ============================================
             11. LAYOUT / GRID
             ============================================ -->
        <section id="sg-layout-grid" class="m-styleguide__section">
            <div class="m-styleguide__section-header">
                <h2 class="m-styleguide__section-heading">Layout / Grid</h2>
                <p class="m-styleguide__section-desc">12-column grid system. Container max-width: 1440px. Gutter: 2rem.</p>
            </div>

            <h3 class="m-styleguide__subsection-title">12-Column Grid</h3>
            <div class="row g-2 mb-4">
                <?php for ($i = 1; $i <= 12; $i++) : ?>
                    <div class="col-1">
                        <div class="m-styleguide__grid-col-inner"><?php echo $i; ?></div>
                    </div>
                <?php endfor; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">4-Column Grid (Mobile)</h3>
            <div class="row g-2 mb-4">
                <?php for ($i = 1; $i <= 4; $i++) : ?>
                    <div class="col-3">
                        <div class="m-styleguide__grid-col-inner"><?php echo $i; ?></div>
                    </div>
                <?php endfor; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">Grid Settings</h3>
            <div class="m-styleguide__breakpoint-table">
                <table class="m-styleguide__table">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>columns</th>
                            <th>margin</th>
                            <th>gutter</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Mobile</strong><br><span class="body-xsmall text-muted">&lt;575px</span></td>
                            <td>4</td>
                            <td>28</td>
                            <td>24</td>
                        </tr>
                        <tr>
                            <td><strong>Desktop</strong><br><span class="body-xsmall text-muted">1200 - 1400</span></td>
                            <td>12</td>
                            <td>80</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td><strong>Desktop Wide</strong><br><span class="body-xsmall text-muted">1440&gt;</span></td>
                            <td>12</td>
                            <td>Auto</td>
                            <td>40</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ============================================
             LOGO & FAVICON
             ============================================ -->
        <section id="sg-logo" class="m-styleguide__section">
            <div class="m-styleguide__section-header">
                <h2 class="m-styleguide__section-heading">Logo &amp; Favicon</h2>
                <p class="m-styleguide__section-desc">Brand mark assets from the Figma design system.</p>
            </div>

            <h3 class="m-styleguide__subsection-title">Logo</h3>
            <div class="m-styleguide__demo-block">
                <div class="m-styleguide__demo-preview p-4 bg-white">
                    <?php echo appian_get_svg_icon('logo'); ?>
                </div>
                <div class="m-styleguide__demo-preview p-4 bg-neutral-500">
                    <?php echo appian_get_svg_icon('logo'); ?>
                </div>
            </div>

            <h3 class="m-styleguide__subsection-title">Favicon</h3>
            <div class="m-styleguide__demo-block">
                <div class="m-styleguide__demo-preview p-4 gap-4">
                    <div class="m-styleguide__favicon-preview-wrap" style="width: 48px; height: 48px; display: inline-flex; align-items: center; justify-content: center;">
                        <?php echo appian_get_svg_icon('favicon'); ?>
                    </div>
                    <div class="m-styleguide__favicon-preview-wrap" style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
                        <?php echo appian_get_svg_icon('favicon'); ?>
                    </div>
                </div>
            </div>
        </section>



    </main>

    <!-- Toast Notification -->
    <div class="m-styleguide__toast">Copied!</div>
</div>