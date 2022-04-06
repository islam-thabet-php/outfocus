<?php

namespace Ithabet\Xlstart\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Ithabet\Xlstart\Http\Controllers\BaseController;

class CategoriesController extends BaseController
{
    protected function setUp(){
        $data['page'] = ['name'=>'simple-crud','title' => __('Categories')];
        $data['form']['route'] = 'categories';
        $data['form']['title'] = __('Add New Category');
        $data['form']['fields'] = [
            [
                'type' => 'text',
                'name' => 'name',
                'label' => __('Name'),
                'is_required' => true,
                'value' => '',
                'store_rules' =>'required',
                'update_rules' =>'required',
                'class' => 'extra-class-names',
                'placeholder' =>  __('Enter Category Name'),
                'attributes'=>['data-target'=>'name'],
            ],
            [
                'type' => 'select',
                'name' => 'parent',
                'label' => __('Parent Category'),
                'is_required' => true,
                'store_rules' =>'required',
                'update_rules' =>'',
                'value' => '',
                'options'=> $this->get_dropdown_options('categories',[]),
                'class' => 'extra-class-names',
                'attributes'=>['data-target'=>'name'],

            ],
        ];
        $setup = new XlstartMainController($data);
        $this->xlstart = $setup->setup();
    }

    public function index(){
        $this->setUp();
        $xlstart = $this->xlstart;
        return view('xlstart::pages.simple-crud',compact('xlstart'));
   }


}
