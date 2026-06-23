function initContactForm() {
    const roots = document.querySelectorAll('.c-contact-form');
    roots.forEach((root) => {
        initDateField(root);
        initUnitToggle(root);
        initValidation(root);
    });
}

function getTodayDateString() {
    const today = new Date();
    today.setMinutes(today.getMinutes() - today.getTimezoneOffset());
    return today.toISOString().slice(0, 10);
}

function initDateField(root) {
    const dateField = root.querySelector('input[name="move-in-date"]');
    if (!dateField) return;

    dateField.min = getTodayDateString();

    const showPlaceholder = () => {
        if (!dateField.value) {
            dateField.type = 'text';
            dateField.placeholder = 'Move-In Date *';
        }
    };

    const showPicker = () => {
        dateField.type = 'date';
        try {
            if (typeof dateField.showPicker === 'function') {
                dateField.showPicker();
            }
        } catch (e) {}
    };

    showPlaceholder();

    dateField.addEventListener('focus', showPicker);
    dateField.addEventListener('click', showPicker);
    dateField.addEventListener('blur', showPlaceholder);
}

function initUnitToggle(root) {
    const toggle = root.querySelector('[data-unit-toggle]');
    const label = root.querySelector('[data-unit-toggle-label]');
    const radioField = root.querySelector('.c-contact-form__field--radio');
    const hiddenInput = root.querySelector('input[name="unit-type"]');
    const radios = root.querySelectorAll('input[name="unit-preference"]');

    if (!toggle || !radioField) return;

    const setOpen = (isOpen) => {
        radioField.hidden = !isOpen;
        radioField.classList.toggle('is-open', isOpen);
        toggle.setAttribute('aria-expanded', String(isOpen));
    };

    let recentlyOpenedByFocus = false;

    toggle.addEventListener('focus', () => {
        if (toggle.getAttribute('aria-expanded') !== 'true') {
            setOpen(true);
            recentlyOpenedByFocus = true;
            setTimeout(() => { recentlyOpenedByFocus = false; }, 200);
        }
    });

    toggle.addEventListener('click', () => {
        if (!recentlyOpenedByFocus) {
            setOpen(toggle.getAttribute('aria-expanded') !== 'true');
        }
    });

    radios.forEach((radio) => {
        radio.addEventListener('change', () => {
            if (hiddenInput) hiddenInput.value = radio.value;
            if (label) label.textContent = radio.value;
            toggle.classList.remove('is-invalid');
            toggle.classList.add('has-value');
        });
    });

    setOpen(true);
}

function initValidation(root) {
    const form = root.querySelector('.c-contact-form__form');
    if (!form || form.dataset.validationBound) return;

    form.dataset.validationBound = 'true';

    function getOrCreateError(field, parentSelector) {
        const parent = field.closest(parentSelector);
        if (!parent) return null;
        let error = parent.querySelector('.c-contact-form__error-message');
        if (!error) {
            error = document.createElement('span');
            error.className = 'c-contact-form__error-message body-small';
            error.setAttribute('aria-live', 'polite');
            parent.appendChild(error);
        }
        return error;
    }

    function checkFieldValidity(field) {
        const errorEl = getOrCreateError(field, '.c-contact-form__field');
        const value = field.value.trim();
        const isPhoneInvalid = field.name === 'phone' && value !== '' && !/^[0-9]{10}$/.test(value);
        const isMoveInDateInvalid = field.name === 'move-in-date'
            && value !== ''
            && (!/^\d{4}-\d{2}-\d{2}$/.test(value) || value < getTodayDateString());

        const isNameInvalid = (field.name === 'first-name' || field.name === 'last-name')
            && value !== ''
            && !/^[a-zA-Z\s]+$/.test(value);

        let isEmailInvalid = false;
        let emailErrorMessage = 'Please enter a valid email address.';

        if (field.type === 'email' && value !== '') {
            if (value.length > 254) {
                isEmailInvalid = true;
                emailErrorMessage = 'Email must not exceed 254 characters.';
            } else {
                const parts = value.split('@');
                if (parts.length !== 2) {
                    isEmailInvalid = true;
                } else {
                    const [localPart, domainPart] = parts;
                    if (localPart.length > 64) {
                        isEmailInvalid = true;
                        emailErrorMessage = 'Email local part must not exceed 64 characters.';
                    } else if (domainPart.length > 255) {
                        isEmailInvalid = true;
                        emailErrorMessage = 'Email domain must not exceed 255 characters.';
                    } else {
                        const labels = domainPart.split('.');
                        if (labels.length < 2 || labels.some(label => label.length === 0 || label.length > 63)) {
                            isEmailInvalid = true;
                            emailErrorMessage = 'Email domain structure is invalid.';
                        } else {
                            const domainRegex = /^[a-zA-Z0-9.-]+$/;
                            if (!domainRegex.test(domainPart)) {
                                isEmailInvalid = true;
                                emailErrorMessage = 'Email domain must not contain special characters or emojis.';
                            } else {
                                const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                                if (!emailRegex.test(value)) {
                                    isEmailInvalid = true;
                                    emailErrorMessage = 'Please enter a valid email address.';
                                }
                            }
                        }
                    }
                }
            }
        }

        if (!field.checkValidity() || isPhoneInvalid || isMoveInDateInvalid || isNameInvalid || isEmailInvalid) {
            field.classList.add('is-invalid');
            if (errorEl) {
                if (value === '') {
                    errorEl.textContent = 'Please fill out this field.';
                } else if (isNameInvalid) {
                    errorEl.textContent = 'Please enter valid alphabetic characters only.';
                } else if (isEmailInvalid) {
                    errorEl.textContent = emailErrorMessage;
                } else if (field.type === 'email') {
                    errorEl.textContent = 'Please enter a valid email address.';
                } else if (field.name === 'phone') {
                    errorEl.textContent = 'Please enter a 10 digit phone number.';
                } else if (field.name === 'move-in-date') {
                    errorEl.textContent = 'Please choose today or a future date.';
                }
            }
            return false;
        } else {
            field.classList.remove('is-invalid');
            if (errorEl) errorEl.textContent = '';
            return true;
        }
    }

    function checkRadioValidity() {
        const radios = form.querySelectorAll('input[name="unit-preference"]');
        if (radios.length === 0) return true;

        const isChecked = Array.from(radios).some((r) => r.checked);
        const radioField = form.querySelector('.c-contact-form__field--radio');
        const toggle = form.querySelector('[data-unit-toggle]');
        const errorEl = toggle ? getOrCreateError(toggle, '.c-contact-form__field--select') : null;

        if (!isChecked) {
            if (radioField) {
                radioField.hidden = false;
                radioField.classList.add('is-open');
            }
            if (toggle) {
                toggle.classList.add('is-invalid');
                toggle.setAttribute('aria-expanded', 'true');
            }
            if (errorEl) errorEl.textContent = 'Please fill out this field.';
            return false;
        } else {
            if (toggle) toggle.classList.remove('is-invalid');
            if (errorEl) errorEl.textContent = '';
            return true;
        }
    }

    form.querySelectorAll('input:not([type="radio"]), select').forEach((field) => {
        field.addEventListener('blur', () => checkFieldValidity(field));
        field.addEventListener('input', () => {
            if (field.classList.contains('is-invalid')) {
                checkFieldValidity(field);
            }
        });
    });

    form.querySelectorAll('input[type="radio"]').forEach((radio) => {
        radio.addEventListener('change', checkRadioValidity);
    });

    form.addEventListener('submit', async (e) => {
        let isFormValid = true;

        form.querySelectorAll('input:not([type="radio"]), select').forEach((field) => {
            if (!checkFieldValidity(field)) {
                isFormValid = false;
            }
        });

        if (!checkRadioValidity()) {
            isFormValid = false;
        }

        if (!isFormValid) {
            e.preventDefault();
            const firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) firstInvalid.focus();
        } else {
            e.preventDefault();
            const formData = new FormData(form);
            formData.append('action', 'submit_contact_form');

            const response = await fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) return;

            form.reset();
            const unitToggleLabel = form.querySelector('[data-unit-toggle-label]');
            const unitToggle = form.querySelector('[data-unit-toggle]');
            const radioField = form.querySelector('.c-contact-form__field--radio');
            const successMessage = form.querySelector('[data-contact-form-success]');
            if (unitToggleLabel) unitToggleLabel.textContent = 'Unit Type *';
             if (unitToggle) {
                unitToggle.classList.remove('is-invalid');
                unitToggle.classList.remove('has-value');
                unitToggle.setAttribute('aria-expanded', 'true');
            }
            if (radioField) {
                radioField.hidden = false;
                radioField.classList.add('is-open');
            }
            if (successMessage) successMessage.hidden = false;
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initContactForm);
} else {
    initContactForm();
}
