<div class="card mt-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="align-self-start">
                <div class="input-group">
                    <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addCategoryModal">Add Category</button>
                </div>
            </div>
            <div class="align-self-end w-50">
                <div class="form-outline">
                    <input type="search" name="category_search" id="category_search" class="form-control rounded" placeholder="Search Categories" aria-label="Search Departments">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col table-responsive">
                <div id="categories-datatable" data-mdb-loading="true"></div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load", (e) => {
        getCategories();
    });
    // Awards Table
    window.getCategories = function() {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Name', field: 'name'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('categories-datatable'),
            { columns,}
        );
        fetch('/api/getCategories')
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            actions: `
                            <a href="/categories/read/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-info"></i></button></a>
                        @can('UpdateSystem')
                            <a href="/categories/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-pen"></i></button></a>
                        @endcan
                            `,
                            name: row.name,
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false }
                );
            });
        document.getElementById('category_search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
</script>
