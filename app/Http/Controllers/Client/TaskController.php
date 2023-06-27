<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ProposalTask;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $data['tasks'] = ProposalTask::where('assigned_user', $user_id)->latest()->get();
        return view('client.tasks.index', $data);
    }

    public function create(Request $request)
    {
        $data['proposal_id'] = $proposal_id = $request['proposal_id'];
        if(isset($proposal_id)) {
            $data['users'] = User::where('role', 'User')->orderBy('fname')->get();
            return view('client.tasks.create', $data);
        }

        return redirect()->back();
    }

    public function store(TaskRequest $request)
    {
        $proposal_id    = $request['proposal_id'];
        $task           = new ProposalTask;
        $task->title            = $request['title'];
        $task->description      = $request['description'];
        $task->assigned_user    = $request['assigned_user'];
        $task->due_date         = $request['due_date'];
        $task->proposal_id      = $proposal_id;
        $task->user_id          = auth()->user()->id;

        if(isset($request['document_file']) && $request->has('document_file')) {
            $file  = $request->file('document_file');
            $document_file = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('s3')->putFileAs(
                'skapp/uploads/tasks',
                $file,
                $document_file,
                'public'
            );
            
            $task->document_file = Storage::disk('s3')->url($path);
        }

        $task->save();

        return redirect()->to('client/proposals/'.$proposal_id);
    }

    public function edit($id)
    {
        $data['task']   = ProposalTask::find($id);
        $data['users']  = User::where('role', 'User')->orderBy('fname')->get();
        return view('client.tasks.edit', $data);
    }

    public function show(Request $request, $id)
    {
        $type = $request['type'];
        switch ($type) {

            case 'in_progress':
                
                $task = ProposalTask::find($id);
                $task->status = 'In Progress';
                $task->save();

                break;
            
            case 'complete':
                
                $task = ProposalTask::find($id);
                $task->status = 'Completed';
                $task->date_completed = Carbon::now();
                $task->save();

                break;
        }

        return redirect()->back();
    }
}
