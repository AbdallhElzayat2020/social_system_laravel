@extends('dashboard.layouts.master')
@section('title', 'Reply to Message')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800">
                <i class="fas fa-reply text-primary mr-2"></i>
                Reply to Message
            </h1>
            <a href="{{ route('admin.contact.show', $contact->id) }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left mr-1"></i>
                Back to Message
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-gradient-primary text-white py-3">
                <h5 class="mb-0">
                    <i class="fas fa-envelope mr-2"></i>
                    Send Reply
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contact.send-reply', $contact->id) }}" method="POST">
                    @csrf
                    
                    <!-- Original Message Info -->
                    <div class="alert alert-info mb-4">
                        <h6 class="font-weight-bold mb-2">Original Message:</h6>
                        <p class="mb-0">{{ $contact->body }}</p>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700">
                            <i class="fas fa-user text-primary mr-1"></i>
                            To
                        </label>
                        <input type="text" class="form-control bg-light" value="{{ $contact->name }} <{{ $contact->email }}>" disabled>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700" for="reply_subject">
                            <i class="fas fa-heading text-primary mr-1"></i>
                            Subject
                        </label>
                        <input type="text" class="form-control @error('reply_subject') is-invalid @enderror" 
                               id="reply_subject" name="reply_subject" 
                               value="{{ old('reply_subject', 'Re: Your Message') }}" required>
                        @error('reply_subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700" for="reply_message">
                            <i class="fas fa-comment-alt text-primary mr-1"></i>
                            Reply Message
                        </label>
                        <textarea class="form-control @error('reply_message') is-invalid @enderror" 
                                  id="reply_message" name="reply_message" rows="8" required>{{ old('reply_message') }}</textarea>
                        @error('reply_message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-paper-plane"></i>
                            </span>
                            <span class="text">Send Reply</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .btn-icon-split {
            transition: all 0.3s ease;
        }
        .btn-icon-split:hover {
            transform: translateY(-2px);
        }
        .form-control:disabled {
            background-color: #f8f9fc !important;
            cursor: not-allowed;
        }
    </style>
@endsection 