@extends('admin.layout.app')


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@if(isset($customer))
                            Edit Customer
                        @else
                            New Add Customer
                        @endif</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('customers.index')}}">Customer</a></li>
                        <li class="breadcrumb-item active">@if(isset($customer))
                                {{$customer->name}}  {{$customer->lastname}}
                            @else
                                New Add Customer
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
                            <h3 class="card-title">@if(isset($customer))
                                    {{$customer->name}}  {{$customer->lastname}}
                                @else
                                    New Add Customer
                                @endif</h3>
                        </div>
                        <!-- /.card-header -->

                        <form @if(isset($customer))
                                  action="{{route('customers.update',$customer->id) }}"
                              @else
                                  action="{{route('customers.store') }}"
                              @endif
                              method="post">
                            @csrf

                            @if(isset($customer))
                                @method('put')
                            @endif


                            <div class="card-body">
                                <div class="container">
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
