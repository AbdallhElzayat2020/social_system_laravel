@extends('dashboard.layouts.master')
@push('css')
    <!-- Custom styles for this page -->
    <link href="{{asset('assets/dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@section('title', 'Users')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ url()->current() }}" class="btn btn-primary">Create User</a>
            </div>
            @include('dashboard.pages.users.filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
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
                        @forelse($users as $user)
                            <tr>
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
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <a href="" class="btn btn-warning"><i class="fas fa-trash"></i></a>
                                    <a href="" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="" class="btn btn-danger"><i class="fas fa-ban"></i></a>
                                    <a href="" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
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

@push('js')
    <!-- Page level plugins -->
    <script src="{{asset('assets/dashboard')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/dashboard')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('assets/dashboard')}}/js/demo/datatables-demo.js"></script>
@endpush