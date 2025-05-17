@extends('dashboard.layouts.master')

@section('title', 'Posts Managements')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Posts Managements</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary float-right">Create User</a>
            </div>
            @include('dashboard.pages.posts.filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Number Views</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($posts as $index=> $post)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->category->name}}</td>
                                <td>{{$post->user->name}}</td>
                                <td>
                                    @if($post->status === 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($post->status === 'inactive')
                                        <span class="badge badge-danger">Not Active</span>
                                    @endif
                                </td>
                                <td>{{$post->num_of_views}}</td>
                                <td>{{ $post->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#delete_post_{{$post->id}}" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('admin.post.status-change',$post->id) }}" class="btn btn-warning">
                                        @if($post->status == 'active')
                                            <i class="fas fa-ban"></i>
                                        @else
                                            <i class="fas fa-play"></i>
                                        @endif
                                    </a>
                                    <a href="{{ route('admin.posts.edit',$post->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                            @include('dashboard.pages.posts.delete')
                        @empty
                            <tr>
                                <td colspan="7" class="text-center alert alert-info">No posts found</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    {{$posts->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
