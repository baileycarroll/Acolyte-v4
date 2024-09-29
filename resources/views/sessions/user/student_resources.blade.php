@extends('layout')
@section('main')
    <header>
        @include("components/sidebar")

        @include("components/navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            <div class="row mt-4">
                <h2 class="text-center text-light mb-4">Student Resources</h2>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="align-self-start">
                                <div class="input-group d-none">
                                    <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addResourceModal">Create Resource</button>
                                </div>
                            </div>
                            <div class="align-self-center w-50">
                                <div class="form-outline">
                                    <input class="form-control rounded bg-light" type="search" id="resource-search" placeholder="Search Resources" aria-label="Search Resources">
                                </div>
                            </div>
                            <div class="align-self-end">
                                <div class="input-group d-none">
                                    <button class="btn btn-primary">Export</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col table-responsive">
                                <div id="resources-datatable" data-mdb-loading="true"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        window.addEventListener("load", (e) => {
            getResources();
        });
    </script>
    <script>
        // Resources Table
        window.getResources = function() {
            const columns = [
                {label: 'Name', field: 'name'},
                {label: 'Description', field: 'description'},
                {label: 'Resource Type', field: 'resource_type'},
                {label: 'Content', field: 'url'},
                {label: 'Last Updated', field: 'updated_at'},
            ];
            const asyncTable = new mdb.Datatable(
                document.getElementById('resources-datatable'),
                { columns,}
            );
            fetch('/api/getResources')
                .then((response) => response.json())
                .then((data) => {
                    asyncTable.update(
                        {
                            rows: data.map((row) => ({
                                ...row,
                                name: row.name,
                                description: row.description,
                                resource_type: row.resource_type.name,
                                url: `<button class="btn btn-primary rounded"><a href="${row.url}" class="text-light" target="_blank">View Content   <i class="fa-solid fa-arrow-up-right-from-square"></i></a></button>`,
                                updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                            })),
                        },
                        { loading: false }
                    );
                });
            document.getElementById('resource-search').addEventListener('input', (e) => {
                asyncTable.search(e.target.value)
            });
        }
    </script>
@endsection
