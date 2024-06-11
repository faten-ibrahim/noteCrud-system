<!DOCTYPE html>
<html>

<head>
    <meta name="_token" content="{{ csrf_token() }}">

    <title>notes</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">My Notes</h3>
            <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('status') }}
                    </div>
                @endif
                <br>
                <a class="btn btn-info btn-sm" href="notes/create"><i class="fa fa-plus"></i><span>Add New
                        note</span></a><br><br>

                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>content</th>
                            <th>Created At</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

<script type="text/javascript">
    $(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('notes.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'content',
                    name: 'content',
                    "width": "70%"
                },
                {
                    data: 'created_at',
                    "width": "17%",
                    name: 'created_at'
                },
                {
                    data: 'action',
                    "width": "14%",
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });
</script>

</html>
