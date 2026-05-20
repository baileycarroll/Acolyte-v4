@extends('layout')
@section('main')
    <header>
        @include("components.sidebar")

        @include("components.navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            <a href="/roles" class="text-decoration-none text-light">
                <button class="btn btn-primary">Back to All Roles</button>
            </a>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">{{$role->name}}</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-md-2 g-4 mb-5 mt-3">
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h3 class="text-center text-primary">Users w/Role</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-center display-1 text-primary">{{$users}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h3 class="text-center text-primary">Num. Permissions</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-center display-1 text-primary">{{$role->permissions->count()}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">{{$role->name}} Permissions</div>
                <div class="card-body">
                    <div class="border-top border-primary border-solid mt-3">
                        <div class="row">
                            {{--                                User Permissions--}}
                            <div class="col border-end border-solid border-primary">
                                <h4 class="text-center">System</h4>
                                <div class="text-start">
                                    <div class="form-check form-switch">
                                        <label for="ViewSystem">View All</label>
                                        @if($role->hasPermissionTo('ViewSystem'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewSystem" id="ViewSystem" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewSystem" id="ViewSystem">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="ViewDeptSystem">View Department</label>
                                        @if($role->hasPermissionTo('ViewDeptSystem'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewDeptSystem" id="ViewDeptSystem" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewDeptSystem" id="ViewDeptSystem">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="ViewSelfSystem">View Self</label>
                                        @if($role->hasPermissionTo('ViewSelfSystem'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewSelfSystem" id="ViewSelfSystem" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewSelfSystem" id="ViewSelfSystem">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="UpdateSystem">Update</label>
                                        @if($role->hasPermissionTo('UpdateSystem'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="UpdateSystem" id="UpdateSystem" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="UpdateSystem" id="UpdateSystem">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="CreateSystem">Create</label>
                                        @if($role->hasPermissionTo('CreateSystem'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="CreateSystem" id="CreateSystem" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="CreateSystem" id="CreateSystem">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{--                                Content Permissions--}}
                            <div class="col border-end border-solid border-primary">
                                <h4 class="text-center">Content</h4>
                                <div class="text-start">
                                    <div class="form-check form-switch">
                                        <label for="ViewContent">View All</label>
                                        @if($role->hasPermissionTo('ViewContent'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewContent" id="ViewContent" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewContent" id="ViewContent">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="ViewDeptContent">View Department</label>
                                        @if($role->hasPermissionTo('ViewDeptContent'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewDeptContent" id="ViewDeptContent" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewDeptContent" id="ViewDeptContent">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="ViewSelfContent">View Self</label>
                                        @if($role->hasPermissionTo('ViewSelfContent'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewSelfContent" id="ViewSelfContent" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewSelfContent" id="ViewSelfContent">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="UpdateContent">Update</label>
                                        @if($role->hasPermissionTo('UpdateContent'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="UpdateContent" id="UpdateContent" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="UpdateContent" id="UpdateContent">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="CreateContent">Create</label>
                                        @if($role->hasPermissionTo('CreateContent'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="CreateContent" id="CreateContent" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="CreateContent" id="CreateContent">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{--                                Grade Permissions--}}
                            <div class="col border-end border-solid border-primary">
                                <h4 class="text-center">Grade</h4>
                                <div class="text-start">
                                    <div class="form-check form-switch">
                                        <label for="ViewGrade">View All</label>
                                        @if($role->hasPermissionTo('ViewGrade'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewGrade" id="ViewGrade" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewGrade" id="ViewGrade">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="ViewDeptGrade">View Department</label>
                                        @if($role->hasPermissionTo('ViewDeptGrade'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewDeptGrade" id="ViewDeptGrade" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewDeptGrade" id="ViewDeptGrade">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="ViewSelfGrade">View Self</label>
                                        @if($role->hasPermissionTo('ViewSelfGrade'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewSelfGrade" id="ViewSelfGrade" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewSelfGrade" id="ViewSelfGrade">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="UpdateGrade">Update</label>
                                        @if($role->hasPermissionTo('UpdateGrade'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="UpdateGrade" id="UpdateGrade" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="UpdateGrade" id="UpdateGrade">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="CreateGrade">Create</label>
                                        @if($role->hasPermissionTo('CreateGrade'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="CreateGrade" id="CreateGrade" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="CreateGrade" id="CreateGrade">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{--                                Forum Permissions--}}
                            <div class="col border-end border-solid border-primary">
                                <h4 class="text-center">Forum</h4>
                                <div class="text-start">
                                    <div class="form-check form-switch">
                                        <label for="ViewForum">View All</label>
                                        @if($role->hasPermissionTo('ViewForum'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewForum" id="ViewForum" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewForum" id="ViewForum">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="ViewDeptForum">View Department</label>
                                        @if($role->hasPermissionTo('ViewDeptForum'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewDeptForum" id="ViewDeptForum" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewDeptForum" id="ViewDeptForum">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="ViewSelfForum">View Self</label>
                                        @if($role->hasPermissionTo('ViewSelfForum'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewSelfForum" id="ViewSelfForum" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewSelfForum" id="ViewSelfForum">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="UpdateForum">Update</label>
                                        @if($role->hasPermissionTo('UpdateForum'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="UpdateForum" id="UpdateForum" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="UpdateForum" id="UpdateForum">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="CreateForum">Create</label>
                                        @if($role->hasPermissionTo('CreateForum'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="CreateForum" id="CreateForum" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="CreateForum" id="CreateForum">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{--                                Announcement Permissions--}}
                            <div class="col">
                                <h4 class="text-center">Announce</h4>
                                <div class="text-start">
                                    <div class="form-check form-switch">
                                        <label for="ViewAnnounce">View All</label>
                                        @if($role->hasPermissionTo('ViewAnnounce'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewAnnounce" id="ViewAnnounce" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewAnnounce" id="ViewAnnounce">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="ViewDeptAnnounce">View Department</label>
                                        @if($role->hasPermissionTo('ViewDeptAnnounce'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewDeptAnnounce" id="ViewDeptAnnounce" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewDeptAnnounce" id="ViewDeptAnnounce">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="ViewSelfAnnounce">View Self</label>
                                        @if($role->hasPermissionTo('ViewSelfAnnounce'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewSelfAnnounce" id="ViewSelfAnnounce" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="ViewSelfAnnounce" id="ViewSelfAnnounce">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="UpdateAnnounce">Update</label>
                                        @if($role->hasPermissionTo('UpdateAnnounce'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="UpdateAnnounce" id="UpdateAnnounce" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="UpdateAnnounce" id="UpdateAnnounce">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        <label for="CreateAnnounce">Create</label>
                                        @if($role->hasPermissionTo('CreateAnnounce'))
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="CreateAnnounce" id="CreateAnnounce" checked>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled role="switch" name="CreateAnnounce" id="CreateAnnounce">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">
                    Users With Role
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-2">
                        <div class="align-self-center w-50">
                            <div class="form-outline">
                                <input class="form-control rounded" type="search" id="role-user-search" placeholder="Search Users with Role" aria-label="Search Users with Role">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col table-responsive">
                            <div id="role-users-datatable" data-mdb-loading="true"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script>
        window.getRolesUsers = function() {
            const columns = [
                {label: 'Actions', field: 'actions'},
                {label: 'Full Name', field: 'full_name'},
                {label: 'Email', field: 'email'},
                {label: 'Phone', field: 'phone'},
                {label: 'Account Status', field: 'status'},
            ];
            const asyncTable = new mdb.Datatable(
                document.getElementById('role-users-datatable'),
                { columns,}
            );
            fetch("/api/getUsersRole/{{$role->id}}")
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
            document.getElementById('role-user-search').addEventListener('input', (e) => {
                asyncTable.search(e.target.value)
            });
        }
        window.addEventListener("load", (e) => {
            getRolesUsers();
        });
    </script>
@endsection
