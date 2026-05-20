<div class="card mt-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="align-self-start">
                <div class="input-group">
                    <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addRoleModal">Create Role</button>
                </div>
            </div>
            <div class="align-self-center w-50">
                <div class="form-outline">
                    <input class="form-control rounded" type="search" id="role-search" placeholder="Search Roles" aria-label="Search Roles">
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
                <div id="roles-datatable" data-mdb-loading="true"></div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load", (e) => {
        getRoles();
    });
</script>
<script>
    // Roles Table
    window.getRoles = function() {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Name', field: 'name'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('roles-datatable'),
            { columns,}
        );
        fetch('/api/getRoles')
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            actions: `
                            @can('ViewSystem')
                            <a href="/role_information/read/${row.id}" class="text-decoration-none text-light mx-auto"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-info"></i></button></a>
                            @endcan
                            @can('UpdateSystem')
                            <a href="/role_information/${row.id}" class="text-decoration-none text-light mx-auto"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-pen"></i></button></a>
                            @endcan
                            @can('DeleteSystem')
                            <button class="btn ms-2 btn-primary btn-floating btn-sm mx-auto" onclick="document.getElementById('DeleteRole_${row.id}').submit();"><i class="fa-solid fa-trash"></i></button>
                            <form id="DeleteRole_${row.id}" action='/delete_role' method='POST'>
                            @csrf
                                <input type='hidden' name='role_id' value="${row.id}">
                            </form>
                            @endcan
                        `,
                            name: row.name,
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false }
                );
            });
        document.getElementById('role-search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
</script>
