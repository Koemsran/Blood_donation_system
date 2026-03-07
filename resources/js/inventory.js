const setupInventorySearch = () => {
    const searchForm = document.querySelector('.inventory-search-form');
    if (!searchForm) {
        return;
    }

    const searchInput = searchForm.querySelector('input[name="search"]');
    if (!searchInput) {
        return;
    }

    let lastValue = searchInput.value.trim();

    searchInput.addEventListener('keydown', (event) => {
        if (event.key !== 'Enter') {
            return;
        }

        event.preventDefault();
        const currentValue = searchInput.value.trim();
        if (currentValue === lastValue) {
            return;
        }

        lastValue = currentValue;
        searchForm.requestSubmit();
    });

    searchInput.addEventListener('blur', () => {
        const currentValue = searchInput.value.trim();
        if (currentValue === lastValue) {
            return;
        }

        lastValue = currentValue;
        searchForm.requestSubmit();
    });
};

const setupInventoryEditModal = () => {
    const editButtons = document.querySelectorAll('[data-stock-edit]');
    const editForm = document.getElementById('editStockForm');

    if (!editForm || editButtons.length === 0) {
        return;
    }

    const bankIdInput = document.getElementById('editStockBankId');
    const bloodTypeInput = document.getElementById('editStockBloodType');
    const quantityInput = document.getElementById('editStockQuantity');
    const expiryDateInput = document.getElementById('editStockExpiryDate');

    editButtons.forEach((button) => {
        button.addEventListener('click', () => {
            editForm.action = button.dataset.updateUrl || '#';
            if (bankIdInput) bankIdInput.value = button.dataset.stockBankId || '';
            if (bloodTypeInput) bloodTypeInput.value = button.dataset.stockBloodType || '';
            if (quantityInput) quantityInput.value = button.dataset.stockQuantity || '';
            if (expiryDateInput) expiryDateInput.value = button.dataset.stockExpiryDate || '';
        });
    });
};

const setupInventoryPage = () => {
    setupInventorySearch();
    setupInventoryEditModal();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupInventoryPage);
} else {
    setupInventoryPage();
}
