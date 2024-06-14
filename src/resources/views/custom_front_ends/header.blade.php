<nav class="navbar navbar-expand-lg navbar-dark fixed-top mask-custom shadow-0 mb-3">
    <div class="container">
        <a class="navbar-brand" href="/">{{\App\Models\SetupKeys::where('key', '=', 'instance_name')->first()->value}}</a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/about_us">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/our_events">Our Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/why_we_are_here">Why We Are Here</a>
                </li>
            </ul>
            <ul class="navbar-nav d-flex flex-row">
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link" href="https://www.facebook.com/unTraditionalMagick" target="_blank">
                        <i class="fab fa-facebook"></i>
                    </a>
                </li>
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link" href="https://www.instagram.com/un_traditional_magick" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                </li>
                <li class="nav-item ms-3 d-none">
                    <a href="/login" class="nav-link">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
