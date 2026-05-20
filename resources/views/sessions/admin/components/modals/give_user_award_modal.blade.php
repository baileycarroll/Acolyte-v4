<div class="modal fade" id="addAwardToUser" tabindex="-1" aria-labelledby="addAwardToUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/give_award_to_user" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Give User Award</h4>
                    <input type="hidden" name="user" value="{{$user->id}}">
                    <label for="award">Award:</label>
                    <select name="award" id="award" class="select" data-mdb-container="#addAwardToUser" data-mdb-filter="true" required>
                        <option>Select Award</option>
                        @foreach($awards as $award)
                            <option value="{{$award->id}}">{{$award->name}}</option>
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
