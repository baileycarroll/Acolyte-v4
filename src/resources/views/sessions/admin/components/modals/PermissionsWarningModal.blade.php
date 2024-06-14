<div class="modal fade" id="permissionWarningModal" tabindex="-1" aria-labelledby="permissionWarningModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/give_all_permissions/{{$role->id}}" method="post">
                @csrf
                <input type="hidden" name="role_id" value="{{$role->id}}">
                <div class="modal-body">
                    <h3 class="text-center text-primary">WARNING!</h3>
                    <p class="text-center mt-3 text-primary">This action will give the role FULL access to the system! This should only be available to the support user. Use with CAUTION!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Go Back To Safety</button>
                    <button type="submit" class="btn btn-primary">Give All Permissions</button>
                </div>
            </form>
        </div>
    </div>
</div>
