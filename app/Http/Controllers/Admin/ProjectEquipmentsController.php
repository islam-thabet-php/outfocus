<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Project;
use App\Models\ProjectEquipment;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectEquipmentsController extends Controller
{
    public function index($id){
        $project = Project::find($id);
        $equipments = Equipment::all();
        $users = User::where('is_active',1)->get();
        $project_equipments = ProjectEquipment::where('project_id',$id)->get();
        return view('project.equipments',compact('project_equipments','project','users','equipments'));
    }
    public function save(Request $request,$id){
        $rules = [
            'equipment_id'=>'required',
            'start_date'=>'required',
            'price'=>'required',
        ];
        $request->validate($rules);
        $project_equipment = new ProjectEquipment();
        $project_equipment->equipment_id = $request->equipment_id;
        $project_equipment->user_id = $request->user_id;
        $project_equipment->start_date = $request->start_date;
        $project_equipment->price = $request->price;
        $project_equipment->end_date = $request->end_date;
        $project_equipment->project_id = $id;
        $project_equipment->save();
        return back()->with(['status'=>'success','message'=>__('Added Successfully')]);
    }
    public function delete($id){
        ProjectEquipment::find($id)->delete();
        return back()->with(['status'=>'success','message'=>__('Deleted Successfully')]);
    }
}
