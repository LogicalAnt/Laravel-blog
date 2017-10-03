@extends('layouts.app')
@section('content')
    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title">{{$post->title}}</h1>
            <p><a href="/user/{{$post->user->id}}">{{$post->user->name}}</a> {{$post->created_at->toDayDateTimeString()}}</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
                @if($post->user->id == Auth::id())
                    <div class="dropdown" style="float: right;">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           {{-- <span class="glyphicon glyphicon-menu-down"></span>--}}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            <li><a href="/post/{{$post->id}}/update">Update</a></li>
                             <li>
                                   <a href="/post/delete/{{$post->id}}" >
                                       <form action="/post/delete/{{$post->id}}" method="POST">
                                           {{method_field('DELETE')}}
                                           {{csrf_field()}}
                                           <p name="delete">Delete</p>
                                       </form>
                                   </a>
                             </li>
                            <li><a href="#"><input type="checkbox"> Anonymous</a></li>
                        </ul>
                    </div> {{--dropdowns--}}
                @endif

                <div class="blog-post">
                    {{--fetch blog post--}}
                    {!!Markdown::convertToHtml($post->body)!!}
                    {{--fetch blog post--}}

                        @foreach($post->tags as $tag)
                            <a href="/topic/{{$tag->name}}">
                                <span class="label label-info">{{$tag->name}}</span>
                            </a>
                        @endforeach {{--tag section--}}
                    <hr style="border-width: 5px;">
                </div><!-- /.blog-post -->

{{--                <div class="blog-post">
                <form action="/post/{{$post->id}}/comments" method="post">
                    {{csrf_field()}}

                    <div class="form-group">
                        <textarea name="body" class="form-control" id="exampleTextarea" rows="1"></textarea>
                        <button class="btn btn-primary btn-sm" style="float:right;">comment</button>
                    </div>
                </form>
                </div> --}}{{--colllect comment--}}{{--

                <div class="blog-post">
                    @foreach($comments as $comment)
                    --}}{{--issue: Is sortByDesc perform every loop iteration?--}}{{--
                        <p> <a href="/user/{{$comment->user->id}}">{{$comment->user->name}}</a>
                        {{
                           $comment->created_at
                                   ->diffForHumans(\Carbon\Carbon::now()->addHours(6))
                         }}
                    </p>
                    <p>{{$comment->body}}</p>
                    <hr>
                    @endforeach
                </div> --}}{{--fetch comment--}}
                    <div class="fb-comments" data-href="https://localhost:8000/laravel-blog" data-numposts="5"></div>
            </div><!-- /.blog-main -->

            @include('others.sidebar');

        </div><!-- /.row -->

    </div><!-- /.container -->
@endsection