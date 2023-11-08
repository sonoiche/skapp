@extends('layouts.app', ['page' => ['name' => 'Update a Proposal']])
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
                <form action="{{ url('client/proposals', $proposal->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('client.proposals.form')
                    @if ($proposal->status != 'Declined')
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
{!! JsValidator::formRequest('App\Http\Requests\ProposalRequest') !!}
<script>
$(document).ready(function () {
    $('#status').change(function (e) { 
        e.preventDefault();
        var status = $(this).val();
        if(status == 'Declined') {
            $('#div-feedback').show();
        } else {
            $('#div-feedback').hide();
        }
    });
});

function removePhoto(id) {
    swal({
        title: "Are you sure?",
        text: "You want to remove this document file",
        icon: "warning",
        buttons: { cancel: !0, confirm: { text: "Yes, delete it!", value: !0, visible: !0, className: "bg-danger", closeModal: !0 } },
    }).then(function (e) {
        if(e) {
            $.ajax({
                type: "GET",
                url: "{{ url('client/proposals') }}/"+id+"/photo/remove",
                dataType: "json",
                success: function (response) {
                    location.reload();
                }
            });
        }
    })
}
</script>
@endsection