@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/addProfile') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Enter Name:</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="profile_about" class="col-md-4 col-form-label text-md-right">About Me:</label>

                                <div class="col-md-6">
                                    <input id="profile_about" type="profile_about" class="form-control @error('profile_about') is-invalid @enderror" name="profile_about" value="{{ old('profile_about') }}" required autocomplete="profile_about" autofocus>
    
                                    @error('profile_about')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                        <div class="form-group row">
                                <label for="profile_image" class="col-md-4 col-form-label text-md-right">Profile Image:</label>

                                <div class="col-md-6">
                                    <input id="profile_image" type="file" class="form-control-file @error('profile_image') is-invalid @enderror" name="profile_image" value="{{ old('profile_image') }}" autocomplete="profile_image" autofocus>
    
                                    @error('profile_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Upload Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection