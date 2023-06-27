@extends('layouts.app', ['page' => ['name' => 'Proposals']])
@section('content')
<div class="d-flex justify-content-end my-3">
    <a href="{{ url('client/proposals/create') }}" class="btn btn-primary">Add New Proposal</a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <div class="card-title"></div>
            </div>
            <div class="card-body">
                <table class="table table-striped my-4 w-100" id="proposal-table">
                    <thead>
                        <tr>
                            <th style="width: 3%" class="text-center">#</th>
                            <th style="width: 20%">Title</th>
                            <th style="width: 10%" class="text-center">Document File</th>
                            <th style="width: 10%">Propose Amount</th>
                            <th style="width: 10%">Created By</th>
                            <th style="width: 10%">Committee</th>
                            <th style="width: 5%">Status</th>
                            <th style="width: 5%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposals as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $item->title }}</td>
                            <td class="text-center"><a href="{{ $item->document_file }}" class="btn btn-sm btn-outline-primary" target="_blank" {{ !isset($item->document_file) ? 'disabled' : '' }}><i class="fa fa-download"></i> Download</a></td>
                            <td>{{ $item->budget }}</td>
                            <td>{{ isset($item->user) ? $item->user->fullname : '' }}</td>
                            <td>{{ isset($item->action) ? $item->action->fullname : '' }}</td>
                            <td>{{ $item->status }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-secondary" data-toggle="dropdown">Action</button>
                                    <div class="dropdown-menu animated pulse" role="menu">
                                        <a class="dropdown-item" href="{{ url('client/proposals', $item->id) }}/edit">Edit</a>
                                        <a class="dropdown-item" href="{{ url('client/proposals', $item->id) }}">View Proposal</a>
                                        <a class="dropdown-item" href="javascript:;" onclick="deleteProposal({{ $item->id }})">Delete</a>
                                    </div>
                                </div>                                
                            </td>
                        </tr>
                        @endforeach
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
    $("#proposal-table").DataTable({
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

function deleteProposal(id) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this proposal!",
        icon: "warning",
        buttons: { cancel: !0, confirm: { text: "Yes, delete it!", value: !0, visible: !0, className: "bg-danger", closeModal: !0 } },
    }).then(function (e) {
        if(e) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('client/proposals') }}/"+id,
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