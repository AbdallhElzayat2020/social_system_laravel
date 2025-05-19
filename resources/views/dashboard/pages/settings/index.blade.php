@extends('dashboard.layouts.master')
@section('title','Settings Page')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Settings Management</h1>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">General Settings</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Site Identity Section -->
                        <div class="col-md-6 mb-4">
                            <div class="card border-left-primary h-100">
                                <div class="card-header bg-light">
                                    <h6 class="m-0 font-weight-bold text-primary">Site Identity</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="site_logo">Site Logo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="site_logo" name="site_logo">
                                            <label class="custom-file-label" for="site_logo">Choose file</label>
                                        </div>
                                        @error('site_logo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="site_favicon">Site Favicon</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="site_favicon" name="site_favicon">
                                            <label class="custom-file-label" for="site_favicon">Choose file</label>
                                        </div>
                                        @error('site_favicon')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="site_name">Site Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="site_name" value="{{old('site_name')}}" name="site_name"
                                               placeholder="Enter site name">
                                        @error('site_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_title">Site Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                               value="{{old('meta_title')}}" placeholder="Enter site title">
                                        @error('meta_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" 
                                                  rows="3" placeholder="Enter meta description">{{old('meta_description')}}</textarea>
                                        @error('meta_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="col-md-6 mb-4">
                            <div class="card border-left-success h-100">
                                <div class="card-header bg-light">
                                    <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="site_email">Site Email<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="site_email" value="{{old('site_email')}}" 
                                               name="site_email" placeholder="Enter site email">
                                        @error('site_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="site_phone">Site Phone<span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="site_phone" value="{{old('site_phone')}}" 
                                               name="site_phone" placeholder="Enter site phone">
                                        @error('site_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="site_address">Site Address<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="site_address" name="site_address" 
                                                  rows="2" placeholder="Enter site address">{{old('site_address')}}</textarea>
                                        @error('site_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" id="city" value="{{old('city')}}" 
                                                       name="city" placeholder="Enter city">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <input type="text" class="form-control" id="country" value="{{old('country')}}" 
                                                       name="country" placeholder="Enter country">
                                                @error('country')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Links Section -->
                        <div class="col-md-12 mb-4">
                            <div class="card border-left-info">
                                <div class="card-header bg-light">
                                    <h6 class="m-0 font-weight-bold text-primary">Social Media Links</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="facebook_link">Facebook</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control" id="facebook_link" value="{{old('facebook_link')}}" 
                                                           name="facebook_link" placeholder="Enter Facebook URL">
                                                </div>
                                                @error('facebook_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="twitter_link">Twitter</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control" id="twitter_link" value="{{old('twitter_link')}}" 
                                                           name="twitter_link" placeholder="Enter Twitter URL">
                                                </div>
                                                @error('twitter_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="instagram_link">Instagram</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control" id="instagram_link" value="{{old('instagram_link')}}" 
                                                           name="instagram_link" placeholder="Enter Instagram URL">
                                                </div>
                                                @error('instagram_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="linkedin_link">LinkedIn</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control" id="linkedin_link" value="{{old('linkedin_link')}}" 
                                                           name="linkedin_link" placeholder="Enter LinkedIn URL">
                                                </div>
                                                @error('linkedin_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="youtube_link">YouTube</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control" id="youtube_link" value="{{old('youtube_link')}}" 
                                                           name="youtube_link" placeholder="Enter YouTube URL">
                                                </div>
                                                @error('youtube_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tiktok_link">TikTok</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-tiktok"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control" id="tiktok_link" value="{{old('tiktok_link')}}" 
                                                           name="tiktok_link" placeholder="Enter TikTok URL">
                                                </div>
                                                @error('tiktok_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Settings
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        // Add custom file input functionality
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    @endpush
@endsection