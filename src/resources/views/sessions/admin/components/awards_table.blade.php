<div class="card mt-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="align-self-start">
                <div class="input-group">
                    @can('CreateSystem')
                        <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addAwardModal">Create Award</button>
                    @endcan
                    <button class="btn btn-primary d-none">Export</button>
                </div>
            </div>
            <div class="align-self-center w-50">
                <div class="form-outline">
                    <input class="form-control rounded" type="search" id="award-search" placeholder="Search Awards" aria-label="Search Awards">
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
                <div id="awards-datatable" data-mdb-loading="true"></div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load", (e) => {
        getAwards();
    });
    // Awards Table
    window.getAwards = function() {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Name', field: 'name'},
            {label: 'Description', field: 'description'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('awards-datatable'),
            { columns,}
        );
        fetch('/api/getAwards')
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            actions: `
                            <a href="/award_information/read/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-info"></i></button></a>
                        @can('UpdateSystem')
                                <a href="/award_information/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-pen"></i></button></a>
                        @endcan
                        @hasrole('Support')
                            <button class="btn ms-2 btn-primary btn-floating btn-sm"><a class="text-decoration-none text-light" href="/api/delete_award/${row.id}"><i class="fa-solid fa-trash"></i></a></button>
                        @endhasrole
                        `,
                            name: row.name,
                            description: row.description,
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false }
                );
            });
        document.getElementById('award-search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
</script>
