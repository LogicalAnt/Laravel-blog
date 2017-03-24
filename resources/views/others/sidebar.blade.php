<div class="col-sm-3 offset-sm-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p>
            Echo is a simple blog post application to express your thought more loudly.</br>
            Say whatever you want, Be like a free bird :)</br>
        </p>
    </div>
    <div class="sidebar-module">
        <h4>Archives</h4>

        <form class="form-inline" method="GET" action="/archive/">
            {{--{{csrf_field()}}--}}
            <input type="text" class="input-group col-sm-3" placeholder="year" name="year">
            <select  class="input-group col-sm-3" name="month">
                <option value="1">Jan</option>
                <option value="2">Feb</option>
                <option value="3">Mar</option>
                <option value="4">Apr</option>
                <option value="5">May</option>
                <option value="6">Jun</option>
                <option value="7">Jul</option>
                <option value="8">Aug</option>
                <option value="9">Sep</option>
                <option value="10">Oct</option>
                <option value="11">Nov</option>
                <option value="12">Dec</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm">search</button>
        </form>

    </div>

    <div class="sidebar-module">
        <h4>Top Category</h4>
        <ol class="list-unstyled">
            @foreach($tags as $tag)

                @if($tag->count)
                <li>
                    <a href="/topic/{{$tag->name}}">
                        {{($tag->name)}}
                        <span class="badge badge-primary" style="background-color: cornflowerblue">{{$tag->count}}</span>
                    </a>
                </li>
                @endif

            @endforeach
        </ol>
    </div>
    <div class="sidebar-module">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
        </ol>
    </div>
</div><!-- /.blog-sidebar -->