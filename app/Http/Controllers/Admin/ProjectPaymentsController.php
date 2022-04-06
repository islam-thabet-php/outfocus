<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Project;
use App\Models\ProjectEquipment;
use App\Models\ProjectPayment;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectPaymentsController extends Controller
{
    public function index($id){
        $project = Project::find($id);
        $users = User::where('is_active',1)->get();
        $project_payments = ProjectPayment::all();
        return view('project.payments',compact('project_payments','project','users'));
    }
    public function save(Request $request,$id){
        $rules = [
            'title'=>'required',
            'amount'=>'required',
        ];
        $request->validate($rules);
        $project_payment = new ProjectPayment();
        $project_payment->title = $request->title;
        $project_payment->user_id = auth()->user()->id;
        $project_payment->project_id = $id;
        $project_payment->amount = $request->amount;
        $project_payment->save();
        return back()->with(['status'=>'success','message'=>__('Added Successfully')]);
    }
    public function delete($id){
        ProjectPayment::find($id)->delete();
        return back()->with(['status'=>'success','message'=>__('Deleted Successfully')]);
    }
}
