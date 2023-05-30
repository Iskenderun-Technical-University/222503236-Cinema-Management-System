@extends('.admin.layout.app')




@section('content')

    <!-- Content Header (Page header) -->
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

    <!-- Main content -->
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

                            <h3 class="profile-username text-center">{{$user->first_name .' '.$user->last_name}}</h3>

                            <p class="text-muted text-center">{{$user->email }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Phone Number :</b> {{$user->phone_number }}
                                </li>
                                <li class="list-group-item">
                                    <b>Date of Birth : </b> {{$user->date_of_birth }}
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
                                <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Information</a></li>
                                <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="info">
                                    <form class="form-horizontal" method="post" action="{{route('profile.update')}}">
                                        @csrf
                                        @method('patch')

                                        <div class="form-group row">
                                            <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                       class="form-control @error('first_name') is-invalid @enderror"
                                                       id="first_name"
                                                       value="{{  $user->first_name }}"
                                                       name="first_name"
                                                       required
                                                       autofocus
                                                       autocomplete="first_name"
                                                >
                                                @error('first_name')
                                                <div class="alert alert-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                       class="form-control @error('last_name') is-invalid @enderror"
                                                       id="last_name"
                                                       value="{{ old('last_name', $user) }}"
                                                       name="last_name"
                                                >
                                                @error('last_name')
                                                <div class="alert alert-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       id="email"
                                                       value="{{ old('email', $user) }}"
                                                       name="email"
                                                >
                                                @error('email')
                                                <div class="alert alert-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>

                                            <div class="col-sm-10">
                                                <input type="text"
                                                       class="form-control @error('phone_number') is-invalid @enderror"
                                                       id="phone_number"
                                                       value="{{ old('phone_number', $user) }}"
                                                       name="phone_number"
                                                >
                                                @error('phone_number')
                                                <div class="alert alert-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="date_of_birth" class="col-sm-2 col-form-label">Date of Birth</label>

                                            <div class="col-sm-10">
                                                <input type="date"
                                                       class="form-control @error('date_of_birth') is-invalid @enderror"
                                                       id="date_of_birth"
                                                       value="{{ old('date_of_birth', $user) }}"
                                                       name="date_of_birth"
                                                >
                                                @error('date_of_birth')
                                                <div class="alert alert-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="password">
                                    <form class="form-horizontal" method="post" action="{{route('password.update')}}">
                                        @csrf
                                        @method('put')

                                        <div class="form-group row">
                                            <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
                                            <div class="col-sm-10">
                                                <input type="password"
                                                       class="form-control @error('current_password') is-invalid @enderror"
                                                       id="current_password"
                                                       value="{{  $user->current_password }}"
                                                       name="current_password"
                                                       required
                                                       autofocus
                                                       autocomplete="current_password"
                                                >
                                                @if($errors->updatePassword->get('current_password'))
                                                <div class="alert alert-danger">
                                                    {{$errors->updatePassword->get('current_password')[0]}}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       id="password"
                                                       value="{{ old('password', $user) }}"
                                                       name="password"
                                                       autocomplete="new-password"
                                                >
                                                @if($errors->updatePassword->get('password'))
                                                    <div class="alert alert-danger">
                                                        {{$errors->updatePassword->get('password')[0]}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                                            <div class="col-sm-10">
                                                <input type="password"
                                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                                       id="password_confirmation"
                                                       value="{{ old('password_confirmation', $user) }}"
                                                       name="password_confirmation"
                                                       autocomplete="new-password"
                                                >
                                                @if($errors->updatePassword->get('password_confirmation'))
                                                    <div class="alert alert-danger">
                                                        {{$errors->updatePassword->get('password_confirmation')[0]}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- /.tab-pane -->
                                @if (session('status') === 'password-updated')
                                    <div class="alert alert-success">
                                         Password changed successfully
                                    </div>
                                @endif
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
    <!-- /.content -->

@endsection
