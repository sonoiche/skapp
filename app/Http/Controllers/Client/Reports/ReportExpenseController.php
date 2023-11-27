<?php

namespace App\Http\Controllers\Client\Reports;

use Carbon\Carbon;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\ProposalExpense;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportExpenseController extends Controller
{
    public function index()
    {
        $from   = Carbon::now()->subDays(30)->format('Y-m-d');
        $to     = Carbon::now()->format('Y-m-d');
        $data['proposals']  = Proposal::orderBy('title')->get();
        $data['finances']   = ProposalExpense::whereBetween(DB::raw("date(created_at)"), [$from, $to])->orderby('created_at')->get();
        $data['datefield']  = Carbon::now()->subDays(30)->format('m/d/Y').' - '.Carbon::now()->format('m/d/Y');
        
        return view('client.reports.finance.index', $data);
    }

    public function store(Request $request)
    {
        $datefield      = $request['daterange'];
        $daterange      = explode('-', $datefield);
        $proposal_id    = $data['proposal_id'] = $request['porposal_id'];
        $from           = Carbon::parse($daterange[0])->format('Y-m-d');
        $to             = Carbon::parse($daterange[1])->format('Y-m-d');

        $data['proposals']  = Proposal::orderBy('title')->get();
        $data['finances']   = ProposalExpense::whereBetween(DB::raw("date(created_at)"), [$from, $to])
            ->when($proposal_id, function ($query, $proposal_id) {
                $query->where('proposal_id', $proposal_id);
            })->orderby('created_at')->get();
        $data['datefield'] = $datefield;
        
        return view('client.reports.finance.index', $data);
    }
}
