<?php

namespace App\Http\Controllers\Admin;


use App\Models\Project;
use Ithabet\Xlstart\Http\Controllers\BaseController;
use Ithabet\Xlstart\Http\Controllers\XlstartMainController;

class ProjectController extends BaseController
{

    protected function setUp(){
        $data['entityName'] = 'project';
        $data['page'] = ['name'=>'simple-crud','title' => __('Projects Management')];
        $data['columns'] = [
//            ['label'=>__('ID'),'field'=>'id','type'=>'text'],
//
            ['label'=>__('Title'),'field'=>'title','type'=>'text'],
            ['label'=>__('Start Date'),'field'=>'start_date','type'=>'text'],
            ['label'=>__('End Date'),'field'=>'end_date','type'=>'text'],
            ['label'=>__('Client'),'field'=>'client.name','type'=>'model_relation'],
            ['label'=>__('Created By'),'field'=>'user.name','type'=>'model_relation'],
            ['label'=>__('status'),'field'=>'status','type'=>'controller_function'],
        ];
        $data['actions'] = true;
        $data['form']['route'] = 'projects';
        $data['form']['title'] = __('Add New Project');
        $data['editForm']['title'] = __('Edit Project');
        $data['form']['fields'] = [
            [
                'type' => 'text',
                'name' => 'title',
                'label' => __('Title'),
                'is_required' => true,
                'value' => old('title'),
                'store_rules' =>'required',
                'update_rules' =>'required',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Enter Project Title'),
            ],
            [
                'notCrud' => false,
                'type' => 'select',
                'name' => 'client_id',
                'label' => __('Client'),
                'is_required' => true,
                'store_rules' =>'required',
                'update_rules' =>'required',
                'value' => old('client_id'),
                'options'=> $this->get_dropdown_options('clients',[]),
                'relation' =>'client',
                "attributes"=>[],
                'class' => 'select2',
            ],
            [
                'type' => 'default-date-picker',
                'name' => 'start_date',
                'label' => __('Start Date'),
                'is_required' => true,
                'value' => old('start_date'),
                'store_rules' =>'required',
                'update_rules' =>'required',
                'class' => 'pick-start-date',
                'placeholder' =>  __('Select Start Date'),
            ],
            [
                'type' => 'default-date-picker',
                'name' => 'end_date',
                'label' => __('End Date'),
                'is_required' => false,
                'value' => old('end_date'),
                'store_rules' =>'',
                'update_rules' =>'',
                'class' => 'pick-end-date',
                'placeholder' =>  __('Select End Date'),
            ],
            [
                'type' => 'textarea',
                'name' => 'notes',
                'label' => __('Notes'),
                'is_required' => false,
                'value' => old('notes'),
                'store_rules' =>'',
                'update_rules' =>'',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Enter Project Notes'),
            ]
        ];
        $setup = new XlstartMainController($data);
        $this->xlstart = $setup->setUp();
    }
    /*
     *  Customize request fields and inject in store / update function
     */
    public function customizedFields($fields,$request){
        /* fields customizations */

        /* end of fields customizations */
        return $fields;
    }




    /**
     * Actions appears on data table.
     */
    public function actions($entity)
    {

        $actions[] = '<a class="dropdown-item"
        href="'.route('project.equipments',['id'=>$entity->id]).'">
                            <i class="bx bx-camera-movie mr-1"></i>'.__('Equipments').'</a>';

        $actions[] = '<a class="dropdown-item"
        href="'.route($this->xlstart->form->route.'.edit',[$this->xlstart->entityName=>$entity->id]).'">
                            <i class="bx bx-money mr-1"></i>'.__('Expenses').'</a>';

        $actions[] = '<a class="dropdown-item"
        href="'.route('project.payments',['id'=>$entity->id]).'">
                            <i class="bx bx-money mr-1"></i>'.__('Payments').'</a>';


        $actions[] = '<a class="dropdown-item"
        href="'.route($this->xlstart->form->route.'.edit',[$this->xlstart->entityName=>$entity->id]).'">
                            <i class="bx bx-edit-alt mr-1"></i>'.__('Edit').'</a>';

        $actions[] = '<a class="dropdown-item"
        href="'.route($this->xlstart->form->route.'.destroy',[$this->xlstart->entityName=>$entity->id]).'"
        onclick="event.preventDefault(); document.getElementById(\'del_'.$entity->id.'\').submit();">
                            <i class="bx bx-trash mr-1"></i>'.__('Delete').'</a>
                            <form id="del_'.$entity->id.'" action="'.route($this->xlstart->form->route.'.destroy',[$this->xlstart->entityName=>$entity->id]).'" method="POST" class="d-none">
                                '.csrf_field().'
                                <input type="hidden" name="_method" value="DELETE"></form>';
        return $actions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * For Overriding store method uncomment below method
     */
    public function afterStore($entity, $request){
        $entity->user_id  = auth()->user()->id;
        $entity->save();
        return $entity;
    }
    public function afterUpdate($entity, $request){

        return $entity;
    }
//    public function store(Request $request){
//
//    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    public function status($id){
        $project = Project::find($id);
        if($project->status == 'pending')
            $data = '<span class="badge-round badge badge-info">'.__($project->status).'</span>';

        return $data;
    }
}
