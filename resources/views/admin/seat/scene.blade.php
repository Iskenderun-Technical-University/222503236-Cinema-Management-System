@extends('admin.layout.app')



@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    Seating Arrangement for {{\App\Models\Cinema::findOrFail($cinema_id)->name}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('cinemas.index')}}">Cinema List</a></li>
                        <li class="breadcrumb-item"><a href="{{route('seats.index')}}">All Seats List</a></li>
                        <li class="breadcrumb-item active">Seat Scene</li>
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
                            <h3 class="card-title">Seating Arrangement </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="text-center text-bold" >Movie Screen</p>
                            <table class="scene">

                                <tbody>

                                @foreach( $seats as $key =>$seat)

                                    <tr>
                                        <td><span class="letter"> {{$key}}</span></td>
                                        @foreach( $seat as $number)
                                            <td><span> {{$number}}</span></td>
                                        @endforeach
                                        <td><span class="letter"> {{$key}}</span></td>
                                    </tr>

                                @endforeach
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
    <style>
        .scene {
            display: flex;
            justify-content: center;
        }

        .scene td {
            text-align: center;

        }

        .scene tr {
            display: flex;
            justify-content: center;

        }

        .scene td span {
            display: inline-block;

            border-style: solid;
            border-color: green;
            border-radius: 3px;

            margin: 1px;
            height: 40px;
            width: 40px;

        }

        .scene .letter {
            display: inline-block;
            border-style: solid;
            border-color: darkred;
            border-radius: 3px;
            font-weight: bold;
            margin: 1px;
            height: 40px;
            width: 40px;

        }


    </style>

@endsection

@section('js-area')

@endsection
