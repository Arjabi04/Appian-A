// Validate the footer email value and return an error message string.

// Trims trailing whitespace and rejects internal whitespace.
function getFooterEmailError(value, options = {}) {
  const rawEmail = value || '';
  const email = rawEmail.trim();
  const showRequired = Boolean(options.showRequired);

  if (!email) return showRequired ? 'Email is required.' : '';
  if (/\s/.test(rawEmail)) return 'Email must not contain whitespace.';
  if (email.length > 254) return 'Email must be 254 characters or less.';

  // email validation: only one @ symbol allowed
  // word limit before @
  const firstAt = email.indexOf('@');
  if (firstAt === -1) {
    if (email.length > 64) return 'Email local part (before @) must be 64 characters or less.';
    return 'Email must include an "@" symbol.';
  }

  // word limit after @
  const localPart = email.slice(0, firstAt);
  const domainPart = email.slice(firstAt + 1);

  if (!localPart) return 'Email must include text before "@".';
  if (!domainPart) return 'Email must include a domain after "@".';

  if (localPart.length > 64) return 'Email local part (before @) must be 64 characters or less.';
  if (domainPart.length > 189) return 'Email domain (after @) must be 189 characters or less.';

  return '';
}

// Check only the domain length portion of the email (after @).
function getFooterEmailDomainLengthError(value) {
  const rawEmail = value || '';
  const email = rawEmail.trim();
  if (!email) return '';
  // Reject any whitespace characters anywhere in the raw input.
  if (/\s/.test(rawEmail)) return 'Email must not contain whitespace.';

  const firstAt = email.indexOf('@');
  if (firstAt === -1) return '';
  if (email.indexOf('@', firstAt + 1) !== -1) return '';

  const domainPart = email.slice(firstAt + 1);
  if (!domainPart) return '';

  return domainPart.length > 189 ? 'Email domain (after @) must be 189 characters or less.' : '';
}

// Enforce maximum lengths for the full email and its local part.
// Does not alter internal whitespace handling — that is validated elsewhere.
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

// Return a human-friendly message explaining why truncation happened.
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

// Log an event when the user submits an empty footer email (server-side hook).
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

// Initialize footer email input validation for all footer forms on the page.
function initFooterEmailValidation() {
  const forms = document.querySelectorAll('.site-footer__form');
  if (!forms.length) return;

  forms.forEach((form) => {
    const input = form.querySelector('#footer-email');
    const errorEl = form.querySelector('[data-footer-email-error]');
    const submitBtn = form.querySelector('[type="submit"]');
    if (!input) return;

    let hasSubmitted = false;
    let isSubscribed = false;
    let lastTruncationMessage = '';

    // Render validation messages and set ARIA state on the input.
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

    // Keep input responsive: enforce length limits and update message.
    input.addEventListener('input', () => {
      if (isSubscribed) return;
      const original = input.value;
      const enforced = enforceEmailLengthLimit(original);
      lastTruncationMessage = '';

      if (enforced !== original) {
        // If we had to truncate, show a truncation message and restore cursor.
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
      if (isSubscribed) return;
      if (hasSubmitted) {
        validate({ showRequired: true });
      }
    });

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (isSubscribed) return;

      hasSubmitted = true;
      const ok = validate({ showRequired: true });
      if (!ok) {
        input.focus();
        if (!input.value.trim()) logEmptyEmailSubmit(form);
        return;
      }

      const data = new FormData(form);
      data.append('action', 'submit_newsletter_subscription');

      const response = await fetch(form.dataset.footerAjaxUrl || '/wp-admin/admin-ajax.php', {
        method: 'POST',
        body: data,
        credentials: 'same-origin',
      });

      if (!response.ok) {
        if (errorEl) errorEl.textContent = 'Please try again.';
        return;
      }

      isSubscribed = true;
      lastTruncationMessage = '';
      if (errorEl) errorEl.textContent = 'THANK YOU FOR SUBSCRIPTION';
      input.setAttribute('aria-invalid', 'false');
      input.value = '';
      input.disabled = true;
      if (submitBtn) submitBtn.disabled = true;
    });
  });
}

initFooterEmailValidation();
