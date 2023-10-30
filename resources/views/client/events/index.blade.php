@extends('layouts.app', ['page' => ['name' => 'Manage Events']])
@section('content')
<div class="d-flex justify-content-end my-3">
    <a href="{{ url('client/events/create') }}" class="btn btn-primary">Add New Event</a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <div class="card-title"></div>
            </div>
            <div class="card-body">
                <table class="table table-striped my-4 w-100" id="event-table">
                    <thead>
                        <tr>
                            <th style="width: 3%" class="text-center">#</th>
                            <th style="width: 20%">Title</th>
                            <th style="width: 10%">Location</th>
                            <th style="width: 10%">Event Schedule</th>
                            <th style="width: 10%">Created By</th>
                            <th style="width: 5%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td><a href="{{ url('client/events', $item->id) }}">{{ $item->title }}</a></td>
                            <td>{{ $item->location }}</td>
                            <td>{{ $item->schedule }}</td>
                            <td>{{ isset($item->user) ? $item->user->fullname : '' }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-secondary" data-toggle="dropdown">Action</button>
                                    <div class="dropdown-menu animated pulse" role="menu">
                                        <a class="dropdown-item" href="{{ url('client/events', $item->id) }}/edit">Edit</a>
                                        <a class="dropdown-item" href="javascript:;" onclick="deleteEvent({{ $item->id }})">Delete</a>
                                    </div>
                                </div>                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-css')
<link rel="stylesheet" href="{{ url('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ url('assets/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css') }}">
<link rel="stylesheet" href="{{ url('assets/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css') }}">
@endsection

@section('page-js')
<script src="{{ url('assets/vendor/datatables.net/js/jquery.dataTables.js') }}"></script>
<script src="{{ url('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ url('assets/vendor/datatables.net-buttons/js/dataTables.buttons.js') }}"></script>
<script src="{{ url('assets/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.js') }}"></script>
<script src="{{ url('assets/vendor/datatables.net-buttons/js/buttons.colVis.js') }}"></script>
<script src="{{ url('assets/vendor/datatables.net-buttons/js/buttons.flash.js') }}"></script>
<script src="{{ url('assets/vendor/datatables.net-buttons/js/buttons.html5.js') }}"></script>
<script src="{{ url('assets/vendor/datatables.net-buttons/js/buttons.print.js') }}"></script>
<script src="{{ url('assets/vendor/datatables.net-keytable/js/dataTables.keyTable.js') }}"></script>
<script src="{{ url('assets/vendor/datatables.net-responsive/js/dataTables.responsive.js') }}"></script>
<script src="{{ url('assets/vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ url('assets/vendor/jszip/dist/jszip.js') }}"></script>
<script src="{{ url('assets/vendor/pdfmake/build/pdfmake.js') }}"></script>
<script src="{{ url('assets/vendor/pdfmake/build/vfs_fonts.js') }}"></script>
<script>
$(document).ready(function () {
    $("#event-table").DataTable({
        paging: !0,
        ordering: !0,
        info: !0,
        responsive: !0,
        oLanguage: {
            sSearch: '<em class="fas fa-search"></em>',
            sLengthMenu: "_MENU_ records per page",
            info: "Showing page _PAGE_ of _PAGES_",
            zeroRecords: "Nothing found - sorry",
            infoEmpty: "No records available",
            infoFiltered: "(filtered from _MAX_ total records)",
            oPaginate: { sNext: '<em class="fa fa-caret-right"></em>', sPrevious: '<em class="fa fa-caret-left"></em>' },
        },
    })
});

function deleteEvent(id) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this event!",
        icon: "warning",
        buttons: { cancel: !0, confirm: { text: "Yes, delete it!", value: !0, visible: !0, className: "bg-danger", closeModal: !0 } },
    }).then(function (e) {
        if(e) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('client/events') }}/"+id,
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