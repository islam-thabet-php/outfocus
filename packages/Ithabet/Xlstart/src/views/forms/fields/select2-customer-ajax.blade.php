<!--
 field : {
    "type"=>"select2-data-ajax",
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
        @if(((isset($entity->{$field->relation}) && isset($entity->{$field->relation}->id) ) ))
        <option selected
                value="{{ $entity->{$field->relation}->id }}">{{ $entity->{$field->relation}->name }}</option>
            @endif
            </select>
            @error($field->name)
            <span id="field-{{$field->name}}-error" class="error">{{ $message }}</span>
            @enderror
    </div>
</div>
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets') }}/app-assets/vendors/css/forms/select/select2.min.css">
@endpush
@push('scripts')
    <script src="{{ asset('xlstart-assets') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script>
        $(function (){

            $('#field-{{ $field->name }}').select2({
                dropdownAutoWidth: false,
                width: "100%",
                ajax: {
                    url: APP_URL+"xadmin/customers/ajax/list", dataType: "json", delay: 250, data: function (e) {
                         return {q: e.term}
                    }, processResults: function (e) {
                        return  {results: e}
                    }, cache: false
                },
                placeholder: "{{ $field->placeholder }}",
                escapeMarkup: function (e) {
                    return e
                },
                minimumInputLength: 4,
                templateResult: function (e) {
                    if (e.loading) return e.text;
                    var t = "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__meta'>" +
                        "<div class='select2-result-repository__title'>" + e.name + "</div>"+
                    "<div class='select2-result-repository__description'>" + e.phone + "</div>";
                    return t += "<div class='select2-result-repository__statistics'><p>" + e.address + "</p></div></div></div>";
                },
                templateSelection: function (e) {
                    $('select[name="type"],input[name="remain_items"],input[name="remain_orders"]').remove();

                    if(check_subscription(e) && e.subscription ){
                        $('#field-{{ $field->name }}').closest('div').append('<select name="type" class="form-control">' +
                            '<option value="2">'+e.subscription.plan.name+'| I ='+e.subscription.remain_items+'| O='+e.subscription.remain_orders+'</option>' +
                            '<option value="1">--</option>' +
                            '</select>' +
                            '<input name="remain_items" value="'+e.subscription.remain_items+'" type="hidden">' +
                            '<input name="remain_orders" value="'+e.subscription.remain_orders+'" type="hidden">');
                        calculate_totals();
                    }
                    if(e.address) $('#field-delivery_address').val(e.address);

                    $('#field-notes').val(e.notes);
                    return e.name || e.phone
                }
            });
            @if( isset($entity) && $entity->type==2)
            $('#field-{{ $field->name }}').closest('div').append('<select name="type" class="form-control">' +
                '<option value="2">{{ $entity->customer->subscription->plan->name }}| I ={{ $entity->customer->subscription->remain_items }}| O={{ $entity->customer->subscription->remain_orders }}</option>' +
                '<option value="1">--</option>' +
                '</select>' +
                '<input name="remain_items" value="{{ $entity->customer->subscription->remain_items }}" type="hidden">' +
                '<input name="remain_orders" value="{{ $entity->customer->subscription->remain_orders }}" type="hidden">');
                calculate_totals();
            @endif
            @if( isset($entity)&&$entity->{$field->relation}->name)
                $('#select2-field-{{$field->name}}-container').html('{{$entity->{$field->relation}->name}}');
            @endif
        });
        function check_subscription(e){
            let state = false;
             $.ajax({
                type:'GET',
                 async: false,
                 url: APP_URL+'xadmin/customers/'+e.id+'/subscription/state',
                success:function(data) {
                    state = data;
                }
            });
             return state;
        }
    </script>
@endpush
