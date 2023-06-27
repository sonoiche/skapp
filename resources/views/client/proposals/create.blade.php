@extends('layouts.app', ['page' => ['name' => 'Submit a Proposal']])
@section('content')
<div class="d-flex justify-content-end my-3">
    <a href="{{ url('client/proposals') }}" class="btn btn-outline-danger">Back</a>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
               <div class="card-title"></div>
            </div>
            <div class="card-body">
                <form action="{{ url('client/proposals') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('client.proposals.form')
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
{!! JsValidator::formRequest('App\Http\Requests\ProposalRequest') !!}
@endsection