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
                        <li class="breadcrumb-item active">CMS Pages</li>
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
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">CMS Pages</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="btn-group mb-3">
                                <button type="button" class="btn btn-danger" onclick="location.href='{{ url('admin/create-cms-pages') }}'"><i class="fas fa-plus mr-2"></i>Add New</button>
                            </div>
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ Session::get('success') }}
                                </div>
                            @elseif (Session::has('warning'))
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ Session::get('warning') }}
                                </div>
                            @elseif (Session::has('danger'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ Session::get('danger') }}
                                </div>
                            @endif
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr class="bg-dark">
                                        <th>Title</th>
                                        <th>URL</th>
                                        <th>Created</th>
                                        <th class="text-center">Active</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($cmsPages) > 0)
                                        @foreach ($cmsPages as $row)
                                            <tr>
                                                <td>{{ $row->title }}</td>
                                                <td>{{ $row->url }}</td>
                                                <td>{{ $row->created_at }}</td>
                                                <td align="center">
                                                    @if ($row->status == 1)
                                                        <a href="javascript:void(0)" class="text-success" onclick="location.href='{{ url('admin/update-cms-pages-status/0/'.$row->id) }}'" style="font-size:18px"><i class="fas fa-check-circle"></i></a>
                                                    @else
                                                        <a href="javascript:void(0)" class="text-danger" onclick="location.href='{{ url('admin/update-cms-pages-status/1/'.$row->id) }}'" style="font-size:18px"><i class="fas fa-times-circle"></i></a>
                                                    @endif
                                                </td>
                                                <td align="center">
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" class="btn btn-warning" title="Edit" onclick="location.href='{{ url('admin/edit-cms-pages/'.$row->id) }}'">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" title="Delete" onclick="location.href='{{ url('admin/delete-cms-pages/'.$row->id) }}'">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" align="center">-- No Data --</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
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