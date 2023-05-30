@extends('admin.layout.app')



@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@if(isset($seat))
                            Edit Seat
                        @else
                            New Add Seat
                        @endif</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('seats.index',$cinema_id)}}">Seat</a></li>
                        <li class="breadcrumb-item active">@if(isset($seat))
                                {{$seat->name}}
                            @else
                                New Add Seat
                            @endif</li>
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
                            <h3 class="card-title">@if(isset($seat))
                                    {{$seat->name}}
                                @else
                                    New Add Seat
                                @endif</h3>
                        </div>
                        <!-- /.card-header -->

                        <form @if(isset($seat))
                                  action="{{route('seats.update',$seat->id) }}"
                              @else
                                  action="{{route('seats.store') }}"
                              @endif
                              method="post">
                            @csrf

                            @if(isset($seat))
                                @method('put')
                            @endif
                            <input type="hidden" value="{{$cinema_id}}" name="cinema_id">
                            <div class="card-body">
                                <div class="container">
                                    <div class="form-group">
                                        <label for="title">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               value="@if(isset($seat)){{old('name',$seat)}}@else{{old('name')}}@endif"
                                               id="name"
                                               placeholder="Enter name"
                                               name="name">
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
