@csrf
<div class="form-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label for="field-name">{{ __('Name') }}</label>
                </div>
                <div class="col-lg-10 col-9">
                    <input type="text" id="field-name"
                        class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}"
                        placeholder="{{ __('Role Name') }}" name="name"
                        value="{{ $model->name }}">
                    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>
        </div>

        <div class="col-12">
            <h5>{{ __('Permissions') }}</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <fieldset>
                                    <div class="checkbox">
                                        <input type="checkbox" class="checkbox-input" id="checkbox-all">
                                        <label for="checkbox-all"></label>
                                    </div>
                                </fieldset>
                            </th>
                            <th>{{ __('Module Name') }}</th>
                            <th>{{ __('Permissions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modules as $module)
                            <tr>
                                <td>
                                    <fieldset>
                                        <div class="checkbox">
                                            <input type="checkbox" class="check-all-module"
                                                id="checkbox-{{ $loop->index }}-all"
                                                data-module="{{ $module['module'] }}">
                                            <label for="checkbox-{{ $loop->index }}-all"></label>
                                        </div>
                                    </fieldset>
                                </td>
                                <td>{{ $module['module'] }}</td>
                                <td>
                                    @foreach ($module['permissions'] as $permission)
                                        <fieldset class="float-left m-2">
                                            <div class="checkbox">
                                                <input type="checkbox" name="permissions[]"
                                                    value="{{ $permission['id'] }}" class="checkbox-input-permission"
                                                    data-module="{{ $module['module'] }}"
                                                    id="checkbox-{{ $permission['id'] }}-{{ $permission['name'] }}"
                                                    @if ($permission['is_selected']) checked="checked" @endif>
                                                <label
                                                    for="checkbox-{{ $permission['id'] }}-{{ $permission['name'] }}">{{ $permission['title'] }}</label>
                                            </div>
                                        </fieldset>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mr-1">{{ __('Save') }}</button>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#checkbox-all').on('click', function() {
                $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
            });

            $('.check-all-module').on('click', function() {
                let module = $(this).data('module');
                $(".checkbox-input-permission[data-module=" + module + "]").prop("checked", $(this).prop(
                    "checked"));
            });
        });
    </script>
@endpush
