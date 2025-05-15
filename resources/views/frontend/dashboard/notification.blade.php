@extends('frontend.layouts.master')
@section('title', 'Notifications')
@push('header_meta')
    <link rel="canonical" href="{{ url()->full() }}"/>
@endpush
@section('content')
    <br>
    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="mb-0">Notifications</h2>
                    </div>
                    <div class="col-md-6 text-end">
                        <form action="{{ route('frontend.dashboard.notifications.markAllAsRead') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Mark All as Read</button>
                        </form>

                        <form action="{{ route('frontend.dashboard.notifications.delete-all') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete All</button>
                        </form>
                    </div>
                </div>

                @forelse(auth()->user()->notifications as $notification)
                    <div class="notification alert alert-info d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $notification->data['title'] ?? 'Info' }}</strong> {{ $notification->data['message'] ?? 'Notification' }}
                            <small class="d-block text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>

                        <div class="d-flex align-items-center">
                            <a href="{{ route('frontend.dashboard.notifications.redirect', $notification->id) }}" class="btn btn-sm btn-primary mr-2"
                               title="View">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="{{ route('frontend.dashboard.notifications.destroy') }}" method="POST">
                                @csrf
                                <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <strong>No notifications available.</strong>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
    <!-- Dashboard End-->
    <br><br>
@endsection
