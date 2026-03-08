<div class="modal fade" id="createDonorProfileModal" tabindex="-1" aria-labelledby="createDonorProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="createDonorProfileForm" action="#" method="POST" novalidate>
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createDonorProfileModalLabel">Complete Donor Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-danger d-none user-modal-alert" role="alert"></div>

                    <div class="mb-3">
                        <label class="form-label">User Name</label>
                        <input type="text" class="form-control" id="donorProfileUserName" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Age</label>
                        <input type="number" class="form-control" name="age" min="18" max="65" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Blood Type</label>
                        <select class="form-select" name="blood_type" required>
                            <x-blood-type-options />
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact</label>
                        <input type="text" class="form-control" name="contact" id="donorProfileContact" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Last Donation Date</label>
                        <input type="date" class="form-control" name="last_donation_date">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Later</button>
                    <button type="submit" class="btn btn-danger">Save Donor Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
