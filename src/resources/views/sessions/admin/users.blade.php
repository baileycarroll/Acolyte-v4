@extends('layout')
@section('main')

    {{--    <div class="container text-center">--}}
    {{--        @include('components/sidebar')--}}
    {{--        <div class="container">--}}
    {{--            @include('components/users_metrics')--}}
    {{--            @include('components/users_table')--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <header>
        @include("components/sidebar")

        @include("components/navbar")
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            @include("sessions.admin.components.users_metrics")
            @include("sessions.admin.components.users_table")
        </div>
    </main>
    <!--Main layout-->
    {{--    Add User Modal    --}}
    @include("sessions.admin.components.modals.add_user_modal")
    <script>
        // Users Table
        window.getUsers = function() {
            const columns = [
                {label: 'Actions', field: 'actions'},
                {label: 'Full Name', field: 'full_name'},
                {label: 'Email', field: 'email'},
                {label: 'Phone', field: 'phone'},
                {label: 'Account Status', field: 'status'},
            ];
            const asyncTable = new mdb.Datatable(
                document.getElementById('users-datatable'),
                { columns,}
            );
            fetch('/api/getUsers')
                .then((response) => response.json())
                .then((data) => {
                    asyncTable.update(
                        {
                            rows: data.map((row) => ({
                                ...row,
                                actions: `
                        <a href="/user_information/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-pen"></i></button></a>
                        <a href="/contact_user/${row.id}" class="text-decoration-none text-light" target="_blank"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-envelope"></i></button></a>
                        @hasrole('Support')
                                <button class="btn ms-2 btn-primary btn-floating btn-sm" onclick="document.getElementById('delete-user-${row.id}').submit()"><a class="text-decoration-none text-light" href="#"><i class="fa-solid fa-trash"></i></a></button>
                        <form id="delete-user-${row.id}" action="/delete_user/${row.id}" method="post">@csrf</form>
                        @endhasrole
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
            document.getElementById('user-search').addEventListener('input', (e) => {
                asyncTable.search(e.target.value)
            });
        }
    </script>
@endsection
