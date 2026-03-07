const clearValidation = (form) => {
    const alertBox = form.querySelector('.user-modal-alert');
    if (alertBox) {
        alertBox.classList.add('d-none');
        alertBox.textContent = '';
    }

    form.querySelectorAll('.is-invalid').forEach((field) => {
        field.classList.remove('is-invalid');
    });

    form.querySelectorAll('.invalid-feedback').forEach((feedback) => {
        feedback.textContent = '';
    });
};

const setFieldError = (form, fieldName, message) => {
    const field = form.querySelector(`[name="${fieldName}"]`);
    if (!field) {
        return;
    }

    field.classList.add('is-invalid');
    const feedback = field.parentElement?.querySelector('.invalid-feedback');
    if (feedback) {
        feedback.textContent = message;
    }
};

const setAlertError = (form, message) => {
    const alertBox = form.querySelector('.user-modal-alert');
    if (!alertBox) {
        return;
    }

    alertBox.textContent = message;
    alertBox.classList.remove('d-none');
};

const runClientValidation = (form) => {
    let valid = true;
    const formData = new FormData(form);

    form.querySelectorAll('input, select').forEach((field) => {
        if (typeof field.checkValidity === 'function' && !field.checkValidity()) {
            valid = false;
            setFieldError(form, field.name, field.validationMessage || 'This field is required.');
        }
    });

    const password = formData.get('password');
    const confirmPassword = formData.get('password_confirmation');
    if (password !== null && confirmPassword !== null && password !== confirmPassword) {
        valid = false;
        setFieldError(form, 'password_confirmation', 'Password confirmation does not match.');
    }

    if (!valid) {
        setAlertError(form, 'Please correct the highlighted fields.');
    }

    return valid;
};

const submitModalForm = async (form) => {
    clearValidation(form);

    if (!runClientValidation(form)) {
        return;
    }

    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        });

        if (response.ok) {
            window.location.reload();
            return;
        }

        if (response.status === 422) {
            const data = await response.json();
            const errors = data?.errors || {};

            Object.entries(errors).forEach(([field, messages]) => {
                if (Array.isArray(messages) && messages.length > 0) {
                    setFieldError(form, field, messages[0]);
                }
            });

            setAlertError(form, data?.message || 'Please correct the highlighted fields.');
            return;
        }

        setAlertError(form, 'Something went wrong. Please try again.');
    } catch {
        setAlertError(form, 'Network error. Please check your connection and try again.');
    }
};

const setupUserModals = () => {
    const createForm = document.getElementById('createUserForm');
    const editForm = document.getElementById('editUserForm');

    const editButtons = document.querySelectorAll('[data-user-edit]');
    const editUserIdField = document.getElementById('editUserIdField');
    const editUserName = document.getElementById('editUserName');
    const editUserEmail = document.getElementById('editUserEmail');
    const editUserRole = document.getElementById('editUserRole');

    if (createForm) {
        createForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            await submitModalForm(createForm);
        });
    }

    if (editForm) {
        editForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            await submitModalForm(editForm);
        });
    }

    if (editButtons.length > 0 && editForm) {
        editButtons.forEach((button) => {
            button.addEventListener('click', () => {
                clearValidation(editForm);
                editForm.action = button.dataset.updateUrl || '#';
                if (editUserIdField) editUserIdField.value = button.dataset.userId || '';
                if (editUserName) editUserName.value = button.dataset.userName || '';
                if (editUserEmail) editUserEmail.value = button.dataset.userEmail || '';
                if (editUserRole) editUserRole.value = button.dataset.userRole || 'user';
            });
        });
    }
};

const setupUserFilters = () => {
    const filterForm = document.querySelector('.users-filter-card');
    if (!filterForm) {
        return;
    }

    const searchInput = filterForm.querySelector('input[name="search"]');
    const roleSelect = filterForm.querySelector('select[name="role"]');
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

    if (roleSelect) {
        roleSelect.addEventListener('change', submitFilters);
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', submitFilters);
    }
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        setupUserModals();
        setupUserFilters();
    });
} else {
    setupUserModals();
    setupUserFilters();
}
