<?php

namespace App\Http\Controllers\Admin;


use Ithabet\Xlstart\Http\Controllers\BaseController;
use Ithabet\Xlstart\Http\Controllers\XlstartMainController;

class VendorController extends BaseController
{

    protected function setUp(){
        $data['entityName'] = 'vendor';
        $data['page'] = ['name'=>'simple-crud','title' => __('Vendors Management')];
        $data['columns'] = [
//            ['label'=>__('ID'),'field'=>'id','type'=>'text'],
//
            ['label'=>__('Name'),'field'=>'name','type'=>'text'],
            ['label'=>__('Phone'),'field'=>'phone','type'=>'text'],
            ['label'=>__('Notes'),'field'=>'notes','type'=>'text'],
            ['label'=>__('Balance'),'field'=>'balance','type'=>'text'],
        ];
        $data['actions'] = true;
        $data['form']['route'] = 'vendors';
        $data['form']['title'] = __('Add New Vendor');
        $data['editForm']['title'] = __('Edit Vendor');
        $data['form']['fields'] = [
            [
                'type' => 'text',
                'name' => 'name',
                'label' => __('Name'),
                'is_required' => true,
                'value' => old('name'),
                'store_rules' =>'required',
                'update_rules' =>'required',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Enter Vendor Name'),
            ],
            [
                'type' => 'text',
                'name' => 'phone',
                'label' => __('Phone'),
                'is_required' => true,
                'value' => old('phone'),
                'store_rules' =>'required',
                'update_rules' =>'required',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Enter Vendor Phone'),
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
                'placeholder' =>  __('Enter Vendor Notes'),
            ],
            [
                'type' => 'text',
                'name' => 'balance',
                'label' => __('Balance'),
                'is_required' => true,
                'value' => 0,
                'store_rules' =>'required',
                'update_rules' =>'required',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Enter Vendor Balance'),
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
