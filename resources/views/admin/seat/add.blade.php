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
                            <h3 class="card-title"> Bulk Add Seats </h3>
                        </div>
                        <!-- /.card-header -->


                        <form action="{{route('seats.add',$cinema_id) }}" method="post">
                            @csrf
                            <input type="hidden" value="{{$cinema_id}}" name="cinema_id">
                            <div class="card-body">
                                <div class="container">
                                    <div class="form-group">
                                        <label for="title">Kacinci siraya kadar olsun </label>
                                        <select name="order" class="form-control">
                                            @php
                                                $letters=range('A','Z');
                                            @endphp
                                            @foreach($letters as $letter )
                                                <option
                                                    value="{{$letter}}"
                                                    @if(isset($order) && $order==$letter ) selected @endif
                                                >
                                                    {{$letter}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if(isset($order))

                                        @php
                                            $letters=range('A',$order);
                                        @endphp
                                        @foreach($letters as $letter )
                                            <div class="form-group">
                                                <label for="{{$letter}}">{{$letter}}</label>
                                                <input type="text" class="form-control @error($letter) is-invalid @enderror"
                                                       value="@if(isset($seat)){{old($letter)}}@else{{old($letter)}}@endif"
                                                       id="{{$letter}}"
                                                       placeholder="Enter {{$letter}} nunmber"
                                                       name="{{$letter}}">
                                                @error('$letter')
                                                <div class="alert alert-danger"> {{ $message }}</div>
                                                @enderror
                                            </div>

                                        @endforeach
                                    @endif
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
