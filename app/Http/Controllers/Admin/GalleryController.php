<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Order;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GalleryController extends Controller
{
    //
    public function gallery ()
    {
        $gallery = Gallery::latest()->get()->all();
        return view('admin.gallery.index', compact('gallery'));
    }

    public function galleryCreate ()
    {
        return view('admin.gallery.create');
    }

    public function galleryStore (Request $request)
    {
        Gallery::create([
            'title' => $request['title'],
            'file'=> $request['img-data'] ?? ''
        ]);

        $gallery = Gallery::get()->all();
        return redirect()->route('gallery', ['gallery' => $gallery]);
    }

    public function galleryDelete(Request $request)
    {
        Gallery::where('id',$request['id'])->delete();
        return "Record Deleted Successfully..!";
    }

    public function galleryEdit ($id)
    {
        $gallery = Gallery::where('id',$id)->get()->first();
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function galleryUpdate(Request $request)
    {
        if (($request->hasFile('file')) && ($request['img-data'] != '')) {
            $imageDbIqaman = $request['img-data'];
        }
        $time = time();
        Gallery::where('id',$request['id'])->update([
            'title' => $request['title'],
            'file'=> $imageDbIqaman ?? $request['pre-image']
        ]);

        $gallery = Gallery::get()->all();
        return view('admin.gallery.index', compact('gallery'));
    }


}
