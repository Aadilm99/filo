@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header"><h3>Request Form</h3></div>
                <div class="card-body">
                    <br>
                    <form method="POST" action="{{ url('/addRequest') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="reason" class="col-md-3 col-form-label text-md-right"><h5>Enter Reason</h5></label>

                            <div class="col-md-6">
                                <textarea rows="10"cols="100" id="reason" type="reason" class="form-control @error('reason') is-invalid @enderror" name="reason" value="{{ old('reason') }}" required autocomplete="reason"></textarea>

                                @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div>
                        <input type="hidden" name="post_id" value="{{$posts->id}}">
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">
                                <button type="submit" class="btn btn-primary btn-lg ">
                                    Send Request
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

