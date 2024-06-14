<nav
    id="main-navbar"
    class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top"
>
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#sidebarMenu"
            aria-controls="sidebarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="/">
            {{App\Models\SetupKeys::where("key", '=', 'instance_name')->first()->value}}
        </a>
        <!-- Right links -->
        <ul class="navbar-nav ms-auto ms-sm-0 d-flex flex-row d-none d-md-block d-lg-block">
            <!-- Avatar -->
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
                    href="#"
                    id="navbarDropdownMenuLink"
                    role="button"
                    data-mdb-toggle="dropdown"
                    aria-expanded="false"
                >
                    <i class="fa-solid fa-circle-user fa-2x"></i>
                </a>
                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDropdownMenuLink"
                >
                    <li><a class="dropdown-item" href="/my_profile">My profile</a></li>
{{--                    <li><a class="dropdown-item" href="#">Settings</a></li>--}}
                    <li>
                        <form action="/logout" method="POST" id="logout_form">
                            @csrf
                            <a class="dropdown-item" href="#" onclick="document.getElementById('logout_form').submit()">Logout</a>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Container wrapper -->
</nav>
