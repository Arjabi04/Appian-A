function initContactForm() {
    const roots = document.querySelectorAll('.c-contact-form');
    roots.forEach((root) => {
        initDateField(root);
        initValidation(root);
    });
}

function initDateField(root) {
    const dateField = root.querySelector('input[name="move-in-date"]');
    if (!dateField) return;

    const showPlaceholder = () => {
        if (!dateField.value) {
            dateField.type = 'text';
            dateField.placeholder = 'Move-In Date *';
        }
    };

    const showPicker = () => {
        dateField.type = 'date';
    };

    showPlaceholder();

    dateField.addEventListener('focus', showPicker);
    dateField.addEventListener('blur', showPlaceholder);
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
        if (!field.checkValidity()) {
            field.classList.add('is-invalid');
            if (errorEl) {
                if (field.value.trim() === '') {
                    errorEl.textContent = 'Please fill out this field.';
                } else if (field.type === 'email') {
                    errorEl.textContent = 'Please enter a valid email address.';
                } else if (field.name === 'phone') {
                    errorEl.textContent = 'Please enter a valid phone number.';
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
        const errorEl = radioField ? getOrCreateError(radios[0], '.c-contact-form__field--radio') : null;

        if (!isChecked) {
            if (errorEl) errorEl.textContent = 'Please fill out this field.';
            return false;
        } else {
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

    form.addEventListener('submit', (e) => {
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
            console.log('Form is valid.');
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initContactForm);
} else {
    initContactForm();
}