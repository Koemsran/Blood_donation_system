<div class="modal fade" id="editStaffModal" tabindex="-1" aria-labelledby="editStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editStaffForm" action="#" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="modal_form" value="edit">

                <div class="modal-header">
                    <h5 class="modal-title" id="editStaffModalLabel">Edit Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" id="editStaffName" name="name" value="{{ old('modal_form') === 'edit' ? old('name') : '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact (Email/Phone)</label>
                        <input type="text" class="form-control" id="editStaffContact" name="contact" value="{{ old('modal_form') === 'edit' ? old('contact') : '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" id="editStaffRole" name="role" value="{{ old('modal_form') === 'edit' ? old('role') : '' }}" required>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Assigned Blood Bank</label>
                        <select class="form-select" id="editStaffAssignedBank" name="assigned_bank_id">
                            <option value="">Not Assigned</option>
                            @foreach ($bloodBanks as $bloodBank)
                                <option value="{{ $bloodBank->id }}">{{ $bloodBank->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
