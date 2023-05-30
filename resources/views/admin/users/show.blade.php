@extends('admin.layout.app')



@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="../../dist/img/user4-128x128.jpg"
                                     alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $user->full_isim  }}</h3>
                            <p class="text-muted text-center">{{ $user->email  }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Phone :</b> {{ $user->phone_number  }}
                                </li>
                                <li class="list-group-item">
                                    <b>Birth date :</b> {{ $user->date_of_birth  }}
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active " href="#timeline" data-toggle="tab">Timeline</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <!-- /.tab-pane -->
                                <div class="tab-pane active" id="timeline">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse overflow-auto " style="height: 400px">
                                        <!-- timeline time label -->
                                        @php
                                            $old_date= null;
                                        @endphp
                                        @foreach($logs as $log)
                                            @php
                                                $date =\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $log->created_at)->format('d M Y ');
                                            @endphp

                                            @if($old_date!=$date)
                                                <div class="time-label">
                                                    <span class="bg-danger"> {{$date }} </span>
                                                </div>
                                                @php($old_date=$date)
                                            @endif
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-user bg-info"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> {{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $log->created_at)->diffForHumans() }} </span>
                                                    <h3 class="timeline-header border-0"><span class="text-bold"> {{$log->type}}</span> {{$log->details}}
                                                    </h3>

                                                </div>
                                            </div>
                                        @endforeach
                                        <!-- END timeline item -->
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form action="{{route('users.update',['user' =>  $user->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="form-group">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name',$user->first_name )}}" id="first_name"
                                                           placeholder="Enter First Name" name="first_name">
                                                    @error('first_name')
                                                    <div class="alert alert-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="first_name">Last Name</label>
                                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{old('last_name',$user->last_name)}}"
                                                           id="last_name"
                                                           placeholder="Enter Last Name" name="last_name">
                                                    @error('last_name')
                                                    <div class="alert alert-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email address</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" id="email" readonly
                                                           placeholder="Enter email" name="email">
                                                    @error('email')
                                                    <div class="alert alert-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone_number">Phone Number</label>
                                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                                           value="{{old('phone_number',$user->phone_number)}}"
                                                           id="phone_number"
                                                           placeholder="Enter phone number"
                                                           name="phone_number">
                                                    @error('phone_number')
                                                    <div class="alert alert-danger"> {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="date_of_birth">Birthdate</label>
                                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                                           value="{{old('date_of_birth',$user->date_of_birth)}}"
                                                           id="date_of_birth"
                                                           placeholder="Enter date of birth"
                                                           name="date_of_birth">
                                                    @error('date_of_birth')
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
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection


