const setupStaffFilters = () => {
    const filterForm = document.querySelector('.staff-filter-form');
    if (!filterForm) {
        return;
    }

    const searchInput = filterForm.querySelector('input[name="search"]');
    const roleSelect = filterForm.querySelector('select[name="role"]');
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

    if (roleSelect) {
        roleSelect.addEventListener('change', submitFilters);
    }
};

const setupStaffEditModal = () => {
    const editButtons = document.querySelectorAll('[data-staff-edit]');
    const editForm = document.getElementById('editStaffForm');
    const editName = document.getElementById('editStaffName');
    const editContact = document.getElementById('editStaffContact');
    const editRole = document.getElementById('editStaffRole');
    const editAssignedBank = document.getElementById('editStaffAssignedBank');

    if (!editForm || editButtons.length === 0) {
        return;
    }

    editButtons.forEach((button) => {
        button.addEventListener('click', () => {
            editForm.action = button.dataset.updateUrl || '#';
            if (editName) editName.value = button.dataset.staffName || '';
            if (editContact) editContact.value = button.dataset.staffContact || '';
            if (editRole) editRole.value = button.dataset.staffRole || '';
            if (editAssignedBank) editAssignedBank.value = button.dataset.staffAssignedBank || '';
        });
    });
};

const setupStaffPage = () => {
    setupStaffFilters();
    setupStaffEditModal();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupStaffPage);
} else {
    setupStaffPage();
}
