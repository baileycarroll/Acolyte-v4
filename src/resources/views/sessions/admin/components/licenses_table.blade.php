<div class="card mt-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="align-self-start">
                <div class="input-group">
                    <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addLicenseModal">Add License</button>
                </div>
            </div>
            <div class="align-self-end w-50">
                <div class="form-outline">
                    <input type="search" name="license_search" id="license_search" class="form-control rounded" placeholder="Search Licenses" aria-label="Search Licenses">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col table-responsive">
                <div id="licenses-datatable" data-mdb-loading="true"></div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load", (e) => {
        getLicenses();
    });
    // Awards Table
    window.getLicenses = function() {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Name', field: 'name'},
            {label: 'Description', field: 'description'},
            {label: 'Stripe API ID', field: 'stripe_api_id'},
            {label: 'Price', field: 'price'},
            {label: 'Trial License?', field: 'trial'},
            {label: 'Admin License?', field: 'admin'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('licenses-datatable'),
            { columns,}
        );
        fetch('/api/getLicenses')
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            actions: `
                            <a href="/licenses/read/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-info"></i></button></a>
                        @can('UpdateSystem')
                            <a href="/licenses/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-pen"></i></button></a>
                        @endcan
                            `,
                            name: row.name,
                            description: row.description,
                            stripe_api_id: row.stripe_api_id,
                            price: row.price,
                            trial: row.trial,
                            admin: row.admin,
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false }
                );
            });
        document.getElementById('license_search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
</script>
