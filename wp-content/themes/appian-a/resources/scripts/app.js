import.meta.glob('../images/**', {
  eager: true,
  import: 'default',
});
import * as bootstrap from 'bootstrap';
import './global/footer.js';
import './global/header.js';

const activateButtonAnimation = (e) => {
  if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;
  const btn = e.target.closest('.btn, .m-two-column__button');
  if (btn && !btn.classList.contains('has-hovered')) {
    btn.classList.add('has-hovered');
  }
};
document.addEventListener('mouseover', activateButtonAnimation);
document.addEventListener('focusin', activateButtonAnimation);
