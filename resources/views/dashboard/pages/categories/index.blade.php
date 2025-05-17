@extends('dashboard.layouts.master')
@section('title', 'Categories')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Categories</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="#" data-toggle="modal" data-target="#create_category" class="btn btn-primary  float-right">
                    <i class="fas fa-plus"></i> Create
                </a>
            </div>

            {{-- Filter --}}
            @include('dashboard.pages.categories.filter.filter')
            {{-- Create Modal--}}
            @include('dashboard.pages.categories.create')
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Posts Count</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($categories as $index=> $category)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    @if($category->status === 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($category->status === 'inactive')
                                        <span class="badge badge-danger">Not Active</span>
                                    @endif
                                </td>
                                <td>{{ $category->posts_count }}</td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#delete_user_{{$category->id}}" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a  href="#" data-toggle="modal" data-target="#edit_category{{$category->id}}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.category.status-change',$category->id) }}" class="btn btn-warning">
                                        @if($category->status == 'active')
                                            <i class="fas fa-ban"></i>
                                        @else
                                            <i class="fas fa-play"></i>
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            @include('dashboard.pages.categories.delete')
                            @include('dashboard.pages.categories.edit')
                        @empty
                            <tr>
                                <td colspan="7" class="text-center alert alert-info">No Categories found</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
