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
                            <hr>
                            <div class="form-group">
                                <div class="alert alert-info" style="display: none"
                                     id="filename" >
                                </div>
                                <label for="file" class="btn btn-success">
                                    <input type="file" name="file" id="file" class="form-control-file" style="display: none;"
                                        onchange="$('#filename').text(`File: ${this.files[0].name} (${this.files[0].size/1000}Kb)`);$('#filename').show();$('#mime').val(this.files[0].type);if($('#tag').val()=='')$('#tag').val(this.files[0].name)"
                                    >
                                    Upload File
                                </label>
                            </div>
                            <input type="hidden" name="mime" id="mime" value="">
                            @csrf
                            <button type="submit" class="btn btn-primary form-control text-lg-center">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
