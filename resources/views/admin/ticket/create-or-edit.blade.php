@extends('admin.layout.app')


@section('content')

    @php
        $session = \App\Models\Session::with('cinema','movie')->findOrFail($session_id);
    @endphp
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        New Add Ticket
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{route('tickets.sell',$session_id)}}">{{\Carbon\Carbon::parse($session->time)->format('H:i')}} {{$session->movie->title}}
                                session</a></li>
                        <li class="breadcrumb-item active"> New Add Ticket</li>
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
                            <h3 class="card-title"> {{$session->cinema->name}} --> {{$session->movie->title}} --> <span
                                    class="text-bold"> {{\App\Models\SessionSeat::findOrFail($seat_id)->seat_name}}</span></h3>
                            <span class="float-right">{{\Carbon\Carbon::parse($session->time)->format('H:i')}}/{{\Carbon\Carbon::parse($session->date)->format('d-m-Y')}}  </span>

                        </div>
                        <!-- /.card-header -->

                        <form action="{{route('tickets.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="session_id" value="{{$session_id}}">
                            <input type="hidden" name="session_seat_id" value="{{$seat_id}}">

                            <div class="card-body">
                                <div class="container">

                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <select name="discount" id="discount" class="form-control">
                                            <option value="normal">Normal</option>
                                            <option value="student">Student</option>
                                            <option value="disabled">Disabled</option>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               value="@if(isset($customer)){{old('name',$customer)}}@else{{old('name')}}@endif"
                                               id="name"
                                               placeholder="Enter Name"
                                               name="name">
                                        @error('name')
                                        <div class="alert alert-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last name</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                               value="@if(isset($customer)){{old('last_name',$customer)}}@else{{old('last_name')}}@endif"
                                               id="last_name"
                                               placeholder="Enter Lastname" name="last_name">
                                        @error('last_name')
                                        <div class="alert alert-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                               value="@if(isset($customer)){{old('phone',$customer)}}@else{{old('phone')}}@endif"
                                               id="phone"
                                               placeholder="Enter phone" name="phone">
                                        @error('phone')
                                        <div class="alert alert-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="Woman" @if(isset($customer) && $customer->gender=="Woman" )selected @endif >Woman</option>
                                            <option value="Man" @if(isset($customer) && $customer->gender=="Man" )selected @endif >Man</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input type="number" class="form-control @error('age') is-invalid @enderror"
                                               value="@if(isset($customer)){{old('age',$customer)}}@else{{old('age')}}@endif"
                                               id="age"
                                               placeholder="Enter age" name="age">
                                        @error('age')
                                        <div class="alert alert-danger">{{ $message }}</div>
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
