@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Item Category</h3></div>
                <div class="card-body">

                    <form method="POST" action="{{ url('/addCategory') }}">
                        @csrf
                        <br>
                        <div class="form-group row">
                            <label style="width:30vw;" for="category" class="col-md-4 col-form-label text-md-right"><h5>Enter Item Category</h5></label>

                            <div class="col-md-6">
                                <input id="category" style="transform: translate(-10px,-8px)" type="category" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}" required autocomplete="category" autofocus>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-2">
                                <button style="width:15vh"type="submit" class="btn btn-primary">
                                    Add Item
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
