@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">

                <div class="blog-post">

                    <form class="form-horizontal" method="POST" action="/post/{{$post->id}}">
                        {!! method_field('patch') !!}
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Heading</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="1" name="title">{{$post->title}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Body</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="10" name="body">{{$post->body}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tags</label>
                            <div class="col-sm-10">
                                <select style="width: 100%" class="js-example-multiple form-control" name="tag[ ]"  multiple="multiple">
                                    @foreach(\App\Tag::all() as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default" style="float: right">Update</button>
                            </div>
                        </div>
                    </form>

                    <hr style="border-width: 5px;">
                     {{--edited post area
                        ...
                     edited post area--}}

                </div><!-- /.blog-post -->

            </div><!-- /.blog-main -->

            @include('others.sidebar');

        </div><!-- /.row -->

    </div><!-- /.container -->

@endsection