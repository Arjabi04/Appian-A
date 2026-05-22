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
if ( ! function_exists( 'sg_code_block' ) ) :
    function sg_code_block( $code ) {
        $escaped = htmlspecialchars( trim( $code ), ENT_QUOTES, 'UTF-8' );
        echo '<div class="m-styleguide__demo-code">';
        echo '<button type="button" class="m-styleguide__copy-btn" data-copy-code>Copy</button>';
        echo '<pre><code>' . $escaped . '</code></pre>';
        echo '</div>';
    }
endif;

$id = 'styleguide-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

$classes = 'm-styleguide';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

// Section definitions for sidebar navigation
$sections = [
    'sg-colors'       => 'Colors',
    'sg-typography'   => 'Typography',
    'sg-buttons'      => 'Buttons',
    'sg-icons'        => 'Icons',
    'sg-components'   => 'Components',
    'sg-forms'        => 'Forms',
    'sg-layout-grid'  => 'Layout / Grid',
    'sg-logo'         => 'Logo &amp; Favicon',
];

// Brand colors with their SCSS variable names and hex values (from Figma "sans")
$brand_colors = [
    ['name' => 'Primary Red',     'var' => '$primary-red',     'hex' => '#d72027', 'slug' => 'primary-red'],
    ['name' => 'Dark Red',        'var' => '$dark-red',        'hex' => '#ad1a1f', 'slug' => 'dark-red'],
    ['name' => 'Darkest Red',     'var' => '$darkest-red',     'hex' => '#811317', 'slug' => 'darkest-red'],
    ['name' => 'Light Red',       'var' => '$light-red',       'hex' => '#f3babc', 'slug' => 'light-red'],
    ['name' => 'Ultra Light Red', 'var' => '$ultra-light-red', 'hex' => '#fbe9e9', 'slug' => 'ultra-light-red'],
];

$secondary_colors = [
    ['name' => 'Secondary',       'var' => '$secondary-dark',  'hex' => '#101922', 'slug' => 'secondary-dark'],
    ['name' => 'Dark',            'var' => '$dark',            'hex' => '#0c131a', 'slug' => 'dark'],
    ['name' => 'Light',           'var' => '$light',           'hex' => '#dbddde', 'slug' => 'light'],
    ['name' => 'Ultra Light',     'var' => '$ultra-light',     'hex' => '#e7e8e9', 'slug' => 'ultra-light'],
];

$neutral_colors = [
    ['name' => 'Neutral 600',  'var' => '$neutral-600',  'hex' => '#111111', 'slug' => 'neutral-600'],
    ['name' => 'Neutral 500',  'var' => '$neutral-500',  'hex' => '#1c1c1c', 'slug' => 'neutral-500'],
    ['name' => 'Neutral 400',  'var' => '$neutral-400',  'hex' => '#292929', 'slug' => 'neutral-400'],
    ['name' => 'Neutral 300',  'var' => '$neutral-300',  'hex' => '#393939', 'slug' => 'neutral-300'],
    ['name' => 'Neutral 200',  'var' => '$neutral-200',  'hex' => '#7c7c7c', 'slug' => 'neutral-200'],
    ['name' => 'Neutral 100',  'var' => '$neutral-100',  'hex' => '#dedede', 'slug' => 'neutral-100'],
    ['name' => 'Neutral 75',   'var' => '$neutral-75',   'hex' => '#e9e9e9', 'slug' => 'neutral-75'],
    ['name' => 'White',        'var' => '$white',         'hex' => '#ffffff', 'slug' => 'white'],
];

$overlay_colors = [
    ['name' => 'Overlay 68%',  'var' => 'rgba(0,0,0,0.68)', 'hex' => 'rgba(0,0,0,0.68)', 'slug' => 'overlay-68'],
    ['name' => 'Overlay 50%',  'var' => 'rgba(0,0,0,0.50)', 'hex' => 'rgba(0,0,0,0.50)', 'slug' => 'overlay-50'],
    ['name' => 'Overlay 30%',  'var' => 'rgba(0,0,0,0.30)', 'hex' => 'rgba(0,0,0,0.30)', 'slug' => 'overlay-30'],
    ['name' => 'Overlay 20%',  'var' => 'rgba(0,0,0,0.20)', 'hex' => 'rgba(0,0,0,0.20)', 'slug' => 'overlay-20'],
];

// Typography definitions: [class, label, font, desktop-size, desktop-lh, mobile-size, mobile-lh, weight]
$typography_display = [
    ['d1', 'Display 1', 'Reckless Neue', '120px', '100%', '48px', '110%', 'Bold'],
    ['d2', 'Display 2', 'Reckless Neue', '88px',  '120%', '40px', '90%',  'Regular'],
];

$typography_headings = [
    ['h1', 'Heading 1', 'Reckless Neue', '64px', '110%', '40px', '120%', 'Bold'],
    ['h2', 'Heading 2', 'Reckless Neue', '48px', '110%', '32px', '140%', 'Bold'],
    ['h3', 'Heading 3', 'Reckless Neue', '40px', '120%', '28px', '140%', 'Bold'],
    ['h4', 'Heading 4', 'Reckless Neue', '32px', '140%', '28px', '140%', 'Bold'],
    ['h5', 'Heading 5', 'Reckless Neue', '28px', '140%', '18px', '160%', 'Medium'],
    ['h6', 'Heading 6', 'Reckless Neue', '24px', '138%', '20px', '140%', 'Medium'],
];

$typography_subheadings = [
    ['sh0', 'Subheading 0', 'Reckless Neue', '28px', '155%', '24px', '138%', 'Book'],
    ['sh1', 'Subheading 1', 'Reckless Neue', '28px', '140%', '24px', '138%', 'Medium'],
    ['sh2', 'Subheading 2', 'Reckless Neue', '20px', '140%', '24px', '138%', 'Medium'],
    ['sh3', 'Subheading 3', 'Reckless Neue', '18px', '110%', '18px', '160%', 'Book'],
];

$typography_body = [
    ['body-xlarge', 'Body XL',    'General Sans', '28px', '150%', '24px', '120%', 'Medium'],
    ['body-large',  'Body Large', 'General Sans', '18px', '140%', '18px', '140%', 'Regular'],
    ['body',        'Body',       'General Sans', '16px', '140%', '16px', '140%', 'Regular'],
    ['body-small',  'Body Small', 'General Sans', '14px', '150%', '14px', '140%', 'Regular'],
    ['body-xsmall', 'Body XS',   'General Sans', '12px', '140%', '12px', '140%', 'Regular'],
];

$typography_caption = [
    ['c1', 'Caption 1', 'General Sans', '14px', '150%', '12px', '150%', 'Medium / Uppercase'],
    ['c2', 'Caption 2', 'General Sans', '14px', '150%', '14px', '150%', 'Medium / Uppercase'],
    ['c3', 'Caption 3', 'General Sans', '12px', '150%', '12px', '150%', 'Medium / Uppercase'],
];

// Load centralized SVG icon registry.
require_once get_template_directory() . '/inc/svg-icons.php';
$icons = appian_get_svg_icons();


?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">

    <!-- Sidebar Navigation -->
    <aside class="m-styleguide__sidebar">
        <div class="m-styleguide__sidebar-inner">
            <span class="m-styleguide__sidebar-title">Design System</span>
            <nav class="m-styleguide__nav">
                <?php foreach ( $sections as $section_id => $section_label ) : ?>
                    <a href="#<?php echo esc_attr( $section_id ); ?>" class="m-styleguide__nav-link">
                        <?php echo esc_html( $section_label ); ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>
    </aside>

    <!-- Mobile Navigation Toggle -->
    <button type="button" class="m-styleguide__mobile-toggle" aria-label="Toggle navigation">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 12H21M3 6H21M3 18H21" stroke="currentColor" stroke-width="2" stroke-miterlimit="5.75877" stroke-linecap="square"/></svg>
    </button>

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
                <?php foreach ( $brand_colors as $color ) : ?>
                    <div class="m-styleguide__swatch" data-color="<?php echo esc_attr( $color['hex'] ); ?>">
                        <div class="m-styleguide__swatch-preview bg-<?php echo esc_attr( $color['slug'] ); ?>"></div>
                        <div class="m-styleguide__swatch-info">
                            <span class="m-styleguide__swatch-name"><?php echo esc_html( $color['name'] ); ?></span>
                            <code class="m-styleguide__swatch-hex"><?php echo esc_html( $color['hex'] ); ?></code>
                            <code class="m-styleguide__swatch-var">var(--<?php echo esc_html( $color['slug'] ); ?>)</code>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">Secondary</h3>
            <div class="m-styleguide__color-grid">
                <?php foreach ( $secondary_colors as $color ) : ?>
                    <div class="m-styleguide__swatch" data-color="<?php echo esc_attr( $color['hex'] ); ?>">
                        <div class="m-styleguide__swatch-preview bg-<?php echo esc_attr( $color['slug'] ); ?>"></div>
                        <div class="m-styleguide__swatch-info">
                            <span class="m-styleguide__swatch-name"><?php echo esc_html( $color['name'] ); ?></span>
                            <code class="m-styleguide__swatch-hex"><?php echo esc_html( $color['hex'] ); ?></code>
                            <code class="m-styleguide__swatch-var">var(--<?php echo esc_html( $color['slug'] ); ?>)</code>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">Neutrals</h3>
            <div class="m-styleguide__color-grid">
                <?php foreach ( $neutral_colors as $color ) : ?>
                    <div class="m-styleguide__swatch" data-color="<?php echo esc_attr( $color['hex'] ); ?>">
                        <div class="m-styleguide__swatch-preview bg-<?php echo esc_attr( $color['slug'] ); ?><?php echo in_array( $color['name'], ['White', 'Neutral 75', 'Neutral 100'] ) ? ' m-styleguide__swatch-preview--light' : ''; ?>"></div>
                        <div class="m-styleguide__swatch-info">
                            <span class="m-styleguide__swatch-name"><?php echo esc_html( $color['name'] ); ?></span>
                            <code class="m-styleguide__swatch-hex"><?php echo esc_html( $color['hex'] ); ?></code>
                            <code class="m-styleguide__swatch-var"><?php echo $color['slug'] === 'white' ? '$white' : 'var(--' . esc_html( $color['slug'] ) . ')'; ?></code>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">Overlays</h3>
            <div class="m-styleguide__color-grid">
                <?php foreach ( $overlay_colors as $color ) : ?>
                    <div class="m-styleguide__swatch" data-color="<?php echo esc_attr( $color['hex'] ); ?>">
                        <div class="m-styleguide__swatch-preview bg-<?php echo esc_attr( $color['slug'] ); ?>"></div>
                        <div class="m-styleguide__swatch-info">
                            <span class="m-styleguide__swatch-name"><?php echo esc_html( $color['name'] ); ?></span>
                            <code class="m-styleguide__swatch-var">var(--<?php echo esc_html( $color['slug'] ); ?>)</code>
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
            <?php foreach ( $typo_groups as $group_label => $group_items ) : ?>
                <h3 class="m-styleguide__subsection-title"><?php echo esc_html( $group_label ); ?></h3>
                <div class="m-styleguide__typo-list">
                    <?php foreach ( $group_items as $type ) :
                        // Determine font-family for inline preview
                        $preview_font = ( $type[2] === 'Reckless Neue' )
                            ? "'Reckless Neue', Georgia, serif"
                            : "'General Sans', sans-serif";

                        // Map weight labels to CSS values
                        $weight_map = [
                            'Bold' => '700',
                            'Medium' => '500',
                            'Book' => '400',
                            'Regular' => '400',
                            'Medium / Uppercase' => '500',
                        ];
                        $css_weight = isset( $weight_map[ $type[7] ] ) ? $weight_map[ $type[7] ] : '400';
                        $is_uppercase = strpos( $type[7], 'Uppercase' ) !== false;
                    ?>
                        <div class="m-styleguide__typo-row">
                            <div class="m-styleguide__typo-meta">
                                <code class="m-styleguide__typo-tag"><?php echo esc_html( $type[1] ); ?></code>
                                <div class="m-styleguide__typo-specs">
                                    <span>Font: <?php echo esc_html( $type[2] ); ?></span>
                                    <span>Weight: <?php echo esc_html( $type[7] ); ?></span>
                                    <span class="m-styleguide__typo-spec-desktop">Desktop: <?php echo esc_html( $type[3] ); ?> / <?php echo esc_html( $type[4] ); ?></span>
                                    <span class="m-styleguide__typo-spec-mobile">Mobile: <?php echo esc_html( $type[5] ); ?> / <?php echo esc_html( $type[6] ); ?></span>
                                </div>
                            </div>
                            <div class="m-styleguide__typo-preview">
                                <div class="m-styleguide__typo-sample <?php echo esc_attr( $type[0] ); ?>">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
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
            $arrow_right = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 12H19M12 19L19 12L12 5" stroke="currentColor" stroke-width="2" stroke-miterlimit="5.75877" stroke-linecap="square"/></svg>';

            // Tertiary button underline (the "line" that sits beneath tertiary buttons)
            $tertiary_line = '<span class="m-styleguide__btn-line"><svg width="100%" height="2" preserveAspectRatio="none" viewBox="0 0 1 2" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 1H1" stroke="currentColor" stroke-width="2"/></svg></span>';
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
                <?php foreach ( $button_types as $btn_type ) :
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

                    // Code snippet — use <i> tag for the arrow, not raw SVG
                    $arrow_i = '<i class="icon-arrow-right"></i>';
                    $code_snippet = '<a href="#" class="' . $classes . '">' . 'Label' . ( $has_arrow ? ' ' . $arrow_i : '' ) . '</a>';
                ?>
                    <div class="m-styleguide__btn-group-row">
                        <div class="m-styleguide__btn-info">
                            <span class="m-styleguide__btn-label"><?php echo esc_html( $label ); ?></span>
                            <?php sg_code_block( $code_snippet ); ?>
                        </div>
                        <div class="m-styleguide__btn-previews">
                            <?php foreach ( $states as $state ) :
                                $state_label     = $state[0];
                                $state_preview   = $state[1];
                                $btn_text        = $state_label === 'Disabled' ? 'Disabled' : $state_label;
                            ?>
                                <div class="m-styleguide__btn-preview-item">
                                    <span class="m-styleguide__btn-state-label"><?php echo esc_html( $state_label ); ?></span>
                                    <div class="m-styleguide__btn-preview-wrap">
                                        <?php if ( $is_tert ) : ?>
                                            <span class="m-styleguide__btn-wrap<?php echo esc_attr( $state_preview ); ?>">
                                                <a href="#" class="<?php echo esc_attr( $classes . $state_preview ); ?>" onclick="return false;"<?php echo $state_label === 'Disabled' ? ' tabindex="-1"' : ''; ?>><?php echo $btn_text . $arrow_html; ?></a>
                                                <?php echo $tertiary_line; ?>
                                            </span>
                                        <?php else : ?>
                                            <a href="#" class="<?php echo esc_attr( $classes . $state_preview ); ?>" onclick="return false;"<?php echo $state_label === 'Disabled' ? ' tabindex="-1"' : ''; ?>><?php echo $btn_text . $arrow_html; ?></a>
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
                <p class="m-styleguide__section-desc">Inline SVG icons from the design system. Click any icon to copy its raw SVG markup. Reference them in PHP using:</p>
                <?php sg_code_block( '<?php echo appian_get_svg_icon( \'icon-name\' ); ?>' ); ?>
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
                <?php foreach ( $sg_icon_names as $name ) : ?>
                    <div class="m-styleguide__icon-card" data-icon-class="<?php echo esc_attr( $name ); ?>">
                        <div class="m-styleguide__icon-svg"><?php echo $icons[ $name ]; ?></div>
                        <span class="m-styleguide__icon-name"><?php echo esc_html( $name ); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


        <!-- ============================================
             10. COMPONENTS
             ============================================ -->
        <section id="sg-components" class="m-styleguide__section">
            <div class="m-styleguide__section-header">
                <h2 class="m-styleguide__section-heading">Components</h2>
                <p class="m-styleguide__section-desc">Reusable component patterns.</p>
            </div>

            <!-- Accordion (Bootstrap 5) -->
            <h3 class="m-styleguide__subsection-title">Accordion</h3>
            <div class="m-styleguide__component-demo m-styleguide__component-demo--accordion">
                <?php
                $accordion_id    = 'sgAccordion';
                $accordion_toggle = appian_accordion_toggle_icon();
                $accordion_items = [
                    [
                        'heading' => 'What is a design system?',
                        'body'    => 'A design system is a collection of reusable components, tokens, and guidelines that help maintain visual consistency across products.',
                    ],
                    [
                        'heading' => 'How do I use these tokens?',
                        'body'    => 'Reference the SCSS variables directly in your stylesheets. For example, use <code>$primary-red</code> for the brand primary or <code>$neutral-400</code> for headline text.',
                    ],
                ];
                ?>
                <div class="m-styleguide__accordion" id="<?php echo esc_attr( $accordion_id ); ?>">
                    <?php foreach ( $accordion_items as $index => $item ) :
                        $item_id = $accordion_id . '-' . $index;
                    ?>
                        <details class="m-styleguide__accordion-item">
                            <summary class="m-styleguide__accordion-button">
                                <span><?php echo esc_html( $item['heading'] ); ?></span>
                                <?php echo $accordion_toggle; ?>
                            </summary>
                            <div class="m-styleguide__accordion-body">
                                <p><?php echo $item['body']; ?></p>
                            </div>
                        </details>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php sg_code_block(
'<details class="accordion-item">
  <summary class="accordion-button">
    <span>Accordion heading</span>
    <?php echo appian_accordion_toggle_icon(); ?>
  </summary>
  <div class="accordion-body">
    <p>Accordion body content.</p>
  </div>
</details>'
            ); ?>

        </section>
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
                                    <?php echo appian_get_svg_icon( 'arrow-down' ); ?>
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
                                <?php echo appian_get_svg_icon( 'arrow-right' ); ?>
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
                <?php for ( $i = 1; $i <= 12; $i++ ) : ?>
                    <div class="col-1">
                        <div class="m-styleguide__grid-col-inner"><?php echo $i; ?></div>
                    </div>
                <?php endfor; ?>
            </div>

            <h3 class="m-styleguide__subsection-title">4-Column Grid (Mobile)</h3>
            <div class="row g-2 mb-4">
                <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
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
                    <svg width="120" height="47" viewBox="0 0 120 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M68.8889 14.476C68.2898 15.1234 68.1517 15.9559 68.1517 16.8345V35.2415H74.3725V8.69489L68.8889 14.476Z" fill="#D72027"/>
                        <path d="M68.1117 0V9.80465L74.3324 3.19113V0H68.1117Z" fill="#D72027"/>
                        <path d="M64.9721 12.2104C64.8339 6.61435 62.8064 4.44067 57.3689 4.44067C54.8344 4.44067 45.4801 4.44067 45.4801 4.44067V46.2029H51.5628V35.1958C52.5765 35.1958 55.3414 35.1958 57.3689 35.1958C62.8064 35.1958 64.8339 32.9297 64.9721 27.3336C64.9721 27.195 64.9721 12.3492 64.9721 12.2104ZM55.1571 29.9699C52.7147 29.9699 51.5628 29.9699 51.5628 27.8424V11.7017C51.5628 9.57426 52.7147 9.57426 55.1571 9.57426C57.4611 9.57426 58.7513 9.57426 58.7513 11.7017V27.8424C58.7513 29.9699 57.4611 29.9235 55.1571 29.9699Z" fill="#D72027"/>
                        <path d="M42.2549 12.2104C42.1166 6.61435 40.0892 4.44067 34.6516 4.44067C32.1173 4.44067 22.763 4.44067 22.763 4.44067V46.2029H28.7994V35.1958C29.8133 35.1958 32.578 35.1958 34.6055 35.1958C40.043 35.1958 42.0705 32.9297 42.2088 27.3336C42.2549 27.195 42.2549 12.3492 42.2549 12.2104ZM32.4398 29.9699C29.9975 29.9699 28.8455 29.9699 28.8455 27.8424V11.7017C28.8455 9.57426 29.9975 9.57426 32.4398 9.57426C34.7438 9.57426 36.0341 9.57426 36.0341 11.7017V27.8424C36.0341 29.9699 34.7438 29.9235 32.4398 29.9699Z" fill="#D72027"/>
                        <path d="M113.59 11.7479C113.59 9.62045 112.3 9.62045 109.995 9.62045C107.554 9.62045 106.402 9.62045 106.402 11.7479V35.1958H100.227V4.44067C100.227 4.44067 109.719 4.44067 112.208 4.44067C117.645 4.44067 119.672 6.70685 119.811 12.3029C119.811 12.4417 119.811 35.2421 119.811 35.2421H113.59V11.7479Z" fill="#D72027"/>
                        <path d="M97.0427 12.2541C96.9037 6.65807 94.7843 4.39191 89.3469 4.39191C89.0703 4.39191 83.3103 4.39191 81.2827 4.39191V9.61799C87.181 9.61799 86.8585 9.61799 87.1349 9.61799C89.4389 9.61799 90.7292 9.61799 90.7292 11.7454V14.7978C89.6233 14.7978 86.9968 14.7516 85.0614 14.7516C79.6239 14.7516 77.5964 17.0177 77.4581 22.6138C77.4581 22.7526 77.4581 27.2848 77.4581 27.4236C77.5964 33.0196 79.6239 35.2396 85.0614 35.2396C87.5957 35.2396 97.0427 35.2396 97.0427 35.2396V12.2541ZM90.9136 27.8862C90.9136 30.0135 89.7616 30.0135 87.3193 30.0135C85.0153 30.0135 83.725 30.0135 83.725 27.8862V22.0589C83.725 19.9314 85.0153 19.9314 87.3193 19.9314C89.7616 19.9314 90.9136 19.9314 90.9136 22.0589V27.8862Z" fill="#D72027"/>
                        <path d="M19.5841 12.2541C19.446 6.65807 17.3262 4.39191 11.8888 4.39191C11.6123 4.39191 5.85221 4.39191 3.82466 4.39191V9.61799C9.72294 9.61799 9.40043 9.61799 9.67692 9.61799C11.9809 9.61799 13.2712 9.61799 13.2712 11.7454V14.7978C12.2113 14.7978 9.58475 14.7516 7.60326 14.7516C2.16578 14.7516 0.138244 16.9716 0 22.6138C0 22.7526 0 27.2848 0 27.4236C0.138244 32.696 1.93538 34.962 6.72773 35.2396L11.6583 30.0135C11.1515 30.0598 10.5524 30.0598 9.81511 30.0598C7.51109 30.0598 6.22084 30.0598 6.22084 27.9323V22.0589C6.22084 19.9314 7.51109 19.9314 9.81511 19.9314C12.2574 19.9314 13.4094 19.9314 13.4094 22.0589V35.1933C13.6398 35.1933 19.5841 35.1933 19.5841 35.1933V12.2541Z" fill="#D72027"/>
                    </svg>
                </div>
                <div class="m-styleguide__demo-preview p-4 bg-neutral-500">
                    <svg width="120" height="47" viewBox="0 0 120 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M68.8889 14.476C68.2898 15.1234 68.1517 15.9559 68.1517 16.8345V35.2415H74.3725V8.69489L68.8889 14.476Z" fill="#D72027"/>
                        <path d="M68.1117 0V9.80465L74.3324 3.19113V0H68.1117Z" fill="#D72027"/>
                        <path d="M64.9721 12.2104C64.8339 6.61435 62.8064 4.44067 57.3689 4.44067C54.8344 4.44067 45.4801 4.44067 45.4801 4.44067V46.2029H51.5628V35.1958C52.5765 35.1958 55.3414 35.1958 57.3689 35.1958C62.8064 35.1958 64.8339 32.9297 64.9721 27.3336C64.9721 27.195 64.9721 12.3492 64.9721 12.2104ZM55.1571 29.9699C52.7147 29.9699 51.5628 29.9699 51.5628 27.8424V11.7017C51.5628 9.57426 52.7147 9.57426 55.1571 9.57426C57.4611 9.57426 58.7513 9.57426 58.7513 11.7017V27.8424C58.7513 29.9699 57.4611 29.9235 55.1571 29.9699Z" fill="#D72027"/>
                        <path d="M42.2549 12.2104C42.1166 6.61435 40.0892 4.44067 34.6516 4.44067C32.1173 4.44067 22.763 4.44067 22.763 4.44067V46.2029H28.7994V35.1958C29.8133 35.1958 32.578 35.1958 34.6055 35.1958C40.043 35.1958 42.0705 32.9297 42.2088 27.3336C42.2549 27.195 42.2549 12.3492 42.2549 12.2104ZM32.4398 29.9699C29.9975 29.9699 28.8455 29.9699 28.8455 27.8424V11.7017C28.8455 9.57426 29.9975 9.57426 32.4398 9.57426C34.7438 9.57426 36.0341 9.57426 36.0341 11.7017V27.8424C36.0341 29.9699 34.7438 29.9235 32.4398 29.9699Z" fill="#D72027"/>
                        <path d="M113.59 11.7479C113.59 9.62045 112.3 9.62045 109.995 9.62045C107.554 9.62045 106.402 9.62045 106.402 11.7479V35.1958H100.227V4.44067C100.227 4.44067 109.719 4.44067 112.208 4.44067C117.645 4.44067 119.672 6.70685 119.811 12.3029C119.811 12.4417 119.811 35.2421 119.811 35.2421H113.59V11.7479Z" fill="#D72027"/>
                        <path d="M97.0427 12.2541C96.9037 6.65807 94.7843 4.39191 89.3469 4.39191C89.0703 4.39191 83.3103 4.39191 81.2827 4.39191V9.61799C87.181 9.61799 86.8585 9.61799 87.1349 9.61799C89.4389 9.61799 90.7292 9.61799 90.7292 11.7454V14.7978C89.6233 14.7978 86.9968 14.7516 85.0614 14.7516C79.6239 14.7516 77.5964 17.0177 77.4581 22.6138C77.4581 22.7526 77.4581 27.2848 77.4581 27.4236C77.5964 33.0196 79.6239 35.2396 85.0614 35.2396C87.5957 35.2396 97.0427 35.2396 97.0427 35.2396V12.2541ZM90.9136 27.8862C90.9136 30.0135 89.7616 30.0135 87.3193 30.0135C85.0153 30.0135 83.725 30.0135 83.725 27.8862V22.0589C83.725 19.9314 85.0153 19.9314 87.3193 19.9314C89.7616 19.9314 90.9136 19.9314 90.9136 22.0589V27.8862Z" fill="#D72027"/>
                        <path d="M19.5841 12.2541C19.446 6.65807 17.3262 4.39191 11.8888 4.39191C11.6123 4.39191 5.85221 4.39191 3.82466 4.39191V9.61799C9.72294 9.61799 9.40043 9.61799 9.67692 9.61799C11.9809 9.61799 13.2712 9.61799 13.2712 11.7454V14.7978C12.2113 14.7978 9.58475 14.7516 7.60326 14.7516C2.16578 14.7516 0.138244 16.9716 0 22.6138C0 22.7526 0 27.2848 0 27.4236C0.138244 32.696 1.93538 34.962 6.72773 35.2396L11.6583 30.0135C11.1515 30.0598 10.5524 30.0598 9.81511 30.0598C7.51109 30.0598 6.22084 30.0598 6.22084 27.9323V22.0589C6.22084 19.9314 7.51109 19.9314 9.81511 19.9314C12.2574 19.9314 13.4094 19.9314 13.4094 22.0589V35.1933C13.6398 35.1933 19.5841 35.1933 19.5841 35.1933V12.2541Z" fill="#D72027"/>
                    </svg>
                </div>
            </div>

            <h3 class="m-styleguide__subsection-title">Favicon</h3>
            <div class="m-styleguide__demo-block">
                <div class="m-styleguide__demo-preview p-4 gap-4">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M40 17.724C39.932 14.9134 38.9333 13.8216 36.2553 13.8216C35.007 13.8216 30.3998 13.8216 30.3998 13.8216V34.7971H33.3957V29.2687C33.895 29.2687 35.2567 29.2687 36.2553 29.2687C38.9333 29.2687 39.932 28.1305 40 25.3198C40 25.2502 40 17.7937 40 17.724ZM35.1659 26.6439C33.963 26.6439 33.3957 26.6439 33.3957 25.5754V17.4685C33.3957 16.4 33.963 16.4 35.1659 16.4C36.3007 16.4 36.9361 16.4 36.9361 17.4685V25.5754C36.9361 26.6439 36.3007 26.6206 35.1659 26.6439Z" fill="#D72027"/>
                        <path d="M28.8114 17.724C28.7432 14.9134 27.7447 13.8216 25.0666 13.8216C23.8184 13.8216 19.2112 13.8216 19.2112 13.8216V34.7971H22.1843V29.2687C22.6836 29.2687 24.0453 29.2687 25.0439 29.2687C27.7219 29.2687 28.7205 28.1305 28.7887 25.3198C28.8114 25.2502 28.8114 17.7937 28.8114 17.724ZM23.9772 26.6439C22.7743 26.6439 22.207 26.6439 22.207 25.5754V17.4685C22.207 16.4 22.7743 16.4 23.9772 16.4C25.112 16.4 25.7475 16.4 25.7475 17.4685V25.5754C25.7475 26.6439 25.112 26.6206 23.9772 26.6439Z" fill="#D72027"/>
                        <path d="M17.6456 17.746C17.5775 14.9353 16.5335 13.7971 13.8554 13.7971C13.7193 13.7971 10.8823 13.7971 9.88372 13.7971V16.422C12.7887 16.422 12.6299 16.422 12.7661 16.422C13.9008 16.422 14.5363 16.422 14.5363 17.4905V19.0236C14.0143 19.0236 12.7207 19.0004 11.7448 19.0004C9.06669 19.0004 8.06809 20.1154 8 22.9492C8 23.0189 8 25.2953 8 25.365C8.06809 28.0131 8.95321 29.1513 11.3135 29.2907L13.7419 26.6658C13.4923 26.689 13.1973 26.689 12.8341 26.689C11.6994 26.689 11.0639 26.689 11.0639 25.6205V22.6705C11.0639 21.602 11.6994 21.602 12.8341 21.602C14.037 21.602 14.6044 21.602 14.6044 22.6705V29.2674C14.7179 29.2674 17.6456 29.2674 17.6456 29.2674V17.746Z" fill="#D72027"/>
                    </svg>
                    <svg width="32" height="32" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M40 17.724C39.932 14.9134 38.9333 13.8216 36.2553 13.8216C35.007 13.8216 30.3998 13.8216 30.3998 13.8216V34.7971H33.3957V29.2687C33.895 29.2687 35.2567 29.2687 36.2553 29.2687C38.9333 29.2687 39.932 28.1305 40 25.3198C40 25.2502 40 17.7937 40 17.724ZM35.1659 26.6439C33.963 26.6439 33.3957 26.6439 33.3957 25.5754V17.4685C33.3957 16.4 33.963 16.4 35.1659 16.4C36.3007 16.4 36.9361 16.4 36.9361 17.4685V25.5754C36.9361 26.6439 36.3007 26.6206 35.1659 26.6439Z" fill="#D72027"/>
                        <path d="M28.8114 17.724C28.7432 14.9134 27.7447 13.8216 25.0666 13.8216C23.8184 13.8216 19.2112 13.8216 19.2112 13.8216V34.7971H22.1843V29.2687C22.6836 29.2687 24.0453 29.2687 25.0439 29.2687C27.7219 29.2687 28.7205 28.1305 28.7887 25.3198C28.8114 25.2502 28.8114 17.7937 28.8114 17.724ZM23.9772 26.6439C22.7743 26.6439 22.207 26.6439 22.207 25.5754V17.4685C22.207 16.4 22.7743 16.4 23.9772 16.4C25.112 16.4 25.7475 16.4 25.7475 17.4685V25.5754C25.7475 26.6439 25.112 26.6206 23.9772 26.6439Z" fill="#D72027"/>
                        <path d="M17.6456 17.746C17.5775 14.9353 16.5335 13.7971 13.8554 13.7971C13.7193 13.7971 10.8823 13.7971 9.88372 13.7971V16.422C12.7887 16.422 12.6299 16.422 12.7661 16.422C13.9008 16.422 14.5363 16.422 14.5363 17.4905V19.0236C14.0143 19.0236 12.7207 19.0004 11.7448 19.0004C9.06669 19.0004 8.06809 20.1154 8 22.9492C8 23.0189 8 25.2953 8 25.365C8.06809 28.0131 8.95321 29.1513 11.3135 29.2907L13.7419 26.6658C13.4923 26.689 13.1973 26.689 12.8341 26.689C11.6994 26.689 11.0639 26.689 11.0639 25.6205V22.6705C11.0639 21.602 11.6994 21.602 12.8341 21.602C14.037 21.602 14.6044 21.602 14.6044 22.6705V29.2674C14.7179 29.2674 17.6456 29.2674 17.6456 29.2674V17.746Z" fill="#D72027"/>
                    </svg>
                </div>
            </div>
        </section>



    </main>

    <!-- Toast Notification -->
    <div class="m-styleguide__toast">Copied!</div>

</div>
