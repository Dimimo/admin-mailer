
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
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css">
@endpush

@push('js')
    <script type="text/javascript" src="//cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('table#customers_table').DataTable({
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: "{{ route('admin-mailer.customers.table.index') }}",
                columns: [
                    { name: 'name' },
                    { name: 'email' },
                    { name: 'city.name', orderable: false, searchable: false },
                    { name: 'list.name', orderable: false, searchable: false },
                    { name: 'accepts_mail', searchable: false },
                    { name: 'reads_mail', searchable: false },
                    { name: 'url', orderable: false, searchable: false },
                    { name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush
