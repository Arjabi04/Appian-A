import '../styles/editor.scss';

const testimonialThemeColors = {
  'primary-red': '#d72027',
  'light-red': '#f3babc',
  'ultra-light-red': '#fbe9e9',
};

const testimonialThemeFields = ['background_theme', 'arrow_theme'];

const renderTestimonialThemePreviews = (root = document) => {
  testimonialThemeFields.forEach((fieldName) => {
    root.querySelectorAll(`.acf-field[data-name="${fieldName}"]`).forEach((field) => {
      const select = field.querySelector('select');
      const input = field.querySelector('.acf-input');

      if (!select || !input) return;

      field.classList.add('appian-acf-color-field');

      let preview = input.querySelector('.appian-acf-color-preview');
      if (!preview) {
        preview = document.createElement('div');
        preview.className = 'appian-acf-color-preview';
        preview.innerHTML = '<span class="appian-acf-color-swatch"></span><span class="appian-acf-color-value"></span>';
        input.appendChild(preview);
      }

      const swatch = preview.querySelector('.appian-acf-color-swatch');
      const value = preview.querySelector('.appian-acf-color-value');
      const selectedColor = testimonialThemeColors[select.value] || 'transparent';
      const selectedLabel = select.options[select.selectedIndex]?.text || '';

      swatch.style.backgroundColor = selectedColor;
      value.textContent = selectedLabel;
    });
  });
};

const initTestimonialThemePreviews = () => {
  renderTestimonialThemePreviews(document);

  document.addEventListener('change', (event) => {
    if (!event.target.matches('.acf-field[data-name="background_theme"] select, .acf-field[data-name="arrow_theme"] select')) {
      return;
    }

    renderTestimonialThemePreviews(document);
  });

  if (window.acf) {
    window.acf.addAction('ready', ($el) => renderTestimonialThemePreviews($el?.[0] || document));
    window.acf.addAction('append', ($el) => renderTestimonialThemePreviews($el?.[0] || document));
  }
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initTestimonialThemePreviews, { once: true });
} else {
  initTestimonialThemePreviews();
}
