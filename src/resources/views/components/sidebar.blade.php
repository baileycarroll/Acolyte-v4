<nav
    id="sidebarMenu"
    class="collapse d-lg-block sidebar collapse bg-white overflow-auto"

>
    <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4 py-5 py-lg-0 py-xl-0">
            <a
                href="/home"
                class="list-group-item list-group-item-action py-2 ripple"
                aria-current="true"
            >
                <i class="fas fa-home fa-fw me-3"></i
                >Home
            </a>
            @if(\App\Models\User::find(Auth::id())->user_status == 'Active')
                @if(!(\App\Models\SetupKeys::where('key', '=', 'use_subscriptions')->first()->value == 0))
                    @if((\App\Models\User::find(Auth::id())->subscribed('acolyte')))
                        @include('components.sidebar_content')
                    @endif
                @else
                    @include('components.sidebar_content')
                @endif
            @endif
    </div>
</nav>
