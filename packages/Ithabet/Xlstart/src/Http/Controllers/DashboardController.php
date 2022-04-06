<?php

namespace Ithabet\Xlstart\Http\Controllers;
use Request;
use Ithabet\Xlstart\Http\Controllers\BaseController;

class DashboardController extends BaseController
{
    public $xlstart;
    public $model;
    public function __construct()
    {
        $data['page'] = ['name'=>'simple-crud','title' => __('Entity Name')];
        $data['form']['title'] = __('Add New Entity');
        $data['form']['fields'] = [
            [
                'type' => 'text',
                'name' => 'field_name',
                'label' => __('Field Label'),
                'is_required' => true,
                'value' => '',
                'store_rules' =>'required',
                'update_rules' =>'required',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Field Placeholder')
            ],
            [
                'type' => 'text',
                'name' => 'email_name',
                'label' => __('Field Label'),
                'is_required' => true,
                'store_rules' =>'required|email',
                'update_rules' =>'required|email',
                'value' => '',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Field Placeholder')
            ],
        ];
        $setup = new XlstartMainController($data);
        $this->xlstart = $setup->setup();
    }

    public function index(){
       $xlstart = $this->xlstart;
       return view('xlstart::pages.simple-crud',compact('xlstart'));
   }
   public function store(Request $request){
        $this->xlstart->validate($request,'store');
        dd($request);
   }
}
