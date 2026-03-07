const setupHospitalFilters = () => {
    const filterForm = document.querySelector('.hospitals-filter-form');
    if (!filterForm) {
        return;
    }

    const searchInput = filterForm.querySelector('input[name="search"]');
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

    if (statusSelect) {
        statusSelect.addEventListener('change', submitFilters);
    }
};

const setupHospitalEditModal = () => {
    const editButtons = document.querySelectorAll('[data-hospital-edit]');
    const editForm = document.getElementById('editHospitalForm');
    const editName = document.getElementById('editHospitalName');
    const editLocation = document.getElementById('editHospitalLocation');
    const editContact = document.getElementById('editHospitalContact');

    if (!editForm || editButtons.length === 0) {
        return;
    }

    editButtons.forEach((button) => {
        button.addEventListener('click', () => {
            editForm.action = button.dataset.updateUrl || '#';
            if (editName) editName.value = button.dataset.hospitalName || '';
            if (editLocation) editLocation.value = button.dataset.hospitalLocation || '';
            if (editContact) editContact.value = button.dataset.hospitalContact || '';
        });
    });
};

const setupHospitalPage = () => {
    setupHospitalFilters();
    setupHospitalEditModal();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupHospitalPage);
} else {
    setupHospitalPage();
}
