@extends('layouts.app', ['page' => ['name' => 'View Proposal']])
@section('content')
<div class="d-flex justify-content-end my-3">
    <a href="{{ url('client/proposals') }}" class="btn btn-outline-danger">Back</a>
</div>
<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="text-bold col-xl-2 col-md-3 col-4 col-form-label text-right">Title</label>
                    <div class="col-xl-10 col-md-9 col-8 mt-2">
                        {{ $proposal->title }}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="text-bold col-xl-2 col-md-3 col-4 col-form-label text-right">Document File</label>
                    <div class="col-xl-10 col-md-9 col-8">
                        <a href="{{ $proposal->document_file }}" class="btn btn-sm btn-outline-primary" target="_blank" {{ !isset($proposal->document_file) ? 'disabled' : '' }}>Download</a>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="text-bold col-xl-2 col-md-3 col-4 col-form-label text-right">Creator</label>
                    <div class="col-xl-10 col-md-9 col-8 mt-2">
                        {{ isset($proposal->user) ? $proposal->user->fullname : '' }}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="text-bold col-xl-2 col-md-3 col-4 col-form-label text-right">Status</label>
                    <div class="col-xl-10 col-md-9 col-8 mt-2">
                        {{ $proposal->status }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between my-3">
    <h4>Proposal Tasks</h4>
    @if ($proposal->status == 'Approved')
    <div class="">
        <a href="{{ url('client/tasks/create') }}?proposal_id={{ $proposal->id }}" class="btn btn-outline-primary">Add New Task</a>
    </div>
    @endif
</div>
<div class="row">
    @forelse ($tasks as $item)
    <div class="col-md-3 col-sm-12">
        <div class="card">
            @if($item->status != 'Completed')
            <div class="card-header">
                <a href="{{ url('client/tasks', $item->id) }}/edit" class="float-right"><i class="icon-pencil"></i></a>
            </div>
            @endif
            <div class="card-body">
                <table class="table table-borderless">
                    @if ($item->status == null && $item->due_date < date('Y-m-d'))
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>Task Overdue</td>
                    </tr>
                    @elseif($item->status != null && $item->due_date < date('Y-m-d'))
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>{{ $item->status }} &mdash; Task Overdue</td>
                    </tr>
                    @else
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>{{ $item->status ?? 'Pending' }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Title</strong></td>
                        <td>{{ $item->title }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>Description</strong>
                            <br>
                            {{ $item->description }}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Attach File</strong></td>
                        <td><a href="{{ $item->document_file }}" target="_blank">Download File</a></td>
                    </tr>
                    <tr>
                        <td><strong>Assigned User</strong></td>
                        <td>{{ isset($item->assign) ? $item->assign->fullname : '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Due Date</strong></td>
                        <td>{{ $item->due_date_display }}</td>
                    </tr>
                    <tr>
                        <td><strong>Completed Date</strong></td>
                        <td>{{ $item->completed_date_display }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @empty
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h4>No data available</h4>
                </div>
            </div>
        </div>
    </div>
    @endforelse
</div>
<div class="d-flex justify-content-between my-3">
    <h4>Proposal Expenses</h4>
    @if ($proposal->status == 'Approved')
    <div class="">
        <a href="{{ url('client/expenses/create') }}?proposal_id={{ $proposal->id }}" class="btn btn-outline-primary">Add New Expenses</a>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped my-4 w-100" id="expenses-table">
                    <thead>
                        <tr>
                            <th style="width: 3%" class="text-center">#</th>
                            <th style="width: 15%">Name</th>
                            <th style="width: 10%">Document File</th>
                            <th style="width: 10%">Propose Amount</th>
                            <th style="width: 30%">Remarks</th>
                            <th style="width: 10%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td><a href="{{ $item->document_file }}" class="btn btn-sm btn-outline-primary" target="_blank" {{ !isset($item->document_file) ? 'disabled' : '' }}><i class="fa fa-download"></i> Download</a></td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->remarks }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-secondary" data-toggle="dropdown">Action</button>
                                    <div class="dropdown-menu animated pulse" role="menu">
                                        <a class="dropdown-item" href="{{ url('client/expenses', $item->id) }}/edit">Edit</a>
                                        <a class="dropdown-item" href="javascript:;" onclick="deleteExpenses({{ $item->id }})">Delete</a>
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
    $("#expenses-table").DataTable({
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

function deleteExpenses(id) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this expenses!",
        icon: "warning",
        buttons: { cancel: !0, confirm: { text: "Yes, delete it!", value: !0, visible: !0, className: "bg-danger", closeModal: !0 } },
    }).then(function (e) {
        if(e) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('client/expenses') }}/"+id,
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