<?php

/**
 * Style Guide Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inline content.
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

if (! function_exists('sg_code_block')) :
    function sg_code_block($code)
    {
        $escaped = htmlspecialchars(trim($code), ENT_QUOTES, 'UTF-8');
        echo '<div class="m-styleguide__example-block">';
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

// Brand colors
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

// Typography definitions
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
    ['body-sm-all',  'Body Sm All'],
    ['body-xsmall', 'Body XS'],
];

$typography_caption = [
    ['c1', 'Caption 1'],
    ['c2', 'Caption 2'],
    ['c3', 'Caption 3'],
];

$typography_buttons_links = [
    ['btn-text-lg', 'Button Text Lg'],
    ['nav-text',    'Nav Text'],
];

require_once get_template_directory() . '/inc/svg-icons.php';
$icons = appian_get_svg_icons();

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">

    <main class="m-styleguide__main">

        <header class="m-styleguide__header">
            <h1 class="m-styleguide__title">Appian Design System</h1>
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
                    <div class="m-styleguide__color-item" data-css-var="--<?php echo esc_attr($color['slug']); ?>">
                        <div class="m-styleguide__color-preview bg-<?php echo esc_attr($color['slug']); ?>"></div>
                        <div class="m-styleguide__color-info">
                            <span class="m-styleguide__color-name"><?php echo esc_html($color['name']); ?></span>
                            <code class="m-styleguide__color-hex" data-hex></code>
                            <code class="m-styleguide__color-variable">var(--<?php echo esc_attr($color['slug']); ?>)</code>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">Secondary</h3>
            <div class="m-styleguide__color-grid">
                <?php foreach ($secondary_colors as $color) : ?>
                    <div class="m-styleguide__color-item" data-css-var="--<?php echo esc_attr($color['slug']); ?>">
                        <div class="m-styleguide__color-preview bg-<?php echo esc_attr($color['slug']); ?>"></div>
                        <div class="m-styleguide__color-info">
                            <span class="m-styleguide__color-name"><?php echo esc_html($color['name']); ?></span>
                            <code class="m-styleguide__color-hex" data-hex></code>
                            <code class="m-styleguide__color-variable">var(--<?php echo esc_html($color['slug']); ?>)</code>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">Neutrals</h3>
            <div class="m-styleguide__color-grid">
                <?php foreach ($neutral_colors as $color) : ?>
                    <div class="m-styleguide__color-item" data-css-var="--<?php echo esc_attr($color['slug']); ?>" <?php echo $color['slug'] === 'white' ? ' data-color="#ffffff"' : ''; ?>>
                        <div class="m-styleguide__color-preview bg-<?php echo esc_attr($color['slug']); ?><?php echo in_array($color['name'], ['White', 'Neutral 75', 'Neutral 100']) ? ' m-styleguide__color-preview--light' : ''; ?>"></div>
                        <div class="m-styleguide__color-info">
                            <span class="m-styleguide__color-name"><?php echo esc_html($color['name']); ?></span>
                            <code class="m-styleguide__color-hex" data-hex><?php echo $color['slug'] === 'white' ? '#ffffff' : ''; ?></code>
                            <code class="m-styleguide__color-variable"><?php echo $color['slug'] === 'white' ? '$white' : 'var(--' . esc_html($color['slug']) . ')'; ?></code>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">Overlays</h3>
            <div class="m-styleguide__color-grid">
                <?php foreach ($overlay_colors as $color) : ?>
                    <div class="m-styleguide__color-item" data-css-var="--<?php echo esc_attr($color['slug']); ?>">
                        <div class="m-styleguide__color-preview bg-<?php echo esc_attr($color['slug']); ?>"></div>
                        <div class="m-styleguide__color-info">
                            <span class="m-styleguide__color-name"><?php echo esc_html($color['name']); ?></span>
                            <code class="m-styleguide__color-variable">var(--<?php echo esc_html($color['slug']); ?>)</code>
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

        <hr class="m-styleguide__divider">

        <!-- ============================================
             2. TYPOGRAPHY
             ============================================ -->
        <section id="sg-typography" class="m-styleguide__section">
            <div class="m-styleguide__section-header">
                <h2 class="m-styleguide__section-heading">Typography</h2>
                <p class="m-styleguide__section-desc">Headings &amp; display use <strong>Reckless Neue</strong> (serif). Body &amp; UI use <strong>General Sans</strong> (sans-serif). Toggle between desktop and mobile previews.</p>
            </div>

            <div class="m-styleguide__typo-buttons">
                <button type="button" class="m-styleguide__typo-button is-active" data-view="desktop">Desktop</button>
                <button type="button" class="m-styleguide__typo-button" data-view="mobile">Mobile</button>
            </div>

            <?php
            $typo_groups = [
                'Display'        => $typography_display,
                'Headings'       => $typography_headings,
                'Subheadings'    => $typography_subheadings,
                'Body'           => $typography_body,
                'Captions'       => $typography_caption,
                'Button / Link'  => $typography_buttons_links,
            ];
            ?>
            <?php foreach ($typo_groups as $group_label => $group_items) : ?>
                <h3 class="m-styleguide__subsection-title"><?php echo esc_html($group_label); ?></h3>
                <div class="m-styleguide__typo-list">
                    <?php foreach ($group_items as $type) : ?>
                        <div class="m-styleguide__typo-item" data-typo-class="<?php echo esc_attr($type[0]); ?>">
                            <div class="m-styleguide__typo-details">
                                <code class="m-styleguide__typo-class"><?php echo esc_html($type[1]); ?></code>
                                <div class="m-styleguide__typo-info">
                                    <span>Font: <span data-typo-font></span></span>
                                    <span>Weight: <span data-typo-weight></span></span>
                                    <span>Desktop: <span data-typo-desktop></span></span>
                                    <span>Mobile: <span data-typo-mobile></span></span>
                                </div>
                            </div>
                            <div class="m-styleguide__typo-preview">
                                <div class="m-styleguide__typo-text <?php echo esc_attr($type[0]); ?>">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </section>

        <hr class="m-styleguide__divider">

        <!-- ============================================
             3. BUTTONS
             ============================================ -->
        <section id="sg-buttons" class="m-styleguide__section">
            <div class="m-styleguide__section-header">
                <h2 class="m-styleguide__section-heading">Buttons</h2>
                <p class="m-styleguide__section-desc">Button variants using centralized <code>.btn</code> classes from <code>_buttons.scss</code>.</p>
            </div>

            <?php
            $arrow_right = appian_get_svg_icon('arrow-right');
            $tertiary_line = '<span class="m-styleguide__button-underline">' . appian_get_svg_icon('tertiary-underline') . '</span>';

            $button_types = [
                ['Primary',                    'btn btn-primary',            true,  false, false],
                ['Primary Small',              'btn btn-primary btn--small', true,  false, false],
                ['Secondary',                  'btn btn-outline',            true,  false, false],
                ['Secondary Small',            'btn btn-outline btn--small', true,  false, false],
                ['Secondary (no arrow)',       'btn btn-outline',            false, false, true],
                ['Secondary Small (no arrow)', 'btn btn-outline btn--small', false, false, true],
                ['Tertiary',                   'btn btn-link',               true,  true,  false],
                ['Tertiary Small',             'btn btn-link btn--small',    true,  true,  false],
            ];
            ?>

            <div class="m-styleguide__button-list">
                <?php foreach ($button_types as $btn_type) :
                    $label            = $btn_type[0];
                    $classes          = $btn_type[1];
                    $has_arrow        = $btn_type[2];
                    $is_tert          = $btn_type[3];
                    $exclude_disabled = isset($btn_type[4]) ? $btn_type[4] : false;
                    $arrow_html       = $has_arrow ? ' ' . $arrow_right : '';

                    $states = [
                        ['Default',  ''],
                        ['Hover',    ' is-hover'],
                    ];
                    if (!$exclude_disabled) {
                        $states[] = ['Disabled', ' is-disabled'];
                    }

                    $arrow_php = "<?php echo appian_get_svg_icon( 'arrow-right' ); ?>";
                    $code_snippet = '<a href="#" class="' . $classes . '">' . ($is_tert ? 'Link' : 'Label') . ($has_arrow ? ' ' . $arrow_php : '') . '</a>';
                ?>
                    <div class="m-styleguide__button-row">
                        <div class="m-styleguide__button-info">
                            <span class="m-styleguide__button-name"><?php echo esc_html($label); ?></span>
                            <?php sg_code_block($code_snippet); ?>
                        </div>
                        <div class="m-styleguide__button-previews">
                            <?php foreach ($states as $state) :
                                $state_label     = $state[0];
                                $state_preview   = $state[1];
                                $btn_text        = $is_tert ? 'Link' : ($state_label === 'Disabled' ? 'Disabled' : $state_label);
                            ?>
                                <div class="m-styleguide__button-preview-item">
                                    <span class="m-styleguide__button-state-text"><?php echo esc_html($state_label); ?></span>
                                    <div class="m-styleguide__button-preview-wrapper">
                                        <?php if ($is_tert) : ?>
                                            <span class="m-styleguide__button-wrapper<?php echo esc_attr($state_preview); ?>">
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

        <hr class="m-styleguide__divider">

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

            <div class="m-styleguide__icon-list">
                <?php foreach ($sg_icon_names as $name) : ?>
                    <div class="m-styleguide__icon-item" data-icon-class="<?php echo esc_attr($name); ?>">
                        <div class="m-styleguide__icon-image"><?php echo $icons[$name]; ?></div>
                        <span class="m-styleguide__icon-title"><?php echo esc_html($name); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <hr class="m-styleguide__divider">

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

            <div class="m-styleguide__form-example">
                <div class="m-styleguide__form-container">
                    <form class="m-styleguide__form" novalidate>
                        <!-- Name row (First & Last) -->
                        <div class="m-styleguide__form-row m-styleguide__form-row--inline">
                            <div class="m-styleguide__form-column">
                                <div class="m-styleguide__form-group">
                                    <input type="text" class="m-styleguide__form-input" placeholder="First Name *" required>
                                </div>
                                <span class="m-styleguide__form-error">Please fill out this field.</span>
                            </div>
                            <div class="m-styleguide__form-column">
                                <div class="m-styleguide__form-group">
                                    <input type="text" class="m-styleguide__form-input" placeholder="Last Name *" required>
                                </div>
                                <span class="m-styleguide__form-error">Please fill out this field.</span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="m-styleguide__form-row">
                            <div class="m-styleguide__form-group">
                                <input type="email" class="m-styleguide__form-input" placeholder="Email *" required>
                            </div>
                            <span class="m-styleguide__form-error">Please fill out this field.</span>
                        </div>

                        <!-- Phone -->
                        <div class="m-styleguide__form-row">
                            <div class="m-styleguide__form-group">
                                <input type="tel" class="m-styleguide__form-input" placeholder="Phone Number *" required>
                            </div>
                            <span class="m-styleguide__form-error">Please fill out this field.</span>
                        </div>

                        <!-- Move-in Date -->
                        <div class="m-styleguide__form-row">
                            <div class="m-styleguide__form-group">
                                <input type="text" class="m-styleguide__form-input" placeholder="Move-In Date *" required>
                            </div>
                            <span class="m-styleguide__form-error">Please fill out this field.</span>
                        </div>

                        <!-- Unit Type -->
                        <div class="m-styleguide__form-row">
                            <div class="m-styleguide__form-group">
                                <select class="m-styleguide__form-select" required>
                                    <option value="">Unit Type *</option>
                                    <option value="studio">Studio</option>
                                    <option value="1bed">1 Bedroom</option>
                                    <option value="2bed">2 Bedroom</option>
                                </select>
                            </div>
                            <span class="m-styleguide__form-error">Please select a unit type.</span>
                        </div>

                        <!-- Radio buttons list -->
                        <div class="m-styleguide__form-row">
                            <div class="m-styleguide__form-radio-list">
                                <label class="m-styleguide__form-radio-option">
                                    <input type="radio" name="sg_unit_type" value="studio" class="m-styleguide__form-radio">
                                    <span class="m-styleguide__form-radio-label">Studio</span>
                                </label>
                                <label class="m-styleguide__form-radio-option">
                                    <input type="radio" name="sg_unit_type" value="1bed" class="m-styleguide__form-radio" checked>
                                    <span class="m-styleguide__form-radio-label">1 Bedroom</span>
                                </label>
                                <label class="m-styleguide__form-radio-option">
                                    <input type="radio" name="sg_unit_type" value="2bed" class="m-styleguide__form-radio">
                                    <span class="m-styleguide__form-radio-label">2 Bedroom</span>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="m-styleguide__form-row">
                            <button type="submit" class="btn btn-primary m-styleguide__form-button">
                                <span>Submit</span>
                                <?php echo appian_get_svg_icon('arrow-right'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <hr class="m-styleguide__divider">

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
                        <div class="m-styleguide__grid-box"><?php echo $i; ?></div>
                    </div>
                <?php endfor; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">4-Column Grid (Mobile)</h3>
            <div class="row g-2 mb-4">
                <?php for ($i = 1; $i <= 4; $i++) : ?>
                    <div class="col-3">
                        <div class="m-styleguide__grid-box"><?php echo $i; ?></div>
                    </div>
                <?php endfor; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">Grid Settings</h3>
            <div class="m-styleguide__table-container">
                <table class="m-styleguide__styleguide-table">
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

        <hr class="m-styleguide__divider">

        <!-- ============================================
             LOGO & FAVICON
             ============================================ -->
        <section id="sg-logo" class="m-styleguide__section">
            <div class="m-styleguide__section-header">
                <h2 class="m-styleguide__section-heading">Logo &amp; Favicon</h2>
                <p class="m-styleguide__section-desc">Brand mark assets from the Figma design system.</p>
            </div>

            <h3 class="m-styleguide__subsection-title">Logo</h3>
            <div class="m-styleguide__example-block">
                <div class="m-styleguide__example-preview p-4 bg-white">
                    <?php echo appian_get_svg_icon('logo'); ?>
                </div>
                <div class="m-styleguide__example-preview p-4 bg-neutral-500">
                    <?php echo appian_get_svg_icon('logo'); ?>
                </div>
            </div>

            <h3 class="m-styleguide__subsection-title">Favicon</h3>
            <div class="m-styleguide__example-block">
                <div class="m-styleguide__example-preview p-4 gap-4">
                    <div class="m-styleguide__favicon-wrapper" style="width: 48px; height: 48px; display: inline-flex; align-items: center; justify-content: center;">
                        <?php echo appian_get_svg_icon('favicon'); ?>
                    </div>
                    <div class="m-styleguide__favicon-wrapper" style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
                        <?php echo appian_get_svg_icon('favicon'); ?>
                    </div>
                </div>
            </div>
        </section>

    </main>
</div>