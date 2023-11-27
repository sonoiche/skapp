<?php

namespace App\Http\Controllers\Client\Reports;

use Carbon\Carbon;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportProposalController extends Controller
{
    public function index()
    {
        $from   = Carbon::now()->subDays(30)->format('Y-m-d');
        $to     = Carbon::now()->format('Y-m-d');
        $data['proposals'] = Proposal::whereBetween(DB::raw("date(created_at)"), [$from, $to])->orderby('created_at')->get();
        $data['datefield'] = Carbon::now()->subDays(30)->format('m/d/Y').' - '.Carbon::now()->format('m/d/Y');

        return view('client.reports.proposal.index', $data);
    }

    public function store(Request $request)
    {
        $datefield      = $request['daterange'];
        $daterange      = explode('-', $datefield);
        $status         = $data['status'] = $request['status'];
        $from           = Carbon::parse($daterange[0])->format('Y-m-d');
        $to             = Carbon::parse($daterange[1])->format('Y-m-d');
        
        $data['proposals'] = Proposal::whereBetween(DB::raw("date(created_at)"), [$from, $to])
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderby('created_at')->get();
        $data['datefield'] = Carbon::now()->subDays(30)->format('m/d/Y').' - '.Carbon::now()->format('m/d/Y');
        $data['datefield'] = $datefield;
        
        return view('client.reports.proposal.index', $data);
    }
}
