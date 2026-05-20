<div class="modal fade" id="addUserToClassModal" tabindex="-1" aria-labelledby="addUserToClassModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/add_user_to_class" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Add User To Class</h4>
                    <label for="class">Class:</label>
                    <input type="hidden" name="user" value="{{$user->id}}">
                    <select name="class" id="class" class="select" data-mdb-container="#addUserToClassModal" data-mdb-filter="true">
                        <option>Choose Option</option>
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
