@extends('layouts.app')
<style type="text/css">
    .avatar{max-width: 20%;}
    #requests{transform: translateY(-25vh);}

</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header"><h3>Dashboard</h3></div>
                <div class="card-body">
                    <div class="col-md-12">
                        @if(!empty($profile))
                            <img src="{{ asset( $profile->profile_image) }}" class="avatar" alt="">
                        @else
                            <img src="{{ url('uploads/avatar-icon.png')}}" class="avatar" alt="">
                        @endif
                            <br><br>
                        @if(!empty($profile))
                            Name: <p class="lead">{{ $profile->name }}</p>
                        @else
                        <p></p>
                        @endif
                        @if(!empty($profile))
                            About Me: <p class="lead">{{ $profile->profile_about }}</p>
                        @else
                        <p></p>
                        @endif
                        <div id="requests" class="col-md-8  float-right">
                            @if(count($requests->all()) > 0)
                                @foreach($requests as $request)
                                    <div class="text-center">
                                        <h1>Request Item ID: {{$request->id}}</h1>
                                        <hr><br>
                                    <h2 style="text-decoration:underline;">User Details:</h2>
                                        <br>
                                    <h3>User Name: {{$request->user->name}}</h3>
                                    <h3>User ID: {{$request->posts->id}}</h3>
                                    <h3>User Email: {{$request->user->email}}</h3>
                                        <br><br>
                                        <h2 style="text-decoration:underline;">Item Post Details:</h2>
                                        <br>
                                    <h3>Post Title: {{$request->posts->post_title}}</h3>
                                        <br>
                                    <h3>Post Description: {{$request->posts->post_description}}</h3>
                                    <br>
                                    <h2>Reason for Request Item: {{$request->reason}}</h2>
                                    <br>
                                    <h2>Status: {{$request->status}}</h2>
                                    <a href="{{action('RequestsController@approveRequest', $request->id)}}" class="btn btn-primary">Approve Request</a>
                                    <a href="{{action('RequestsController@refuseRequest', $request->id)}}" class="btn btn-danger">Refuse Request</a>
                                    <br><br>
                                    <h2>Send Email</h2>
                                    <a href="{{action('RequestsController@emailApprovedRequest', $request->user->id)}}" class="btn btn-success">Send Approve Email</a>
                                    <a href="{{action('RequestsController@emailrefuseRequest', $request->user->id)}}" class="btn btn-warning">Send Refuse Email</a>
                                    </div>
                                    <hr/>
                                @endforeach
                            @else
                                <p>No Requests Available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
