@extends('layouts.app', ['page' => ['name' => 'Manage Account']])
@section('content')
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
               <div class="card-title"></div>
            </div>
            <div class="card-body">
                <form action="{{ url('client/account') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('client.account.form')
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
{!! JsValidator::formRequest('App\Http\Requests\AccountRequest') !!}
<script>
function removePhoto() {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this photo!",
        icon: "warning",
        buttons: { cancel: !0, confirm: { text: "Yes, delete it!", value: !0, visible: !0, className: "bg-danger", closeModal: !0 } },
    }).then(function (e) {
        if(e) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('client/image') }}/0",
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