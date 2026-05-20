<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/add_user" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Add User</h4>
                    <div class="row g-3">
                        <div class="col">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <label for="username">Username:</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="password">Password:</label>
                            <input type="text" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <label for="phone">Phone Number</label>
                            <input type="tel" name="phone" id="phone" class="form-control">
                        </div>
                        <div class="col">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <label for="department">Select Department:</label>
                            <select name="department" id="department" class="select" data-mdb-filter="true" data-mdb-container="#addUserModal" aria-label="select-department" required>
                                <option selected>Choose Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <label for="user_status">Select User Account Status:</label>
                            <select name="user_status" id="user_status" class="select" data-mdb-filter="true" data-mdb-container="#addUserModal" required>
                                <option selected>Choose Status</option>
                                <option value="Active">Active</option>
                                <option value="Suspended">Suspended</option>
                                <option value="Pending">Pending</option>
                                <option value="Deactivated">Deactivated</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="learning_style">Select Learning Style:</label>
                            <select name="learning_style" id="learning_style" class="select" data-mdb-filter="true" data-mdb-container="#addUserModal" required>
                                <option selected>Choose Learning Style</option>
                                @foreach($learning_styles as $learning_style)
                                    <option value="{{$learning_style->id}}">{{$learning_style->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <label for="license">Select License:</label>
                            <select name="license" id="license" class="select" data-mdb-filter="true" data-mdb-container="#addUserModal" required>
                                <option selected>Choose License</option>
                                @foreach($licenses as $license)
                                    <option value="{{$license->id}}">{{$license->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="license_ends">License Ends:</label>
                            <input type="date" name="license_ends" id="license_ends" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>
