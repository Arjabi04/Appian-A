document.addEventListener('click', (e) => {
    const button = e.target.closest('.m-two-column__button');
    if (button) {
        button.classList.add('is-clicked');
    }
});

window.addEventListener('pageshow', () => {
    document.querySelectorAll('.m-two-column__button').forEach(button => {
        button.classList.remove('is-clicked');
    });
});
