@extends('layouts.app', ['page' => ['name' => 'Dashboard']])
@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-primary-dark justify-content-center rounded-left"><em class="icon-cloud-upload fa-3x"></em></div>
            <div class="col-8 py-3 bg-primary rounded-right">
                <div class="h2 mt-0">1700</div>
                <div class="text-uppercase">Uploads</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-purple-dark justify-content-center rounded-left"><em class="icon-globe fa-3x"></em></div>
            <div class="col-8 py-3 bg-purple rounded-right">
                <div class="h2 mt-0">700<small>GB</small></div>
                <div class="text-uppercase">Quota</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-green-dark justify-content-center rounded-left"><em class="icon-bubbles fa-3x"></em></div>
            <div class="col-8 py-3 bg-green rounded-right">
                <div class="h2 mt-0">500</div>
                <div class="text-uppercase">Reviews</div>
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
@endsection
