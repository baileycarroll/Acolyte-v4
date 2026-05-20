<div class="card mt-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="align-self-start">
                <div class="input-group">
                    @can('CreateContent')
                        <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addCourseModal">Add Course</button>
                    @endcan
                </div>
            </div>
            <div class="align-self-center w-50">
                <div class="form-outline">
                    <input class="form-control rounded" type="search" id="course-search" placeholder="Search Courses" aria-label="Search Courses">
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
                <div id="courses-datatable" data-mdb-loading="true"></div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load", (e) => {
        getCourses();
    });
    // Awards Table
    window.getCourses = function() {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Course Name', field: 'name'},
            {label: 'Excerpt', field: 'excerpt'},
            {label: 'Status', field: 'status'},
            {label: 'Department', field: 'department'},
            {label: 'Instructor', field: 'instructor'},
            {label: 'Learning Style', field: 'lstyle'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('courses-datatable'),
            { columns,}
        );
        fetch('/api/getCourses')
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            actions: `
                            <a href="/course_information/read/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-info"></i></button></a>
                        @can('UpdateContent')
                            <a href="/course_information/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-pen"></i></button></a>
                        @endcan
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
        document.getElementById('course-search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
</script>
