@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

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

                        <form action="{{route('action.upload')}}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="tag">
                                    File Tag
                                </label>
                                <input type="text" name="tag" id="tag" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="file">
                                    Upload File
                                </label>
                                <input type="file" name="file" id="file" class="form-control-file">
                            </div>
                            @csrf
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
