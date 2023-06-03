@extends('admin.layout.app')



@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@if(isset($movie)) Edit Movie @else New Add Movie @endif</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('movies.index')}}">Movie</a></li>
                        <li class="breadcrumb-item active">@if(isset($movie))  {{$movie->title}} @else New Add Movie @endif</li>
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
                            <h3 class="card-title">@if(isset($movie)){{$movie->title}}@else New Add Movie @endif</h3>
                        </div>
                        <!-- /.card-header -->

                        <form       @if(isset($movie))
                                        action="{{route('movies.update',$movie->id) }}"
                                    @else
                                        action="{{route('movies.store') }}"
                                    @endif
                            method="post">
                            @csrf

                            @if(isset($movie))
                                @method('put')
                            @endif


                            <div class="card-body">
                                <div class="container">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                               value="@if(isset($movie)){{old('title',$movie)}}@else{{old('title')}}@endif"
                                               id="title"
                                               placeholder="Enter Title"
                                               name="title">
                                        @error('title')
                                        <div class="alert alert-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="genre">Genre</label>
                                        <input type="text" class="form-control @error('genre') is-invalid @enderror"
                                               value="@if(isset($movie)){{old('genre',$movie)}}@else{{old('genre')}}@endif"
                                               id="genre"
                                               placeholder="Enter Genre" name="genre">
                                        @error('genre')
                                        <div class="alert alert-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="director">Director</label>
                                        <input type="text" class="form-control @error('director') is-invalid @enderror"
                                               value="@if(isset($movie)){{old('director',$movie)}}@else{{old('director')}}@endif"
                                               id="director"
                                               placeholder="Enter Genre" name="director">
                                        @error('director')
                                        <div class="alert alert-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="genre">Description</label>
                                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                                               value="@if(isset($movie)){{old('description',$movie)}}@else{{old('description')}}@endif"
                                               id="description"
                                               placeholder="Enter description" name="description">
                                        @error('description')
                                        <div class="alert alert-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="runtime">Runtime</label>
                                        <input type="number" class="form-control @error('runtime') is-invalid @enderror"
                                               value="@if(isset($movie)){{old('runtime',$movie)}}@else{{old('runtime')}}@endif"
                                               id="runtime"
                                               placeholder="Enter runtime" name="runtime">
                                        @error('runtime')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="release_date">Release Date</label>
                                        <input type="date" class="form-control @error('release_date') is-invalid @enderror"
                                               value="@if(isset($movie)){{old('release_date',$movie)}}@else{{old('release_date')}}@endif"
                                               id="release_date"
                                               placeholder="Enter release date" name="release_date">
                                        @error('release_date')
                                        <div class="alert alert-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="poster_url">poster_url</label>
                                        <input type="text" class="form-control @error('poster_url') is-invalid @enderror"
                                               value="@if(isset($movie)){{old('poster_url',$movie)}}@else{{old('poster_url')}}@endif"
                                               id="poster_url"
                                               placeholder="Enter poster_url" name="poster_url">
                                        @error('poster_url')
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
