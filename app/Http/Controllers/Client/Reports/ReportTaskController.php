<?php

namespace App\Http\Controllers\Client\Reports;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\ProposalTask;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportTaskController extends Controller
{
    public function index()
    {
        $from   = Carbon::now()->subDays(30)->format('Y-m-d');
        $to     = Carbon::now()->format('Y-m-d');
        
        $data['proposals'] = Proposal::orderBy('title')->get();
        $data['tasks'] = ProposalTask::whereBetween('due_date', [$from, $to])->orderBy('due_date')->get();
        $data['datefield'] = Carbon::now()->subDays(30)->format('m/d/Y').' - '.Carbon::now()->format('m/d/Y');

        return view('client.reports.tasks.index', $data);
    }

    public function store(Request $request)
    {
        $datefield      = $request['daterange'];
        $daterange      = explode('-', $datefield);
        $status         = $data['status'] = $request['status'];
        $proposal_id    = $data['proposal_id'] = $request['porposal_id'];
        $from           = Carbon::parse($daterange[0])->format('Y-m-d');
        $to             = Carbon::parse($daterange[1])->format('Y-m-d');
        
        $data['proposals'] = Proposal::orderBy('title')->get();
        $data['tasks'] = ProposalTask::whereBetween('due_date', [$from, $to])
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($proposal_id, function ($query, $proposal_id) {
                $query->where('proposal_id', $proposal_id);
            })
            ->orderBy('due_date')
            ->get();

        $data['datefield'] = $datefield;

        return view('client.reports.tasks.index', $data);
    }
}
