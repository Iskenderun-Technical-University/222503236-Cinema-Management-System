@extends('admin.layout.app')



@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> {{$cinema->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{route('cinemas.index')}}">Cinema</a></li>
                        <li class="breadcrumb-item active"> {{$cinema->name}}</li>
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
                            <h3 class="card-title">Edit Cinema </h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="{{route('cinemas.update',$cinema->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="container">
                                    <div class="form-group">
                                        <label for="first_name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$cinema)}}" id="name"
                                               placeholder="Enter Name" name="name">
                                        @error('name')
                                        <div class="alert alert-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="total_seat">Total Seat</label>
                                        <input type="text" class="form-control @error('total_seat') is-invalid @enderror" value="{{old('total_seat',$cinema)}}"
                                               id="total_seat"
                                               placeholder="Enter Total Seat" name="total_seat">
                                        @error('total_seat')
                                        <div class="alert alert-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
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
