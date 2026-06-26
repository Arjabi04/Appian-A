import.meta.glob('../images/**', {
  eager: true,
  import: 'default',
});
import * as bootstrap from 'bootstrap';
import './global/footer.js';
import './global/header.js';
import { initImageAnimations, initLazyLoadImages } from './utils/images.js';

const activateButtonAnimation = (e) => {
  if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;
  const btn = e.target.closest('.btn, .m-two-column__button, .m-two-column__card');
  if (btn && !btn.classList.contains('has-hovered')) {
    btn.classList.add('has-hovered');
  }
};
document.addEventListener('mouseover', activateButtonAnimation);
document.addEventListener('focusin', activateButtonAnimation);

const initImageObservers = () => {
  initLazyLoadImages();
  initImageAnimations();
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initImageObservers, { once: true });
} else {
  initImageObservers();
}

document.addEventListener('click', (e) => {
  const btn = e.target.closest('.btn');
  if (btn) {
    btn.classList.add('is-clicked');
  }
});

document.addEventListener('mouseout', (e) => {
  const btn = e.target.closest('.btn');
  if (btn && !btn.contains(e.relatedTarget)) {
    btn.classList.remove('is-clicked');
  }
});

window.addEventListener('pageshow', () => {
  document.querySelectorAll('.btn').forEach((btn) => {
    btn.classList.remove('is-clicked');
  });
});
