<div class="modal fade" id="createDonorModal" tabindex="-1" aria-labelledby="createDonorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('donors.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createDonorModalLabel">Add New Donor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Age</label>
                        <input type="number" class="form-control" name="age" min="18" max="65" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Blood Type</label>
                        <select class="form-select" name="blood_type" required>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact</label>
                        <input type="text" class="form-control" name="contact" required>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Last Donation Date</label>
                        <input type="date" class="form-control" name="last_donation_date">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Create Donor</button>
                </div>
            </form>
        </div>
    </div>
</div>
