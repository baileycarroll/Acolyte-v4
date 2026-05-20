<section>
    <div class="card text-center">
        <div class="card-header py-3 text-light bg-primary display-6">User Metrics</div>
        <div class="card-body">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5 mt-3">
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="text-center text-primary">Active Users</h3>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-center display-1 text-primary">{{$active_users}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="text-center text-primary">Users Today</h3>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-center display-1 text-primary">{{$todays_users}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="text-center text-primary">Inactive Users</h3>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-center display-1 text-primary">{{$inactive_users}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
