function initContactForm() {
    const roots = document.querySelectorAll('.c-contact-form');
    roots.forEach((root) => {
        const dateField = root.querySelector('input.wpcf7-date');
        if (!dateField || dateField.dataset.dateSwapBound) return;

        dateField.dataset.dateSwapBound = 'true';

        const showPlaceholder = () => {
            if (!dateField.value) dateField.type = 'text';
        };
        const showPicker = () => {
            dateField.type = 'date';
        };
        showPlaceholder();
        dateField.addEventListener('focus', showPicker);
        dateField.addEventListener('blur', showPlaceholder);
    });
}

function onCf7MailSent(event) {
    const root = event.target.closest('.c-contact-form');
    if (!root) return;
    const dateField = root.querySelector('input.wpcf7-date');
    if (!dateField) return;
    delete dateField.dataset.dateSwapBound;
    initContactForm();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initContactForm);
} else {
    initContactForm();
}

document.addEventListener('wpcf7mailsent', onCf7MailSent);

if (window.acf) {
    window.acf.addAction('render_block_preview/type=contact-form', initContactForm);
}