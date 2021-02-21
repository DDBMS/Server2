@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Document List') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            @if(session('status_custom'))
                                <div class="alert {{session('status_custom')}}" role="alert">
                                    {{ session('status') }}
                                </div>
                            @else
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                        @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">tag</th>
                                <th scope="col">time</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($documents as $doc)
                                <tr>
                                    <th scope="row">
                                        <a href="show/{{$doc->id}}" >{{$doc->id}}</a>
                                    </th>
                                    <td>{{$doc->tag}}</td>
                                    <td>{{$doc->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
