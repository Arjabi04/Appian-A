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
            if (dateField.validity && dateField.validity.badInput) {
                return;
            }
            dateField.type = 'text';
            dateField.placeholder = 'Move-In Date *';
        }
    };

    const showPicker = () => {
        if (dateField.type === 'date') return;
        dateField.type = 'date';
        dateField.min = getTodayDateString();
        try {
            if (typeof dateField.showPicker === 'function') {
                dateField.showPicker();
            }
        } catch (e) { }
    };

    const changeToDate = () => {
        if (dateField.type !== 'date') {
            dateField.type = 'date';
            dateField.min = getTodayDateString();
        }
    };

    showPlaceholder();

    dateField.addEventListener('focus', showPicker);
    dateField.addEventListener('click', showPicker);
    dateField.addEventListener('touchstart', changeToDate);
    dateField.addEventListener('blur', () => {
        setTimeout(() => {
            if (document.activeElement === dateField) {
                return;
            }
            showPlaceholder();
        }, 150);
    });
}

function initUnitToggle(root) {
    const toggle = root.querySelector('[data-unit-toggle]');
    const label = root.querySelector('[data-unit-toggle-label]');
    const radioField = root.querySelector('.c-contact-form__field--radio');
    const hiddenInput = root.querySelector('input[name="unit-type"]');
    const radios = root.querySelectorAll('input[name="unit-preference"]');

    if (!toggle || !radioField) return;

    let closeTimeoutId = null;

    const setOpen = (isOpen) => {
        if (closeTimeoutId) {
            clearTimeout(closeTimeoutId);
            closeTimeoutId = null;
        }
        radioField.hidden = !isOpen;
        radioField.classList.toggle('is-open', isOpen);
        toggle.setAttribute('aria-expanded', String(isOpen));
    };

    root.closeUnitToggle = () => setOpen(false);
    root.cancelUnitToggleClose = () => {
        if (closeTimeoutId) {
            clearTimeout(closeTimeoutId);
            closeTimeoutId = null;
        }
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

    const handleOutsideClick = (e) => {
        const submitButton = root.querySelector('button[type="submit"]');
        if (
            !toggle.contains(e.target) &&
            !radioField.contains(e.target) &&
            (!submitButton || !submitButton.contains(e.target))
        ) {
            if (!closeTimeoutId) {
                closeTimeoutId = setTimeout(() => {
                    setOpen(false);
                    closeTimeoutId = null;
                }, 150);
            }
        }
    };
    document.addEventListener('click', handleOutsideClick);

    // Track touch interactions to support click outside on mobile without closing on scroll/swipe
    let touchStartX = 0;
    let touchStartY = 0;

    const handleTouchStart = (e) => {
        if (e.touches && e.touches[0]) {
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
        }
    };

    const handleTouchEnd = (e) => {
        if (e.changedTouches && e.changedTouches[0]) {
            const touchEndX = e.changedTouches[0].clientX;
            const touchEndY = e.changedTouches[0].clientY;
            const diffX = Math.abs(touchEndX - touchStartX);
            const diffY = Math.abs(touchEndY - touchStartY);

            // If the user moved their finger more than 10 pixels, consider it a scroll/swipe and don't close.
            if (diffX > 10 || diffY > 10) {
                return;
            }
        }
        handleOutsideClick(e);
    };

    document.addEventListener('touchstart', handleTouchStart, { passive: true });
    document.addEventListener('touchend', handleTouchEnd);

    const form = root.querySelector('.c-contact-form__form');
    if (form) {
        form.addEventListener('reset', () => {
            setTimeout(() => {
                const checkedRadio = Array.from(radios).find(r => r.checked);
                if (checkedRadio) {
                    if (hiddenInput) hiddenInput.value = checkedRadio.value;
                    if (label) label.textContent = checkedRadio.value;
                    toggle.classList.add('has-value');
                } else {
                    if (hiddenInput) hiddenInput.value = '';
                    if (label) label.textContent = 'Unit Type *';
                    toggle.classList.remove('has-value');
                }
                toggle.classList.remove('is-invalid');
                setOpen(true);
            }, 0);
        });
    }

    // Initialize state
    const checkedRadio = Array.from(radios).find(r => r.checked);
    if (checkedRadio) {
        if (hiddenInput) hiddenInput.value = checkedRadio.value;
        if (label) label.textContent = checkedRadio.value;
        toggle.classList.add('has-value');
    } else {
        if (label) label.textContent = 'Unit Type *';
        toggle.classList.remove('has-value');
    }
    setOpen(true);
}

function initValidation(root) {
    const form = root.querySelector('.c-contact-form__form');
    if (!form || form.dataset.validationBound) return;
    const submitButton = form.querySelector('button[type="submit"]');

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

    function checkFieldValidity(field, isSubmitting = false) {
        const errorEl = getOrCreateError(field, '.c-contact-form__field');
        const value = field.value.trim();
        const isPhoneInvalid = field.name === 'phone' && value !== '' && !/^[0-9]{10}$/.test(value);
        const isMoveInDateInvalid = field.name === 'move-in-date'
            && value !== ''
            && !(!isSubmitting && document.activeElement === field && value.startsWith('0'))
            && (!/^\d{4}-\d{2}-\d{2}$/.test(value) || value < getTodayDateString());

        const isNameInvalid = (field.name === 'first-name' || field.name === 'last-name')
            && value !== ''
            && !/^[a-zA-Z\s]+$/.test(value);

        let emailErrorMessage = 'Please enter a valid email address.';
        let isEmailInvalid = false;

        if (field.type === 'email' && value !== '') {
            const parts = value.split('@');
            const [localPart = '', domainPart = ''] = parts;
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]{1,63}\.[a-zA-Z]{2,63}$/;

            // to reject emojis
            const isPunycode = domainPart.includes('xn--');

            isEmailInvalid = value.length > 254
                || parts.length !== 2
                || localPart.length > 64
                || domainPart.length > 188
                || isPunycode
                || !emailRegex.test(value);

            if (value.length > 254) {
                emailErrorMessage = 'Email must not exceed 254 characters.';
            } else if (localPart.length > 64) {
                emailErrorMessage = 'Email local part must not exceed 64 characters.';
            } else if (domainPart.length > 188) {
                emailErrorMessage = 'Email domain must not exceed 188 characters.';
            } else if (parts.length === 2 && domainPart.split('.')[0]?.length > 63) {
                emailErrorMessage = 'Email domain label must not exceed 63 characters.';
            }
        }

        let isFieldValid = true;
        if (field.name === 'move-in-date') {
            const hasBadInput = field.validity && field.validity.badInput;
            const isRequired = field.hasAttribute('required');
            if (hasBadInput) {
                isFieldValid = false;
            } else if (isRequired && value === '') {
                isFieldValid = false;
            } else if (isMoveInDateInvalid) {
                isFieldValid = false;
            }
        } else {
            isFieldValid = field.checkValidity() && !isPhoneInvalid && !isNameInvalid && !isEmailInvalid;
        }

        if (!isFieldValid) {
            field.classList.add('is-invalid');
            if (errorEl) {
                if (field.name === 'move-in-date' && field.validity && field.validity.badInput) {
                    errorEl.textContent = 'Date entered is invalid.';
                } else if (value === '') {
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
        field.addEventListener('change', () => checkFieldValidity(field));
        field.addEventListener('input', () => {
            if (field.name === 'move-in-date') return;
            if (field.classList.contains('is-invalid')) {
                checkFieldValidity(field);
            }
        });
    });

    form.querySelectorAll('input[type="radio"]').forEach((radio) => {
        radio.addEventListener('change', checkRadioValidity);
    });

    form.addEventListener('submit', async (e) => {
        if (typeof root.cancelUnitToggleClose === 'function') {
            root.cancelUnitToggleClose();
        }

        if (submitButton?.disabled || form.classList.contains('is-success')) {
            e.preventDefault();
            return;
        }

        let isFormValid = true;

        form.querySelectorAll('input:not([type="radio"]), select').forEach((field) => {
            if (!checkFieldValidity(field, true)) {
                isFormValid = false;
            }
        });

        if (!checkRadioValidity()) {
            isFormValid = false;
        }

        if (!isFormValid) {
            e.preventDefault();
            if (checkRadioValidity()) {
                if (typeof root.closeUnitToggle === 'function') {
                    root.closeUnitToggle();
                }
            }
            const firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) firstInvalid.focus();
            return;
        }

        e.preventDefault();
        if (submitButton) submitButton.disabled = true;

        try {
            const formData = new FormData(form);
            formData.append('action', 'submit_contact_form');

            const response = await fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) throw new Error('Contact form submission failed.');

            form.reset();
            const successMessage = form.querySelector('[data-contact-form-success]');
            if (successMessage) successMessage.hidden = false;
            form.classList.add('is-success');

            if (successMessage) {
                successMessage.setAttribute('tabindex', '-1');
                successMessage.focus({ preventScroll: true });
                successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        } catch (error) {
            if (submitButton) submitButton.disabled = false;
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initContactForm);
} else {
    initContactForm();
}
