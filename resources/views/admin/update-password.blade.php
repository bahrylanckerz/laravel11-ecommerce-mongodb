@extends('admin.layout.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Admin Management</a></li>
                            <li class="breadcrumb-item active">Update Password</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Update Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ url('admin/update-password') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    @if (Session::has('success'))
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            {{ Session::get('success') }}
                                        </div>
                                    @elseif (Session::has('danger'))
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            {{ Session::get('danger') }}
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="currentPassword">Current Password</label>
                                        <input type="password" id="currentPassword" name="currentPassword" class="form-control @error('currentPassword') is-invalid @enderror" placeholder="Enter Current Password">
                                        @error('currentPassword') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword">New Password</label>
                                        <input type="password" id="newPassword" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror" placeholder="Enter New Password">
                                        @error('newPassword') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword">Confirm Password</label>
                                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" placeholder="Enter Confirm Password">
                                        @error('confirmPassword') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection