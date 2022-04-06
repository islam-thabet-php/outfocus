@extends('xlstart::layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">{{ $xlstart->page->title }}</h5>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-horizontal-layouts">
                <div class="row">
                    @if(isset($entity))
                        <div class="col-md-4 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ $xlstart->editForm->title }}</h4>
                                </div>
                                <div class="card-body">
                                    <form id="crud-form" method="post" action="{{ route($xlstart->form->route.'.update',[$xlstart->entityName=>$entity->id]) }}" class="form form-horizontal">
                                        <input type="hidden" name="_method" value="PUT">
                                        @csrf
                                        <div class="form-body">
                                            @foreach($xlstart->form->fields as $field)
                                                @include('xlstart::forms.fields.'.$field->type)
                                            @endforeach
                                            <div class="row">
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button id="save-btn" type="submit" class="btn btn-primary float-right">{{ __('save') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-4 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ $xlstart->form->title }}</h4>
                                </div>
                                <div class="card-body">
                                    <form id="crud-form" method="post" action="{{ route($xlstart->form->route.'.store') }}" class="form form-horizontal">
                                        @csrf
                                        <div class="form-body">
                                            @foreach($xlstart->form->fields as $field)
                                                @include('xlstart::forms.fields.'.$field->type)
                                            @endforeach
                                                <div class="row">
                                                    <div class="col-sm-12 d-flex justify-content-end">
                                                        <button id="save-btn" type="submit" class="btn btn-primary float-right">{{ __('save') }}</button>
                                                    </div>
                                                </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                        <div class="col-md-8 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __(ucfirst($xlstart->form->route)) }}</h4>
                            </div>
                            <div class="card-body">
                                @include('xlstart::datatables.simple-table')
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection


