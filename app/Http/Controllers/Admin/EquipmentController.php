<?php

namespace App\Http\Controllers\Admin;


use App\Models\Equipment;
use Ithabet\Xlstart\Http\Controllers\BaseController;
use Ithabet\Xlstart\Http\Controllers\XlstartMainController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EquipmentController extends BaseController
{

    protected function setUp(){
        $data['entityName'] = 'equipment';
        $data['page'] = ['name'=>'simple-crud','title' => __('Equipments Management')];
        $data['columns'] = [
            ['label'=>__('ID'),'field'=>'id','type'=>'text'],
            ['label'=>__('QR-Code'),'field'=>'qrcode','type'=>'controller_function'],
            ['label'=>__('Name'),'field'=>'name','type'=>'text'],
            ['label'=>__('Model'),'field'=>'model','type'=>'text'],
            ['label'=>__('Code'),'field'=>'code','type'=>'text'],
            ['label'=>__('Type'),'field'=>'type.name','type'=>'model_relation'],
            ['label'=>__('Price'),'field'=>'price','type'=>'text'],
            ['label'=>__('Image'),'field'=>'attachments.image','type'=>'attachment'],
        ];
        $data['actions'] = true;
        $data['form']['route'] = 'equipments';
        $data['form']['title'] = __('Add New Equipment');
        $data['editForm']['title'] = __('Edit Equipment');
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
                'placeholder' =>  __('Enter Equipment Name'),
            ],

            [
                'type' => 'text',
                'name' => 'model',
                'label' => __('Model'),
                'is_required' => true,
                'value' => old('model'),
                'store_rules' =>'required',
                'update_rules' =>'required',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Enter Equipment Model'),
            ],
            [
                'type' => 'text',
                'name' => 'code',
                'label' => __('Code'),
                'is_required' => true,
                'value' => old('code'),
                'store_rules' =>'required|unique:equipments',
                'update_rules' =>'required',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Enter Equipment Code'),
            ],
            [
                'notCrud' => false,
                'type' => 'select',
                'name' => 'type_id',
                'label' => __('Type'),
                'is_required' => true,
                'store_rules' =>'required',
                'update_rules' =>'required',
                'value' => old('type_id'),
                'options'=> $this->get_dropdown_options('types',[]),
                'relation' =>'type',
                "attributes"=>[],
                'class' => 'extra-class-names',
            ],
            [
                'type' => 'text',
                'name' => 'price',
                'label' => __('Price'),
                'is_required' => true,
                'value' => old('price'),
                'store_rules' =>'required',
                'update_rules' =>'required',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Enter Equipment Price'),
            ],
            [
                'notCrud' => true,
                'type' => 'attachment',
                'id' => 'image',
                'name' => 'image',
                'label' => __('Image'),
                'is_required'   => false,
                'store_rules'   =>'mimes:jpeg,jpg,png,gif|required|max:10000',
                'update_rules'  =>'mimes:jpeg,jpg,png,gif|required|max:10000',
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

    public function view_qrcode($id){
        $equipment = Equipment::find($id);
        $equipment_url = url('equipments/'.$equipment->id);
        return QrCode::size(600)->generate($equipment_url);
    }
    public function qrcode($id){
        $equipment = Equipment::find($id);
        $equipment_url = url('equipments/'.$equipment->id);
        return '<a href="'.url('xadmin/equipments/'.$equipment->id.'/qrcode').'" target="_blank">'.QrCode::size(70)->generate($equipment_url).'</a>';
    }
}
