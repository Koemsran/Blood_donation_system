<div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStockModalLabel">Update Stock Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editStockForm" action="#" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="editStockBankId" class="form-label">Blood Bank</label>
                            <select id="editStockBankId" name="blood_bank_id" class="form-select" required>
                                <option value="">Select blood bank</option>
                                @foreach ($bloodBanks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="editStockBloodType" class="form-label">Blood Type</label>
                            <input id="editStockBloodType" name="blood_type" class="form-control" required />
                        </div>

                        <div class="col-md-6">
                            <label for="editStockQuantity" class="form-label">Quantity</label>
                            <input id="editStockQuantity" name="quantity" type="number" min="1" class="form-control" required />
                        </div>

                        <div class="col-md-6">
                            <label for="editStockExpiryDate" class="form-label">Expiry Date</label>
                            <input id="editStockExpiryDate" name="expiry_date" type="date" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Update Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>
