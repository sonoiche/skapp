@extends('layouts.app', ['page' => ['name' => 'Assigned Tasks']])
@section('content')
<div class="d-flex justify-content-end my-3"></div>
<div class="row">
    @forelse ($tasks as $item)
    <div class="col-md-3 col-sm-12">
        <div class="card">
            <div class="card-header">
                @if ($item->status == null || $item->status != 'Completed')
                <div class="btn-group float-right">
                    <a href="javascript:;" data-toggle="dropdown"><i class="icon-arrow-down"></i></a>
                    <div class="dropdown-menu animated pulse" role="menu">
                        @if ($item->status == null)
                        <a class="dropdown-item" href="{{ url('client/tasks', $item->id) }}?type=in_progress">In Progress</a>
                        @endif
                        <a class="dropdown-item" href="{{ url('client/tasks', $item->id) }}?type=complete">Complete</a>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    @if ($item->status == null && $item->due_date < date('Y-m-d'))
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>Task Overdue</td>
                    </tr>
                    @elseif($item->status != null && $item->status != 'Completed' && $item->due_date < date('Y-m-d'))
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
@endsection