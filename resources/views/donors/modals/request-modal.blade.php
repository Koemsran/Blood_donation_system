<div class="modal fade" id="requestDonationModal" tabindex="-1" aria-labelledby="requestDonationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestDonationModalLabel">Request to Donate Blood</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('donations.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Hidden donor_id field with current user's donor ID -->
                    <input type="hidden" name="donor_id" value="{{ $currentUserDonor?->id ?? '' }}">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="donorBloodBank">Blood Bank</label>
                            <select class="form-select" id="donorBloodBank" name="blood_bank_id" required>
                                <option value="">Select Blood Bank</option>
                                @foreach ($bloodBanks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="donorBloodGroup">Blood Group</label>
                            <select class="form-select" id="donorBloodGroup" name="blood_group" required>
                                <x-blood-type-options :selected="old('blood_group')" placeholder="Select blood group" />
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="donorDonationDate">Donation Date</label>
                            <input type="date" class="form-control" id="donorDonationDate" name="donation_date" value="{{ old('donation_date', now()->toDateString()) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="donorVolume">Unit Volume (ml)</label>
                            <input type="number" class="form-control" id="donorVolume" name="unit_volume" min="100" max="1000" value="{{ old('unit_volume', 450) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="donorLocation">Location</label>
                            <input type="text" class="form-control" id="donorLocation" name="location" value="{{ old('location') }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="donorNotes">Notes</label>
                            <textarea class="form-control" id="donorNotes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Request Donation</button>
                </div>
            </form>
        </div>
    </div>
</div>
