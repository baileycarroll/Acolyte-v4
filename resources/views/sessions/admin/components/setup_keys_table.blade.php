<div class="card mt-4">
    <div class="card-header bg-primary">
        <h3 class="text-center text-white">System Actions</h3>
    </div>
    <div class="card-body">
        <form class="d-inline" action="/update_color_style" method="POST">
            @csrf
            <button class="btn btn-primary" type="submit">Refresh Primary Color</button>
        </form>
        <form action="/create_frontend_keys" method="post" class="d-inline">
            @csrf
            <button class="btn btn-primary" type="submit">Generate Custom Link Keys</button>
        </form>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="align-self-start">
                <button class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#addSetupKeyModal">Create Key</button>
            </div>
            <div class="align-self-center w-50">
                <div class="form-outline">
                    <input class="form-control" type="search" id="key-search" placeholder="Search Keys" aria-label="Search Keys">
                </div>
            </div>
            <div class="align-self-end">
                <div class="input-group">
                    <button class="btn btn-primary">Export</button>
                </div>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col table-responsive">
                <div id="setup_keys-datatable" data-mdb-loading="true"></div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load", (e) => {
        getKeys();
    });
</script>
<script>
    // Roles Table
    window.getKeys = function() {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Key', field: 'key'},
            {label: 'Value', field: 'value'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('setup_keys-datatable'),
            { columns,}
        );
        fetch('/api/getKeys')
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            actions: `
                            @can('UpdateSystem')
                            <a href="/key_information/${row.id}" class="text-decoration-none text-light mx-auto"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-pen"></i></button></a>
                            @endcan
                            `,
                            key: row.key,
                            value: row.value,
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false }
                );
            });
        document.getElementById('key-search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
</script>
