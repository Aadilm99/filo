@extends('layouts.app')
<style type="text/css">
    .list-group-item{transform: translate(20px, -5px);}
    .list-group-item:hover{background-color: lightgray;border-radius:5px;}
    #posts{transform: translateY(20px);}
    .text{font-size: 20px;}
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Item Posts</h3></div>
                <br>
                <div class="card-body">
                    <div class="col-md-12">
                <div id="posts" class="col-md-12 text-center">
                    @if(count($posts) > 0)
                    @foreach($posts as $post)
                        <div>
                            <h1 style="text-decoration:underline">{{$post->post_title}}</h1>
                            <br>
                            <img class="img-thumbnail" style="width:100% height:100%" src="{{ $post->post_image }}" alt="">
                        <br><br><hr>
                            <div class="text-center">
                                <h3>{{$post->post_description}}</h3>
                                    <br>
                                <h4>{{$post->colour}}</h4>
                                <br>
                                <h4>{{$post->found_location}}</h4>
                            </div>
                        </div>
                        <br>
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
