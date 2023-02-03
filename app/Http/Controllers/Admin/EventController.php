<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Product;
use App\Models\Order;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{
    //
    public function event ()
    {
        $event = Event::latest()->get()->all();
        return view('admin.event.index', compact('event'));
    }

    public function eventCreate ()
    {
        return view('admin.event.create');
    }

    public function eventStore (Request $request)
    {
        Event::create([
            'title' => $request['title'],
            'short_description' => $request['short_description'] ?? '',
            'long_description' => $request['long_description'],
            'form_status' => $request['form_status'],
            'event_type' => $request['event_type'],
            'location' => $request['location'],
            'event_time' => $request['event_time'],
            'file'=> $request['img-data'] ?? ''
        ]);

        $event = Event::get()->all();
        return redirect()->route('event', ['event' => $event]);
    }

    public function eventDelete(Request $request)
    {
        Event::where('id',$request['id'])->delete();
        return "Record Deleted Successfully..!";
    }

    public function eventEdit ($id)
    {
        $event = Event::where('id',$id)->get()->first();
        return view('admin.event.edit', compact('event'));
    }

    public function eventUpdate(Request $request)
    {
        if (($request->hasFile('file')) && ($request['img-data'] != '')) {
            $imageDbIqaman = $request['img-data'];
        }
        $time = time();
        Event::where('id',$request['id'])->update([
            'title' => $request['title'],
            'short_description' => $request['short_description'] ?? '',
            'long_description' => $request['long_description'],
            'form_status' => $request['form_status'],
            'event_type' => $request['event_type'],
            'location' => $request['location'],
            'event_time' => $request['event_time'],
            'file'=> $imageDbIqaman ?? $request['pre-image']
        ]);

        $event = Event::get()->all();
        return view('admin.event.index', compact('event'));
    }

}
