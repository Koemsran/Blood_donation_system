<div class="modal fade" id="createStaffProfileModal" tabindex="-1" aria-labelledby="createStaffProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="createStaffProfileForm" action="#" method="POST" novalidate>
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createStaffProfileModalLabel">Complete Staff Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-danger d-none user-modal-alert" role="alert"></div>

                    <div class="mb-3">
                        <label class="form-label">User Name</label>
                        <input type="text" class="form-control" id="staffProfileUserName" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Staff Role</label>
                        <input type="text" class="form-control" name="role" placeholder="e.g. LAB MANAGER" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact</label>
                        <input type="text" class="form-control" name="contact" id="staffProfileContact" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Assigned Blood Bank</label>
                        <select class="form-select" name="assigned_bank_id">
                            <option value="">Not Assigned</option>
                            @foreach ($bloodBanks as $bloodBank)
                                <option value="{{ $bloodBank->id }}">{{ $bloodBank->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Later</button>
                    <button type="submit" class="btn btn-danger">Save Staff Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
