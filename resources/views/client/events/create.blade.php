@extends('layouts.app', ['page' => ['name' => 'Add New Event']])
@section('content')
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
               <div class="card-title"></div>
            </div>
            <div class="card-body">
                <form action="{{ url('client/events') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('client.events.form')
                    <div class="form-group">
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                        <a href="{{ url('client/events') }}" class="btn btn-outline-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-css')
<link rel="stylesheet" href="{{ url('assets/vendor/select2/dist/css/select2.css') }}">
<link rel="stylesheet" href="{{ url('assets/vendor/ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.css') }}">
<link rel="stylesheet" href="{{ url('vendor/daterangepicker/daterangepicker.css') }}">
<style>
.w-15 {
    width: 15%;
}
</style>
@endsection

@section('page-js')
{!! JsValidator::formRequest('App\Http\Requests\EventRequest') !!}
<script src="{{ url('assets/vendor/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ url('vendor/moment/moment.min.js') }}"></script>
<script src="{{ url('vendor/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ url('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
$(document).ready(function () {
    var dateToday = new Date();
    $('.daterange').daterangepicker({
        startDate: moment().startOf('day'),
        minDate: moment().startOf('day')
    });
    $("#select2-1").select2({theme:"bootstrap4"})

    ClassicEditor.create( document.querySelector( '#description' ), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ],
    })
    .then( editor => {
        window.editor = editor;
        editor.ui.view.editable.element.style.height = '200px';
    })
    .catch( err => {
        console.error( err.stack );
    });

    ClassicEditor.create( document.querySelector( '#event_goal' ), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ],
    })
    .then( editor => {
        window.editor = editor;
        editor.ui.view.editable.element.style.height = '200px';
    })
    .catch( err => {
        console.error( err.stack );
    });
});

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
                url: "{{ url('client/event-image') }}/0",
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