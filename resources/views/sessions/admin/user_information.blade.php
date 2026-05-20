@extends('layout')
@section('main')
    <header>
        @include("components/sidebar")

        @include("components/navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
                <a href="/users" class="text-decoration-none text-light">
                    <button class="btn btn-primary">Back to All Users</button>
                </a>
            @if(session('status'))
                <div class="alert alert-success my-3">
                    {{ session('status') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger my-3">
                    {{ session('error') }}
                </div>
            @endif
{{--            User Information --}}
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">{{$user->first_name." ".$user->last_name}}</div>
                <div class="card-body">
                    <form action="/update_user" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <div class="row row-cols-sm-1 row-cols-lg-2 mb-5 mt-3">
                            <div class="col d-none d-sm-none d-md-none d-lg-block">
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
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3">
                                <div class="col">
                                    <label for="rolesSelect">User Roles:</label>
                                    <select name="roles[]" id="rolesSelect" class="select" multiple data-mdb-filter="true">
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
                                    <select name="department" id="department" class="select" aria-label="select-department" required data-mdb-filter="true">
                                        <option value="{{$user->department_id}}" selected>Current: {{$user->user_department}}</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="user_status">Select User Account Status:</label>
                                    <select name="user_status" id="user_status" class="select" required data-mdb-filter="true">
                                        <option value="{{$user->user_status}}" selected>Current: {{$user->user_status}}</option>
                                        <option value="Active">Active</option>
                                        <option value="Suspended">Suspended</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Deactivated">Deactivated</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="learning_style">Select Learning Style:</label>
                                    <select name="learning_style" id="learning_style" class="select" required data-mdb-filter="true">
                                        <option value="{{$user->ls_id}}" selected>Current: {{$user->ls_name}}</option>
                                        @foreach($learning_styles as $learning_style)
                                            <option value="{{$learning_style->id}}">{{$learning_style->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="license">Select License:</label>
                                    <select name="license" id="license" class="select" required data-mdb-filter="true">
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
            <div class="row row-cols-sm-1 row-cols-lg-2">
                <div class="col">
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
                                   <button class="btn btn-white text-primary rounded d-none">Export</button>
                               </div>
                           </div>
                       </div>
                       <div class="card-body">
                           <div class="row">
                               <div class="col table-responsive">
                                   <input class="form-control rounded mb-2" type="search" id="user-class-search" placeholder="Search User's Classes" aria-label="Search User's Classes">
                                   <div id="user-class-datatable" data-mdb-loading="true"></div>
                               </div>
                           </div>
                       </div>
                   </div>
                </div>
                <div class="col">
                    <div class="card mt-3 text-center">
                        <div class="card-header py-3 text-light bg-primary display-6">
                            <div class="d-flex justify-content-between">
                                <div class="align-self-start">
                                    <button class="btn btn-white text-primary rounded d-none">Add Course</button>
                                </div>
                                <div class="align-self-center">
                                    Available Courses
                                </div>
                                <div class="align-self-end">
                                    <button class="btn btn-white text-primary rounded d-none">Export</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col table-responsive">
                                    <input class="form-control rounded mb-2" type="search" id="user-course-search" placeholder="Search Users Courses" aria-label="Search Users Courses">
                                    <div id="user-course-datatable" data-mdb-loading="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-sm-1 row-cols-lg-2">
                <div class="col">
                    <div class="card mt-3 text-center">
                        <div class="card-header py-3 text-light bg-primary display-6">
                            <div class="d-flex justify-content-between">
                                <div class="align-self-start">
                                    <button class="btn btn-white text-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addAwardToUser">Give Award</button>
                                </div>
                                <div class="align-self-center">
                                    Awards
                                </div>
                                <div class="align-self-end">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col table-responsive">
                                    <input class="form-control rounded mb-2" type="search" id="user-award-search" placeholder="Search User's Awards" aria-label="Search User's Awards">
                                    <div id="user-award-datatable" data-mdb-loading="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mt-3 text-center">
                        <div class="card-header py-3 text-light bg-primary display-6">Transcripts</div>
                        <div class="card-body">
                            <h3 class="text-center text-primary">Total Average Grade: <small>{{intval($average_grade)}} %</small></h3>
                            <input class="form-control rounded mb-2" type="search" id="user-transcript-search" placeholder="Search User's Transcripts" aria-label="Search User's Transcripts">
                            <div id="user-transcript-datatable" data-mdb-loading="true"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@include('sessions.admin.components.modals.give_user_award_modal')
@endsection
{{-- Modals --}}
@include("sessions.admin.components.modals.add_user_to_class_modal")
{{-- Scripts --}}
<script>
    window.addEventListener("load", () => {
        getUsersClasses();
        getUserAwards();
        getUserCourses();
        getUserTranscripts();
    });
    // Classes Table
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
    window.getUserAwards = function () {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Award Name', field: 'name'},
            {label: 'Award Description', field: 'description'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('user-award-datatable'),
            { columns,}
        );
        fetch("/api/getUserAwards/{{$user->id}}")
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            actions: `
                            <a href="/award_information/read/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-info"></i></button></a>
                        @can('UpdateContent')
                            <a href="/award_information/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-pen"></i></button></a>
                        @endcan
                            `,
                            name: row.name,
                            description: row.description,
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false }
                );
            });
        document.getElementById('user-award-search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
    window.getUserCourses = function () {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Course Name', field: 'name'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('user-course-datatable'),
            { columns,}
        );
        fetch("/api/getUserCourses/{{$user->id}}")
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
                            name: row.course_name,
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false, defaultValue: 'No Courses Found',  }
                );
            });
        document.getElementById('user-course-search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
    window.getUserTranscripts = function () {
        const columns = [
            {label: 'Content Name', field: 'name'},
            {label: 'Grade', field: 'grade'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('user-transcript-datatable'),
            { columns,}
        );
        fetch("/api/getUserTranscripts/{{$user->id}}")
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            name: row.name,
                            grade: row.grade,
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false, defaultValue: 'No Courses Found',  }
                );
            });
        document.getElementById('user-transcript-search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }

</script>
