@extends('layout')
@section('main')
    <header>
        @include("components.sidebar")

        @include("components.navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            <a href="/awards" class="text-decoration-none text-light">
                <button class="btn btn-primary">Back to All Awards</button>
            </a>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">{{$award->name}}</div>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-2 mb-5 mt-3">
                            <div class="col-12 col-md-2">
                                <h4 class="text-center text-primary">Award Image</h4>
                                <img
                                    src="{{$image}}"
                                    alt="Award Image"
                                    class="img-fluid"
{{--                                    style="width: 400px;"--}}
                                >
                                <p class="text-center">{{$award->filename}}</p>
                            </div>
                            <div class="col-12 col-md-10">
                                <label for="first_name">Award Name:</label>
                                <input type="text" class="form-control mb-2" value="{{$award->name}}" disabled>
                                <label for="last_name">Description:</label>
                                <textarea class="form-control mb-2" cols="30" rows="10" disabled>{{$award->description}}</textarea>
                                <label for="updated_at">Last Updated:</label>
                                <input type="text" id="updated_at" class="form-control" value="{{$award->updated_at}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">Users with {{$award->name}} Award</div>
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-2">
                        <div class="align-self-center w-50">
                            <div class="form-outline">
                                <input class="form-control rounded" type="search" id="award-user-search" placeholder="Search Users with Award" aria-label="Search Users with Award">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col table-responsive">
                            <div id="award-users-datatable" data-mdb-loading="true"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        //Awards Users Table
        window.getAwardsUsers = function() {
            const columns = [
                {label: 'Actions', field: 'actions'},
                {label: 'Full Name', field: 'full_name'},
                {label: 'Email', field: 'email'},
                {label: 'Phone', field: 'phone'},
                {label: 'Account Status', field: 'status'},
            ];
            const asyncTable = new mdb.Datatable(
                document.getElementById('award-users-datatable'),
                { columns,}
            );
            fetch("/api/getUsersWithAward/{{$award->id}}")
                .then((response) => response.json())
                .then((data) => {
                    asyncTable.update(
                        {
                            rows: data.map((row) => ({
                                ...row,
                                actions: `
                        <a href="/user_information/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-info"></i></button></a>
                        <button class="btn ms-2 btn-primary btn-floating btn-sm d-none"><i class="fa-solid fa-envelope"></i></button>
                        `,
                                full_name: row.first_name+" "+row.last_name,
                                email: row.email,
                                phone: row.phone,
                                status: row.user_status,
                            })),
                        },
                        { loading: false }
                    );
                });
            document.getElementById('award-user-search').addEventListener('input', (e) => {
                asyncTable.search(e.target.value)
            });
        }
        window.addEventListener("load", (e) => {
            getAwardsUsers();
        });
    </script>
@endsection
