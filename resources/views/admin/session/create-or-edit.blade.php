@extends('admin.layout.app')



@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@if(isset($session))
                            Edit Session
                        @else
                            New Add Session
                        @endif</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('sessions.index')}}">Session</a></li>
                        <li class="breadcrumb-item active">@if(isset($session))
                                {{$session->title}}
                            @else
                                New Add Session
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
                            <h3 class="card-title">@if(isset($session))
                                    {{$session->title}}
                                @else
                                    New Add Session
                                @endif</h3>
                        </div>
                        <!-- /.card-header -->

                        <form @if(isset($session))
                                  action="{{route('sessions.update',$session->id) }}"
                              @else
                                  action="{{route('sessions.store') }}"
                              @endif
                              method="post">
                            @csrf

                            @if(isset($session))
                                @method('put')
                            @endif


                            <div class="card-body">
                                <div class="container">
                                    <div class="form-group">
                                        <label for="cinema_id">Cinema</label>
                                        <select name="cinema_id"  class="form-control"  id="cinema_id"  >
                                            @foreach(\App\Models\Cinema::all() as $cinema)
                                                <option value="{{$cinema->id}}">{{$cinema->name}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="movie_id">Movie</label>
                                        <select name="movie_id"  class="form-control"  id="movie_id"  >
                                            @foreach(\App\Models\Movie::all() as $movie)
                                                <option value="{{$movie->id}}">{{$movie->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-group col-md-6">
                                            <label for="date"> Date</label>
                                            <input type="date" class="form-control @error('date') is-invalid @enderror"
                                                   value="@if(isset($session)){{old('date',$session)}}@else{{old('date')}}@endif"
                                                   id="date_time"
                                                   placeholder="Enter Date" name="date">
                                            @error('date')
                                            <div class="alert alert-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="time"> Time</label>
                                            <input type="time" class="form-control @error('time') is-invalid @enderror"
                                                   value="@if(isset($session)){{old('time',$session)}}@else{{old('time')}}@endif"
                                                   id="time"
                                                   placeholder="Enter Time" name="time">
                                            @error('time')
                                            <div class="alert alert-danger"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                                               value="@if(isset($session)){{old('price',$session)}}@else{{old('price')}}@endif"
                                               id="price"
                                               placeholder="Enter Price" name="price">
                                        @error('price')
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
