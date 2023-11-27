<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Proposal;
use App\Models\ProposalTask;
use Illuminate\Http\Request;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today      = Carbon::now()->addDays(3)->format('Y-m-d');
        $user_id    = auth()->user()->id;
        $data['activeProposalCount'] = Proposal::where('status', 'Approved')->count();
        $data['myProposalCount']     = Proposal::where('user_id', $user_id)->where('status', '!=', 'Declined')->count();
        $data['assignedTaskCount']   = ProposalTask::where('assigned_user', $user_id)->where('status', '!=', 'Completed')->count();
        
        if (auth()->user()->role == 'Admin') {
            $data['tasks']           = ProposalTask::where('status', '!=', 'Completed')->where('due_date', '<', $today)->get();
        } else {
            $data['tasks']           = ProposalTask::where('assigned_user', $user_id)->where(function ($query) {
                $query->orWhere('status', '!=', 'Completed')
                    ->orWhereNull('status');
            })->where('due_date', '<', $today)->get();
        }
        
        return view('home', $data);
    }

    public function template()
    {
        return view('client.mails.reminder');
    }
}
