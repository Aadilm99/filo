@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>My Requests</h3></div>
                <br>
                <div class="card-body">
                    <div class="col-md-12">
                <div id="posts" class="col-md-12 text-center">
                    @if(count($requests) > 0)
                        @foreach ($requests as $request)
                        <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">Post ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Reason For Request Item</th>
                            <th scope="col">Request Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">{{$request->posts->id}}</th>
                            <td>{{strtoupper($request->user->name)}}</td>
                            <td>{{$request->reason}}</td>
                            <td>{{$request->status}}</td>
                            </tr>
                        @endforeach
                    @else
                        <p>You have no Requests</p>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
