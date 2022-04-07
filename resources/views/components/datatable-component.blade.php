    <table class="table table-striped table-hover  zero-configuration">
        <thead>
        <tr>
            @if($dataTable->actions)
                <th>{{ __('actions') }}</th>
            @endif
            @foreach($dataTable->columns as $column)
                <th>{{ $column->label }}</th>
            @endforeach

        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
@endpush
@push('scripts')
    <script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/tables/datatable/buttons.colVis.min.js"></script>
    <script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script>
        $(".zero-configuration").DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'colvis',
                    collectionLayout: 'four-column'
                }
            ],
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route($dataTable->route,isset($request)?$request->all():[]) }}",
            columns: [
                    @if($dataTable->actions)
                {data: 'action', name: 'action',orderable: false, searchable: false },
                    @endif
                    @foreach($dataTable->columns as $column)

                {data: '{{ $column->data }}', name: '{{ $column->name }}',orderable: true, searchable: true},
                @endforeach

            ]
        });
    </script>
@endpush
