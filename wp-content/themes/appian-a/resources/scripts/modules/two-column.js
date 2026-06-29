document.addEventListener('click', (e) => {
    const card = e.target.closest('.m-two-column__card');
    if (card) {
        const selection = window.getSelection();
        if (selection && selection.toString().trim() !== '') {
            e.preventDefault();
            return;
        }

        card.classList.add('is-clicked');
        const button = card.querySelector('.m-two-column__button');
        if (button) {
            button.classList.add('is-clicked');
        }
    }
});
document.addEventListener('mouseout', (e) => {
    const card = e.target.closest('.m-two-column__card');
    if (card && !card.contains(e.relatedTarget)) {
        card.classList.remove('is-clicked');
        const button = card.querySelector('.m-two-column__button');
        if (button) {
            button.classList.remove('is-clicked');
        }
    }
});

document.addEventListener('focusin', (e) => {
    const card = e.target.closest('.m-two-column__card');
    if (card && card.matches(':focus-visible')) {
        card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
});

window.addEventListener('pageshow', () => {
    document.querySelectorAll('.m-two-column__card, .m-two-column__button').forEach(el => {
        el.classList.remove('is-clicked');
    });
});
