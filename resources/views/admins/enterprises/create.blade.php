@extends('layouts.app', ['activePage' => $activePage, 'activeButton' => $activeButton, 'title' => $title, 'navName' => $navName])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="section-image">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0">{{ __($title) }}</h3>
                                <a href="{{route('enterprises.index')}}" class="btn btn-secondary btn-fill pull-right"><i class="w3-xxlarge fa fa-arrow-left"></i>{{ __('Return') }}</a>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('enterprises.store')}}" class="form-horizontal">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="dni">{{__('DNI')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="dni" id="dni" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" id="name" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-2 control-label" for="description">{{__('description')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="description" id="description" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-info btn-fill pull-right" type="submit">{{ __('Save') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
