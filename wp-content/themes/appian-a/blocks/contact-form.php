<?php
$contact_form_heading = get_field('contact_form_heading') ?: 'A New Chapter in Student Living';
$contact_form_text    = get_field('contact_form_text') ?: 'Quisque quis nisl vel elit tristique mollis vel ut ex. Integer et est enim. Nullam sagittis nibh sit amet ornare pretium. Sed eget tellus a ex sagittis accumsan lobortis id ipsum.';
?>

<section class="m-contact-form" aria-label="<?php echo esc_attr($contact_form_heading); ?>">
    <div class="grid-container">
        <div class="m-contact-form__inner">

            <div class="m-contact-form__content">
                <div class="m-contact-form__heading-body">
                    <h2 class="m-contact-form__heading h2 m-0 text-break">
                        <?php echo esc_html($contact_form_heading); ?>
                    </h2>
                    <p class="m-contact-form__text body-sm-all m-0 text-break">
                        <?php echo esc_html($contact_form_text); ?>
                    </p>
                </div>
            </div>

            <div class="m-contact-form__form-wrap">
                <div class="c-contact-form">
                    <form class="c-contact-form__form" id="contact-form" novalidate>

                        <div class="c-contact-form__row c-contact-form__row--name">
                            <div class="c-contact-form__field">
                                <input type="text" name="first-name" id="first-name"
                                    class="c-contact-form__input body"
                                    placeholder="First Name *" required>
                            </div>
                            <div class="c-contact-form__field">
                                <input type="text" name="last-name" id="last-name"
                                    class="c-contact-form__input body"
                                    placeholder="Last Name *" required>
                            </div>
                        </div>

                        <div class="c-contact-form__field">
                            <input type="email" name="email" id="email"
                                class="c-contact-form__input body"
                                placeholder="Email *" required>
                        </div>

                        <div class="c-contact-form__field">
                            <input type="tel" name="phone" id="phone"
                                class="c-contact-form__input body"
                                inputmode="numeric"
                                maxlength="10"
                                pattern="[0-9]{10}"
                                placeholder="Phone Number *" required>
                        </div>

                        <div class="c-contact-form__field">
                            <input type="text" name="move-in-date" id="move-in-date"
                                class="c-contact-form__input body"
                                placeholder="Move-In Date *"
                                required>
                        </div>

                        <div class="c-contact-form__field c-contact-form__field--select">
                            <input type="hidden" name="unit-type" id="unit-type">
                            <button type="button" id="unit-type-toggle"
                                class="c-contact-form__input c-contact-form__select body"
                                aria-expanded="false"
                                aria-controls="unit-preference-options"
                                data-unit-toggle>
                                <span data-unit-toggle-label>Unit Type *</span>
                            </button>
                        </div>

                        <div class="c-contact-form__field c-contact-form__field--radio" id="unit-preference-options" hidden>
                            <div class="c-contact-form__radio-group">
                                <span class="c-contact-form__radio-item">
                                    <label class="body">
                                        <input type="radio" name="unit-preference" value="Studio">
                                        <span>Studio</span>
                                    </label>
                                </span>
                                <span class="c-contact-form__radio-item">
                                    <label class="body">
                                        <input type="radio" name="unit-preference" value="1 Bedroom">
                                        <span>1 Bedroom</span>
                                    </label>
                                </span>
                                <span class="c-contact-form__radio-item">
                                    <label class="body">
                                        <input type="radio" name="unit-preference" value="2 Bedroom">
                                        <span>2 Bedroom</span>
                                    </label>
                                </span>
                            </div>
                        </div>

                        <div class="c-contact-form__submit">
                            <button type="submit" class="btn btn-primary c-contact-form__submit-input">
                                <span>Submit</span>
                                <?php echo appian_get_svg_icon('arrow-right'); ?>
                            </button>
                        </div>

                        <p class="c-contact-form__success body-sm-all m-0" data-contact-form-success hidden>
                            Thank you for contacting us.
                        </p>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
