<div class="card mt-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="align-self-start">
                <div class="input-group">
                    @can('CreateContent')
                        <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addClassModal">Add Class</button>
                    @endcan
                </div>
            </div>
            <div class="align-self-center w-50">
                <div class="form-outline">
                    <input class="form-control rounded" type="search" id="class-search" placeholder="Search Classes" aria-label="Search Classes">
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
                <div id="classes-datatable" data-mdb-loading="true"></div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load", (e) => {
        getClasses();
    });
    // Awards Table
    window.getClasses = function() {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Class Name', field: 'name'},
            {label: 'Excerpt', field: 'excerpt'},
            {label: 'Status', field: 'status'},
            {label: 'Department', field: 'department'},
            {label: 'Instructor', field: 'instructor'},
            {label: 'Learning Style', field: 'lstyle'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('classes-datatable'),
            { columns,}
        );
        fetch('/api/getClasses')
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            actions: `
                            <a href="/class_information/read/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-info"></i></button></a>
                        @can('UpdateContent')
                            <a href="/class_information/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-pen"></i></button></a>
                        @endcan
                        @hasrole('Support')
                            <button class="btn ms-2 btn-primary btn-floating btn-sm"><a class="text-decoration-none text-light" href="/api/delete_class/${row.id}"><i class="fa-solid fa-trash"></i></a></button>
                        @endhasrole
                            `,
                            name: row.name,
                            excerpt: row.excerpt,
                            status: row.status,
                            department: row.department_name,
                            instructor: row.instructor_name,
                            lstyle: row.ls_name,
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false }
                );
            });
        document.getElementById('class-search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
</script>
