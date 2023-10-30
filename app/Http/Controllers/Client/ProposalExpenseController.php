<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\ProposalExpense;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use Illuminate\Support\Facades\Storage;

class ProposalExpenseController extends Controller
{
    public function create(Request $request)
    {
        $data['proposal_id'] = $request['proposal_id'];
        return view('client.expenses.create', $data);
    }

    public function store(ExpenseRequest $request)
    {
        $proposal_id    = $request['proposal_id'];
        $expense        = new ProposalExpense;
        $expense->name          = $request['name'];
        $expense->amount        = $request['amount'];
        $expense->remarks       = $request['remarks'];
        $expense->user_id       = auth()->user()->id;
        $expense->proposal_id   = $proposal_id;

        if(isset($request['document_file']) && $request->has('document_file')) {
            $file  = $request->file('document_file');
            $document_file = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('upcloud')->putFileAs(
                'skapp/uploads/expenses',
                $file,
                $document_file,
                'public'
            );
            
            $expense->document_file = Storage::disk('upcloud')->url($path);
        }

        $expense->save();

        return redirect()->to('client/proposals/'.$proposal_id);
    }

    public function edit($id)
    {
        $data['expense']        = $expense = ProposalExpense::find($id);
        $data['proposal_id']    = $expense->proposal_id;
        return view('client.expenses.edit', $data);
    }

    public function update(ExpenseRequest $request, $id)
    {
        $proposal_id    = $request['proposal_id'];
        $expense        = ProposalExpense::find($id);
        $expense->name          = $request['name'];
        $expense->amount        = $request['amount'];
        $expense->remarks       = $request['remarks'];

        if(isset($request['document_file']) && $request->has('document_file')) {
            $file  = $request->file('document_file');
            $document_file = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('upcloud')->putFileAs(
                'skapp/uploads/expenses',
                $file,
                $document_file,
                'public'
            );
            
            $expense->document_file = Storage::disk('upcloud')->url($path);
        }

        $expense->save();

        return redirect()->to('client/proposals/'.$proposal_id);
    }
}
