@extends('layout')
@section('main')
    <header>
        @include("components.sidebar")

        @include("components.navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            <a href="/learning_styles" class="text-decoration-none text-light">
                <button class="btn btn-primary">Back to All Learning Styles</button>
            </a>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">{{$lstyle->name}}</div>
                <div class="card-body">
                    <div class="row mb-5 mt-3">
                        <div class="col">
                            <label for="first_name">Learning Style Name:</label>
                            <input type="text" class="form-control mb-2" value="{{$lstyle->name}}" disabled>
                            <label for="last_name">Description:</label>
                            <textarea class="form-control mb-2" cols="30" rows="10" disabled>{{$lstyle->description}}</textarea>
                            <label for="updated_at">Last Updated:</label>
                            <input type="text" id="updated_at" class="form-control" value="{{$lstyle->updated_at}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">Users with {{$lstyle->name}} Learning Style</div>
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-2">
                        <div class="align-self-center w-50">
                            <div class="form-outline">
                                <input class="form-control rounded" type="search" id="ls-user-search" placeholder="Search Users with Learning Style" aria-label="Search Users with Learning Style">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col table-responsive">
                            <div id="ls-users-datatable" data-mdb-loading="true"></div>
                        </div>
                    </div>
                </div>
            </div>
            @if(auth()->user()->can('ViewContent') || auth()->user()->can('ViewDeptContent') || auth()->user()->can('ViewSelfContent'))
                <div class="card mt-4 text-center">
                    <div class="card-header py-3 text-light bg-primary display-6">Classes {{$lstyle->name}} Learning Style</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-2">
                            <div class="align-self-center w-50">
                                <div class="form-outline">
                                    <input class="form-control rounded" type="search" id="ls-class-search" placeholder="Search Classes with Learning Style" aria-label="Search Classes with Learning Style">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col table-responsive">
                                {{--                            <div id="ls-class-datatable" data-mdb-loading="true"></div>--}}
                                Coming Soon!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4 text-center">
                    <div class="card-header py-3 text-light bg-primary display-6">Course Modules with {{$lstyle->name}} Learning Style</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-2">
                            <div class="align-self-center w-50">
                                <div class="form-outline">
                                    <input class="form-control rounded" type="search" id="ls-module-search" placeholder="Search Course Modules with Learning Style" aria-label="Search Course Modules with Learning Style">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col table-responsive">
                                {{--                            <div id="ls-modules-datatable" data-mdb-loading="true"></div>--}}
                                Coming Soon
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
    <script>
        //Awards Users Table
        window.getLSUsers = function() {
            const columns = [
                {label: 'Actions', field: 'actions'},
                {label: 'Full Name', field: 'full_name'},
                {label: 'Email', field: 'email'},
                {label: 'Phone', field: 'phone'},
                {label: 'Account Status', field: 'status'},
            ];
            const asyncTable = new mdb.Datatable(
                document.getElementById('ls-users-datatable'),
                { columns,}
            );
            fetch("/api/getUsersWithLS/{{$lstyle->id}}")
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
            document.getElementById('ls-user-search').addEventListener('input', (e) => {
                asyncTable.search(e.target.value)
            });
        }
        window.addEventListener("load", (e) => {
            getLSUsers();
        });
    </script>
@endsection
