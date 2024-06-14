@extends('layout')
@section('main')
    <header>
        @include("components/sidebar")

        @include("components/navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
                <a href="/users" class="text-decoration-none text-light">
                    <button class="btn btn-primary">Back to All Users</button>
                </a>
{{--            User Information --}}
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">{{$user->first_name." ".$user->last_name}}</div>
                <div class="card-body">
                    <form action="/update_user" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <div class="row mb-5 mt-3">
                            <div class="col-2">
                                <img
                                    src="{!! asset('./assets/img/Profile.png') !!}"
                                    alt="Default Profile Image"
                                    class="img-fluid"
                                    style="width: 200px;"
                                >
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label for="first_name">First Name:</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{$user->first_name}}" required>
                                    </div>
                                    <div class="col">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{$user->last_name}}" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="pref_name">Preferred Name:</label>
                                        <input type="text" name="pref_name" id="pref_name" class="form-control" value="{{$user->pref_name}}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="phone">Phone:</label>
                                        <input type="tel" name="phone" id="phone" class="form-control" value="{{$user->phone}}">
                                    </div>
                                    <div class="col">
                                        <label for="email">Email:</label>
                                        <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="row">
                                <div class="col">
                                    <label for="rolesSelect">User Roles:</label>
                                    <select name="roles[]" id="rolesSelect" class="select" multiple>
                                        @foreach($roles as $role)
                                                <option
                                                    value="{{$role->name}}"
                                                    @if($user_roles->contains($role->name)))
                                                        selected
                                                    @endif
                                                >
                                                    {{$role->name}}
                                                </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="department">Select Department:</label>
                                    <select name="department" id="department" class="form-select" aria-label="select-department" required>
                                        <option value="{{$user->department_id}}" selected>Current: {{$user->user_department}}</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="user_status">Select User Account Status:</label>
                                    <select name="user_status" id="user_status" class="form-select" required>
                                        <option value="{{$user->user_status}}" selected>Current: {{$user->user_status}}</option>
                                        <option value="Active">Active</option>
                                        <option value="Suspended">Suspended</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Deactivated">Deactivated</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="learning_style">Select Learning Style:</label>
                                    <select name="learning_style" id="learning_style" class="form-select" required>
                                        <option value="{{$user->ls_id}}" selected>Current: {{$user->ls_name}}</option>
                                        @foreach($learning_styles as $learning_style)
                                            <option value="{{$learning_style->id}}">{{$learning_style->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="license">Select License:</label>
                                    <select name="license" id="license" class="form-select" required>
                                        <option value="{{$user->lic_id}}" selected>Current: {{$user->lic_name}}</option>
                                        @foreach($licenses as $license)
                                            <option value="{{$license->id}}">{{$license->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="license_ends">License Ends:</label>
                                    <input type="date" name="license_ends" id="license_ends" class="form-control" value="{{$user->license_ends}}" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn-primary btn mt-3">Save Changes</button>
                    </form>
                </div>
            </div>

{{--            Content User Has Access To --}}
            <div class="card mt-3 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">
                    <div class="d-flex justify-content-between">
                        <div class="justify-self-start">
                            <button class="btn btn-white text-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addUserToClassModal">Add Class</button>
                        </div>
                        <div class="justify-self-center">
                            Available Classes
                        </div>
                        <div class="justify-self-end">
                            <button class="btn btn-white text-primary rounded">Export</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col table-responsive">
                            <input class="form-control rounded mb-2" type="search" id="user-class-search" placeholder="Search Users Classes" aria-label="Search Users Classes">
                            <div id="user-class-datatable" data-mdb-loading="true"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">
                    <div class="d-flex justify-content-between">
                        <div class="justify-self-start">
                            <button class="btn btn-white text-primary rounded">Add Course</button>
                        </div>
                        <div class="justify-self-center">
                            Available Courses
                        </div>
                        <div class="justify-self-end">
                            <button class="btn btn-white text-primary rounded">Export</button>
                        </div>
                    </div>
                </div>
                <div class="card-body"> Coming Soon...
{{--                    <div class="row">--}}
{{--                        <div class="col table-responsive">--}}
{{--                            <input class="form-control rounded mb-2" type="search" id="user-course-search" placeholder="Search Users Courses" aria-label="Search Users Courses">--}}
{{--                            <div id="user-course-datatable" data-mdb-loading="true"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>

{{--            Users Awards --}}
            <div class="card mt-3 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">Awards</div>
                <div class="card-body"> Coming Soon...</div>
            </div>
{{--            Users Transcripts --}}
                <div class="card mt-3 text-center">
                    <div class="card-header py-3 text-light bg-primary display-6">Transcripts</div>
                    <div class="card-body"> Coming Soon...</div>
                </div>
        </div>
    </main>

@endsection
{{-- Modals --}}
@include("sessions.admin.components.modals.add_user_to_class_modal")
{{-- Scripts --}}
<script>
    window.addEventListener("load", (e) => {
        getUsersClasses();
    });
    // Awards Table
    window.getUsersClasses = function() {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Class Name', field: 'name'},
            {label: 'Department', field: 'department'},
            {label: 'Instructor', field: 'instructor'},
            {label: 'Learning Style', field: 'lstyle'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('user-class-datatable'),
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
                            `,
                            name: row.name,
                            department: row.department_name,
                            instructor: row.instructor_name,
                            lstyle: row.ls_name,
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false }
                );
            });
        document.getElementById('user-class-search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
</script>
