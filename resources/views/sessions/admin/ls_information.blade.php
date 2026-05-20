@extends('layout')
@section('main')
    <header>
        @include("components.sidebar")

        @include("components.navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <a href="/learning_styles" class="text-decoration-none text-light">
                <button class="btn btn-primary">Back to All Learning Styles</button>
            </a>
            <div class="card mt-4 text-center">
                <form action="/update_learning_style" method="POST">
                    @csrf
                    <div class="card-header py-3 text-light bg-primary display-6">{{$lstyle->name}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="learning_style_id" value="{{$lstyle->id}}">
                                <label for="learning_style_name">Learning Style Name:</label>
                                <input type="text" class="form-control mb-2" name="learning_style_name" value="{{$lstyle->name}}">
                                <label for="learning_style_description">Description:</label>
                                <textarea class="form-control mb-2" cols="30" rows="10" name="learning_style_description">{{$lstyle->description}}</textarea>
                                <label for="updated_at">Last Updated:</label>
                                <input type="text" id="updated_at" class="form-control" value="{{$lstyle->updated_at}}" disabled>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </div>
                </form>
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
