<div class="modal fade" id="addResourceModal" tabindex="-1" aria-labelledby="addResourceModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/add_resource" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Add Resource</h4>
                    <label for="#add_resource_type_name">Resource Name:</label>
                    <input type="text" name="resource_name" id="add_resource_name" class="form-control">

                    <label for="#add_resource_description">Resource Description:</label>
                    <textarea name="add_resource_description" id="add_resource_description" cols="30" rows="10" class="form-control"></textarea>

                    <label for="#add_resource_type_select">Select Resource Type:</label>
                    <select name="add_resource_type_select" id="add_resource_type_select" class="select" data-mdb-container="#addResourceModal" data-mdb-filter="true">
                        <option selected>Choose Resource Type</option>
                        @foreach($resource_types as $resource_type)
                            <option value="{{$resource_type->id}}">{{$resource_type->name}}</option>
                        @endforeach
                    </select>

                    <label for="#add_resource_url">Resource URL:</label>
                    <input type="text" name="add_resource_url" id="add_resource_url" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
