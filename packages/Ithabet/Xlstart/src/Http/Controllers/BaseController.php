<?php

namespace Ithabet\Xlstart\Http\Controllers;
use App\Http\Controllers\Controller;
use Bnb\Laravel\Attachments\Attachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BaseController extends Controller
{
    public $xlstart;

    public function get_dropdown_options($tbl,$whereArray){
        $options = DB::table($tbl)->where($whereArray)->get();
        return $options;
    }
    public function xlValidate($request,$action){
        $rules = $this->getRules($action);
        $validatedData = $request->validate($rules);
        return $validatedData;
    }
    public function getRules($store_or_update){
        $rules = [];
        foreach ($this->xlstart->form->fields as $field){
            if($field->type != 'attachment') {
                if ($store_or_update == 'store') {
                    if (isset($field->store_rules)) {
                        $rules[$field->name] = $field->store_rules;
                    }
                } else {
                    if (isset($field->update_rules)) {
                        $rules[$field->name] = $field->update_rules;
                    }
                }
            }
        }
        return $rules;
    }
    public function getFeilds(Request $request){
        $fields = [];
        foreach ($this->xlstart->form->fields as $field){
            if(isset($field->notCrud) && $field->notCrud==true){
                continue;
            }
            $fieldName = $field->name;
            if($request->has($fieldName))
            $fields[$fieldName] = $request->$fieldName;
        }
        $fields = $this->customizedFields($fields,$request);
        return $fields;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->setUp($request);
        $xlstart = $this->xlstart;
        return view('xlstart::pages.'.$xlstart->page->name,compact('xlstart','request'));
    }
    public function edit($id,Request $request)
    {
        $this->setUp($request);
        $xlstart = $this->xlstart;
        $entityName = ucfirst($this->xlstart->entityName);
        $model = "App\\Models\\$entityName";
        $entity = $model::find($id);
        return view('xlstart::pages.'.$xlstart->page->name,compact('xlstart','entity'));
    }
    public function store(Request $request){
        $data=[];

        $this->setUp($data);
        $this->xlValidate($request,'store') ;
        $entityName = ucfirst($this->xlstart->entityName);
        $model = "App\\Models\\$entityName";
        $fields = $this->getFeilds($request);
        $entity = $model::create($fields);
        if($request->has('attachment')){
            foreach($request->attachment as $key=>$attachment){
                Attachment::attach($attachment, $entity,['key'=>$key]);
            }
        }
        $entity = $this->afterStore($entity,$request);
        return back()->with(['status'=>'success','message'=>__('Added Successfully')]);
        //return response()->json(["message"=>"success",$entityName=>$entity]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=[];
        $this->setUp($data);
        $this->xlValidate($request,'update') ;
        $entityName = ucfirst($this->xlstart->entityName);
        $model = "App\\Models\\$entityName";
        $entity = $model::find($id);
        $fields = $this->getFeilds($request);
        $update = $entity->update($fields);
        if($request->has('attachment')){
            foreach($request->attachment as $key=>$attachment){
                Attachment::attach($attachment, $entity,['key'=>$key]);
            }
        }
        $entity = $this->afterUpdate($entity,$request);
        return back()->with(['status'=>'success','message'=>__('Updated Successfully')]);
        //return response()->json(["message"=>"success",$entityName=>$entity]);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $this->setUp($request);
        $entityName = ucfirst($this->xlstart->entityName);
        $model = "App\\Models\\$entityName";
        $entity = $model::find($id);
        $entity->delete();
        return back()->with(['status'=>'success','message'=>__('Deleted Successfully')]);

    }

    public function DTList(Request $request)
    {
        $this->setUp($request);
        $entityName = ucfirst($this->xlstart->entityName);
        $model = "App\\Models\\$entityName";
        $columns = [];
        $model_relations = [];
        $table_relations = [];
        $controller_functions = [];
        $attachments = [];
        $actions = ['action'];
        foreach ($this->xlstart->columns as $column) {
            if ($column->type == 'attachment') {
                $columnField = explode('.', $column->field);
                array_push($attachments, $columnField[1]);
                continue;
            }
            if ($column->type == 'model_relation') {
                $relation =[];
                $columnField = explode('.', $column->field);
                $relation['model'] = $columnField[0];
                $relation['field'] = $columnField[1];
                array_push($model_relations, $relation);
                continue;
            }
            if ($column->type == 'controller_function') {
                $relation =  $column->field;
                array_push($controller_functions, $relation);
                continue;
            }
            array_push($columns, $column->field);
        }
        $rows = $model::query($columns);
        if($request->has('status')) {
            $rows = $model::where('status',$request->status);
        }


        $data = DataTables::of($rows);

        foreach ($attachments as $image) {
            $data->addColumn($image, function ($row) use ($image, $model) {
                $currentRow = $model::find($row['id']);
                $result = $currentRow->attachment($image);
                $imageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if ($result && in_array($result->filetype, $imageTypes))
                    return $result ? '<img src="' . $result->url . '" width="60">' : '';
                else
                    return $result ? '<a href="' . $result->url . '">' . $result->filename . '</a>' : '';
            });
        }
        foreach ($model_relations as $relation) {
            $data->addColumn($relation['model'].'_'.$relation['field'], function ($row) use ($relation, $model) {
                $cuurentRow = $model::find($row['id']);
                $results = json_decode($cuurentRow->{$relation['model']});

                $data = [];
                if (is_array($results)) {
                    foreach ($results as $result) {
                        $data[] = $result->{$relation['field']};
                    }
                } elseif($results) {
                    $data[] = $results->{$relation['field']};
                }
                return $data;

            });
            if(array_key_exists($relation['model'],$model::dt_relations)){
                $data->filterColumn($relation['model'].'_'.$relation['field'],function($query,$keyword)use ($relation, $model){
                    $current_relation = "App\\Models\\".$model::dt_relations[$relation['model']];
                    $relation_table = $model::dt_relations[$relation['model']];
                    $relation_field = strtolower($relation_table).'_id';
                    $ids = $current_relation::where('name','LIKE','%'.$keyword.'%')->pluck('id')->toArray();
                    $query->whereIn($relation_field,$ids);
                });
            }


        }
        foreach ($controller_functions as $function) {
            $data->addColumn($function, function ($row) use ($function, $model) {
                $data = $this->{$function}($row['id']);
                return $data;
            })->escapeColumns($function);
            $data->filterColumn($function,function($query,$keyword)use ($function, $model){
                if($keyword==$function){
                    $query->where($function,1);
                }
            });
        }
        if ($this->xlstart->actions){
            $data->addColumn('action', function ($row) use ($model) {
                $entity = $model::find($row['id']);
                $actions = $this->actions($entity);
                $actionBtn = '<div class="dropdown">
                    <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                    <div class="dropdown-menu dropdown-menu-right" style="">
                      ' . implode(' ', $actions) . '
                      </div>
                  </div>';
                return $actionBtn;
            });
        }
        $rowColumns = array_merge($attachments,$actions);
        $rowColumns = array_merge($model_relations,$rowColumns);
        $rowColumns = array_merge($controller_functions,$rowColumns);

        $data->rawColumns(array_values($rowColumns));
        $data->make(true);
       // dd($rowColumns);
        return $data->toJson();
    }

}
