@extends('admin.layout.app')



@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    Log List
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Log List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Log List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered ">
                                <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Details</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td> {{$loop->iteration}}</td>
                                        <td> {{$log->full_name}}</td>
                                        <td> {{$log->type}}</td>
                                        <td> {{$log->details}}</td>
                                        <td> {{\Carbon\Carbon::parse($log->created_at)->diffForHumans()}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('css-area')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('js-area')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('../../plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('../../plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('../../plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('../../plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('../../plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('../../plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('../../plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('../../plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('../../plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "ordering": true,
                "paging": true,
                "searching": true,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
