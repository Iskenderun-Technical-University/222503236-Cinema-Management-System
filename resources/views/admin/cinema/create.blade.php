@extends('admin.layout.app')



@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>New Add Cinema </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('cinemas.index')}}">Cinema</a></li>
                        <li class="breadcrumb-item active"> New Add Cinema</li>
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
                            <h3 class="card-title">New Add Cinema </h3>
                         </div>
                        <!-- /.card-header -->
                        <form action="{{route('cinemas.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="container">

                                    <div class="form-group">
                                        <label for="first_name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" id="name"
                                               placeholder="Enter Name" name="name">
                                        @error('name')
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
