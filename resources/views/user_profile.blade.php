@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
                <div  class="col-sm-12">
                    <div class="col-sm-8">
                        {{--<img src="https://duckduckgo.com/i/781630fa.jpg" class="img-circle" style="width:160px;height:160px;">
--}}                        @if($user->avatar)
                                <img src="{{$user->avatar}}"
                                 class="img-circle" style="width:150px;height:150px;">
                            @else
                                <img src="/storage/avatars/default.png"
                                     alt="https://duckduckgo.com/i/781630fa.jpg"
                                     class="img-circle" style="width:150px;height:150px;">
                            @endif

                    </div>
                    <div class="col-sm-4">
                        <span>User name: {{$user->name}}</span> <br>
                        <span>Total posts: {{$user->post->count()}}</span> <br>
                        <span>User joined: {{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</span>
                    </div>
                </div>{{--user info--}}





                <div  class="col-sm-12">
                    <hr style="border-width: 2px; border-color: red; padding: 1em">
                    @foreach($posts as $post)
                        <a href="/post/{{$post->id}}">
                            {{$post->title}}
                        </a>
                        <br>
                        <small>{{$post->created_at}}</small>
                        <p>{{str_limit($post->body,50)}}</p>
                        <hr>
                    @endforeach
                </div>

                <nav class="blog-pagination">
                    {{--    <a class="btn btn-outline-primary" href={!! $posts->url() !!}}>Older</a>
                        <a class="btn btn-outline-secondary" href="#">Newer</a>--}}
                    {{$posts->links()}}
                </nav>


            </div><!-- /.blog-main -->

            @include('others.sidebar');
        </div><!-- /.row -->
    </div><!-- /.container -->


@endsection