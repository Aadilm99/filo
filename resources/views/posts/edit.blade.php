@extends('layouts.app')
<style type="text/css">
    .size{
        font-size: 1rem;
    };

</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header"><h3>Edit Post</h3></div>
                <div class="card-body">
                    <br>
                    <form method="POST" action="{{ url('/editPost', array($posts->id)) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="post_title" class="col-md-4 col-form-label text-md-right"><h5>Title</h5></label>

                            <div class="col-md-6">
                            <input id="post_title" type="text" class="form-control @error('post_title') is-invalid @enderror" name="post_title" value="{{ $posts->post_title }}" required autocomplete="post_title" autofocus>

                                @error('post_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_description" class="col-md-4 col-form-label text-md-right"><h5>Description</h5></label>

                            <div class="col-md-6">
                                <textarea rows="10" cols="30" id="post_description" type="post_description" class="form-control @error('post_description') is-invalid @enderror" name="post_description"  required autocomplete="post_description">{{$posts->post_description}}</textarea>

                                @error('post_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_id	" class="col-md-4 col-form-label text-md-right"><h5>Select Item Category</h5></label>

                            <div class="col-md-6">
                                <select id="category_id" type="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id" required autocomplete="category_id">
                                    <option class="size" value="{{ $category->id }}">{{$category->category}}</option>
                                    @if(count($categories) > 0)
                                    @foreach($categories as $category)
                                        <option class="size" value="{{ $category->id }}">{{$category->category}}</option>
                                    @endforeach
                                    @endif
                                </select>

                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="post_image" class="col-md-4 col-form-label text-md-right"><h5>Add Post Image</h5></label>

                            <div class="col-md-6">
                                <input id="post_image" type="file" class="form-control-file @error('post_image') is-invalid @enderror" name="post_image" value="{{ $posts->post_image}}" autocomplete="post_image" autofocus>

                                @error('post_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colour" class="col-md-4 col-form-label text-md-right"><h5>Colour</h5></label>

                            <div class="col-md-6">
                                <input id="colour" type="text" class="form-control @error('colour') is-invalid @enderror" name="colour" value="{{ $posts->colour }}" autocomplete="colour" autofocus>

                                @error('colour')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="found_location" class="col-md-4 col-form-label text-md-right"><h5>Found Location</h5></label>

                            <div class="col-md-6">
                                <input id="found_location" type="text" class="form-control @error('post_title') is-invalid @enderror" name="found_location" value="{{ $posts->found_location }}" autocomplete="found_location" autofocus>

                                @error('found_location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg ">
                                    Update Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

