@extends('layouts.app')
<style type="text/css">
    .avatar{max-width: 20%;}
    #posts{transform: translateY(-100px);}
    .text{font-size: 20px;}
</style>
@if(!Auth::user()->isAdmin)
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
                        <div id="posts" class="col-md-8  float-right">
                                <h1>Your Posts!</h1>
                            @if(count($posts) > 0)
                                @foreach($posts as $post)
                                    <div class="text-center">
                                        <h3>{{$post->post_title}}</h3>
                                            <hr>
                                        <img class="img-thumbnail" style="width:100% height:100%" src="{{ $post->post_image }}" alt="">
                                            <br><br>
                                        <h5>{{ substr($post->post_description, 0, 150)}}</h5>
                                    </div>
                                    <div class="text-center ">
                                        <ul class="nav nav-pills nav-justified">
                                            <li class="active">
                                                <a href="{{ url("/view/{$post->id}") }}">
                                                    <span class="text m-3 p-5"><i class='far fa-eye' style='font-size:20px;color:blue'></i> View</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url("/edit/{$post->id}") }}">
                                                    <span class="text m-3 p-5" id="moveEdit"><i class='far fa-edit' style='font-size:20px;color:green'></i> Edit</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url("/delete/{$post->id}") }}">
                                                    <span class="text m-2 p-5"><i class='fa fa-trash' style='font-size:20px;color:red;'></i> Delete</span>
                                                </a>
                                            </li>
                                        </ul>
                                            <cite style="">Posted on:{{date('M j, Y H:i', strtotime($post->created_at))}}</cite>
                                    </div>
                                    <hr/>
                                @endforeach
                            @else
                                <p>No posts Available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif
