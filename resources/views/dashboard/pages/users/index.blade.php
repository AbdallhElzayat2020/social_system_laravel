@extends('dashboard.layouts.master')

@section('title', 'Users')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                {{--                @can('create_users')--}}
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-right">Create User</a>
                {{--                @endcan--}}
            </div>
            @include('dashboard.pages.users.filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Country</th>
                            <th>Phone</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($users as $index=> $user)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->status === 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($user->status === 'inactive')
                                        <span class="badge badge-danger">Not Active</span>
                                    @endif
                                </td>
                                <td>{{$user->country}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>

                                    {{--                                    @can('delete_users')--}}
                                    <a href="#" data-toggle="modal" data-target="#delete_user_{{$user->id}}" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{--                                    @endcan--}}

                                    {{--                                    @can('change_status_users')--}}
                                    <a href="{{ route('admin.user.status-change',$user->id) }}" class="btn btn-warning">
                                        @if($user->status == 'active')
                                            <i class="fas fa-ban"></i>
                                        @else
                                            <i class="fas fa-play"></i>
                                        @endif
                                    </a>
                                    {{--                                    @endcan--}}

                                    {{--                                    @can('edit_users')--}}
                                    <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    {{--                                    @endcan--}}
                                </td>
                            </tr>
                            @include('dashboard.pages.users.delete')
                        @empty
                            <tr>
                                <td colspan="7" class="text-center alert alert-info">No users found</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
