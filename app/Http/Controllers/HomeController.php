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
        )->post( "http://t22.tfcis.org:10022/file/upload",[
            'tag' => $tag,
            'key' => Auth::user()->id
        ]);

        #env('DDBMS_API')
        return response()->json([]);
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
