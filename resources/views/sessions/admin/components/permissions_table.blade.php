<div class="card mt-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="align-self-start">
                <div class="input-group">
                    <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addRoleModal">Create Permission</button>
                </div>
            </div>
            <div class="align-self-center w-50">
                <div class="form-outline">
                    <input class="form-control rounded" type="search" id="permission-search" placeholder="Search Permissions" aria-label="Search Roles">
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
                <div id="permissions-datatable" data-mdb-loading="true"></div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load", (e) => {
        getPermissions();
    });
</script>
