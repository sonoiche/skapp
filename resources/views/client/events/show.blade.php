@extends('layouts.app', ['page' => ['name' => $event->title]])
@section('content')
<div class="row">
    <div class="col-md-9 col-sm-12">
        <div class="card">
            <div class="row row-flush">
                <div class="col-5 d-flex align-items-center justify-content-center" style="background: url({{ $event->photo }}); background-size: cover;"></div>
                <div class="col-7">
                    <div class="p-3">
                        <div class="float-right"><a class="btn btn-outline-primary btn-sm" href="{{ url('client/events', $event->id) }}/edit"><i class="fa fa-pencil-alt fa-fw"></i> &nbsp; Edit</a></div>
                        <div class="d-flex">
                            @if($event->date_from != $event->date_to)
                            <p><span class="text-lg">{{ $event->schedule_from[1] }}</span>{{ $event->schedule_from[0] }}</p>
                            <div class="d-flex justify-content-center align-items-center" style="width: 10%">
                                &mdash;
                            </div>
                            <p><span class="text-lg">{{ $event->schedule_to[1] }}</span>{{ $event->schedule_from[0] }}</p>
                            @else
                            <p><span class="text-lg">{{ $event->schedule_from[1] }}</span>{{ $event->schedule_from[0] }}</p>
                            @endif
                        </div>
                        <p><strong>{{ strtoupper($event->title) }}</strong></p>
                        <div style="height: 20px"></div>
                        <p><strong>EVENT REQUIREMENTS</strong></p>
                        <p>{!! $event->description !!}</p>
                        <div style="height: 10px"></div>
                        <p><strong>EVENT GOALS</strong></p>
                        <p>{!! $event->event_goal !!}</p>
                        <div style="height: 10px"></div>
                        <p><strong>EVENT LOCATION</strong></p>
                        <p>{{ $event->location }}</p>
                    </div>
                </div>
            </div>
            <!-- END card-->
        </div>
    </div>
</div>
@endsection