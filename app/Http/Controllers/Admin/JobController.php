<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Product;
use App\Models\Order;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JobController extends Controller
{
    //
    public function job ()
    {
        $job = Job::orderBy('id','desc')->get()->all();
        return view('admin.job.index', compact('job'));
    }

    public function jobCreate ()
    {
        return view('admin.job.create');
    }

    public function jobStore (Request $request)
    {
        Job::create([
            'title' => $request['title'],
            'short_description' => $request['short_description'] ?? '',
            'long_description' => $request['long_description'] ?? '',
            'job_description' => $request['job_description'] ?? '',
            'requirement' => $request['requirement'] ?? '',
            'tags' => $request['tags'] ?? '',
            'job_category' => $request['job_category'] ?? '',
            'job_product_group' => $request['job_product_group'] ?? '',
            'job_types' => $request['job_types'] ?? '',
            'location' => $request['location'] ?? '',
            'file'=> $request['img-data'] ?? ''
        ]);

        return redirect()->route('job');
    }

    public function jobDelete(Request $request)
    {
        Job::where('id',$request['id'])->delete();
        return "Record Deleted Successfully..!";
    }

    public function jobEdit ($id)
    {
        $job = Job::where('id',$id)->get()->first();
        return view('admin.job.edit', compact('job'));
    }

    public function jobUpdate(Request $request)
    {
        if (($request->hasFile('file')) && ($request['img-data'] != '')) {
            $imageDbIqaman = $request['img-data'];
        }
        $time = time();
        Job::where('id',$request['id'])->update([
            'title' => $request['title'],
            'short_description' => $request['short_description'] ?? '',
            'long_description' => $request['long_description'] ?? '',
            'job_description' => $request['job_description'] ?? '',
            'requirement' => $request['requirement'] ?? '',
            'tags' => $request['tags'] ?? '',
            'job_category' => $request['job_category'] ?? '',
            'job_product_group' => $request['job_product_group'] ?? '',
            'job_types' => $request['job_types'] ?? '',
            'location' => $request['location'] ?? '',
            'file'=> $imageDbIqaman ?? $request['pre-image']
        ]);

        return redirect()->route('job');
    }

    public function active_job($id)
    {
        Job::where('id',$id)->update([
            'status' => 1
        ]);
        return redirect()->route('job');
    }

    public function inactive_job($id)
    {
        Job::where('id',$id)->update([
            'status' => 0
        ]);
        return redirect()->route('job');
    }

}
