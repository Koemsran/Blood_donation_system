<div class="modal fade" id="createStockModal" tabindex="-1" aria-labelledby="createStockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createStockModalLabel">Add Stock Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('inventory.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="stockBankId" class="form-label">Blood Bank</label>
                            <select id="stockBankId" name="blood_bank_id" class="form-select" required>
                                <option value="">Select blood bank</option>
                                @foreach ($bloodBanks as $bank)
                                    <option value="{{ $bank->id }}" {{ old('blood_bank_id') == $bank->id ? 'selected' : '' }}>{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="stockBloodType" class="form-label">Blood Type</label>
                            <input id="stockBloodType" name="blood_type" class="form-control" value="{{ old('blood_type') }}" placeholder="e.g. O+" required />
                        </div>

                        <div class="col-md-6">
                            <label for="stockQuantity" class="form-label">Quantity</label>
                            <input id="stockQuantity" name="quantity" type="number" min="1" class="form-control" value="{{ old('quantity', 1) }}" required />
                        </div>

                        <div class="col-md-6">
                            <label for="stockExpiryDate" class="form-label">Expiry Date</label>
                            <input id="stockExpiryDate" name="expiry_date" type="date" class="form-control" value="{{ old('expiry_date') }}" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Save Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>
