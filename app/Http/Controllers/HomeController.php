<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request){

        $file = $request->file('file');
        $tag  = $request->tag;
        $response = Http::attach(
            'data', file_get_contents($file->getRealPath()), $file->getFilename()
        )->post(config('DDBMS.API').'/file/upload' ,[
            'tag' => $tag,
            'key' => Auth::user()->id
        ]);
        return response()->json($response->json());
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
