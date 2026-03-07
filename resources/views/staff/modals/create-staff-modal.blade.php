<div class="modal fade" id="createStaffModal" tabindex="-1" aria-labelledby="createStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('staff.store') }}" method="POST">
                @csrf
                <input type="hidden" name="modal_form" value="create">

                <div class="modal-header">
                    <h5 class="modal-title" id="createStaffModalLabel">Add New Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('modal_form') === 'create' ? old('name') : '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact (Email/Phone)</label>
                        <input type="text" class="form-control" name="contact" value="{{ old('modal_form') === 'create' ? old('contact') : '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" name="role" value="{{ old('modal_form') === 'create' ? old('role') : '' }}" placeholder="e.g. LAB MANAGER" required>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Assigned Blood Bank</label>
                        <select class="form-select" name="assigned_bank_id">
                            <option value="">Not Assigned</option>
                            @foreach ($bloodBanks as $bloodBank)
                                <option value="{{ $bloodBank->id }}" {{ old('modal_form') === 'create' && old('assigned_bank_id') == $bloodBank->id ? 'selected' : '' }}>
                                    {{ $bloodBank->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Create Staff</button>
                </div>
            </form>
        </div>
    </div>
</div>
