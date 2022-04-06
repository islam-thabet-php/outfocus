@extends('xlstart::layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">{{ $project->title }}</h5>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-horizontal-layouts">
                <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('New Equipment') }}</h4>
                                </div>
                                <div class="card-body">
                                    <form id="crud-form" method="post" action="{{ route('project.equipments.save',['id'=>$project->id]) }}" class="form form-horizontal">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <label for="field-client_id">{{ __('Equipment') }} *</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-control select2 @error('equipment_id') error @enderror" name="equipment_id">
                                                        <option value="">{{ __('Select Equipment') }}</option>
                                                        @foreach($equipments as $equipment)
                                                            <option value="{{ $equipment->id }}">{{ $equipment->name }} - {{ $equipment->code }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <label for="field-client_id">{{ __('Employee') }}</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-control select2" name="user_id">
                                                        <option value="">{{ __('Select Employee') }}</option>
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <label for="field-start_date">{{ __('Start Date') }} *</label>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <input type="default-date-picker" id="field-start_date"
                                                           class="form-control pick-start-date @error('start_date') error @enderror"
                                                           value=""
                                                           name="start_date" placeholder="{{ __('Select Start Date') }}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <label for="field-end_date">{{ __('End Date') }} </label>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <input type="default-date-picker" id="field-end_date"
                                                           class="form-control pick-end-date "
                                                           value=""
                                                           name="end_date" placeholder="{{ __('Select End Date')}}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <label for="field-price">{{ __('Price') }} *</label>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <fieldset class=" position-relative ">
                                                        <input name="price" id="field-price" value="0" type="text" class="form-control @error('price') error @enderror " placeholder="{{ __('Enter Equipment Price') }}">
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button id="save-btn" type="submit" class="btn btn-primary float-right">{{ __('save') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-8 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('Project Equipments') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Actions') }}</th>
                                                <th>{{ __('Equipment') }}</th>
                                                <th>{{ __('Employee') }}</th>
                                                <th>{{ __('Start Date') }}</th>
                                                <th>{{ __('End Date') }}</th>
                                                <th>{{ __('Price') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($project_equipments as $equipment)
                                            <tr>
                                                <td>
                                                    <div class="dropdown">
                                                        <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('del_{{$equipment->id}}').submit();">
                                                                <i class="bx bx-trash mr-1"></i>Delete</a>
                                                            <form id="del_{{$equipment->id}}" action="{{ route('project.equipments.delete',['id'=>$equipment->id]) }}" method="POST" class="d-none">
                                                              @csrf
                                                                <input type="hidden" name="_method" value="DELETE"></form>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $equipment->equipment->name }}</td>
                                                <td>{{ (isset($equipment->user))?$equipment->user->name:'' }}</td>
                                                <td>{{ $equipment->start_date }}</td>
                                                <td>{{ $equipment->end_date }}</td>
                                                <td>{{ $equipment->price }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="5">{{ __('Total') }}</th>
                                            <th>{{ $project_equipments->sum('price') }}</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
    $('.pick-start-date').pickadate({format:"yyyy-mm-dd"});
    $('.pick-end-date').pickadate({format:"yyyy-mm-dd"});
    </script>
@endpush
