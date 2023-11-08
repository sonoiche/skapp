@extends('layouts.app', ['page' => ['name' => 'Dashboard']])
@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-primary-dark justify-content-center rounded-left"><em class="icon-cloud-upload fa-3x"></em></div>
            <div class="col-8 py-3 bg-primary rounded-right">
                <div class="h2 mt-0">{{ $activeProposalCount }}</div>
                <div class="text-uppercase">Active Proposals</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-purple-dark justify-content-center rounded-left"><em class="icon-globe fa-3x"></em></div>
            <div class="col-8 py-3 bg-purple rounded-right">
                <div class="h2 mt-0">{{ $myProposalCount }}</div>
                <div class="text-uppercase">My Proposals</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-green-dark justify-content-center rounded-left"><em class="icon-bubbles fa-3x"></em></div>
            <div class="col-8 py-3 bg-green rounded-right">
                <div class="h2 mt-0">{{ $assignedTaskCount }}</div>
                <div class="text-uppercase">Assigned Tasks</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12">
        <!-- START date widget-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-green justify-content-center rounded-left">
                <div class="text-center">
                    <!-- See formats: https://docs.angularjs.org/api/ng/filter/date-->
                    <div class="text-sm" data-now="" data-format="MMMM"></div>
                    <br />
                    <div class="h2 mt-0" data-now="" data-format="D"></div>
                </div>
            </div>
            <div class="col-8 py-3 rounded-right">
                <div class="text-uppercase" data-now="" data-format="dddd"></div>
                <br />
                <div class="h2 mt-0" data-now="" data-format="h:mm"></div>
                <div class="text-muted text-sm" data-now="" data-format="a"></div>
            </div>
        </div>
        <!-- END date widget-->
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @if (auth()->user()->role == 'Admin')
                <h3 class="card-title">Tasks Due Soon</h3>
                @else
                <h3 class="card-title">Assigned Task Due Soon</h3>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Document File</th>
                            <th>Created By</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if (isset($item->document_file))
                                <a href="{{ $item->document_file }}" target="_blank">Download File</a>
                                @endif
                            </td>
                            <td>{{ isset($item->user) ? $item->user->fullname : '' }}</td>
                            <td>{{ $item->due_date_display }}</td>
                            <td>{{ $item->status }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No tasks due on the next 3 days</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
