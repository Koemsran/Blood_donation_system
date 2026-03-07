<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="createUserForm" action="{{ route('users.store') }}" method="POST" novalidate>
                @csrf
                <input type="hidden" name="modal_form" value="create">

                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-danger d-none user-modal-alert" role="alert"></div>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('modal_form') === 'create' ? old('name') : '' }}" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('modal_form') === 'create' ? old('email') : '' }}" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" required>
                            <option value="user" {{ old('modal_form') === 'create' && old('role') === 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('modal_form') === 'create' && old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" minlength="6" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" minlength="6" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>
