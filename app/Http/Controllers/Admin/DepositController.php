<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Bnb\Laravel\Attachments\Attachment;
use Illuminate\Http\Request;
use Ithabet\Xlstart\Http\Controllers\BaseController;
use Ithabet\Xlstart\Http\Controllers\XlstartMainController;

class DepositController extends BaseController
{

    protected function setUp(){
        $data['entityName'] = 'deposit';
        $data['page'] = ['name'=>'simple-crud','title' => __('Deposits Management')];
        $data['columns'] = [
//            ['label'=>__('ID'),'field'=>'id','type'=>'text'],
//
            ['label'=>__('Title'),'field'=>'name','type'=>'text'],
            ['label'=>__('Receiver Name'),'field'=>'user.name','type'=>'model_relation'],
            ['label'=>__('Depositer'),'field'=>'depositer.name','type'=>'model_relation'],
            ['label'=>__('Amount'),'field'=>'amount','type'=>'text'],
            ['label'=>__('Date'),'field'=>'created_at','type'=>'text'],
        ];
        $data['actions'] = true;
        $data['form']['route'] = 'deposits';
        $data['form']['title'] = __('Add New Deposit');
        $data['editForm']['title'] = __('Edit Deposit');
        $data['form']['fields'] = [
            [
                'type' => 'text',
                'name' => 'name',
                'label' => __('Title'),
                'is_required' => true,
                'value' => old('name'),
                'store_rules' =>'required',
                'update_rules' =>'required',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Enter Deposit Name'),
            ],
            [
                'notCrud' => false,
                'type' => 'select',
                'name' => 'user_id',
                'label' => __('Deposit To'),
                'is_required' => true,
                'store_rules' =>'required',
                'update_rules' =>'required',
                'value' => old('user_id'),
                'options'=> $this->get_dropdown_options('users',[]),
                'relation' =>'user',
                "attributes"=>[],
                'class' => 'extra-class-names',
            ],
            [
                'type' => 'text',
                'name' => 'amount',
                'label' => __('Amount'),
                'is_required' => true,
                'value' => old('amount'),
                'store_rules' =>'',
                'update_rules' =>'',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Enter Amount'),
            ],

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
        $entity->depositer_id = auth()->user()->id;
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


}
