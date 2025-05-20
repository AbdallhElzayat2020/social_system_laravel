@extends('dashboard.layouts.master')

@section('title', 'admins')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Admins Management</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary float-right">Create Admin</a>
            </div>
            @include('dashboard.pages.admins.filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>UserName</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($admins as $index=> $admin)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->email}}</td>
                                <td>{{$admin->username}}</td>
                                <td>
                                    @if($admin->status === 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($admin->status === 'inactive')
                                        <span class="badge badge-danger">Not Active</span>
                                    @endif
                                </td>
                                <td>{{ $admin->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#delete_admin_{{$admin->id}}" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <a href="{{ route('admin.user.status-change',$admin->id) }}" class="btn btn-warning">
                                        @if($admin->status == 'active')
                                            <i class="fas fa-ban"></i>
                                        @else
                                            <i class="fas fa-play"></i>
                                        @endif
                                    </a>
                                    <a href="{{ route('admin.admins.edit',$admin->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                            @include('dashboard.pages.admins.delete')
                        @empty
                            <tr>
                                <td colspan="7" class="text-center alert alert-info">No admins found</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    {{$admins->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
