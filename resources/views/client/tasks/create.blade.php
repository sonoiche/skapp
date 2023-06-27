@extends('layouts.app', ['page' => ['name' => 'Create Proposal Task']])
@section('content')
<div class="d-flex justify-content-end my-3">
    <a href="{{ url('client/proposals', $proposal_id) }}" class="btn btn-outline-danger">Back</a>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
               <div class="card-title"></div>
            </div>
            <div class="card-body">
                <form action="{{ url('client/tasks') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('client.tasks.form')
                    <div class="form-group">
                        <input type="hidden" name="proposal_id" value="{{ $proposal_id }}">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
{!! JsValidator::formRequest('App\Http\Requests\TaskRequest') !!}
@endsection