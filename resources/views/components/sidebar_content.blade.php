<div class="d-block d-md-none mt-auto list-group-item list-group-item-action py-2 ripple">
    <a
        href="{{ route('my_profile') }}"
    ><i class="fa-solid fa-circle-user fa-fw me-3"></i><span>My Profile</span></a
    >
</div>
<a href="/my_content" class="list-group-item list-group-item-action py-2 ripple"><i class="fa-solid fa-books fa-fw me-3"></i>My Content</a>
<button class="list-group-item list-group-item-action dropdown-toggle dropend" id="catalog_dropdown_button" data-mdb-toggle="dropdown">
    <i class="fa-solid fa-atom-simple fa-fw me-3"></i>Catalog
</button>
<ul class="dropdown-menu">
    <li><a href="/course_catalog" class="dropdown-item py-2 ripple">Courses</a></li>
    <li> <a href="/class_catalog" class="dropdown-item py-2 ripple">Classes</a></li>
</ul>
<a href="/student_resources" class="list-group-item list-group-item-action py-2 ripple"><i class="fa-solid fa-paperclip fa-fw me-3"></i>Resources</a>
@hasrole('Support')
@if(\App\Models\SetupKeys::where('key', '=', 'use_subscriptions')->first()->value == 1)
    <a href="/membership" class="list-group-item list-group-item-action py-2 ripple"><i class="fa-solid fa-paperclip fa-fw me-3"></i>Membership</a>
@endif
@endhasrole

</div>
@canany(['ViewSystem' , 'ViewSelfSystem' , 'ViewDeptSystem'
    , 'ViewContent' , 'ViewSelfContent' , 'ViewDeptContent'
    , 'ViewAnnounce' , 'ViewSelfAnnounce' , 'ViewDeptAnnounce'
    , 'ViewGrade' , 'ViewSelfGrade' , 'ViewDeptGrade'
    , 'ViewForum' , 'ViewSelfForum' , 'ViewDeptForum'])
    <div class="list-group list-group-flush mx-3 mt-lg-5 border-top">
        <h5 class="text-muted text-center">Administration</h5>
        {{--            <a--}}
        {{--                href="#"--}}
        {{--                class="list-group-item list-group-item-action py-2 ripple"--}}
        {{--            >--}}
        {{--                <i class="fas fa-user-graduate fa-fw me-3"></i--}}
        {{--                ><span>Gradebook</span>--}}
        {{--            </a>--}}
        {{--            <a--}}
        {{--                href="#"--}}
        {{--                class="list-group-item list-group-item-action py-2 ripple"--}}
        {{--            ><i class="fas fa-scroll fa-fw me-3"></i><span>Transcripts</span></a--}}
        {{--            >--}}
        @can('ViewSystem')
            <a
                href="/awards"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-award fa-fw me-3"></i
                ><span>Awards</span></a
            >
        @endcan
        @if(auth()->user()->can('ViewContent') | auth()->user()->can('ViewDeptContent') | auth()->user()->can('ViewSelfContent'))
            <a
                href="/courses"
                class="list-group-item list-group-item-action py-2 ripple"
            >
                <i class="fas fa-books fa-fw me-3"></i><span>Courses</span>
            </a>
            <a
                href="/classes"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-book fa-fw me-3"></i
                ><span>Classes</span></a
            >
            <a
                href="/discussions"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fa-solid fa-people-group fa-fw me-3"></i><span>Discussions</span></a
            >
        @endif
        @can('ViewSystem')
            <a
                href="/learning_styles"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-wrench fa-fw me-3"></i
                ><span>Learning Styles</span></a
            >
            <a
                href="/resource_types"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-hockey-puck fa-fw me-3"></i
                ><span>Resource Types</span></a
            >
            <a
                href="/resources"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-truck fa-fw me-3"></i><span>Resources</span></a
            >
            <a
                href="/users"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-users fa-fw me-3"></i><span>Users</span></a
            >
            <a
                href="/roles"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-lock fa-fw me-3"></i><span>Roles</span></a
            >
            @hasrole('Support')
            <a
                href="/permissions"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fa-solid fa-grip-dots fa-fw me-3"></i><span>Permissions</span></a
            >
            <a
                href="/setup_keys"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-key fa-fw me-3"></i><span>Setup Keys</span></a
            >
            @endhasrole
            <a
                href="/departments"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-globe fa-fw me-3"></i><span>Departments</span></a
            >
            <a
                href="/categories"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-tags fa-fw me-3"></i><span>Categories</span></a
            >
            @hasrole('Support')
            <a
                href="/licenses"
                class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-id-badge fa-fw me-3"></i><span>Licenses</span></a
            >
            @endhasrole
        @endcan
        {{--            <a--}}
        {{--                href="#"--}}
        {{--                class="list-group-item list-group-item-action py-2 ripple"--}}
        {{--            ><i class="fas fa-bell fa-fw me-3"></i><span>Announcements</span></a--}}
        {{--            >--}}
    </div>
@endcanany
