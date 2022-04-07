@extends('xlstart::layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">{{ __('Roles Management') }}</h5>
                    <div class="float-right">
                        @can('roles.create')
                            <a href="{{ route('roles.create') }}" class="btn  btn-primary"> <i class="bx bx-plus-circle"></i>
                                {{ __('New') }}</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('Roles') }}</h4>
                            </div>
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>{{ __('ID') }}</th>
                                                <th>{{ __('Role Name') }}</th>
                                                <th>{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <span
                                                                class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false" role="menu"></span>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <x-edit-component :href="route('roles.edit', [$item->id])"
                                                                    permission="roles.edit" />
                                                                <x-delete-component
                                                                    :href="route('roles.destroy', [$item->id])"
                                                                    permission="roles.destroy" :id="$item->id" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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

@push('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
@endpush

@push('scripts')
    <script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js">
    </script>
    <script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js">
    </script>
    <script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js">
    </script>
    <script src="{{ asset('xlstart-assets/') }}/app-assets/js/scripts/datatables/datatable.min.js"></script>
@endpush
