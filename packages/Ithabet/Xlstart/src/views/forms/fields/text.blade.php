<!--
 field : {
    "type"=>"text",
    "label"=>__("Field Label"),
    "is_required"=true/false,
    "name"=>"field_name",
    "value"=>$value,
    "placeholder"=>__("Field Placeholder"),
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
        <fieldset class="form-group position-relative ">
            <input  name="{{ $field->name }}" id="field-{{$field->name}}" @error($field->name)
            aria-describedby="field-{{$field->name}}-error"@error($field->name) error @enderror
                   @enderror
                   value="{{ isset($entity->{$field->name})?$entity->{$field->name}:$field->value }}"
                   type="text" class="form-control {{ $field->class }} @error($field->name) error @enderror"
            @if(isset($field->attributes))
                @foreach($field->attributes as $k=>$v)
                    {{ $k }}="{{$v}}"
                @endforeach
            @endif placeholder="{{ $field->placeholder }}">

            @error($field->name)
            <span id="field-{{$field->name}}-error" class="error">{{ $message }}</span>
            @enderror
        </fieldset>
    </div>
</div>
