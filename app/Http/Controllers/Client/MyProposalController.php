<?php

namespace App\Http\Controllers\Client;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyProposalController extends Controller
{
    public function index()
    {
        $user_id    = auth()->user()->id;
        $data['proposals'] = Proposal::where('user_id', $user_id)->latest()->get();
        return view('client.myproposals.index', $data);
    }
}
