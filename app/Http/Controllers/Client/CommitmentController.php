<?php

namespace App\Http\Controllers\Client;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommitmentController extends Controller
{
    public function index()
    {
        $user_id    = auth()->user()->id;
        $data['proposals'] = Proposal::where('user_action', $user_id)->where('status', '!=', 'Declined')->latest()->get();
        return view('client.commitment.index', $data);
    }
}
