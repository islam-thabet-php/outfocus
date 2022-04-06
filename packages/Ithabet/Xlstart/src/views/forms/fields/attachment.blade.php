<!--
 field : {
    'notCrud' => true,
                'type' => 'attachment',
                'name' => 'avatar',
                'label' => __('Avatar'),
                'is_required'   => false,
                'store_rules'   =>'mimes:jpeg,jpg,png,gif|required|max:10000',
                'update_rules'  =>'mimes:jpeg,jpg,png,gif|required|max:10000',
                'value' => '',
                'class' => 'extra-class-names',
     }
 !-->
<div class="row align-items-center">
    <div class="col-md-4">
        <label for="field-{{$field->name}}">{{ $field->label }} {{ ($field->is_required)?'*':'' }}</label>
    </div>
    <div class="col-md-8 form-group">
        <div class="dropzone dropzone-area dz-clickable" id="{{$field->id}}">
            <div class="dz-message">{{ __('Choose File') }}</div>
            @if(isset($entity) && $entity->attachment($field->name))
                    <?php
                    $imageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                    $result = $entity->attachment($field->name);
                    ?>
                    @if($result && in_array($result->filetype, $imageTypes))
                            <div class="dz-preview dz-processing dz-image-preview dz-success dz-complete">
                                <div class="dz-image">
                                    <img data-dz-thumbnail="" width="165" alt=""
                                         src="{{ $result->url }}">
                                </div>
                            </div>
                    @else
                        <a href="{{ $result->url }}">{{ $result->filename }}</a>
                    @endif

            @endif
        </div>

        <input type="hidden"  @if(isset($entity) && $entity->attachment($field->name)) value="{{$entity->attachment($field->name)->id}}" @endif  name="attachment[{{$field->name}}]">
    </div>
</div>
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/ui/prism.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css/plugins/file-uploaders/dropzone.min.css">
    <style>
        .dropzone {
            height: 150px!important;
            min-height: 130px!important;
            padding: 5px!important;
        }
        .dropzone .dz-preview {
            margin:8px!important;
        }
        .dropzone .dz-message:before{
            top:5.2rem!important;
        }
        .dropzone .dz-message{
            font-size: 14px ;
        }
    </style>
@endpush
@push('scripts')

    <script>
            Dropzone.options.{{$field->id}} = {
            paramName: "file",
            url: '{{ route('attachments.dropzone') }}',
            headers: {
                'x-csrf-token': document.head.querySelector('meta[name="csrf-token"]').content,
            },
            maxFiles: 1,
            clickable: true,
            init: function () {
                this.on("maxfilesexceeded", function (e) {
                    this.removeAllFiles(), this.addFile(e);
                });
                this.on("success", function (file, response) {
                    $('input[name="attachment[{{$field->name}}]"]').val(response.uuid)  ;
                });
            },
        }
    </script>
@endpush
