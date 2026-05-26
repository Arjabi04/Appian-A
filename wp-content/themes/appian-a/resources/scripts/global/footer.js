function getFooterEmailError(value, options = {}) {
  const email = (value || '').trim();
  const showRequired = Boolean(options.showRequired);

  if (!email) return showRequired ? 'Email is required.' : '';
  if (email.length > 254) return 'Email must be 254 characters or less.';

  const firstAt = email.indexOf('@');
  if (firstAt === -1) {
    if (email.length > 64) return 'Email local part (before @) must be 64 characters or less.';
    return 'Email must include an "@" symbol.';
  }

  if (email.indexOf('@', firstAt + 1) !== -1) {
    return 'Email must contain a single "@" symbol.';
  }

  const localPart = email.slice(0, firstAt);
  const domainPart = email.slice(firstAt + 1);

  if (!localPart) return 'Email must include text before "@".';
  if (!domainPart) return 'Email must include a domain after "@".';

  if (localPart.length > 64) return 'Email local part (before @) must be 64 characters or less.';
  if (domainPart.length > 189) return 'Email domain (after @) must be 189 characters or less.';

  return '';
}

function getFooterEmailDomainLengthError(value) {
  const email = (value || '').trim();
  if (!email) return '';

  const firstAt = email.indexOf('@');
  if (firstAt === -1) return '';
  if (email.indexOf('@', firstAt + 1) !== -1) return '';

  const domainPart = email.slice(firstAt + 1);
  if (!domainPart) return '';

  return domainPart.length > 189 ? 'Email domain (after @) must be 189 characters or less.' : '';
}

function enforceEmailLengthLimit(rawValue) {
  const value = rawValue || '';

  if (value.length > 254) return value.slice(0, 254);

  const atIndex = value.indexOf('@');
  if (atIndex === -1) {
    return value.length > 64 ? value.slice(0, 64) : value;
  }

  const localPart = value.slice(0, atIndex);
  const domainPart = value.slice(atIndex + 1);

  const cappedLocal = localPart.length > 64 ? localPart.slice(0, 64) : localPart;
  const cappedDomain = domainPart;

  let rebuilt = `${cappedLocal}@${cappedDomain}`;
  if (rebuilt.length > 254) rebuilt = rebuilt.slice(0, 254);

  return rebuilt;
}

function getTruncationMessage(originalValue) {
  const value = originalValue || '';
  if (!value) return '';

  if (value.length > 254) {
    return 'Email max length is 254 characters.';
  }

  const atIndex = value.indexOf('@');
  if (atIndex === -1) {
    if (value.length > 64) return 'Email local part (before @) max is 64 characters.';
    return '';
  }

  const localPart = value.slice(0, atIndex);
  const domainPart = value.slice(atIndex + 1);

  if (localPart.length > 64) return 'Email local part (before @) max is 64 characters.';
  if (domainPart.length > 189) return 'Email domain (after @) max is 189 characters.';

  return '';
}

function logEmptyEmailSubmit(form) {
  const url = form?.dataset?.footerAjaxUrl;
  if (!url) return;

  const data = new FormData();
  data.append('action', 'appian_footer_email_empty');
  data.append('nonce', form.dataset.footerAjaxNonce || '');

  if (typeof navigator !== 'undefined' && typeof navigator.sendBeacon === 'function') {
    const ok = navigator.sendBeacon(url, data);
    if (ok) return;
  }

  fetch(url, {
    method: 'POST',
    body: data,
    credentials: 'same-origin',
  }).catch(() => {});
}

function initFooterEmailValidation() {
  const forms = document.querySelectorAll('.site-footer__form');
  if (!forms.length) return;

  forms.forEach((form) => {
    const input = form.querySelector('#footer-email');
    const errorEl = form.querySelector('[data-footer-email-error]');
    if (!input) return;

    let hasSubmitted = false;
    let lastTruncationMessage = '';

    const render = (message) => {
      const effectiveMessage = message || lastTruncationMessage;
      if (!hasSubmitted) {
        if (errorEl) errorEl.textContent = effectiveMessage || '';
        input.setAttribute('aria-invalid', effectiveMessage ? 'true' : 'false');
        return;
      }
      if (errorEl) errorEl.textContent = effectiveMessage || '';
      input.setAttribute('aria-invalid', effectiveMessage ? 'true' : 'false');
    };

    const validate = (options) => {
      const message = getFooterEmailError(input.value, options);
      render(message);
      return !message;
    };

    input.addEventListener('input', () => {
      const original = input.value;
      const enforced = enforceEmailLengthLimit(original);
      lastTruncationMessage = '';

      if (enforced !== original) {
        lastTruncationMessage = getTruncationMessage(original) || 'Email is too long.';
        const cursor = input.selectionStart;
        input.value = enforced;
        if (typeof cursor === 'number') {
          const nextCursor = Math.min(cursor, enforced.length);
          input.setSelectionRange(nextCursor, nextCursor);
        }
      }
      if (hasSubmitted) {
        validate({ showRequired: true });
      } else {
        const domainLengthError = getFooterEmailDomainLengthError(input.value);
        render(domainLengthError);
      }
    });

    input.addEventListener('blur', () => {
      if (hasSubmitted) {
        validate({ showRequired: true });
      }
    });

    form.addEventListener('submit', (e) => {
      hasSubmitted = true;
      const ok = validate({ showRequired: true });
      if (!ok) {
        e.preventDefault();
        input.focus();
        if (!input.value.trim()) logEmptyEmailSubmit(form);
      }
    });
  });
}

initFooterEmailValidation();
