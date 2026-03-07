const setupDonorFilters = () => {
    const filterForm = document.querySelector('.donor-filter-form');
    if (!filterForm) {
        return;
    }

    const searchInput = filterForm.querySelector('input[name="search"]');
    const bloodTypeSelect = filterForm.querySelector('select[name="blood_type"]');
    const statusSelect = filterForm.querySelector('select[name="status"]');

    let lastSubmittedSearch = searchInput ? searchInput.value.trim() : '';

    const submitFilters = () => {
        filterForm.requestSubmit();
    };

    if (searchInput) {
        searchInput.addEventListener('keydown', (event) => {
            if (event.key !== 'Enter') {
                return;
            }

            event.preventDefault();
            const currentValue = searchInput.value.trim();
            if (currentValue === lastSubmittedSearch) {
                return;
            }

            lastSubmittedSearch = currentValue;
            submitFilters();
        });

        searchInput.addEventListener('blur', () => {
            const currentValue = searchInput.value.trim();
            if (currentValue === lastSubmittedSearch) {
                return;
            }

            lastSubmittedSearch = currentValue;
            submitFilters();
        });
    }

    if (bloodTypeSelect) {
        bloodTypeSelect.addEventListener('change', submitFilters);
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', submitFilters);
    }
};

const setupDonorEditModal = () => {
    const editButtons = document.querySelectorAll('[data-donor-edit]');
    const editForm = document.getElementById('editDonorForm');
    const editName = document.getElementById('editDonorName');
    const editAge = document.getElementById('editDonorAge');
    const editBloodType = document.getElementById('editDonorBloodType');
    const editContact = document.getElementById('editDonorContact');
    const editLastDonation = document.getElementById('editDonorLastDonation');

    if (!editForm || editButtons.length === 0) {
        return;
    }

    editButtons.forEach((button) => {
        button.addEventListener('click', () => {
            editForm.action = button.dataset.updateUrl || '#';
            if (editName) editName.value = button.dataset.donorName || '';
            if (editAge) editAge.value = button.dataset.donorAge || '';
            if (editBloodType) editBloodType.value = button.dataset.donorBloodType || '';
            if (editContact) editContact.value = button.dataset.donorContact || '';
            if (editLastDonation) editLastDonation.value = button.dataset.donorLastDonation || '';
        });
    });
};

const setupDonorPage = () => {
    setupDonorFilters();
    setupDonorEditModal();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupDonorPage);
} else {
    setupDonorPage();
}
