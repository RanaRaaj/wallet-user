<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Application;
use App\Models\Job;
use App\Models\Product;
use App\Models\Order;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApplicationController extends Controller
{
    public function application ()
    {
        Application::where('status',1)->update([
            'status' => 2
        ]);
        $application = Application::select('applications.*', 'jobs.title as job_title', 'jobs.id as job_id', 'jobs.status as job_status')
        ->leftJoin('jobs','applications.job_id','jobs.id')->latest()->get()->all();
        return view('admin.application.index', compact('application'));
    }

    public function applicationView ($id)
    {
        $application = Application::select('applications.*', 'jobs.title as job_title', 'jobs.id as job_id', 'jobs.short_description as job_description')
        ->leftJoin('jobs','applications.job_id','jobs.id')->where('applications.id',$id)->get()->first();
        return view('admin.application.view', compact('application'));
    }
}
