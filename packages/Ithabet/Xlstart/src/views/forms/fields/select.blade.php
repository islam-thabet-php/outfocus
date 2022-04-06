<!--
 field : {
    "type"=>"select",
    "label"=>__("Field Label"),
    "is_required"=true/false,
    "name"=>"field_name",
    "value"=>$value,
    "option"=> get_options(),
    "class"=>"extra-class-names",
    "store_rules"=>"required|attributes ...",
    "update_rules=>"",
    "attributes"=>""
     }
 !-->
<div class="row align-items-center">
    <div class="col-md-4">
        <label for="field-{{$field->name}}">{{ $field->label }} {{ ($field->is_required)?'*':'' }}</label>
    </div>
    <div class="col-md-8 form-group">
        @php
            $relation_id =0;
            if(isset($entity->{$field->relation})){
                $relation_id = isset($entity->{$field->relation}->id)?$entity->{$field->relation}->id:$entity->{$field->relation}->first()->id;
            }
        @endphp
        <select name="{{ $field->name }}" id="field-{{ $field->name }}"
        @error($field->name)
                aria-describedby="field-{{$field->name}}-error"
        @enderror
        @if(isset($field->attributes))
            @foreach($field->attributes as $k=>$v)
                {{ $k }}="{{$v}}"
            @endforeach
        @endif
        class="form-control {{ $field->class }}">
        <option value=""> -- {{ __('Select') }} {{ $field->label }} --</option>
        @foreach($field->options as $option)


            <option {{ ((isset($entity->{$field->relation}) && $relation_id && $relation_id ==  $option->id) || $option->id == $field->value)?'selected':'' }}
                    value="{{ $option->id }}">{{ $option->name }}</option>
        @endforeach
            </select>
        @error($field->name)
            <span id="field-{{$field->name}}-error" class="error">{{ $message }}</span>
        @enderror
    </div>
</div>
