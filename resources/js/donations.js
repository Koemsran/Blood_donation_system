const setupDonationSearch = () => {
    const form = document.querySelector('.donations-search-form');
    if (!form) {
        return;
    }

    const input = form.querySelector('input[name="search"]');
    if (!input) {
        return;
    }

    let lastValue = input.value.trim();

    input.addEventListener('keydown', (event) => {
        if (event.key !== 'Enter') {
            return;
        }

        event.preventDefault();
        const current = input.value.trim();
        if (current === lastValue) {
            return;
        }

        lastValue = current;
        form.requestSubmit();
    });

    input.addEventListener('blur', () => {
        const current = input.value.trim();
        if (current === lastValue) {
            return;
        }

        lastValue = current;
        form.requestSubmit();
    });
};

const setupDonationsPage = () => {
    setupDonationSearch();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupDonationsPage);
} else {
    setupDonationsPage();
}
