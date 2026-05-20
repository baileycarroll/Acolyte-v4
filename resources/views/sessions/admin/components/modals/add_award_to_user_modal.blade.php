<div class="modal fade" id="addAwardToUser" tabindex="-1" aria-labelledby="addAwardToUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/add_award_to_user" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Give User Award</h4>
                    <input type="hidden" name="award" value="{{$award->id}}">
                    <label for="user">User:</label>
                    <select name="user" id="user" class="select" data-mdb-container="#addAwardToUser" data-mdb-filter="true" required>
                        <option>Select User</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
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
