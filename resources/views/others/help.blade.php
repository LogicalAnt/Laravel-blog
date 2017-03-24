@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class="table">
                    <thead class="thead-inverse">
                    <tr>
                        <th>Text using Markdown syntax</th>
                        <th>HTML produced by a Markdown processor</th>
                        <th>Text viewed in a browser</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>

                        <td># Heading</td>

                        <td>
                            <code><</code>
                            <code>h1</code>
                            <code>></code>
                            <span>Heading</span>
                            <code><</code>
                            <code>/</code>
                            <code>h1</code>
                            <code>></code>
                        </td>

                        <td><h1>Heading</h1></td>
                    </tr>



                    <tr>

                        <td><code>[link]</code><a>(http://example.com)</a></td>
                        <td>
                            <span> < </span>
                            <span> a </span>
                            <span> > </span>
                            <span>href="http://example.com"</span>
                            <span> < </span>
                            <span> a </span>
                            <span> / </span>
                            <span> > </span>


                        </td>
                        <td><a href="http://example.com">link</a></td>
                    </tr>
                    <tr>

                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

@endsection