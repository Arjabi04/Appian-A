/**
 * Contact Form module.
 *
 * Native <input type="date"> always shows the "dd/mm/yyyy" mask and ignores the
 * placeholder attribute, so the Figma "Move-In Date *" label can never appear.
 * To match the design we render the field as text (so the placeholder shows) and
 * swap it to a real date picker on focus, swapping back to text while it is empty.
 * CF7 still validates the field server-side as a date regardless of input type.
 */
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

        // Start as text so the placeholder is visible on load.
        showPlaceholder();

        dateField.addEventListener('focus', showPicker);
        dateField.addEventListener('blur', showPlaceholder);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initContactForm);
} else {
    initContactForm();
}

if (window.acf) {
    window.acf.addAction('render_block_preview/type=contact-form', initContactForm);
}
