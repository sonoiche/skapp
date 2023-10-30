@extends('layouts.app', ['page' => ['name' => 'Finances Report']])
@section('content')
<form action="{{ url('client/reports/finance') }}" method="post">
    @csrf
    <div class="d-flex my-3">
        <div class="w-25 mr-3">
            <div class="input-group date" id="datetimepicker1">
                <input class="form-control daterange" type="text" name="daterange" value="{{ $datefield ?? '' }}" />
                <span class="input-group-append input-group-addon">
                    <span class="input-group-text fas fa-calendar-alt"></span>
                </span>
            </div>
        </div>
        <div class="w-25 mr-3">
            <select class="form-control select2-hidden-accessible" id="select2-1" data-select2-id="select2-1" tabindex="-1" aria-hidden="true">
                <option value="">All Proposal</option>
                @foreach ($proposals as $item)
                <option value="{{ $item->id }}" {{ (isset($proposal_id) && $proposal_id == $item->id) ? 'selected' : '' }}>{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="d-flex align-items-center">
            <button class="btn btn-primary" type="submit">Generate Report</button>
        </div>
    </div>
</form>
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
                            <th style="width: 10%">Date Created</th>
                            <th style="width: 15%">Proposal</th>
                            <th style="width: 20%">Name</th>
                            <th style="width: 15%">Document File</th>
                            <th style="width: 15%">Amount</th>
                            <th style="width: 10%">Created By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($finances as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $item->created_at_display }}</td>
                            <td>{{ $item->proposal->title ?? '' }}</td>
                            <td>{{ $item->name }}</td>
                            <td><a href="{{ $item->document_file }}" target="_blank">{{ basename($item->document_file) }}</a></td>
                            <td>{{ number_format($item->amount, 2) }}</td>
                            <td>{{ $item->user->fullname ?? '' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No data available</td>
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
<script src="{{ url('assets/vendor/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ url('vendor/moment/moment.min.js') }}"></script>
<script src="{{ url('vendor/daterangepicker/daterangepicker.js') }}"></script>
<script>
$(document).ready(function () {
    $('.daterange').daterangepicker({
        ranges: {
            Today: [moment(), moment()],
            Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        <?php if(!isset($datefield)): ?>
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
        <?php endif; ?>
    });
    
    $("#select2-1").select2({theme:"bootstrap4"})
});
</script>
@endsection