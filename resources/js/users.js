import { Modal } from 'bootstrap';

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

const submitModalForm = async (form, options = {}) => {
    const { reloadOnSuccess = true } = options;
    clearValidation(form);

    if (!runClientValidation(form)) {
        return { ok: false };
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
            const contentType = response.headers.get('content-type') || '';
            const hasJson = contentType.includes('application/json');
            const payload = hasJson ? await response.json() : null;

            if (reloadOnSuccess) {
                window.location.reload();
            }

            return { ok: true, payload };
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
            return { ok: false };
        }

        setAlertError(form, 'Something went wrong. Please try again.');
        return { ok: false };
    } catch {
        setAlertError(form, 'Network error. Please check your connection and try again.');
        return { ok: false };
    }
};

const setupUserModals = () => {
    const createForm = document.getElementById('createUserForm');
    const editForm = document.getElementById('editUserForm');
    const donorProfileForm = document.getElementById('createDonorProfileForm');
    const staffProfileForm = document.getElementById('createStaffProfileForm');

    const editButtons = document.querySelectorAll('[data-user-edit]');
    const editUserIdField = document.getElementById('editUserIdField');
    const editUserName = document.getElementById('editUserName');
    const editUserEmail = document.getElementById('editUserEmail');
    const editUserRole = document.getElementById('editUserRole');

    const donorProfileUserName = document.getElementById('donorProfileUserName');
    const donorProfileContact = document.getElementById('donorProfileContact');
    const staffProfileUserName = document.getElementById('staffProfileUserName');
    const staffProfileContact = document.getElementById('staffProfileContact');

    const createModalElement = document.getElementById('createUserModal');
    const editModalElement = document.getElementById('editUserModal');
    const donorModalElement = document.getElementById('createDonorProfileModal');
    const staffModalElement = document.getElementById('createStaffProfileModal');
    const createUserModal = createModalElement ? Modal.getOrCreateInstance(createModalElement) : null;
    const editUserModal = editModalElement ? Modal.getOrCreateInstance(editModalElement) : null;
    const donorProfileModal = donorModalElement ? Modal.getOrCreateInstance(donorModalElement) : null;
    const staffProfileModal = staffModalElement ? Modal.getOrCreateInstance(staffModalElement) : null;

    const hideThen = (modalElement, modalInstance, callback) => {
        if (!modalElement || !modalInstance) {
            callback();
            return;
        }

        modalElement.addEventListener('hidden.bs.modal', callback, { once: true });
        modalInstance.hide();
    };

    const openFollowUpModal = (payload, source = 'create') => {
        if (!payload || !payload.user || !payload.next_step) {
            window.location.reload();
            return;
        }

        const sourceModalElement = source === 'edit' ? editModalElement : createModalElement;
        const sourceModal = source === 'edit' ? editUserModal : createUserModal;

        if (payload.next_step === 'donor_profile' && donorProfileForm && donorProfileModal) {
            donorProfileForm.action = `/users/${payload.user.id}/donor-profile`;
            donorProfileForm.reset();
            clearValidation(donorProfileForm);
            if (donorProfileUserName) donorProfileUserName.value = payload.user.name || '';
            if (donorProfileContact) donorProfileContact.value = payload.user.email || '';
            hideThen(sourceModalElement, sourceModal, () => donorProfileModal.show());
            return;
        }

        if (payload.next_step === 'staff_profile' && staffProfileForm && staffProfileModal) {
            staffProfileForm.action = `/users/${payload.user.id}/staff-profile`;
            staffProfileForm.reset();
            clearValidation(staffProfileForm);
            if (staffProfileUserName) staffProfileUserName.value = payload.user.name || '';
            if (staffProfileContact) staffProfileContact.value = payload.user.email || '';
            hideThen(sourceModalElement, sourceModal, () => staffProfileModal.show());
            return;
        }

        window.location.reload();
    };

    if (createForm) {
        createForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const result = await submitModalForm(createForm, { reloadOnSuccess: false });
            if (result?.ok) {
                openFollowUpModal(result.payload);
            }
        });
    }

    if (editForm) {
        editForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const result = await submitModalForm(editForm, { reloadOnSuccess: false });
            if (result?.ok) {
                openFollowUpModal(result.payload, 'edit');
            }
        });
    }

    if (donorProfileForm) {
        donorProfileForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            await submitModalForm(donorProfileForm);
        });
    }

    if (staffProfileForm) {
        staffProfileForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            await submitModalForm(staffProfileForm);
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
                if (editUserRole) editUserRole.value = button.dataset.userRole || 'donor';
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
