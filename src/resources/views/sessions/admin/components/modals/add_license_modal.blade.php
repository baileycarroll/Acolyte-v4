<div class="modal fade" id="addLicenseModal" tabindex="-1" aria-labelledby="addLicenseModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/add_license" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Add License</h4>

                    <label for="add_license_name">License Name:</label>
                    <input type="text" name="license_name" id="add_license_name" class="form-control mb-2" required>

                    <label for="license_description">License Description:</label>
                    <input type="text" name="license_description" id="license_description" class="form-control mb-2" required>

                    <label for="stripe_api_id">Stripe API ID:</label>
                    <input type="text" name="stripe_api_id" id="stripe_api_id" class="form-control mb-2" required>

                    <label for="license_price">License Price:</label>
                    <input type="number" name="license_price" id="license_price" class="form-control mb-2" step="0.01" required>

                    <div class="form-check form-switch">
                        <input type="checkbox" name="license_trial" id="license_trial" class="form-check-input" role="switch">
                        <label class="form-check-label" for="license_trial">Trial License?</label>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="license_admin" id="license_admin" class="form-check-input" role="switch">
                        <label class="form-check-label" for="license_admin">Admin License</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
