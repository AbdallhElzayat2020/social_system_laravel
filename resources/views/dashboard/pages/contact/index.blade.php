@extends('dashboard.layouts.master')

@section('title', 'Contact')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Contact</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="javascript:;" class="btn btn-primary float-right">Contact Management</a>
            </div>
            @include('dashboard.pages.contact.filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Phone</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($contacts as $index=> $contact)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$contact->name}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->status == 'active'? 'Read' : 'unRead'}}</td>
                                <td>{{$contact->phone}}</td>
                                <td>{{ $contact->created_at->diffForHumans() }}</td>
                                <td>

                                    <a href="#" data-toggle="modal" data-target="#delete_user_{{$contact->id}}" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <a href="{{ route('admin.contact.show',$contact->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                            @include('dashboard.pages.contact.delete')
                        @empty
                            <tr>
                                <td colspan="7" class="text-center alert alert-info">No users found</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    {{$contacts->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
