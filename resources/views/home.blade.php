@extends('layouts.app')

@section('content')

    @if(session('message'))
    <div class="alert alert-success" style="text-align: center;" id="alert"> 
        {{Auth::user()->name.' '. session('message')}}
        {{session()->forget('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <script type="text/javascript">
            $().alert('close')

    </script>
@endsection
