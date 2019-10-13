<table id="customers_table" class="table table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>City</th>
        <th>List</th>
        <th title="Accepts mail?"><span class="fas fa-at"></span></th>
        <th title="Reads mail?"><span class="fas fa-eye"></span></th>
        <th><span class="fas fa-link" title="Has a known website?"></span></th>
        <th></th>
    </tr>
    </thead>
</table>

@push('css')
    <link rel="stylesheet" type="text/css" href="/vendor/admin-mailer/css/datatables.min.css">
@endpush

@push('js')
    <script type="text/javascript" src="/vendor/admin-mailer/js/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('table#customers_table').DataTable({
                serverSide: true,
                processing: true,
                responsive: true,
                cache: false,
                ajax: {
                    "url": "{{ route('admin-mailer.customers.table.index') }}",
                    @if (isset($query))
                    "data": {!! $query !!}
                    @endif
                },
                columns: [
                    {name: 'name'},
                    {name: 'email'},
                    {name: 'city_name', orderable: false, searchable: false},
                    {name: 'list.name', orderable: false, searchable: false},
                    {name: 'accepts_mail', searchable: false},
                    {name: 'reads_mail', searchable: false},
                    {name: 'url', orderable: false, searchable: false},
                    {name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush
