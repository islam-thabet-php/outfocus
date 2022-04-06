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
                                    <h4 class="card-title">{{ __('New Expense') }}</h4>
                                </div>
                                <div class="card-body">
                                    <form id="crud-form" method="post" action="{{ route('project.expenses.save',['id'=>$project->id]) }}" class="form form-horizontal">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <label for="field-client_id">{{ __('Title') }} *</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <fieldset class=" position-relative ">
                                                        <input name="title" id="field-title" value="" type="text" class="form-control @error('title') error @enderror " placeholder="{{ __('Enter Payment Title') }}">
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <label for="field-price">{{ __('Amount') }} *</label>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <fieldset class=" position-relative ">
                                                        <input name="amount" id="field-amount" value="0" type="text" class="form-control @error('amount') error @enderror " placeholder="{{ __('Enter Payment Amount') }}">
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
                                <h4 class="card-title">{{ __('Project Expenses') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Actions') }}</th>
                                                <th>{{ __('Employee') }}</th>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Date') }}</th>
                                                <th>{{ __('Amount') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($project_expenses as $expense)
                                            <tr>
                                                <td>
                                                    <div class="dropdown">
                                                        <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('del_{{$expense->id}}').submit();">
                                                                <i class="bx bx-trash mr-1"></i>Delete</a>
                                                            <form id="del_{{$expense->id}}" action="{{ route('project.expense.delete',['id'=>$expense->id]) }}" method="POST" class="d-none">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE"></form>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $expense->user->name }}</td>
                                                <td>{{ $expense->title }}</td>
                                                <td>{{ $expense->created_at }}</td>
                                                <td>{{ $expense->amount }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="4">{{ __('Total') }}</th>
                                            <th>{{ $project_expenses->sum('amount') }}</th>
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
