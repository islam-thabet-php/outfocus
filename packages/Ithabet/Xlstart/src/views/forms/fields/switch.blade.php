<!--
 field : {
    "type"=>"switch",
    "label"=>__("Field Label"),
    "name"=>"field_name",
    "value"=>$value,
 }

 !-->
<div class="row align-items-center">

    <div class="col-md-12 form-group">
        <div class="custom-control float-right custom-switch custom-control-inline mb-1">
            <input type="checkbox" name="{{$field->name}}" id="field-{{$field->name}}" value="1" class="custom-control-input"
                {{ (isset($entity->{$field->name})&&$entity->{$field->name}==1)||!isset($entity->{$field->name})&&$field->value? 'checked':'' }} >
            <label class="custom-control-label mr-1" for="field-{{$field->name}}">

            </label>
            <span>{{ $field->label }} </span>
        </div>
    </div>
</div>
