<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Bnb\Laravel\Attachments\Attachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ithabet\Xlstart\Http\Controllers\BaseController;
use Ithabet\Xlstart\Http\Controllers\XlstartMainController;

class UserController extends BaseController
{

    protected function setUp(){
        $data['entityName'] = 'user';
        $data['page'] = ['name'=>'simple-crud','title' => __('Users Management')];
        $data['columns'] = [
            ['label'=>__('ID'),'field'=>'id','type'=>'text'],
//            ['label'=>__('Avatar'),'field'=>'attachments.avatar','type'=>'attachment'],
            ['label'=>__('Role'),'field'=>'roles.name','type'=>'model_relation'],
            ['label'=>__('User Name'),'field'=>'name','type'=>'text'],
            ['label'=>__('User Email'),'field'=>'email','type'=>'text'],
        ];
        $data['actions'] = true;
        $data['form']['route'] = 'users';
        $data['form']['title'] = __('Add New User');
        $data['editForm']['title'] = __('Edit User');
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
                'placeholder' =>  __('Enter User Name'),
            ],
            [
                'type' => 'text',
                'name' => 'email',
                'label' => __('Email'),
                'is_required' => true,
                'value' => old('email'),
                'store_rules' =>'required|email|unique:users',
                'update_rules' =>'required',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Enter Email Address'),
            ],
            [
                'notCrud' => true,
                'type' => 'select',
                'name' => 'role_id',
                'label' => __('Role'),
                'is_required' => true,
                'store_rules' =>'required',
                'update_rules' =>'required',
                'value' => '',
                'options'=> $this->get_dropdown_options('roles',[]),
                'relation' =>'roles',
                'class' => 'extra-class-names',
            ],
        ];
        $data['form']['fields'][] = [
            'type' => 'password',
            'name' => 'password',
            'label' => __('Password'),
            'is_required' => true,
            'value' => '',
            'store_rules' =>'required|min:6',
            'update_rules' =>'',
            'class' => 'extra-class-names',
            'placeholder' =>  __('Enter Password'),
        ];
        $data['form']['fields'][] =[
            'type' => 'text',
            'name' => 'full_name',
            'label' => __('Full Name'),
            'is_required' => true,
            'value' => old('full_name'),
            'store_rules' =>'required',
            'update_rules' =>'required',
            'class' => 'extra-class-names ',
            'placeholder' =>  __('Enter Employee Full Name'),
        ];
        $data['form']['fields'][] =[
            'type' => 'text',
            'name' => 'national_id',
            'label' => __('National ID'),
            'is_required' => true,
            'value' => old('national_id'),
            'store_rules' =>'required',
            'update_rules' =>'required',
            'class' => 'extra-class-names ',
            'placeholder' =>  __('Enter Employee National ID'),
        ];
        $data['form']['fields'][] =[
            'type' => 'text',
            'name' => 'phone_number',
            'label' => __('Phone Number'),
            'is_required' => true,
            'value' => old('phone_number'),
            'store_rules' =>'required',
            'update_rules' =>'required',
            'class' => 'extra-class-names ',
            'placeholder' =>  __('Enter Employee Phone Number'),
        ];
        $data['form']['fields'][] =[
            'type' => 'text',
            'name' => 'alt_phone_number',
            'label' => __('Alt Phone Number'),
            'is_required' => true,
            'value' => old('alt_phone_number'),
            'store_rules' =>'required',
            'update_rules' =>'required',
            'class' => 'extra-class-names ',
            'placeholder' =>  __('Enter Employee Alt Phone Number'),
        ];
        $data['form']['fields'][] =[
            'type' => 'text',
            'name' => 'job_title',
            'label' => __('Job Title'),
            'is_required' => true,
            'value' => old('job_title'),
            'store_rules' =>'required',
            'update_rules' =>'required',
            'class' => 'extra-class-names ',
            'placeholder' =>  __('Enter Employee Job Title'),
        ];
        $data['form']['fields'][] =[
            'type' => 'text',
            'name' => 'basic_salary',
            'label' => __('Basic Salary'),
            'is_required' => true,
            'value' => old('basic_salary'),
            'store_rules' =>'required',
            'update_rules' =>'required',
            'class' => 'extra-class-names',
            'placeholder' =>  __('Enter Employee Basic Salary'),
        ];
        $data['form']['fields'][] =          [
                'notCrud' => true,
                'type' => 'attachment',
                'id' => 'avatar',
                'name' => 'avatar',
                'label' => __('Profile Picture'),
                'is_required'   => false,
                'store_rules'   =>'mimes:jpeg,jpg,png,gif|required|max:10000',
                'update_rules'  =>'mimes:jpeg,jpg,png,gif|required|max:10000',
            ];
        $data['form']['fields'][] =
            [
                'type' => 'switch',
                'name' => 'is_active',
                'label' => __('Active'),
                'value' => '0',
                'placeholder' =>  __('Is Active'),
            ];
        $data['form']['fields'][] =
            [
                'type' => 'textarea',
                'name' => 'address',
                'label' => __('Address'),
                'is_required' => true,
                'value' => old('address'),
                'store_rules' =>'required',
                'update_rules' =>'required',
                'class' => '',
                'placeholder' =>  __('Enter Employee Address'),
            ];
        $setup = new XlstartMainController($data);
        $this->xlstart = $setup->setUp();
    }
    /*
     *  Customize request fields and inject in store / update function
     */
    public function customizedFields($fields,$request){
        /* fields customizations */
        if(isset($request->password))
        $fields['password'] = bcrypt($request->password);

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

        if($entity->id != 1)
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
        $entity->assignRole($request->role_id);
        return $entity;
    }
    public function afterUpdate($entity, $request){
        $entity->roles()->detach();
        $entity->assignRole($request->role_id);
        if(!isset($request->is_active)){
            $entity->is_active=0;
        }
        $entity->save();
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



    public function updatePassword(Request $request){
        $user = User::find(auth()->user()->id);
        if($request->has('password')){


                $user->password = bcrypt($request->password);
                $user->save();
                return back()->with(['status'=>'success','message'=>__('Password Updated')]);


        }
        return back();
    }

}
