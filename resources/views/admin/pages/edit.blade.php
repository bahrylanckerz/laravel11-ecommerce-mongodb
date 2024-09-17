@extends('admin.layout.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pages Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages Management</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin/cms-pages') }}">CMS Pages</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                                <h3 class="card-title">Edit CMS Pages</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ url('admin/edit-cms-pages/'.$cmsPage->id) }}" method="post">
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
                                        <label for="title">Title</label>
                                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title" value="{{ old('title') ?? $cmsPage->title }}">
                                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="url">URL</label>
                                        <input type="text" id="url" name="url" class="form-control @error('url') is-invalid @enderror"
                                            placeholder="Enter URL" value="{{ old('url') ?? $cmsPage->url }}">
                                        @error('url') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Enter description here" cols="30" rows="10">{{ old('description') ?? $cmsPage->description }}</textarea>
                                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-secondary" onclick="location.href='{{ url('admin/cms-pages') }}'"><i class="fas fa-arrow-left mr-2"></i>Back</button>
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-paper-plane mr-2"></i>Submit</button>
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