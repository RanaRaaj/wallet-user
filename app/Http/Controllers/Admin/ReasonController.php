<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReasonType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class ReasonController extends Controller
{
    //
    public function reason_type()
    {
    	$data = ReasonType::get()->all();
    	return view('admin.reason.index', compact('data'));
    }
    public function create_reason_type()
    {
    	return view('admin.reason.create');
    }
    public function reasonTypeStore (Request $request)
    {
        ReasonType::create([
            'reason_types' => $request['reason_type'],
            'reason'=>$request['reason']?? 0,
            'cancel'=>$request['cancel']?? 0
        ]);

        return redirect()->route('reason_type');
    }
    public function delete_reason_type(Request $request)
    {
    	ReasonType::where('id',$request['id'])->delete();
        return "Record Deleted Successfully..!";
    }
    public function edit_reason_type ($id)
    {
        $data = ReasonType::where('id',$id)->get()->first();
        return view('admin.reason.edit', compact('data'));
    }
    public function reasonTypeUpdate(Request $request)
    {
        ReasonType::where('id',$request['id'])->update([
            'reason_types' => $request['reason_type'],
            'reason'=>$request['reason']?? 0,
            'cancel'=>$request['cancel']?? 0
        ]);
        return redirect()->back()->with('success','Order Type updated successfully.');
    }
}
