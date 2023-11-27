@extends('layouts.app', ['page' => ['name' => 'Update Proposal Task']])
@section('content')
<div class="d-flex justify-content-end my-3">
    <a href="{{ url('client/proposals', $task->proposal_id) }}" class="btn btn-outline-danger">Back</a>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
               <div class="card-title"></div>
            </div>
            <div class="card-body">
                <form action="{{ url('client/tasks', $task->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('client.tasks.form')
                    <div class="form-group">
                        <input type="hidden" name="proposal_id" value="{{ $task->proposal_id }}">
                        <button class="btn btn-primary" type="submit">Save Changes</button> &nbsp;
                        <a href="javascript:;" onclick="removeTask({{ $task->id }}, {{ $task->proposal_id }})" class="btn btn-danger">Delete</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
{!! JsValidator::formRequest('App\Http\Requests\TaskRequest') !!}
<script>
function removeTask(id, proposal_id) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this task!",
        icon: "warning",
        buttons: { cancel: !0, confirm: { text: "Yes, delete it!", value: !0, visible: !0, className: "bg-danger", closeModal: !0 } },
    }).then(function (e) {
        if(e) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('client/tasks') }}/"+id,
                dataType: "json",
                success: function (response) {
                    window.location.href = "/client/proposals/"+proposal_id;
                }
            });
        }
    })
}
</script>
@endsection