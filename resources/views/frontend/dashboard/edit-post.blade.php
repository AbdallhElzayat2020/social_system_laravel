@extends('frontend.layouts.master')
@section('title',@$post->title)
@section('content')
    <br>
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar')
        <!-- Sidebar -->

        <!-- Main Content -->
        <div class="main-content col-md-9">
            <!-- Show/Edit Post Section -->
            <section id="posts-section" class="posts-section">
                <h2>Your Posts</h2>
                <ul class="list-unstyled user-posts">
                    <!-- Example of a Post Item -->
                    <li class="post-item">
                        <!-- Editable Title -->
                        <input type="text" name="title" class="form-control mb-2 post-title" value="{{old('title',$post->title)}}"/>

                        <!-- Editable Content -->
                        <textarea name="description"
                                  class="form-control mb-2 post-content">{!! old('description',chunk_split($post->description , 60)) !!}</textarea>

                        <!-- Post Images Slider -->
                        <div class="tn-slider">
                            <div class="slick-slider edit-slider" id="postImages">
                                <!-- Existing Images -->
                            </div>
                        </div>

                        <!-- Image Upload Input for Editing -->
                        <input type="file" name="images" class="form-control mt-2 edit-post-image" accept="image/*" multiple/>

                        <!-- Editable Category Dropdown -->
                        <select name="category_id" class="form-control mb-2 post-category">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{old('category_id', $category->id) === $post->category_id ? 'selected' : ''}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>

                        <!-- Editable Enable Comments Checkbox -->
                        <div class="form-check mb-2">
                            <input id="comment_able" class="form-check-input enable-comments" type="checkbox"
                                   name="comment_able" {{$post->comment_able ? 'checked' : ''}}/>
                            <label for="comment_able" class="form-check-label">
                                Enable Comments
                            </label>
                        </div>

                        <!-- Post Meta: Views and Comments -->
                        <div class="post-meta d-flex justify-content-between">
                            <span class="views">
                                <i class="fas fa-eye"></i> Views ({{$post->num_of_views}})
                            </span>
                        </div>

                        <!-- Post Actions -->
                        <div class="post-actions mt-2">
                            <button class="btn btn-primary edit-post-btn">Save</button>
                            <button class="btn btn-success save-post-btn d-none">
                                Save
                            </button>
                            <button class="btn btn-secondary cancel-edit-btn d-none">
                                Cancel
                            </button>
                        </div>

                    </li>
                    <!-- Additional posts will be added dynamically -->
                </ul>
            </section>
        </div>
    </div>
    <br>
    <br>
@endsection