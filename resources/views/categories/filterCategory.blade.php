@extends('layouts.app')
<style type="text/css">
    .list-group-item{transform: translate(20px, -5px);}
    .list-group-item:hover{background-color: lightgray;border-radius:5px;}
    #posts{transform: translateY(20px);}
    .text{font-size: 20px;}
    .col-md-12{transform:translateX(-2%);}
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                    <div class="col-md-12">
                        <ul class=" text-center">
                            <h1>Select Item Category</h1>
                                <br>
                            @if(count($categories) > 0)
                                @foreach($categories as $category)
                                <a href='{{ url("category/{$category->id}") }}' style="height:5vh;margin:1%;" class="btn btn-outline-secondary btn-lg">{{strtoupper($category->category)}}</a>
                                   {{--<li class="list-group-item"><a style="font-size:20px;" href='{{ url("category/{$category->id}") }}'>{{strtoupper($category->category)}}</a></li>--}}
                                @endforeach
                            @else
                                <p>No Category Found!</p>
                            @endif
                        </ul>
                        <br><br><hr>
                <div id="posts" class="col-md-12 ">
                    @if(count($posts) > 0)
                    @foreach($posts as $post)
                        <div>
                            <h2>{{$post->post_title}}</h2>
                        {{-- <img style="width:100%" src="{{ $post->post_image }}" alt=""> --}}
                        <br>
                            <div class="text-center">
                                {{-- <h4>{{$post->post_description}}</h4> --}}
                            <small>Created on:{{$post->created_at}} by {{$post->user->name}}</small>
                            </div>
                            <a href="{{ url("/view/{$post->id}") }}" class="btn btn-success">View</a>

                            @if(!Auth::guest())
                                @if(!Auth::user()->isAdmin)
                                    @if(Auth::user()->id != $post->user_id)
                                    <div class="float-right">
                                        {{-- <a href="/requests/{id}" class="btn btn-outline-primary">Request Item</a> --}}
                                        <a href="{{action('RequestsController@makeRequest', $post->id)}}" class="btn btn-primary">Request Item</a>
                                    </div>
                                    @endif
                                @endif
                                {{-- <a href="{{action('PostsController@viewPost', $post->id)}}" class="btn btn-primary">View</a> --}}

                            @if(Auth::user()->isAdmin)
                                <a href="{{ url("/edit/{$post->id}") }}" class="btn btn-primary">Edit</a>
                            @endif
                            @endif
                            <br>
                        </div>
                        <hr />
                    @endforeach
                    @else
                        <p>No posts Available</p>
                    @endif
        </div>
    </div>
</div>
</div>
@endsection
