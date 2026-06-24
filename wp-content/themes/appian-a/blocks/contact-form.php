<?php
$contact_group = get_field('contact_group');
$contact_form_heading  = $contact_group['heading'] ?? '';
$contact_form_text     = $contact_group['description'] ?? '';

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
                                inputmode="tel"
                                placeholder="Phone Number *" required>
                        </div>

                        <div class="c-contact-form__field">
                            <input type="text" name="move-in-date" id="move-in-date"
                                class="c-contact-form__input body"
                                placeholder="Move-In Date *"
                                required>
                        </div>

                        <div class="c-contact-form__field c-contact-form__field--select">
                            <input type="hidden" name="unit-type" id="unit-type" value="1 Bedroom">
                            <button type="button" id="unit-type-toggle"
                                class="c-contact-form__input c-contact-form__select body has-value"
                                aria-expanded="true"
                                aria-controls="unit-preference-options"
                                data-unit-toggle>
                                <span data-unit-toggle-label>1 Bedroom</span>
                            </button>
                        </div>

                        <div class="c-contact-form__field c-contact-form__field--radio" id="unit-preference-options" role="radiogroup" aria-labelledby="unit-type-toggle">
                            <div class="c-contact-form__radio-group">
                                <span class="c-contact-form__radio-item">
                                    <label class="body">
                                        <input type="radio" name="unit-preference" value="Studio">
                                        <span>Studio</span>
                                    </label>
                                </span>
                                <span class="c-contact-form__radio-item">
                                    <label class="body">
                                        <input type="radio" name="unit-preference" value="1 Bedroom" checked>
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
                            THANK YOU FOR CONTACTING US.
                        </p>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>