<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Proposal;
use App\Models\ProposalTask;
use Illuminate\Http\Request;
use App\Models\ProposalExpense;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProposalRequest;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        $type       = $request['type'];
        $user_id    = auth()->user()->id;

        $data['proposals'] = Proposal::when($type, function ($query, $type) use ($user_id) {
            if($type == 'own-proposal') {
                $query->where('user_id', $user_id);
            }
        })->latest()->get();
        return view('client.proposals.index', $data);
    }

    public function create()
    {
        return view('client.proposals.create');
    }

    public function store(ProposalRequest $request)
    {
        $proposal = new Proposal;
        $proposal->title        = $request['title'];
        $proposal->description  = $request['description'];
        $proposal->budget       = $request['budget'];
        $proposal->user_id      = auth()->user()->id;
        $proposal->status       = 'Pending';

        if(isset($request['document_file']) && $request->has('document_file')) {
            $file  = $request->file('document_file');
            $document_file = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('s3')->putFileAs(
                'skapp/uploads/proposals',
                $file,
                $document_file,
                'public'
            );
            
            $proposal->document_file = Storage::disk('s3')->url($path);
        }

        $proposal->save();

        return redirect()->to('client/proposals')->with('success', 'The proposal has been submitted');
    }

    public function edit($id)
    {
        $data['proposal']   = Proposal::find($id);
        return view('client.proposals.edit', $data);
    }

    public function update(ProposalRequest $request, $id)
    {
        $proposal = Proposal::find($id);
        $proposal->title        = $request['title'];
        $proposal->description  = $request['description'];
        
        if($proposal->status != 'Approved') {
            $proposal->budget   = $request['budget'];
        }

        if(isset($request['document_file']) && $request->has('document_file')) {
            $file  = $request->file('document_file');
            $document_file = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('s3')->putFileAs(
                'skapp/uploads/proposals',
                $file,
                $document_file,
                'public'
            );
            
            $proposal->document_file = Storage::disk('s3')->url($path);
        }

        if(auth()->user()->committee) {
            $proposal->status   = $request['status'];
            if(in_array($request['status'], ['Approved','Declined'])) {
                $proposal->user_action = auth()->user()->id;
            }
        }

        $proposal->save();

        return redirect()->back()->with('success', 'The proposal has been updated.');
    }

    public function show($id)
    {
        $data['proposal']   = Proposal::find($id);
        $data['tasks']      = ProposalTask::where('proposal_id', $id)->latest()->get();
        $data['expenses']   = ProposalExpense::where('proposal_id', $id)->latest()->get();
        return view('client.proposals.show', $data);
    }

    public function photoRemove($id)
    {
        $proposal = Proposal::find($id);

        Storage::disk('s3')->delete('skapp/uploads/proposals/'.basename($proposal->document_file));

        $proposal->document_file = null;
        $proposal->save();

        return response()->json(200);
    }
}
