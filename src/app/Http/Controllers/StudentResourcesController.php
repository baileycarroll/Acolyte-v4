<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_Resources;

class StudentResourcesController extends Controller
{
    public function addResource(Request $request) {
        $resource = new Student_Resources();
        $resource->name = $request->resource_name;
        $resource->description = $request->add_resource_description;
        $resource->type = $request->add_resource_type_select;
        $resource->url = $request->add_resource_url;
        $resource->save();
        return redirect('/resources')->with('status', 'Resource Created!');
    }
    public function updateResource(Request $request) {
        $resource = Student_Resources::findOrFail($request->resource_id);
        $resource->name = $request->resource_name;
        $resource->description = $request->editResourceDescription;
        $resource->type = $request->editResourceType;
        $resource->url = $request->editResourceUrl;
        $resource->save();
        return redirect('/resources')->with('status', 'Resource Updated!');
    }
    public function deleteResource(Request $request){
        $resource_type = Student_Resources::findOrFail($request->resource_id);
        $resource_type->delete();
        return redirect('/resources')->with('status', 'Resource Deleted!');
    }
}
