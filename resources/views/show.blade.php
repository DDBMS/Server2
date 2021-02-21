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
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Download File</h5>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"
                                           oninput="document.getElementById('download_btn').setAttribute('download',this.value)"
                                           id="filename" placeholder="Filename (including extension)"
                                           aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <a href="data:application/octet-stream;base64,{{$data}}"
                                   download=""
                                   id="download_btn"
                                   class="btn btn-success"
                                >
                                    Download
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div>{{base64_decode($data)}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
