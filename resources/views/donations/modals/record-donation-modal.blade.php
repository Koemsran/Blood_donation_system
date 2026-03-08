<div class="modal fade" id="recordDonationModal" tabindex="-1" aria-labelledby="recordDonationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recordDonationModalLabel">Record Blood Donation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('donations.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="donationDonor">Donor</label>
                            <select class="form-select" id="donationDonor" name="donor_id" required>
                                <option value="">Select donor</option>
                                @foreach ($donors as $donor)
                                    <option value="{{ $donor->id }}" {{ old('donor_id') == $donor->id ? 'selected' : '' }}>
                                        {{ $donor->name }} ({{ strtoupper($donor->blood_type) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="donationBloodGroup">Blood Group</label>
                            <select class="form-select" id="donationBloodGroup" name="blood_group" required>
                                <x-blood-type-options :selected="old('blood_group')" placeholder="Select blood group" />
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="donationDate">Donation Date</label>
                            <input type="date" class="form-control" id="donationDate" name="donation_date" value="{{ old('donation_date', now()->toDateString()) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="donationVolume">Unit Volume (ml)</label>
                            <input type="number" class="form-control" id="donationVolume" name="unit_volume" min="100" max="1000" value="{{ old('unit_volume', 450) }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="donationLocation">Location</label>
                            <input type="text" class="form-control" id="donationLocation" name="location" value="{{ old('location') }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="donationNotes">Notes</label>
                            <textarea class="form-control" id="donationNotes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Save Donation</button>
                </div>
            </form>
        </div>
    </div>
</div>
