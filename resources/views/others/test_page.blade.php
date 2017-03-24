<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" >

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("p").click(function(){
                $(this).hide();
            });
        });
    </script>



</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4">

            <p>If you click on me, I will disappear.</p>
            <p>Click me away!</p>
            <p>Click me too!</p>


            <form action="/testing" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <select name="tag[ ]" id="tag"class="js-example-basic-multiple form-control" multiple="multiple">
                        <option value="1">one</option>
                        <option value="2">two</option>
                        <option value="3">three</option>
                    </select>
                    <button type="submit" id="">ok</button>
                </div>
            </form>
        </div>
    </div>

    {{--@foreach($tags as $tag)--}}
        {{--{{\App\Tag::find($tag->tag)->name}}--}}
    {{--@endforeach--}}


</div>




</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
   /* $(document).ready(function() {
        $(".js-example-basic-multiple").select2();

    });*/ /*strict*/

    $(".js-example-basic-multiple").select2({
        tags: true
    }) /*user friendly*/
</script>
</html>