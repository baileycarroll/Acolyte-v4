<?php

namespace App\Http\Controllers;

use App\Models\Resource_Types;
use Illuminate\Http\Request;

class ResourceTypesController extends Controller
{
    public function addResourceType(Request $request) {
        $resource_type = new Resource_Types();
        $resource_type->name = $request->resource_type_name;
        $resource_type->save();
        return redirect('/resource_types')->with('status', 'Resource Type Created!');
    }
    public function updateResourceType(Request $request) {
        $resource_type = Resource_Types::findOrFail($request->resource_type_id);
        $resource_type->name = $request->resource_type_name;
        $resource_type->save();
        return redirect('/resource_types')->with('status', 'Resource Type Updated!');
    }
    public function deleteResourceType(Request $request){
        $resource_type = Resource_Types::findOrFail($request->resource_type_id);
        $resource_type->delete();
        return redirect('/resource_types')->with('status', 'Resource Type Deleted!');
    }
    public static function showResourceTypes() {
        return view('sessions.admin.resource_types', ['resource_types' => Resource_Types::all()]);
    }
    public static function resourceTypeInformationRead($id) {
        return view('sessions.admin.resource_types_information_readonly', ['resource_type' => Resource_Types::find($id)]);
    }
    public static function resourceTypeInformation($id) {
        return view('sessions.admin.resource_types_information_readonly', ['resource_type' => Resource_Types::find($id)]);
    }
}
