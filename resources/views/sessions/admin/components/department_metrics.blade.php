<section>
    <div class="card text-center">
        <div class="car-header py-3 text-light bg-primary display-6">Department Metrics</div>
        <div class="card-body bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5 mt-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center text-primary">Users w/ Departments</h3>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-center display-6 text-primary">{{$numUsersWithDepts}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center text-primary">Number of Departments</h3>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-center display-6 text-primary">{{$numDepts}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center text-primary">Users w/out Departments</h3>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-center display-6 text-primary">{{$numUsersWithoutDepts}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
