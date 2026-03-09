<div class="modal fade" id="editDonorModal" tabindex="-1" aria-labelledby="editDonorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editDonorForm" action="#" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editDonorModalLabel">Edit Donor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" id="editDonorName" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="editDonorDateOfBirth" name="date_of_birth" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Blood Type</label>
                        <select class="form-select" id="editDonorBloodType" name="blood_type" required>
                            <x-blood-type-options />
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact</label>
                        <input type="text" class="form-control" id="editDonorContact" name="contact" required>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Last Donation Date</label>
                        <input type="date" class="form-control" id="editDonorLastDonation" name="last_donation_date">
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
