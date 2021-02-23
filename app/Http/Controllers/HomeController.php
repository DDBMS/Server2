<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function upload(Request $request) {
        $file = $request->file('file');
        $tag = $request->tag;
        $mime = $request->mime ?? "";
        $doc = new Document();

        try {
            $doc = Auth::user()->documents()->create([
                'tag' => $tag,
                'mime' => $file->getClientMimeType()
            ]);
        } catch (\Exception $e) {
            $request->session()->flash('status_custom', 'alert-danger');
            $request->session()->flash('status', 'Database Error!');
            return view('home');
        }

        $response = Http::attach(
            'data', file_get_contents($file->getRealPath()), $file->getFilename()
        )->post(config('DDBMS.API') . '/file/upload', [
            'tag' => $doc->id,
            'key' => Auth::user()->id
        ])->json();

        if ($response['status']) {
            $request->session()->flash('status', $response['tag'] . ' Uploaded!');
            $doc->length = $response['len'];
            $doc->iv     = $response['iv'];
            $doc->mime   = $mime;
            $doc->save();
            return view('home');
        } else {
            $request->session()->flash('status', 'Failed!');
            return view('home');
        }
    }

    public function list() {
        return view('list')->with('documents', Auth::user()->documents()->get());
    }

    public function show(Request $request) {
        $id = $request->id;
        $doc = Auth::user()->documents()->find($id)->first();

        $response = Http::asForm()->post(config('DDBMS.API') . '/file/content', [
            'tag' => $doc->id,
            'key' => Auth::user()->id,
            'iv' => $doc->iv,
            'len' => $doc->length
        ])->json();

        if ($response['status']) {
            $request->session()->flash('status', $response['tag'] . ' Got!');
            return view('show')
                ->with('data', $response['data'])
                ->with('doc', $doc);
        } else {
            $request->session()->flash('status', 'Failed!');
            return redirect(route('home'));
        }
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('home');
    }
}
