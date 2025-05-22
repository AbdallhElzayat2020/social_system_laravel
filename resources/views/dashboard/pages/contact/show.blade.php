@extends('dashboard.layouts.master')
@section('title', 'Message Details')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800">
                <i class="fas fa-envelope-open-text text-primary mr-2"></i>
                Message Details
            </h1>
            <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left mr-1"></i>
                Back to Messages
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-gradient-primary text-white py-3">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle mr-2"></i>
                    Sender Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Sender Information -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-primary text-white mr-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <h6 class="mb-0 text-primary">Sender Details</h6>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">
                                        <i class="fas fa-user-tag text-primary mr-1"></i>
                                        Name
                                    </label>
                                    <input disabled type="text" class="form-control bg-light border-0 shadow-sm"
                                           value="{{ old('name', $contact->name) }}">
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">
                                        <i class="fas fa-envelope text-primary mr-1"></i>
                                        Email Address
                                    </label>
                                    <input disabled type="email" class="form-control bg-light border-0 shadow-sm"
                                           value="{{ old('email', $contact->email) }}">
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">
                                        <i class="fas fa-phone text-primary mr-1"></i>
                                        Phone Number
                                    </label>
                                    <input disabled type="tel" class="form-control bg-light border-0 shadow-sm"
                                           value="{{ old('phone', $contact->phone) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message Content -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-success text-white mr-3">
                                        <i class="fas fa-envelope-open"></i>
                                    </div>
                                    <h6 class="mb-0 text-success">Message Content</h6>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">
                                        <i class="fas fa-comment-alt text-success mr-1"></i>
                                        Message Text
                                    </label>
                                    <textarea disabled class="form-control bg-light border-0 shadow-sm"
                                              rows="8" style="resize: none;">{{ $contact->body }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 pt-3 border-top">
                    <div class="d-flex justify-content-end">
                        @can('reply_contact')
                            <a href="#" class="btn btn-success btn-icon-split ml-2">
                            <span class="icon text-white-50">
                                <i class="fas fa-reply"></i>
                            </span>
                                <span class="text">Reply to Message</span>
                            </a>
                        @endcan

                        @can('delete_contact')
                            <a href="#" data-toggle="modal" data-target="#delete_user_{{$contact->id}}"
                               class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                                <span class="text">Delete Message</span>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.pages.users.delete')

    <style>
        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .form-control:disabled {
            background-color: #f8f9fc !important;
            cursor: not-allowed;
        }

        .btn-icon-split {
            transition: all 0.3s ease;
        }

        .btn-icon-split:hover {
            transform: translateY(-2px);
        }
    </style>
@endsection