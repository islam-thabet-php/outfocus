<!--
 field : {
    "type"=>"hidden",
    "name"=>"field_name",
    "value"=>$value,
    "store_rules"=>"required|attributes ...",
    "update_rules=>"",
    "attributes"=>""
 }

 !-->

<input type="{{$field->type}}" id="hidden-field-{{$field->name}}"
       @error($field->name)
       aria-describedby="field-{{$field->name}}-error"
@enderror
@if(isset($field->attributes))
    @foreach($field->attributes as $k=>$v)
        {{ $k }}="{{$v}}"
    @endforeach
@endif
value="{{ isset($entity->{$field->name})?$entity->{$field->name}:$field->value }}"
name="{{$field->name}}">
@error($field->name)
<span id="field-{{$field->name}}-error" class="error">{{ $message }}</span>
@enderror

