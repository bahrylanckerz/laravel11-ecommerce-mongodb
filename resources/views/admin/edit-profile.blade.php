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
                            <li class="breadcrumb-item active">Edit Profile</li>
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
                                <h3 class="card-title">Edit Profile</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ url('admin/edit-profile') }}" method="post" enctype="multipart/form-data">
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
                                        @php $nameVal = old('name') ?: Auth::guard('admin')->user()->name @endphp
                                        <label for="name">Full Name</label>
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Full Name" value="{{ $nameVal }}">
                                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        @php $phoneVal = old('phone') ?: Auth::guard('admin')->user()->phone @endphp
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone Number" value="{{ $phoneVal }}">
                                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    @if (!empty(Auth::guard('admin')->user()->image))
                                        <div class="form-group">
                                            <label>Current Photo</label>
                                            <br>
                                            <img src="{{ asset('admin/img/profile/'.Auth::guard('admin')->user()->image) }}" alt="photo-profile" width="150">
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="image">Photo Profile</label>
                                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Enter Phone Number">
                                        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
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