<div class="card mt-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="align-self-start">
                <div class="input-group">
                    <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addDiscussionModal">Create Discussion</button>
                    <button class="btn btn-primary d-none">Export</button>
                </div>
            </div>
            <div class="align-self-end w-50">
                <div class="form-outline d-none">
                    <input type="search" name="department_search" id="department_search" class="form-control rounded" placeholder="Search Departments" aria-label="Search Departments">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col table-responsive">
                <div id="discussions-datatable" data-mdb-loading="true"></div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load", (e) => {
        getDiscussions();
    });
    // Awards Table
    window.getDiscussions = function() {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Topic', field: 'topic'},
            {label: 'Month', field: 'month'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('discussions-datatable'),
            { columns,}
        );
        fetch('/api/getDiscussions')
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            actions: `
                            <a href="/discussions/read/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-info"></i></button></a>
                        @can('UpdateContent')
                            <a href="/discussions/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-pen"></i></button></a>
                        @endcan
                            `,
                            topic: row.topic,
                            month: new Date(row.month).toLocaleString("en-US", { month: "long"}),
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false }
                );
            });
    }
</script>
