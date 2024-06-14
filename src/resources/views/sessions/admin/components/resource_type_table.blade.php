<div class="card mt-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="align-self-start">
                <div class="input-group">
                    @can('CreateSystem')
                        <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addResource_TypeModal">Add Resource Type</button>
                    @endcan
                </div>
            </div>
            <div class="align-self-center w-50">
                <div class="form-outline">
                    <input type="search" name="resource_type_search" id="resource_type_search" class="form-control rounded" placeholder="Search Resource Types" aria-label="Search Resource Types">
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
                <div id="resource_types-datatable" data-mdb-loading="true"></div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load", (e) => {
        getResourceTypes();
    });
    // Awards Table
    window.getResourceTypes = function() {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Name', field: 'name'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('resource_types-datatable'),
            { columns,}
        );
        fetch('/api/getResourceTypes')
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            actions: `
                            <a href="/resource_types/read/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-info"></i></button></a>
                        @can('UpdateSystem')
                            <a href="/resource_types/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-pen"></i></button></a>
                        @endcan
                            `,
                            name: row.name,
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false }
                );
            });
        document.getElementById('resource_type_search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
</script>

