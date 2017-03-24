@extends('welcome')
@section('content')

<div class="blog-header">
  <div class="container">
    <h1 class="blog-title">Express Yours Thoughts!!</h1>

  </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
<!-- modal triggerer-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Post Something</h4>
                </div>
  
                <div class="panel-body">
                  <p data-toggle="modal" data-target="#exampleModalLong">Write here . . .</p>
                  <p class=" btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"style="float:right">post</p>
                </div>
            </div>
<!-- modal triggerer-->
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <form method="POST" action="/home">
          {{csrf_field()}}
        <input type="text" class="form-control" id="exampleInputName2" placeholder="Post Title" name="title" required>
         </div>
          <div class="modal-body">
            <textarea class="form-control" rows="10" name="body"></textarea>

          </div>
        <div class="modal-body">
            {{--tag section--}}
             <span>Tags:</span>
            <select style="width: 100%" class="js-example-multiple form-control" name="tag[ ]"  multiple="multiple">
                @foreach(\App\Tag::all() as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
            {{--tag section--}}
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Post</button>

          </div>  
      </form>
      
    </div>
  </div>
</div>
<hr>
<!-- modal -->

        {{--errors--}}
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        {{--errors--}}


          <div class="blog-post">
              {{--fetch blog post--}}
            @foreach($posts as $post)
                <a href="/post/{{$post->id}}"> <h2>{{$post->title}}</h2> </a>
                  <p class="blog-post-meta">{{$post->created_at}} by
                    <a href="/user/{{$post->user_id}}">{{\App\User::find($post->user_id)->name}}</a>
                  </p>
                {!!Markdown::convertToHtml(str_limit($post->body, 400))!!}
                @if(strlen($post->body)>400)<a href="/post/{{$post->id}}">see more</a>
                @endif

                <hr>
            @endforeach
            {{--fetch blog post--}}
          </div><!-- /.blog-post -->

          <nav class="blog-pagination">
        {{--    <a class="btn btn-outline-primary" href={!! $posts->url() !!}}>Older</a>
            <a class="btn btn-outline-secondary" href="#">Newer</a>--}}
            {{$posts->links()}}
          </nav>
        </div><!-- /.blog-main -->

        @include('others.sidebar')

    </div><!-- /.row -->
    </div><!-- /.container -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    var x= $(".js-example-multiple").select2({
        /*tags: true,*/
    }) /*trigger select2*/
</script>
@endsection
  
