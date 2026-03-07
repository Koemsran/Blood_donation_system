<div class="modal fade" id="createHospitalModal" tabindex="-1" aria-labelledby="createHospitalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('hospitals.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createHospitalModalLabel">Add New Hospital</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Hospital Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" name="location" required>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Primary Contact</label>
                        <input type="text" class="form-control" name="contact" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Create Hospital</button>
                </div>
            </form>
        </div>
    </div>
</div>
