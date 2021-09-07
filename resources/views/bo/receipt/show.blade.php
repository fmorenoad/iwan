@extends('layouts.app', ['activePage' => $activePage, 'activeButton' => $activeButton, 'title' => $title, 'navName' => $navName])

@section('content')
    <div class="content">
        <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0">{{ __($title) }}</h3>
                                <a href="{{route('receipt.create')}}" class="btn btn-primary btn-fill pull-right"><i class="w3-xxlarge fa fa-plus"></i>{{ __('reception') }}</a>
                            </div>
                            <div class="card-body">
                                @include('bo.receipt.receipt')
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">{{ __('Sampling') }}</h5>
                            </div>
                            <div class="card-body">
                                @include('bo.receipt.sampling')
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">{{ __('Dump Truck') }}</h5>
                            </div>
                            <div class="card-body">
                                @include('bo.receipt.dump-truck')
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">{{ __('Check Out') }}</h5>
                            </div>
                            <div class="card-body">
                                @include('bo.receipt.check-out')
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
